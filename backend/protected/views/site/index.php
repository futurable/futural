<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php 

    if(Yii::app()->user->isGuest){
        $this->redirect(array('/site/login'));
    }
?>

    <h1><?php echo CHtml::encode(Yii::app()->name) ;?></h1>

    <p>
        <?php 
            $user = User::model()->findByPK(Yii::app()->user->id);
            
            echo Yii::t('Index', 'YouAreLoggedInAs').":<br/>
            <strong>
                {$user->username},</br>
                ".Yii::app()->user->tokenCustomer->name."
            </strong>";
         ?>
    </p>