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
        <?php echo Yii::t('Index', 'YouAreLoggedInAs')."<br/>
            <strong>".Yii::app()->user->tokenCustomer->name."</strong>";
         ?>
    </p>