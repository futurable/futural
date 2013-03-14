<?php
/**
 * Creates a new model.
 * If creation is successful, the browser will be redirected to the 'view' page.
 */
class CreateAction extends CAction
{
    public function run()
    {
            $controller=$this->getController();
        
            $company=new Company;
            $industry=new Industry;
            $token=new TokenKey;
            
            // Cost-benefit calculation
            $costBenefitCalculation = new CostbenefitCalculation;
            $costBenefitItem_turnover = new CostbenefitItem;
            $costBenefitItem_salaries = new CostbenefitItem;
            $costBenefitItem_expenses = new CostbenefitItem;
            $costBenefitItem_loans = new CostbenefitItem;
            $costBenefitItem_rents = new CostbenefitItem;
            $costBenefitItem_communication = new CostbenefitItem;
            $costBenefitItem_health = new CostbenefitItem;    

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            // Decide the form step
            if(isset($_GET['token_key'])){
                $company->form_step = 2;
            }
            else $company->form_step = 1;

            // Form validation (step 1)
            if(isset($_POST['TokenKey'])){
                $this->validateTokenKey($controller, $token);
            }

            // Company validation (step 2)
            if(isset($_POST['Company']))
            {
                $company->attributes=$_POST['Company'];

                    if($company->save())
                            $controller->redirect(array('view','id'=>$company->id));
            }

            $controller->render('create',array(
                    'company'=>$company,
                    'industry'=>$industry,
                    'token'=>$token,
            ));
    }
    
    private function validateTokenKey($controller, $token){
        $token->attributes=$_POST['TokenKey'];

        $record=TokenKey::model()->find(array(
            'select'=>'token_key',
            'condition'=>'token_key=:token_key AND reclaim_date IS NULL',
            'params'=>array(':token_key'=>$token->token_key),
        ));
                  
        if($record===null){
            echo "Invalid token key"; //TODO: add error
        }
        else{
            $controller->redirect(array('create','token_key'=>$record->token_key));
        }
    }
}
?>
