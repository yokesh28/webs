<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page'=>array(
						'class'=>'CViewAction',
				),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'


		$month=Month::model()->findByAttributes(array('month'=>'January'));

		$val=array();
		foreach($month->users as $user)
		{

			$values[]= array('name' => $user->name, 'data' => array((int)$user->a,(int) $user->b,(int)$user->c));


		}

			

		$this->render('index',array('value'=>$values));
	}

	public function actionBar(){

		$month=Month::model()->findByAttributes(array('id'=>(int)$_REQUEST['month']));


		$val=array();
		foreach($month->users as $user)
		{

			$values[]= array('name' => $user->name, 'data' => array((int)$user->a,(int) $user->b,(int)$user->c));


		}

		$this->renderPartial('bar',array('type'=>$_REQUEST['barTyp'],'value'=>$values),false,true);
	}

	public function actionDropbox(){


		$dropbox = Yii::app()->dropbox;

		//First step. Connect to dropbox
		$request = $dropbox->getRequestToken();
		Yii::app()->session->add('request', $request); //Save this tokens
		$link = $dropbox->getAuthorizeLink(); //Show this link to user

		
		/**
		 * This code from callback function
		 */
		$dropbox->setToken(Yii::app()->session->get('request')); // Set request tokens
	//	$tokens = $dropbox->getAccessToken(); // get Access tokens
	//	Yii::app()->session->add('dropbox', $tokens); //save request tokens. It's tokens we can save in db and use

		/**
		 * if we get access tokens from database or other storage, we must set tokens by:   *
		 */
//		$dropbox->setToken($tokens);

		/**
		 * Now we can use API methods
		 */
	//	$dropbox->getAccountInfo();
		$dropbox->getFile('path/to/file');
		$dropbox->putFile('path/to/file', 'path/to/file/on/server');

		$this->render('dropbox');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
						"Reply-To: {$model->email}\r\n".
						"MIME-Version: 1.0\r\n".
						"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}