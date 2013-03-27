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
            $company->form_step = $this->getFormStep();

            // Form validation (step 1)
            if(isset($_POST['TokenKey'])){
                $token->attributes=$_POST['TokenKey'];
                $token->scenario = 'validTokenKey';
                
                if($token->validate()){
                    $controller->redirect(array('create','token_key'=>$token->token_key));
                }
            }
            elseif(isset($_GET['token_key'])){
                $token->token_key=$_GET['token_key'];
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
                    'costBenefitCalculation'=>$costBenefitCalculation,
                    'costBenefitItem_turnover'=>$costBenefitItem_turnover,
                    'costBenefitItem_salaries'=>$costBenefitItem_salaries,
                    'costBenefitItem_expenses'=>$costBenefitItem_expenses,
                    'costBenefitItem_loans'=>$costBenefitItem_loans,
                    'costBenefitItem_rents'=>$costBenefitItem_rents,
                    'costBenefitItem_communication'=>$costBenefitItem_communication,
                    'costBenefitItem_health'=>$costBenefitItem_health,
            ));
    }
    
    /**
     * Gets current form step
     */
    private function getFormStep(){
        $form_step = 1;
        
        if(isset($_GET['token_key'])){
            $token = @mysql_real_escape_string($_GET['token_key']);
            
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
