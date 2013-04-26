<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php if(!Yii::app()->user->isGuest){ ?>

    <h1>Welcome to <?php echo CHtml::encode(Yii::app()->name) ;?>!</h1>

    <p>You are logged in as <?php echo Yii::app()->user->name; ?></p>
<?php
}
else $this->redirect(array('/site/login'));
?>