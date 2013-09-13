<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php if(!Yii::app()->user->isGuest){ ?>

    <h1><?php echo CHtml::encode(Yii::app()->name) ;?>!</h1>

    <p><?php echo Yii::t('Index', 'YouAreLoggedInAs')." ".Yii::app()->user->tokenCustomer->name; ?></p>
<?php
}
else $this->redirect(array('/site/login'));
?>