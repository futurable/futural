<?php

class TokenKeyController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $this->allowUser(MANAGER);
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $this->allowUser(ADMIN);
		$model=new TokenKey;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TokenKey']))
		{
			$model->attributes=$_POST['TokenKey'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        $this->allowUser(ADMIN);
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TokenKey']))
		{
			$model->attributes=$_POST['TokenKey'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $this->allowUser(ADMIN);
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $this->allowUser(MANAGER);
        
        // Get customer id
        $customer_id = Yii::app()->user->getTokenCustomer()->id;
        
        // Get role
        $role = Yii::app()->user->getRole();

        if($role<3){
            $condition = "token_customer_id={$customer_id}";
        }
        else $condition = null;
        
		$tokenKeys= TokenKey::model()->findAll(array('condition'=>$condition, 'order'=>'create_date DESC'));
		$this->render('index',array(
			'tokenKeys'=>$tokenKeys,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
        $this->allowUser(ADMIN);
		$model=new TokenKey('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TokenKey']))
			$model->attributes=$_GET['TokenKey'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TokenKey the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TokenKey::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TokenKey $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='token-key-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
