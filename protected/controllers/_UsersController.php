<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/layout';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','registration','confirmRegistration'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
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
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
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
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionRegistration(){
		$model = new Users;
		$helper = new Helpers();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];			
			
			if(!$helper->checkUserEmail($_POST['Users']['email'])){
				
				$model->password = md5($_POST['Users']['password']);
				$model->status = 'inactive';
				$model->created_at = date('Y-m-d H:i:s');
				//$helper->dd($model);
				if($model->save(false)){
					
					$this->mailUserConfirmation($model);
					$this->render('registration',array(
						'model' => $model,
					));
				} else {
					$this->render('create',array(
					'model' => $model,
					'reply' => 'Please try again. Unable to save your data',
				));
				}
			} else {
				$this->render('create',array(
					'model' => $model,
					'reply' => 'Email Already Exists',
				));
			}
				
		}else{
			$model->unsetAttributes();
			$this->render('create',array(
					'model'=>$model,
			));
		}
		
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionConfirmRegistration(){
		$reply = "";
		if(isset($_GET['email']) && isset($_GET['vc'])){
			$email = $_GET['email'];
			$vc = $_GET['vc'];
			if(substr(sha1($email), 9, 13)==$vc){				
				$user = Users::model()->find('email=:email',array('email'=>$email));
				$user->status = 'active';
				if($user->save()){
					$reply = "Congratulation. You complete your registration";
				}else {
					$reply = "Please try again.refresh the page after some while";
				}
			}
		} else {
			$reply = "Varification code is not match.plase try again";
		}
		
		$this->render('registrationConfirm',array(
			//'model'=>$model,
			'reply' => $reply,
		));
	}
	
	public function actionLogin(){
		
	}
	
	private function mailUserConfirmation($data){
		
		$verification_code = substr(sha1($data->email), 9, 13);
		$to = $data->email;
		$subject = "FenceSoft Confirm Registration";
		$message = "Thank you " . $data->user_fname . ' ' . $data->user_lname.' for registration.<br />';
		$message .= "Please click <a href='http://www.jwmdev.com/index.php?r=users/confirmRegistration&email=".$data->email."&vc=".$verification_code."'>here</a> to confirm your registration'";
		$message .= "<br /> <br /> Thank you";
		$from = "support@jwmdev.com";
		$headers = "From:" . $from;
		mail($to, $subject, $message, $headers);
		
	}
}
