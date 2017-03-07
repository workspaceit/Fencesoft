<?php
class IndexController extends Controller {
	
	// public $layout='layout';
	
	// Uncomment the following methods and override them if needed
	/*
	 * public function filters() { // return the filter configuration for this controller, e.g.: return array( 'inlineFilterName', array( 'class'=>'path.to.FilterClass', 'propertyName'=>'propertyValue', ), ); }
	 */
	public function actions() {
		return array (
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha' => array (
						'class' => 'CCaptchaAction',
						'backColor' => 0xFFFFFF 
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page' => array (
						'class' => 'CViewAction' 
				) 
		);
	}
	public function actionIndex() {
		$fenceType = $this->helper->getMaterialsType ();
		$categoryList = $this->helper->getMaterialCategories ( $this->siteID );
		
		$_dummySelectView = '_dummy_select_default';
		if ($this->networkType == 'active_yards') {
			$_dummySelectView = '_dummy_select_ay';
		} else if ($this->networkType == 'fencesoft') {
			$_dummySelectView = '_dummy_select_fs';
		}
		
		$dummySelectContent = $this->renderPartial ( $_dummySelectView, array (
				'categoryList' => $categoryList 
		), true, true );
		
		$this->render ( 'index', array (
				'fenceType' => $fenceType,
				'dummySelectContent' => $dummySelectContent 
		) );
	}
	public function actionGetfences() {
		$this->layout = null;
		$helper = new Helpers ();
		
		$data = $_GET;
		
		$fenceData = $this->helper->getFenceByQuery ( $data, $this->networkType, $this->siteID );
		
		$count = count ( $fenceData );
		
		echo $this->render ( 'getfences', array (
				'itemCount' => $count,
				'fences' => $fenceData 
		), true );
	}
	public function actionEstimation() {
		$selectedMaterial = array ();
		$materialPostCaps = array ();
		$materialGates = array ();
		$materialGatesLatch = array ();
		$quotesInfo = array ();
		$materialGroups = array ();
		
		if (isset ( $_GET ['fence_type'] ) && isset ( $_GET ['fence_id'] )) {
			$selectedMaterial = $this->helper->getSelectedMaterial ( $_GET ['fence_type'], $_GET ['fence_id'] );
			$materialPostCaps = $this->helper->getMaterialPostCaps ( $_GET ['fence_type'], $_GET ['fence_id'], $this->networkType );
			$materialGates = $this->helper->getMaterialGate ( $_GET ['fence_type'], $_GET ['fence_id'], $this->networkType );
			$materialGatesLatch = $this->helper->getMaterialGateLatchOptions ( $_GET ['fence_type'], $_GET ['fence_id'], $this->networkType );
			
			$materialGroups = $this->helper->getGroupMaterials ( $_GET ['fence_type'], $selectedMaterial ['group_material_id'], $this->siteID );
			
			if (isset ( $_GET ['quote_id'] )) {
				$quotesInfo = Quotes::model ()->find ( 'id=:ID', array (
						':ID' => $_GET ['quote_id'] 
				) );
			} else if (isset ( Yii::app ()->session ['beforeLogin'] )) {
				$beforeLogin = Yii::app ()->session ['beforeLogin'];
				//unset ( Yii::app ()->session ['beforeLogin'] );
				if (isset ( $beforeLogin ['quotes_data'] )) {
					$quotesInfo ['quotes_data'] = $beforeLogin ['quotes_data'];                  
				}
			}
		} else {
			$this->redirect ( array (
					'index' 
			) );
		}
        
		$storeData = $this->helper->getStoreData($this->storeID);
        //$this->helper->prd($quotesInfo);
		// $allMaterials = $this->helper->getAllMaterialByNetwork($this->networkType);
		$this->render ( 'estimation', array (
				'quotesInfo' => $quotesInfo,
				// 'allMaterials' =>$allMaterials,
				'selectedMaterial' => $selectedMaterial,
				'materialPostCaps' => $materialPostCaps,
				'materialGates' => $materialGates,
				'materialGatesLatch' => $materialGatesLatch,
				'materialGroups' => $materialGroups,
                'storeData' => $storeData
		) );
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if ($error = Yii::app ()->errorHandler->error) {
			if (Yii::app ()->request->isAjaxRequest)
				echo $error ['message'];
			else
				$this->render ( 'error', $error );
		}
	}
	public function actionLogout() {
		Yii::app ()->user->logout ();
		Yii::app ()->session->destroy ();
		
		$this->redirect ( 'index.php?r=index/index' );
	}
    public function actionDestroy() {
        
       unset(Yii::app()->session['beforeLogin']);

    }
	public function actionSaveQuotes() {
		$this->layout = null;
		
		if (Yii::app ()->session ['isLogin']) {
			if (isset ( $_POST ['quotes_data'] )) {
				
				if (isset ( $_POST ['quotes_id'] ) && ($_POST ['quotes_id'] != '')) {
					$model = Quotes::model ()->findByPk ( $_POST ['quotes_id'] );
					$model->modified_at = date ( 'Y-m-d H:i:s' );
				} else {
					$model = new Quotes ();
					$model->created_at = date ( 'Y-m-d H:i:s' );
				}
				
				$quotes_data = json_decode ( $_POST ['quotes_data'] );
				
				$model->user_id = Yii::app ()->session ['id'];
				$model->store_id = $this->storeID;
				$model->network_type = $this->networkType;
				$model->material_id = $_POST ['material_id'];
				$model->material_type = $_POST ['material_type'];
				$model->post_cap_id = (isset ( $_POST ['postcap_id'] )) ? $_POST ['postcap_id'] : "";
				$model->gate_latch_id = (isset ( $_POST ['gatelatchoption_id'] )) ? $_POST ['gatelatchoption_id'] : "";
				$model->quotes_data = json_encode ( $quotes_data );
				$model->removal_fence = $_POST['fence_removal'];
                $model->feet_removal = $_POST['feetRemoval'];
                $model->notes = $_POST['addNotes'];
				if ($model->save ()) {
					$data ['id'] = $model->id;
					$data ['type'] = 'success';
					$data ['message'] = '<strong>Success:</strong> Your Estimate Was Saved Successfully';
				} else {
					$data ['type'] = 'error';
					$data ['message'] = '<strong>Error:</strong> Oops! We Were Unable to Save the Estimate';
				}
			}
		} else {
			$data ['type'] = 'error';
			$data ['message'] = '<strong>Warning:</strong> Please Login to Your Account';
		}
		
		echo json_encode ( $data );
	}
	public function actionGetUserQuotes() {
		$this->layout = null;
		if (Yii::app ()->session ['isLogin']) {
			$quotes = Quotes::model ()->findAll ( 'user_id=:userID', array (
					':userID' => Yii::app ()->session ['id'] 
			) );
			
			echo $this->renderPartial ( 'get_user_quotes', array (
					'quotes' => $quotes 
			), true, true );
		}
	}
	public function actionGenerateQuotes() {
		if (Yii::app ()->session ['isLogin']) {
			if (isset ( $_POST ['quotes_image'] )) {
				// $this->helper->prd($_POST);
				$selectedGates = "";
				$selectedPostCaps = "";
				$selectedGatesLatch = "";
				$_pdfViewFile = '_pdf_aluminum';
				
				$quotes_id = $_POST ['quotes_id'];
				$material_type = $_POST ['quotes_material_type'];
				$material_id = $_POST ['quotes_material_id'];
				$postcap_id = $_POST ['quotes_post_cap_id'];
				$gatelatchoption_id = $_POST ['quotes_gate_latch_option_id'];
				$canvasImage = $_POST ['quotes_image'];
				$total_corner_post = $_POST ['quotes_corner_post'];
				$total_end_post = $_POST ['quotes_end_post'];
				$end_pos_gate = $_POST ['quotes_end_pos_gate'];
                $quotes_line_post = $_POST ['quotes_line_post'];
				$total_blank_post = $_POST ['quotes_blank_post'];
				$lengthList = explode ( ',', $_POST ['quotes_total_length'] );
				
				if (isset ( $_POST ['gate_id'] )) {
					foreach ( $_POST ['gate_id'] as $key => $id ) {
						$selectedGates [$key] ['details'] = Gates::model ()->find ( 'id=:id', array (
								':id' => $id 
						) );
						$selectedGates [$key] ['number'] = $_POST ['total_gate'] [$id];
						
						$total_end_post += ($_POST ['total_gate'] [$id] * 2);
					}
				}
				
				$selectedMaterial = $this->helper->getSelectedMaterial ( $material_type, $material_id );
				$materialGates = $this->helper->getMaterialGate ( $material_type, $material_id, $this->networkType );
				$storeData = $this->helper->getStoreData ( $this->storeID );
				$quotesInfo = Quotes::model()->find('id=:ID',array(':ID'=>$quotes_id));
				if (! empty ( $postcap_id )) {
					$selectedPostCaps = PostCaps::model ()->find ( 'id=:id', array (
							':id' => $postcap_id 
					) );
				}
				
				if (! empty ( $gatelatchoption_id )) {
					$selectedGatesLatch = GateLatchOptions::model ()->find ( 'id=:id', array (
							':id' => $gatelatchoption_id 
					) );
				}
				
				if (strtolower ( $material_type ) == 'aluminum') {
					$_pdfViewFile = '_pdf_aluminum';
				} else if (strtolower ( $material_type ) == 'chainlink') {
					$_pdfViewFile = '_pdf_chainlink';
				} else if (strtolower ( $material_type ) == 'vinyl') {
					$_pdfViewFile = '_pdf_vinyl';
				} else if (strtolower ( $material_type ) == 'wood') {
					$_pdfViewFile = '_pdf_wood';
				}
				
				$materialCalc = $this->renderPartial ( $_pdfViewFile, array (
						'quotes_id' => $quotes_id,
						'store_id' => $this->storeID,
						'helper' => $this->helper,
						'selectedMaterial' => $selectedMaterial,
						'selectedPostCaps' => $selectedPostCaps,
						'materialGates' => $materialGates,
						'selectedGatesLatch' => $selectedGatesLatch,
						'selectedGates' => $selectedGates,
						'total_corner_post' => $total_corner_post,
						'total_end_post' => $total_end_post,
                        'quotes_line_post' => $quotes_line_post,
						'end_pos_gate' => $end_pos_gate,
						'total_blank_post' => $total_blank_post,
						'lengthList' => $lengthList,
						'canvasImage' => $canvasImage,
						'networkInfo' => $this->networkSettings,
						'storeData' => $storeData,
                        'quotesInfo' => $quotesInfo,
				), true, true );
				
				echo $this->createQuotesPDF ( $materialCalc, $quotes_id );
			}
		} else {
			
			echo '<strong>Warning:</strong> Please Sign-Up or Login to Your Account';
		}
	}
	private function createQuotesPDF($materialCalc, $quotes_id) {
		Yii::import ( 'ext.dompdf.Pdf', true );
		
		$quotesModel = Quotes::model ()->findByPk ( $quotes_id );
		$quotesInfo = Quotes::model()->find('id=:ID',array(':ID'=>$quotes_id));
		$storeData = $this->helper->getStoreData ( $this->storeID );
		$userData = $this->helper->getUserData ( Yii::app ()->session ['id'] );
		$pdfSkelaton = "quotes_pdf_skelaton_hd";
		
		if ($this->networkType == "home_depot") {
			$pdfSkelaton = 'quotes_pdf_skelaton_hd';
		} else if ($this->networkType == "lowe's") {
			$pdfSkelaton = 'quotes_pdf_skelaton_lowes';
		} else if ($this->networkType == "active_yards") {
			$pdfSkelaton = 'quotes_pdf_skelaton_ay';
		} else if ($this->networkType == "fencesoft") {
			$pdfSkelaton = 'quotes_pdf_skelaton_fs';
		}
		
		$pdfContent = $this->renderPartial ( $pdfSkelaton, array (
				'quotes_id' => $quotes_id,
				'materialCalc' => $materialCalc,
				'storeData' => $storeData,
				'userData' => $userData,
                'quotesInfo' => $quotesInfo
		), true, true );
		
		$pdf = new Pdf ();
		$pdfName = 'quotes_' . $quotes_id . '_' . $storeData ['store_id'] . '_' . $userData ['full_name'];
		
		$pdfValue = $pdf->render ( $pdfContent, $pdfName, 1, 'a4', 'portrait', false );
		$pdfFile = Yii::app ()->basePath . '/../pdf/' . $pdfName . '.pdf';
		
		$quotesModel->pdf_file = $pdfName . '.pdf';
		;
		$quotesModel->save ();
		
		file_put_contents ( $pdfFile, $pdfValue );
		if (file_exists ( $pdfFile )) {
			header ( 'Content-Description: File Transfer' );
			header ( 'Content-Type: application/octet-stream' );
			header ( "Content-Type: application/force-download" );
			header ( 'Content-Disposition: attachment; filename=' . urlencode ( basename ( $pdfFile ) ) );
			// header('Content-Transfer-Encoding: binary');
			header ( 'Expires: 0' );
			header ( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
			header ( 'Pragma: public' );
			header ( 'Content-Length: ' . filesize ( $pdfFile ) );
			ob_clean ();
			flush ();
			readfile ( $pdfFile );
			exit ();
		}
	}
	public function actionMaterialDetails() {
		$this->layout = null;
		
		$selectedMaterial = array ();
		$materialPostCaps = array ();
		$materialGates = array ();
		$materialGatesLatch = array ();
		$materialGroups = array ();
		
		$material_type = 'aluminum';
		$_viewFile = 'details_aluminum';
		
		if (isset ( $_GET ['fence_type'] ) && isset ( $_GET ['fence_id'] )) {
			$material_type = $_GET ['fence_type'];
			$material_id = $_GET ['fence_id'];
			
			$selectedMaterial = $this->helper->getSelectedMaterial ( $_GET ['fence_type'], $_GET ['fence_id'] );
			
			if ($selectedMaterial ['is_blank'] == 1) {
				$materialGroups = $this->helper->getGroupMaterials ( $material_type, $material_id, $this->siteID );
			}
			$materialPostCaps = $this->renderPartial ( '_postcap_details', array (
					'PostCaps' => $this->helper->getMaterialPostCaps ( $_GET ['fence_type'], $_GET ['fence_id'], $this->networkType ) 
			), true, true );
			
			$materialGatesLatch = $this->renderPartial ( '_gatelatch_details', array (
					'gateLatchOptions' => $this->helper->getMaterialGateLatchOptions ( $_GET ['fence_type'], $_GET ['fence_id'], $this->networkType ) 
			), true, true );
			
			$materialSingleGates = $this->renderPartial ( '_gate_details', array (
					'gates' => Gates::model ()->findAll ( 'material=:material AND material_id=:material_id AND gate_type=:gateType AND network_type=:networkType', array (
							':material' => strtolower ( $material_type ),
							':material_id' => $material_id,
							':gateType' => 'single',
							':networkType' => $this->networkType 
					) ) 
			), true, true );
			
			$materialDoubleGates = $this->renderPartial ( '_gate_details', array (
					'gates' => Gates::model ()->findAll ( 'material=:material AND material_id=:material_id AND gate_type=:gateType AND network_type=:networkType', array (
							':material' => strtolower ( $material_type ),
							':material_id' => $material_id,
							':gateType' => 'double',
							':networkType' => $this->networkType 
					) ) 
			), true, true );
		}
		
		if (strtolower ( $material_type ) == 'aluminum') {
			$_viewFile = 'details_aluminum';
		} else if (strtolower ( $material_type ) == 'chainlink') {
			$_viewFile = 'details_chainlink';
		} else if (strtolower ( $material_type ) == 'vinyl') {
			$_viewFile = 'details_vinyl';
		} else if (strtolower ( $material_type ) == 'wood') {
			$_viewFile = 'details_wood';
		}
		
		echo $this->render ( $_viewFile, array (
				'selectedMaterial' => $selectedMaterial,
				'materialPostCaps' => $materialPostCaps,
				'materialSingleGates' => $materialSingleGates,
				'materialDoubleGates' => $materialDoubleGates,
				'materialGatesLatch' => $materialGatesLatch,
				'materialGroups' => $materialGroups 
		), true, true );
	}
	
	public function actionSetSessionWithoutLogin() {
		$data ['fence_id'] = $_POST ['fence_id'];
		$data ['fence_type'] = $_POST ['fence_type'];
		
		if (isset ( $_POST ['quotes_data'] )) {
			$data ['quotes_data'] = $_POST ['quotes_data'];
		}
		
		Yii::app ()->session ['beforeLogin'] = $data;
	}
	
	public function actionTermsAndConditions() {
        $data = Sites::model ()->find ( 'id=:id', array(':id' => $this->siteID));		
		$this->render ( 'terms-conditions', array (
				'data' => $data 
		));
	}
    public function actionCheckUserByEmailAndUsername(){
	    $this->layout = null;
	    $email = $_REQUEST['email'];
	    $username = $_REQUEST['username'];
	    
	    $reply['email'] = ($this->helper->checkUserEmail($email)) ? '1' : '0';
	    $reply['username'] = ($this->helper->checkUsername($username)) ? '1' : '0';
	    
	    echo json_encode($reply);	    
	}
}