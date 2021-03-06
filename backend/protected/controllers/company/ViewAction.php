<?php
class ViewAction extends CAction
{
    public function run($id)
    {
        $controller=$this->getController();
        $controller->allowUser(STUDENT);
        $role = Yii::app()->user->isGuest ? null : $role = Yii::app()->user->getRole();
        
        // Only allow own companies for students
        if($role===0){
            $user = User::model()->findByPK(Yii::app()->user->id);
            $company = Company::model()->findByAttributes( array('tag'=>$user->username) );
        }
        else{
            $company = $controller->loadModel($id);
        }
        
        $action = isset($_GET['action']) ? $_GET['action'] : 'info';
        $bankUser = BankUser::model()->findByAttributes(array('username'=>$company->tag));
        
        $newRemark=new Remark;
        $newRemark->company_id = $company->id; 
        if(isset($_POST['Remark'])){
            $controller->allowUser(MANAGER);
            $newRemark->attributes=$_POST['Remark'];
            $newRemark->event_date = date('Y-m-d', strtotime($newRemark->event_date));
            if($newRemark->validate()){
                $newRemark->save();
                $controller->redirect(array('','id'=>$company->id,'action'=>'remarks'));
            }
        }

        // Format variables
        $automatedOrders = null;
        $costBenefitCalculationsArray = null;
        $realizedItemsArray = null;
        $bankAccounts = null;
        $OEHrEmployees = null;
        $OEHrTimesheets = null;
        $OEHrTimecards = null;
        $OESaleOrders = null;
        $OEPurchaseOrders = null;
        $remarks = null;
        $CustomerPayments = null;
        
        // Change OpenERP-database
        Yii::app()->dbopenerp->setActive(false);
        Yii::app()->dbopenerp->connectionString = "pgsql:host=erp.futurality.fi;dbname={$company->tag}";
        Yii::app()->dbopenerp->setActive(true);
        
        if($action=='bankAccounts' OR $action=='costBenefitCalculation' OR $action=='CustomerPayments'){
            $bankAccounts = BankAccount::model()->findAll(
                array(
                    'condition'=>'bank_user_id=:bank_user_id', 
                    'params'=>array('bank_user_id'=>$bankUser->id),
                )
            );
            
            $bankAccountsString = null;
            foreach($bankAccounts as $bankAccount){
                  $bankAccountsString .= "'".$bankAccount->iban."',";
            }
            $bankAccountsString = substr($bankAccountsString,0,-1);
        }
        
        if($action=='costBenefitCalculation'){
            $costBenefitCalculations = CostbenefitCalculation::model()->findAllByAttributes(array('company_id'=>$company->id));
            $costBenefitCalculationsArray = array();
            foreach($costBenefitCalculations as $costBenefitCalculation){
                $costBenefitCalculationsArray[ $costBenefitCalculation->id ][ 'create_date' ] = date('d.m.Y', strtotime($costBenefitCalculation->create_date));
                
                foreach($costBenefitCalculation->costbenefitItems as $CBCItem){
                    $key = $CBCItem->costbenefitItemType->name;
                    $costBenefitCalculationsArray[ $costBenefitCalculation->id ][ $key ] = $CBCItem;
                };
                // Add side expenses to the salaries
                $costBenefitCalculationsArray[ $costBenefitCalculation->id ][ 'salaries' ]->value += $costBenefitCalculationsArray[ $costBenefitCalculation->id ][ 'sideExpenses' ]->value;
            }
   
            $realizedItemsArray = GetRealizedJournalValues::run();
        }
        
        elseif($action=='employees'){
            $criteria = new CDbCriteria();
            //$criteria->select = 'SUM("purchaseOrdersCreated"."id") AS purchaseOrdersCreated';
            $criteria->alias = 'employee';
            //$criteria->with = 'resource.user.purchaseOrdersCreated';
            //$criteria->group = 'employee.id';
            $criteria->order = 'name_related ASC';
              
            $OEHrEmployees = HrEmployee::model()->findAll($criteria);
            
            // @TODO: this should be implemented into the initial query, 
            // but the active record handles the select grouping in multiple joins too fancy
            foreach($OEHrEmployees AS $OEHrEmployee){
                $uid = isset($OEHrEmployee->resource->user->id) ? $OEHrEmployee->resource->user->id : null;
                if($uid===null) continue;
                
                $criteria = new CDbCriteria();
                $criteria->select = "COUNT(create_uid) AS create_uid";
                $criteria->condition = "create_uid = {$uid}";
                
                $OEHrEmployee->purchaseOrdersCreated = PurchaseOrder::model()->find($criteria)->create_uid;
                $OEHrEmployee->saleOrdersCreated = SaleOrder::model()->find($criteria)->create_uid;
                $OEHrEmployee->accountMoveLinesCreated = AccountMoveLine::model()->find($criteria)->create_uid;
                $OEHrEmployee->productsCreated = ProductProduct::model()->find($criteria)->create_uid;
            }
        }
        
        elseif($action=='timesheets'){
            // Get timesheets
            $criteria = new CDbCriteria();
            $criteria->select = 'user_id, to_char(date, \'YYYY-WW\') AS week , SUM(unit_amount) AS "hours"';
            $criteria->addCondition( "date > now() - interval '3 months'" );
            $criteria->group = '"week", user_id';
            $criteria->order = 'user_id, "week" DESC';
            $OEHrTimesheets = AccountAnalyticLine::model()->findAll($criteria); 
        }
        
        elseif($action=='timecards'){
            $query =
            "SELECT
            duration.create_uid
            , duration.login_date
            , duration.logout_date
            , EXTRACT(EPOCH FROM (duration.logout_date - duration.login_date)) AS duration
            FROM
            (
                SELECT a.create_uid, a.create_date as logout_date, 
                    ( 	
                    SELECT MAX(b.create_date) 
                    FROM hr_attendance b 
                    WHERE b.create_date < a.create_date 
                    AND b.create_uid = a.create_uid 
                    AND b.action = 'sign_in'
                    ) AS login_date    
                FROM hr_attendance a 
                WHERE a.action = 'sign_out'
            ) duration
            ORDER BY duration.login_date";

            $AttendanceRecords = Yii::app()->dbopenerp->createCommand($query)->queryAll();
            
            $OEHrTimecards = array();
            foreach($AttendanceRecords as $AttendanceRecord){
                $OEHrTimecards[$AttendanceRecord['create_uid']][] = $AttendanceRecord;
            }
        }
       
        elseif($action=='saleOrders'){
            $OESaleOrders = SaleOrder::model()->findAll(array('order'=>'create_date DESC'));
        }
        
        elseif($action=='purchaseOrders'){
            $OEPurchaseOrders = PurchaseOrder::model()->findAll(array('order'=>'create_date DESC'));
        }
        
        elseif($action=='remarks'){
            $remarks = Remark::model()->findAll(array('condition'=>"company_id={$company->id}"));
        }
        
        elseif($action=='automatedOrders'){
            $controller->allowUser(MANAGER);
            
            $criteria = new CDbCriteria();
            $criteria->addCondition("company_id={$company->id}");
            $criteria->addCondition("active=1");
            $criteria->order = "event_time DESC";
            
            $automatedOrders = Order::model()->findAll($criteria);
        }

        elseif($action=='CustomerPayments'){
            $controller->allowUser(MANAGER);
            $businessCenterIban = 'FI1297030000008863'; // @TODO: get this from somewhere
            
            // Business center bank transactions
            $criteria = new CDbCriteria();
            $criteria->addCondition("status='active'");
            $criteria->addCondition("recipient_iban IN ({$bankAccountsString})");
            $criteria->addCondition("payer_iban = '{$businessCenterIban}'");
                    
            $criteria->order = "event_date DESC";
            
            $CustomerPayments = BankAccountTransaction::model()->findAll($criteria);
        }
        
        $controller->render("view",array(
            'action'=>$action,
            'company'=>$company,
            'automatedOrders'=>$automatedOrders,
            'costBenefitCalculations'=>$costBenefitCalculationsArray,
            'realizedItemsArray'=>$realizedItemsArray,
            'bankAccounts'=>$bankAccounts,
            'CustomerPayments'=>$CustomerPayments,
            'OEHrEmployees'=>$OEHrEmployees,
            'OEHrTimesheets'=>$OEHrTimesheets,
            'OEHrTimecards'=>$OEHrTimecards,
            'OESaleOrders'=>$OESaleOrders,
            'OEPurchaseOrders'=>$OEPurchaseOrders,
            'remarks'=>$remarks,
            'newRemark'=>$newRemark
        ));
    }
}
?>