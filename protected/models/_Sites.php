<?php

/**
 * This is the model class for table "sites".
 *
 * The followings are the available columns in table 'sites':
 * @property string $id
 * @property string $store_id
 * @property string $url
 * @property string $network_type
 * @property string $location
 * @property string $city
 * @property string $state
 * @property string $zip_code
 * @property integer $site_admin
 * @property string $notification_email
 * @property integer $show_item_price
 * @property string $service_area
 * @property integer $vinyl_fence_noa
 * @property string $concrete_cost
 * @property string $removal_vinyl
 * @property string $removal_aluminum
 * @property string $removal_wood
 * @property string $removal_chainlink
 * @property string $sales_tax_method
 * @property string $sales_tax_amount
 * @property string $markup_method
 * @property string $payment_type
 * @property string $payment_amount
 * @property string $modified_at
 * @property string $created_at
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
			array('site_admin, show_item_price, vinyl_fence_noa', 'numerical', 'integerOnly'=>true),
			array('store_id, url, location, city, service_area, sales_tax_method, markup_method, payment_amount', 'length', 'max'=>255),
			array('network_type', 'length', 'max'=>12),
			array('state, concrete_cost, removal_vinyl, removal_aluminum, removal_wood, removal_chainlink, sales_tax_amount, payment_type', 'length', 'max'=>100),
			array('zip_code', 'length', 'max'=>50),
			array('notification_email', 'length', 'max'=>150),
			array('modified_at, created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, store_id, url, network_type, location, city, state, zip_code, site_admin, notification_email, show_item_price, service_area, vinyl_fence_noa, concrete_cost, removal_vinyl, removal_aluminum, removal_wood, removal_chainlink, sales_tax_method, sales_tax_amount, markup_method, payment_type, payment_amount, modified_at, created_at', 'safe', 'on'=>'search'),
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
			'url' => 'Url',
			'network_type' => 'Network Type',
			'location' => 'Location',
			'city' => 'City',
			'state' => 'State',
			'zip_code' => 'Zip Code',
			'site_admin' => 'Site Admin',
			'notification_email' => 'Notification Email',
			'show_item_price' => 'Show Item Price',
			'service_area' => 'Service Area(Zip-codes)',
			'vinyl_fence_noa' => 'Does vinyl fence need to be NOA compliant?',
			'concrete_cost' => 'Cost of Concrete',
			'removal_vinyl' => 'Removal Vinyl',
			'removal_aluminum' => 'Removal Aluminum',
			'removal_wood' => 'Removal Wood',
			'removal_chainlink' => 'Removal Chainlink',
			'sales_tax_method' => 'Sales Tax Method',
			'sales_tax_amount' => '',
			'markup_method' => 'Markup Method',
			'payment_type' => 'Payment Setup',
			'payment_amount' => '',
			'modified_at' => 'Modified',
			'created_at' => 'Created',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('network_type',$this->network_type,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('zip_code',$this->zip_code,true);
		$criteria->compare('site_admin',$this->site_admin);
		$criteria->compare('notification_email',$this->notification_email,true);
		$criteria->compare('show_item_price',$this->show_item_price);
		$criteria->compare('service_area',$this->service_area,true);
		$criteria->compare('vinyl_fence_noa',$this->vinyl_fence_noa);
		$criteria->compare('concrete_cost',$this->concrete_cost,true);
		$criteria->compare('removal_vinyl',$this->removal_vinyl,true);
		$criteria->compare('removal_aluminum',$this->removal_aluminum,true);
		$criteria->compare('removal_wood',$this->removal_wood,true);
		$criteria->compare('removal_chainlink',$this->removal_chainlink,true);
		$criteria->compare('sales_tax_method',$this->sales_tax_method,true);
		$criteria->compare('sales_tax_amount',$this->sales_tax_amount,true);
		$criteria->compare('markup_method',$this->markup_method,true);
		$criteria->compare('payment_type',$this->payment_type,true);
		$criteria->compare('payment_amount',$this->payment_amount,true);
		$criteria->compare('modified_at',$this->modified_at,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}