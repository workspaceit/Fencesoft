<?php

/**
 * This is the model class for table "sites".
 *
 * The followings are the available columns in table 'sites':
 * @property string $id
 * @property string $store_id
 * @property string $site_name
 * @property string $url
 * @property string $network_type
 * @property string $location
 * @property string $city
 * @property string $state
 * @property string $zip_code
 * @property string $phone
 * @property integer $site_admin
 * @property string $notification_email
 * @property integer $show_item_price
 * @property string $service_area
 * @property integer $vinyl_fence_noa
 * @property string $concrete_cost
 * @property string $aluminum_labor_cost
 * @property string $removal_aluminum
 * @property string $vinyl_labor_cost
 * @property string $removal_vinyl
 * @property string $chainlink_lobor_cost
 * @property string $removal_chainlink
 * @property string $removal_wood
 * @property string $wood_labor_cost
 * @property string $sales_tax_method
 * @property string $sales_tax_amount
 * @property string $markup_method
 * @property string $markup_method_amount
 * @property string $payment_type
 * @property string $payment_amount
 * @property string $payment_gateway
 * @property string $merchant_id
 * @property string $public_key
 * @property string $private_key
 * @property string $clientside_key
 * @property string $is_vinyl
 * @property string $is_aluminum
 * @property string $is_wood
 * @property string $is_chainlink
 * @property string $is_sku
 * @property string $is_item
 * @property string $is_gate_kits
 * @property string $is_labor
 * @property string $category_list
 * @property string $vinyl_color
 * @property string $aluminum_color
 * @property string $wood_type
 * @property string $clips_per_unit
 * @property string $clip_price
 * @property string $clip_item
 * @property string $clip_sku
 * @property string $clips_per_cap
 * @property string $created_at
 * @property string $modified_at
 */
