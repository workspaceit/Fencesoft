<?php

class PaymentsController extends Controller
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



	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */

	public function actionPayment() {
	    if(!Yii::app()->session['isLogin'])
	    {
	        $this->redirect("index.php?r=users/registration");
	    }
	    $quoteId = $_GET['quotes_id'];
        $model = Quotes::model()->findByPk($quoteId);
        if($model->payment_status=="pending")
        {
            $store_id = $this->storeID;

            $storeData = $this->helper->getStoreData($store_id);

            if($storeData["merchant_id"]=="" || $storeData["public_key"]=="" || (($storeData["private_key"]=="" || $storeData["clientside_key"]=="") && $storeData["payment_gateway"]=="braintree") )

                $this->render('error',array('message'=>"A problem found on Merchant Account Setup"));


           else

            {
        Yii::import('ext.BraintreeApi.models.BraintreeCCForm');
        $payment = new BraintreeCCForm('charge',$storeData["merchant_id"],$storeData["public_key"],$storeData["private_key"],$storeData["clientside_key"]); //also option for 'customer', 'address', and 'creditcard'

        //Yii::app()->params["braintree"]["merchant_id"] = $storeData["merchant_id"];

        if(isset($_POST['BraintreeCCForm']))
        {
            if($storeData["payment_gateway"]!="braintree")
            {
                if($payment->validate())
                {
            $rest=  $this->processAuthorize($storeData["merchant_id"],$storeData["public_key"]);
            if($rest==1)
            {
                $model->payment_status="partial";
                $model->save();
                $this->render('success');
                return;
            }
                }
            }

            else {



                $payment->setAttributes($_POST['BraintreeCCForm']);
                //$payment->customerId = Yii::app()->session['id']; //needed for 'address' and 'creditcard' scenarios
                if($payment->validate()) {
                    $result = $payment->send();
                    if($result) {
                        $model->payment_status="partial";
                        $model->save();
                        $this->render('success');
                        return;
                    }

                }

            }
        }
         $method = $storeData["payment_gateway"]=="braintree"?"Braintree.net":"Authorized.net";


        $customerInfo = Users::model()->findByPk(Yii::app()->session['id']);
        //var_dump($expression)
        $name= explode(" ", $customerInfo->full_name);
        $payment->customer_email = $customerInfo->user_email;
        $payment->customer_firstName = $name[0];
        $payment->customer_lastName = $name[1];
        $payment->amount = number_format($model->upfront_payment,2);
        $payment->orderId = $name[0]."-".$model->id."-".date('d-m-y h:i:s');
        $this->render('payment',array('model'=>$model,'payment'=>$payment,'method'=>$method,'customer'=>$customerInfo));
        }
        }
        else
        $this->redirect('index.php?r=index');
     }


     private function processAuthorize($merchantId,$publicKey)
     {

         Yii::import('application.vendors.*');
         require_once('authorizeAim/AuthorizeNet.php');
         define("AUTHORIZENET_SANDBOX", true);
         $sale = new AuthorizeNetAIM($merchantId,$publicKey);

            $sale->amount = $_POST['BraintreeCCForm']['amount'];
            $sale->card_num = $_POST['BraintreeCCForm']['creditCard_number'];
            $sale->exp_date = $_POST['BraintreeCCForm']['creditCard_month'].'/'.$_POST['BraintreeCCForm']['creditCard_year'];
            $response = $sale->authorizeAndCapture();

           return $response->response_code;

     }




	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Quotes the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Quotes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The Requested Page Does Not Exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Quotes $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='quotes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
