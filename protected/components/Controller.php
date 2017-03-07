<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/layout-hd';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public $networkType = null;
	public $networkImage = null;
	public $pageHeading = null;
	public $storeID = null;
	public $storeCity = null;
	public $storeState = null;
	public $siteID = null;
	public $helper = null;
	
	public $isAluminum = 'on';
	public $isVinyl = 'on';
	public $isChainlink = 'on';
	public $isWood = 'on';
	
	public $isSku = 'on';
	public $isItem = 'on';
	public $isGateKits = 'on';
	public $isApplyLabor = 'on';
	public $networkLayout = '';
	public $networkSettings = '';
	public $siteDetails = array();
	
	public function init()
	{
	    parent::init();
	     
	    $this->helper = new Helpers();
	    //$session = Yii::app()->session;
	    
	    $this->networkType='fencesoft';
	    $this->storeID = 'testsite01';
	    $this->siteID = 19;
	    $this->storeCity = 'Bedford';
	    $this->storeState = 'Indiana';
	    if($_SERVER['HTTP_HOST'] !='localhost') {
	        $this->getSiteSettings();
	    }
	}
	
	private function getSiteSettings(){
	    $domain = $_SERVER['HTTP_HOST'];
	    $exp = explode('.', $domain);
	    $subdomain = $exp[0];
	
	    $model = Sites::model()->find('store_id=:storeID',array(':storeID'=>$subdomain));
	
	    if($model){
	    	$this->siteDetails = $model;
	    	$this->siteID = $model['id'];
	        $this->storeID = $model['store_id'];
	        $this->storeCity = $model['city'];
	        $this->storeState = $model['state'];
	        $this->networkType = $model['network_type'];

	        $this->isAluminum = $model['is_aluminum'];
		    $this->isVinyl = $model['is_vinyl'];
		    $this->isChainlink = $model['is_chainlink'];
		    $this->isWood = $model['is_wood'];
		
		    $this->isSku = $model['is_sku'];
		    $this->isItem = $model['is_item'];
		    $this->isGateKits = $model['is_gate_kits'];
		    $this->isApplyLabor = $model['is_labor'];
	        
	        if( $this->networkType == "home_depot"){
	            $this->layout = '//layouts/layout-hd';
	            $this->networkLayout = '//layouts/layout-hd';
	            
	        } else if($this->networkType == "active_yards") {
	            $this->layout = '//layouts/layout-ay';
	            $this->networkLayout = '//layouts/layout-ay';
	            
	        } else if($this->networkType == "lowe's"){
	            $this->layout = '//layouts/layout-lowes';
	            $this->networkLayout = '//layouts/layout-lowes';
	        } else if($this->networkType == "fencesoft"){
	            $this->layout = '//layouts/layout-fs';
	            $this->networkLayout = '//layouts/layout-fs';
	        }
	        $this->checkNetworkSettings();
	    }
	}
	
	private function checkNetworkSettings(){
	    $controller = Yii::app()->controller->id;
	    //$session = Yii::app()->session;
	    $model = NetworkSettings::model()->find('network_type=:networkType',array(':networkType'=>$this->networkType));
	
	    /*$this->isAluminum = $model['is_aluminum'];
	    $this->isVinyl = $model['is_vinyl'];
	    $this->isChainlink = $model['is_chainlink'];
	    $this->isWood = $model['is_wood'];
	
	    $this->isSku = $model['is_sku'];
	    $this->isItem = $model['is_item'];
	    $this->isGateKits = $model['is_gate_kits'];
	    $this->isApplyLabor = $model['is_labor'];*/
	    
	    $this->networkSettings = $model;
	}
}
