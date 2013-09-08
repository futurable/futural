<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php if(!Yii::app()->user->isGuest){ ?>

    <h1>Welcome to <?php echo CHtml::encode(Yii::app()->name) ;?>!</h1>

    <p><?php echo "You are logged in as  ".Yii::app()->user->tokenCustomer->name; ?></p>
<?php
}
else $this->redirect(array('/site/login'));
?>