<?php

/**
 * This is the model class for table "network_settings".
 *
 * The followings are the available columns in table 'network_settings':
 * @property integer $id
 * @property string $name
 * @property string $network_type
 * @property string $logo
 * @property string $stylesheet
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
 * @property string $clips_per_cap
 * @property string $clip_price
 * @property string $clip_item
 * @property string $clip_sku
 * @property string $created_at
 * @property string $modified_at
 */
class NetworkSettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NetworkSettings the static model class
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
		return 'network_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, logo, stylesheet, category_list, clips_per_unit, clips_per_cap, clip_price, clip_item, clip_sku', 'length', 'max'=>255),
			array('network_type', 'length', 'max'=>12),
			array('is_vinyl, is_aluminum, is_wood, is_chainlink, is_sku, is_item, is_gate_kits, is_labor', 'length', 'max'=>3),
			array('vinyl_color, aluminum_color, wood_type, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, network_type, logo, stylesheet, is_vinyl, is_aluminum, is_wood, is_chainlink, is_sku, is_item, is_gate_kits, is_labor, category_list, vinyl_color, aluminum_color, wood_type, clips_per_unit, clips_per_cap, clip_price, clip_item, clip_sku, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'name' => 'Network Name',
			'network_type' => 'Network Type',
			'logo' => 'Network Logo',
			'stylesheet' => 'Network Stylesheet',
			'is_vinyl' => 'Vinyl',
			'is_aluminum' => 'Aluminum',
			'is_wood' => 'Wood',
			'is_chainlink' => 'Chainlink',
			'is_sku' => 'SKU# Mandatory',
			'is_item' => 'ITEM# Mandatory',
			'is_gate_kits' => 'Use Gate Kits',
			'is_labor' => 'Apply Labor',
			'category_list' => 'Category List',
			'vinyl_color' => 'Vinyl Color',
			'aluminum_color' => 'Aluminum Color',
			'wood_type' => 'Type of Wood',
			'clips_per_unit' => 'Clips Per Unit',
			'clips_per_cap' => 'Clips Per Cap',
			'clip_price' => 'Clip Price',
			'clip_item' => 'ITEM #',
			'clip_sku' => 'SKU #',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('network_type',$this->network_type,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('stylesheet',$this->stylesheet,true);
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
		$criteria->compare('clips_per_cap',$this->clips_per_cap,true);
		$criteria->compare('clip_price',$this->clip_price,true);
		$criteria->compare('clip_item',$this->clip_item,true);
		$criteria->compare('clip_sku',$this->clip_sku,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}