class Sites extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sites the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sites';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('site_name', 'required'),
			array('site_admin, show_item_price, vinyl_fence_noa', 'numerical', 'integerOnly'=>true),
			array('store_id, site_name, url, location, city, phone, service_area, aluminum_labor_cost, vinyl_labor_cost, chainlink_lobor_cost, wood_labor_cost, sales_tax_method, markup_method, markup_method_amount, payment_amount, payment_gateway, merchant_id, category_list, clips_per_unit, clip_price, clip_item, clip_sku, clips_per_cap', 'length', 'max'=>255),
			array('network_type', 'length', 'max'=>12),
			array('state, concrete_cost, removal_aluminum, removal_vinyl, removal_chainlink, removal_wood, sales_tax_amount, payment_type', 'length', 'max'=>100),
			array('zip_code', 'length', 'max'=>50),
			array('notification_email', 'length', 'max'=>150),
			array('is_vinyl, is_aluminum, is_wood, is_chainlink, is_sku, is_item, is_gate_kits, is_labor', 'length', 'max'=>3),
			array('public_key, private_key, clientside_key, vinyl_color, aluminum_color, wood_type, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, store_id, site_name, url, network_type, location, city, state, zip_code, phone, site_admin, notification_email, show_item_price, service_area, vinyl_fence_noa, concrete_cost, aluminum_labor_cost, removal_aluminum, vinyl_labor_cost, removal_vinyl, chainlink_lobor_cost, removal_chainlink, removal_wood, wood_labor_cost, sales_tax_method, sales_tax_amount, markup_method, markup_method_amount, payment_type, payment_amount, payment_gateway, merchant_id, public_key, private_key, clientside_key, is_vinyl, is_aluminum, is_wood, is_chainlink, is_sku, is_item, is_gate_kits, is_labor, category_list, vinyl_color, aluminum_color, wood_type, clips_per_unit, clip_price, clip_item, clip_sku, clips_per_cap, created_at, modified_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'store_id' => 'Store ID',
			'site_name' => 'Company Name',
			'url' => 'Url',
			'network_type' => 'Network Type',
			'location' => 'Location',
			'city' => 'City',
			'state' => 'State',
			'zip_code' => 'Zip Code',
			'phone' => 'Phone',
			'site_admin' => 'Site Admin',
			'notification_email' => 'Notification Email',
			'show_item_price' => 'Show Item Price',
			'service_area' => 'Service Area(Zip-codes)',
			'vinyl_fence_noa' => 'Does vinyl fence need to be NOA compliant?',
			'concrete_cost' => 'Cost of Concrete',
			'aluminum_labor_cost' => 'for Aluminum',
			'removal_aluminum' => 'Removal Aluminum',
			'vinyl_labor_cost' => 'for Vinyl',
			'removal_vinyl' => 'Removal Vinyl',
			'chainlink_lobor_cost' => 'for Chainlink',
			'removal_chainlink' => 'Removal Chainlink',
		    'wood_labor_cost' => 'for Wood',
			'removal_wood' => 'Removal Wood',
			'sales_tax_method' => 'Sales Tax Method',
			'sales_tax_amount' => 'Sales Tax Amount',
			'markup_method' => 'Markup Method',		        
			'markup_method_amount' => 'Amount(%)',
			'payment_type' => 'Payment Setup',
			'payment_amount' => 'Payment Amount',
	        'payment_gateway' => 'Payment Gateway',
	        'merchant_id' => 'Merchant Key',
	        'public_key' => 'Public / API Key',
	        'private_key' => 'Private Key',
			'clientside_key' => 'Clientside Key',
			'is_vinyl' => 'Is Vinyl',
			'is_aluminum' => 'Is Aluminum',
			'is_wood' => 'Is Wood',
			'is_chainlink' => 'Is Chainlink',
			'is_sku' => 'Is Sku',
			'is_item' => 'Is Item',
			'is_gate_kits' => 'Is Gate Kits',
			'is_labor' => 'Is Labor',
			'category_list' => 'Category List',
			'vinyl_color' => 'Vinyl Color',
			'aluminum_color' => 'Aluminum Color',
			'wood_type' => 'Wood Type',
			'clips_per_unit' => 'Clips Per Unit',
			'clip_price' => 'Clip Price',
			'clip_item' => 'Clip Item',
			'clip_sku' => 'Clip Sku',
			'clips_per_cap' => 'Clips Per Cap',
			'created_at' => 'Created',
			'modified_at' => 'Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('store_id',$this->store_id,true);
		$criteria->compare('site_name',$this->site_name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('network_type',$this->network_type,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('zip_code',$this->zip_code,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('site_admin',$this->site_admin);
		$criteria->compare('notification_email',$this->notification_email,true);
		$criteria->compare('show_item_price',$this->show_item_price);
		$criteria->compare('service_area',$this->service_area,true);
		$criteria->compare('vinyl_fence_noa',$this->vinyl_fence_noa);
		$criteria->compare('concrete_cost',$this->concrete_cost,true);
		$criteria->compare('aluminum_labor_cost',$this->aluminum_labor_cost,true);
		$criteria->compare('removal_aluminum',$this->removal_aluminum,true);
		$criteria->compare('vinyl_labor_cost',$this->vinyl_labor_cost,true);
		$criteria->compare('removal_vinyl',$this->removal_vinyl,true);
		$criteria->compare('chainlink_lobor_cost',$this->chainlink_lobor_cost,true);
		$criteria->compare('removal_chainlink',$this->removal_chainlink,true);
		$criteria->compare('removal_wood',$this->removal_wood,true);
		$criteria->compare('wood_labor_cost',$this->wood_labor_cost,true);
		$criteria->compare('sales_tax_method',$this->sales_tax_method,true);
		$criteria->compare('sales_tax_amount',$this->sales_tax_amount,true);
		$criteria->compare('markup_method',$this->markup_method,true);
		$criteria->compare('markup_method_amount',$this->markup_method_amount,true);
		$criteria->compare('payment_type',$this->payment_type,true);
		$criteria->compare('payment_amount',$this->payment_amount,true);
		$criteria->compare('payment_gateway',$this->payment_gateway,true);
		$criteria->compare('merchant_id',$this->merchant_id,true);
		$criteria->compare('public_key',$this->public_key,true);
		$criteria->compare('private_key',$this->private_key,true);
		$criteria->compare('clientside_key',$this->clientside_key,true);
		$criteria->compare('is_vinyl',$this->is_vinyl,true);
		$criteria->compare('is_aluminum',$this->is_aluminum,true);
		$criteria->compare('is_wood',$this->is_wood,true);
		$criteria->compare('is_chainlink',$this->is_chainlink,true);
		$criteria->compare('is_sku',$this->is_sku,true);
		$criteria->compare('is_item',$this->is_item,true);
		$criteria->compare('is_gate_kits',$this->is_gate_kits,true);
		$criteria->compare('is_labor',$this->is_labor,true);
		$criteria->compare('category_list',$this->category_list,true);
		$criteria->compare('vinyl_color',$this->vinyl_color,true);
		$criteria->compare('aluminum_color',$this->aluminum_color,true);
		$criteria->compare('wood_type',$this->wood_type,true);
		$criteria->compare('clips_per_unit',$this->clips_per_unit,true);
		$criteria->compare('clip_price',$this->clip_price,true);
		$criteria->compare('clip_item',$this->clip_item,true);
		$criteria->compare('clip_sku',$this->clip_sku,true);
		$criteria->compare('clips_per_cap',$this->clips_per_cap,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}