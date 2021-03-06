<?php
/**
 * Creates a new model.
 * If creation is successful, the browser will be redirected to the 'view' page.
 */
class CreateAction extends CAction
{
    public function run()
    {
        // TODO: refactor the code (cut into subclassess / methods)
            $controller=$this->getController();
            
            $company=new Company;
            $industry=new Industry;
            $token=new TokenKey;
            
            // Cost-benefit calculation
            $costBenefitCalculation = new CostbenefitCalculation;
            $costBenefitItem_turnover = new CostbenefitItem;
            $costBenefitItem_expenses = new CostbenefitItem;
            $costBenefitItem_salaries = new CostbenefitItem;
            $costBenefitItem_sideExpenses = new CostbenefitItem;
            $costBenefitItem_loans = new CostbenefitItem;
            $costBenefitItem_rents = new CostbenefitItem;
            $costBenefitItem_communication = new CostbenefitItem;
            $costBenefitItem_health = new CostbenefitItem;    
            $costBenefitItem_other = new CostbenefitItem;    

            // Decide the form step
            $company->form_step = $this->getFormStep();

            // Form validation (step 1)
            if(isset($_POST['TokenKey'])){
                $token->attributes=$_POST['TokenKey'];
                $token->scenario = 'validTokenKey';
                
                if($token->validate() AND $company->form_step==1){
                    $controller->redirect(array('create','token_key'=>$token->token_key));
                }
            }
            elseif(isset($_GET['token_key'])){
                $token->token_key=addslashes($_GET['token_key']);
            }

            // Company validation (step 2)
            if(isset($_POST['Company']) AND isset($_POST['CostbenefitItem']))
            {
                $company->attributes=$_POST['Company'];
                
                // Get token key id
                $tokenKey = TokenKey::model()->find(
                    array('select'=>'id, token_customer_id'
                    , 'condition'=>'token_key=:token_key'
                    , 'params'=>array(':token_key'=>$token->token_key),
                ));
                $company->token_key_id = $tokenKey->id;
                
                // Create company tag
                $tokenCustomer = TokenCustomer::model()->find(
                        array('select'=>'tag'
                            , 'condition'=>'id=:token_customer_id'
                            , 'params'=>array(':token_customer_id'=>$tokenKey->token_customer_id),
                ));
                $customer_tag = $tokenCustomer->tag;
                
                $CommonServices = new CommonServices();
                $company->tag = $customer_tag."_".$CommonServices->createTagFromName($company->name);
                // Create business ID
                $company->business_id = CommonServices::createBusinessID();
                             
                // Cost-benefit calculation
                //$costBenefitCalculation->attributes = new CostbenefitCalculation;
                $costBenefitItem_turnover->attributes = $_POST['CostbenefitItem']['turnover'];
                $costBenefitItem_expenses->attributes = $_POST['CostbenefitItem']['expenses'];
                $costBenefitItem_salaries->attributes = $_POST['CostbenefitItem']['salaries'];
                $costBenefitItem_sideExpenses->attributes = $_POST['CostbenefitItem']['sideExpenses'];
                $costBenefitItem_loans->attributes = $_POST['CostbenefitItem']['loans'];
                $costBenefitItem_rents->attributes = $_POST['CostbenefitItem']['rents'];
                $costBenefitItem_communication->attributes = $_POST['CostbenefitItem']['communication'];
                $costBenefitItem_health->attributes = $_POST['CostbenefitItem']['health'];
                $costBenefitItem_other->attributes = $_POST['CostbenefitItem']['other'];
                
                // Validate all models
                $modelsValid = $company->validate()
                    AND $costBenefitItem_turnover->validate()
                    AND $costBenefitItem_expenses->validate()
                    AND $costBenefitItem_salaries->validate()
                    AND $costBenefitItem_sideExpenses->validate()
                    AND $costBenefitItem_loans->validate()
                    AND $costBenefitItem_rents->validate()
                    AND $costBenefitItem_communication->validate()
                    AND $costBenefitItem_health->validate()
                    AND $costBenefitItem_other->validate();
                
                if($modelsValid)
                {
                    // Start transaction
                    $transaction = Yii::app()->db->beginTransaction();
                    
                    // Save company
                    $companySuccess = $company->save();
                    $tokenKeySuccess = $tokenKey->save();
                    
                    // Save cost-benefit calculation
                    $costBenefitCalculation->company_id = $company->id;
                    $CBCSuccess = $costBenefitCalculation->save();

                    // Save cost-benefit items
                    // TODO: get type id:s from somewhere
                    $costBenefitItem_turnover->costbenefit_calculation_id = $costBenefitCalculation->id;
                    $costBenefitItem_turnover->costbenefit_item_type_id = 1;
                    $CBCSuccess = $costBenefitItem_turnover->save() AND $CBCSuccess;
                    
                    $costBenefitItem_salaries->costbenefit_calculation_id = $costBenefitCalculation->id;
                    $costBenefitItem_salaries->costbenefit_item_type_id = 2;
                    $CBCSuccess = $costBenefitItem_salaries->save() AND $CBCSuccess;
                    
                    $costBenefitItem_expenses->costbenefit_calculation_id = $costBenefitCalculation->id;
                    $costBenefitItem_expenses->costbenefit_item_type_id = 3;
                    $CBCSuccess = $costBenefitItem_expenses->save() AND $CBCSuccess;
                    
                    $costBenefitItem_loans->costbenefit_calculation_id = $costBenefitCalculation->id;
                    $costBenefitItem_loans->costbenefit_item_type_id = 4;
                    $CBCSuccess = $costBenefitItem_loans->save() AND $CBCSuccess;
                    
                    $costBenefitItem_rents->costbenefit_calculation_id = $costBenefitCalculation->id;
                    $costBenefitItem_rents->costbenefit_item_type_id = 5;
                    $CBCSuccess = $costBenefitItem_rents->save() AND $CBCSuccess;
                    
                    $costBenefitItem_communication->costbenefit_calculation_id = $costBenefitCalculation->id;
                    $costBenefitItem_communication->costbenefit_item_type_id = 6;
                    $CBCSuccess = $costBenefitItem_communication->save() AND $CBCSuccess;
                    
                    $costBenefitItem_health->costbenefit_calculation_id = $costBenefitCalculation->id;
                    $costBenefitItem_health->costbenefit_item_type_id = 7;
                    $CBCSuccess = $costBenefitItem_health->save() AND $CBCSuccess;
                    
                    $costBenefitItem_sideExpenses->costbenefit_calculation_id = $costBenefitCalculation->id;
                    $costBenefitItem_sideExpenses->costbenefit_item_type_id = 8;
                    $CBCSuccess = $costBenefitItem_sideExpenses->save() AND $CBCSuccess;
                    
                    $costBenefitItem_other->costbenefit_calculation_id = $costBenefitCalculation->id;
                    $costBenefitItem_other->costbenefit_item_type_id = 9;
                    $CBCSuccess = $costBenefitItem_other->save() AND $CBCSuccess;
                    
                    // Commit or rollback
                    $allSuccessful = $companySuccess AND $CBCSuccess;
                    if($allSuccessful){
                        $transaction->commit();
                        
                        $email = $company->email;                   
                        
                        /* 
                         * Create bank user, profile and account
                         */
                        
                        // Create bank user
                        $bankUser = new BankUser();
                        $bankUser->username = $company->tag;
                        $bankUser->email = $company->email;
                        $bankPassword = CommonServices::generatePassword();
                        $bankUser->password = hash('sha512', $bankPassword);
                        $bankUser->status = 1;
                        
                         // Start transaction
                        $bankTransaction = Yii::app()->dbbank->beginTransaction();
                        $bankSuccess = $bankUser->save();
                        
                        // Create bank profile
                        $bankProfile = new BankProfile();
                        $bankProfile->user_id = $bankUser->id;
                        $bankProfile->company = $company->name;
                        $bankSuccess = $bankProfile->save() AND $bankSuccess;
                        
                        // Create bank account
                        $bankAccount = new BankAccount();
                        $branchCode = 970300; // TODO: get branch number from conf
                        $bban = BBANComponent::generateFinnishBBANaccount($branchCode);
                        $bbanAccountNumber = substr($bban, -6);
                        $bankAccount->iban = IBANComponent::generateFinnishIBANaccount($branchCode,$bbanAccountNumber); 
                        $bankAccount->name = "Checking account";
                        $bankAccount->bank_user_id = $bankUser->id;
                        $bankSuccess = $bankAccount->save() AND $bankSuccess;

                        if($bankSuccess){
                            $bankTransaction->commit();
                            
                            // Create OpenERP database
                            $OERPPassword = CommonServices::generatePassword();
                            $cmd = " '$company->tag' '$company->name' '$OERPPassword' '$company->business_id' '$email' '$bankAccount->iban'";
                            $shellCmd = escapeshellcmd($cmd);
                            $scriptFile = Yii::app()->basePath."/commands/shell/createOpenERPCompany.sh";
                            $output = exec("sh ".$scriptFile.$shellCmd);
                        
                            // Send login information to user
                            $messageContent = "<h1>".Yii::t('Company', 'WelcomeToFuturality')."</h1>";

                            $messageContent .= "<p>";
                                $messageContent .= Yii::t('Company', 'YouHaveCreatedACompanyInThe')."<br/>";
                                $messageContent .= "<a href='https://futurality.fi'>".Yii::t('Company', 'FuturalityLearningEnvironment')."</a>";
                            $messageContent .= "</p>";

                            $messageContent .= "<p>";
                                $messageContent .= Yii::t('Company', 'YourCompanyNameIs');
                                $messageContent .= " <strong>".$company->name."</strong>.<br/>";
                                $messageContent .= Yii::t('Company', 'YourCompanyTagIs');
                                $messageContent .= " <strong>".$company->tag."</strong>.<br>";
                                $messageContent .= Yii::t('Company', 'YourBusinessIdIs');
                                $messageContent .= " <strong>".$company->business_id."</strong>.<br>";
                            $messageContent .= "</p>";

                            $messageContent .= "<h2>".Yii::t('Company', 'OpenERPAccount')."</h2>";
                            $messageContent .= "<ul>";
                                $messageContent .= "<li>".Yii::t('Company', 'UserId').": <strong>admin</strong></li>";
                                $messageContent .= "<li>".Yii::t('Company', 'Password').": <strong>$OERPPassword</strong></li>";
                                $messageContent .= "<li>".Yii::t('Company', 'LoginFrom')." <a href='http://erp.futurality.fi/?db=$company->tag'>erp.futurality.fi</a></li>";
                            $messageContent .= "</ul>";

                            $messageContent .= "<h2>".Yii::t('Company', 'BankAccount')."</h2>";
                            $messageContent .= "<ul>";
                                $messageContent .= "<li>".Yii::t('Company', 'UserId').": <strong>$company->tag</strong></li>";
                                $messageContent .= "<li>".Yii::t('Company', 'Password').": <strong>$bankPassword</strong></li>";
                                $messageContent .= "<li>".Yii::t('Company', 'LoginFrom')." <a href='http://futurality.fi/bank/index.php/user/login/?company=$company->tag'>futurality.fi/bank</a></li>";
                            $messageContent .= "</ul>";

                            $messageContent .= "<p><strong>".Yii::t('Company', "HaveFun")."</strong></p>";
                            
                            $messageContent .= "<p>---</p>";
                            $messageContent .= "<p><a href='http://futurable.fi'>Futurable Oy</a><br/>".date('Y')."</p>";

                            $message = new YiiMailMessage;
                            $message->subject = Yii::t('Company', "FuturalityAccount");
                            $message->setBody($messageContent, 'text/html');
                            $message->addTo($email, $company->name);
                            $message->addTo('webadmin@futurable.fi');
                            $message->from = 'helpdesk@futurality.fi';
                            $message->sender = 'helpdesk@futurality.fi';
                            
                            Yii::app()->mail->send($message);

                            // Redirect to view
                            $controller->redirect(array('view','id'=>$company->id));
                        }
                        else{
                            $bankTransaction->rollback ();
                        }
                    }
                    else{
                        $transaction->rollback();
                    }
                    
                }
                
            }

            $controller->render('create',array(
                    'company'=>$company,
                    'industry'=>$industry,
                    'token'=>$token,
                    'costBenefitCalculation'=>$costBenefitCalculation,
                    'costBenefitItem_turnover'=>$costBenefitItem_turnover,
                    'costBenefitItem_expenses'=>$costBenefitItem_expenses,    
                    'costBenefitItem_salaries'=>$costBenefitItem_salaries,
                    'costBenefitItem_sideExpenses'=>$costBenefitItem_sideExpenses,
                    'costBenefitItem_loans'=>$costBenefitItem_loans,
                    'costBenefitItem_rents'=>$costBenefitItem_rents,
                    'costBenefitItem_communication'=>$costBenefitItem_communication,
                    'costBenefitItem_health'=>$costBenefitItem_health,
                    'costBenefitItem_other'=>$costBenefitItem_other,
            ));
    }
    
    /**
     * Gets current form step
     */
    private function getFormStep(){
        $form_step = 1;
        
        if(isset($_GET['token_key'])){
            # The token input will be sanitized later, this is just to be on the safe side
            $token = addslashes($_GET['token_key']);
            
            $record=TokenKey::model()->find(array(
            'select'=>'token_key, reclaim_date',
            'condition'=>'token_key=:token_key AND reclaim_date IS NULL',
            'params'=>array(':token_key'=>$token),
            ));

            if($record !== null){
                $form_step=2;
            }
            else {
                $form_step=1;
            }
        }
            
        return $form_step;
    }
}
?>
