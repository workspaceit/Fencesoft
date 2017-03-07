<?php

class UsersController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/layout';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('registration', 'confirmRegistration', 'login', 'forgetPassword', 'sendforgetPass', 'newPassword', 'changePassword'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update'),
                'users' => array('@'),
            ),
            /* array('allow', // allow admin user to perform 'admin' and 'delete' actions
              'actions'=>array('admin','delete'),
              'users'=>array('admin'),
              ), */
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Users;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Users');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Users('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Users']))
            $model->attributes = $_GET['Users'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Users the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Users::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Users $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionRegistration() {
        $model = new Users;
        $reply = '';

        $error = array(
            'email' => false,
            'loginname' => false,
        );
        //$helper = new Helpers();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            $error['email'] = $this->helper->checkUserEmail($_POST['Users']['user_email']);
            $error['loginname'] = $this->helper->checkUsername($_POST['Users']['login_name']);
            if (!($error['email'] || $error['loginname'])) {

                $model->site_id = $this->storeID;
                $model->user_type = 'customer';
                $model->network_type = $this->networkType;
                $model->password = md5($_POST['Users']['password']);
                $model->status = 'active';
                $model->created_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    //$this->redirect('index.php?r=index');
                    //$this->mailUserConfirmation($model);
                    $this->render('registration', array(
                        'model' => $model,
                        'reply' => $reply,
                    ));
                } else {
                    $this->render('create', array(
                        'model' => $model,
                        'reply' => 'Unable to save data -- Please try again',
                    ));
                }
            } else {
                $this->render('create', array(
                    'model' => $model,
                    'reply' => 'Email already exists',
                    'error' => $error
                ));
            }
        } else {
            $model->unsetAttributes();
            $this->render('create', array(
                'model' => $model,
                'reply' => $reply,
                'error' => $error
            ));
        }
    }

    public function actionConfirmRegistration() {
        $reply = "";
        if (isset($_GET['email']) && isset($_GET['vc'])) {
            $email = $_GET['email'];
            $vc = $_GET['vc'];
            if (substr(sha1($email), 9, 13) == $vc) {
                $user = Users::model()->find('user_email=:email', array(':email' => $email));
                $user->status = 'active';
                if ($user->save()) {
                    $reply = "Congratulations -- Your registration is complete";
                } else {
                    $reply = "Please refresh the page and try again";
                }
            }
        } else {
            $reply = "Verification code does not match -- Please try again";
        }

        $this->render('registrationConfirm', array(
            //'model'=>$model,
            'reply' => $reply,
        ));
    }

    public function actionLogin() {
        $model = new LoginForm;
        $this->layout = null;
        $reply = array(
            'status' => "",
            'message' => "",
        );
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        // collect user input data
        if (isset($_POST)) {
            $model->username = $_POST['username'];
            $model->password = $_POST['password'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                if (isset(Yii::app()->session['beforeLogin'])) {
                    $data = Yii::app()->session['beforeLogin'];
                    $reply['status'] = "success";
                        $reply["message"] = "Login successful";
                    //$this->redirect('index.php?r=index/estimation&fence_type=' . $data['fence_type'] . '&fence_id=' . $data['fence_id']);
                } else {
                    $reply['status'] = "success";
                        $reply["message"] = "Login successful";
                    //$this->redirect('index.php?r=index');
                }
            }else{
                $reply['status'] = "Failed";
                $reply["message"] = "Invalid user login credentials, please try again";
            }
           echo json_encode($reply); 
        }
        //$this->redirect('index.php?r=index/index');
        
        // display the login form
        //$this->layout='login_template';
        //$this->render('login',array('model'=>$model));
        
    }

    public function actionForgetPassword() {
        $this->layout = null;
        $this->render('forgetpass');
    }

    public function actionSendforgetPass() {
        $this->layout = null;
        $respond_str = array(
            'status' => '',
            'message' => ''
        );

        if ($_POST['username'] != "") {
            $check = $this->helper->checkUsername($_POST['username']);
            if ($check) {
                $data = Users::model()->find('login_name=:loginName', array(':loginName' => $_POST['username']));
                $respond_str['status'] = true;
                $respond_str['message'] = "Email sent -- Please check your inbox";
                $this->mailPassConfirmation($data);
            } else {
                $respond_str['status'] = false;
                $respond_str['message'] = "Username was not found";
            }
        } else if ($_POST['email'] != "") {
            $check = $this->helper->checkUserEmail($_POST['email']); {
                if ($check) {
                    $data = Users::model()->find('user_email=:email', array(':email' => $_POST['email']));
                    $respond_str['status'] = true;
                    $respond_str['message'] = "Email sent -- Please check your inbox";
                    $this->mailPassConfirmation($data);
                } else {
                    $respond_str['status'] = false;
                    $respond_str['message'] = "Email was not found";
                }
            }
        } else {
            $respond_str['status'] = false;
            $respond_str['message'] = "Please enter your Email or Username";
        }
        echo json_encode($respond_str);
    }

    public function actionChangePassword() {
        $status = "";
        $reply = "";
        if (isset($_GET['email']) && isset($_GET['passwordToken'])) {
            $email = $_GET['email'];
            $pvc = $_GET['passwordToken'];

            if (substr(sha1($email), 9, 13) == $pvc) {
                $user = Users::model()->find('user_email=:email', array(':email' => $email));
                $status = 1;
                $reply = "Please change your password";
            } else {
                $status = 2;
                $reply = "Sorry, invalid password token";
            }
        } else {
            $status = 3;

            $reply = "Invalid validation URL";
        }
        $this->render('passwordChange', array(
            'user' => $user,
            'reply' => $reply,
            'status' => $status,
        ));
    }

    public function actionNewPassword() {
        $this->layout = null;
        $reply = array(
            'status' => "",
            'message' => ""
        );
        if ($_POST['password']) {
            $email = $_GET['email'];
            $pvc = $_GET['passwordToken'];
            if (substr(sha1($email), 9, 13) == $pvc) {
                $newpassword = $_REQUEST['password'];
                $user = Users::model()->find('user_email=:email', array(':email' => $_GET['email']));
                $user->password = md5($newpassword);
                if (!empty($user)) {
                    if ($user->save()) {
                        $reply['status'] = "success";
                        $reply["message"] = "Password update was successful";
                    } else {
                        $reply['status'] = "error";
                        $reply["message"] = "Sorry, unable to update password";
                    }
                } else {
                    $reply['status'] = "error";
                    $reply["message"] = "Sorry, user was not located";
                }
            }
        } else {
            $reply['status'] = "warrning";
            $reply["message"] = "Sorry, new password not found";
        }

        echo json_encode($reply);
    }
    private function mailPassConfirmation($data) {
        $sendUrl = "";
        $domain = $_SERVER['HTTP_HOST'];
        $exp = explode('.', $domain);
        $serverUrl = "localhost";
        $verification_code = substr(sha1($data->user_email), 9, 13);
        $to = $data->user_email;

        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            $sendUrl = "localhost/index.php?r=users/changePassword&email='" . $data->user_email . "'&passwordToken='" . $verification_code;
        } else {
            $serverUrl = $exp[1] . '.' . $exp[2];
            $sendUrl = 'http://' . $exp[0] . '.' . $exp[1] . '.' . $exp[2] . '/index.php?r=users/changePassword&email=' . $data->user_email . '&passwordToken=' . $verification_code;
        }

        $subject = "FenceSoft | Password Recovery";
        $message = $data->full_name . ", to change the password for your account | ";
        $message .= "Please click the following link: " . $sendUrl . " ... then follow the on-site instructions. ";
        $message .= "Thank you, FenceSoft Management Team";
        $from = "support@" . $serverUrl;
        $headers = "From:" . $from;
        mail($to, $subject, $message, $headers);
    }

    private function mailUserConfirmation($data) {

        $verification_code = substr(sha1($data->user_email), 9, 13);
        $to = $data->user_email;
        $subject = "FenceSoft Confirm Registration";
        $message = "Thank you " . $data->full_name . ' for registration.<br />';
        $message .= "Please click <a href='http://" . $this->storeID . ".jwmdev.com/index.php?r=users/confirmRegistration&email=" . $data->user_email . "&vc=" . $verification_code . "'>here</a> to confirm your registration'";
        $message .= "<br /> <br /> Thank you";
        $from = "support@jwmdev.com";
        $headers = "From:" . $from;
        mail($to, $subject, $message, $headers);
    }

}
