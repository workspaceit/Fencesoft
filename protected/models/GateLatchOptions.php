<?php

/**
 * This is the model class for table "gate_latch_options".
 *
 * The followings are the available columns in table 'gate_latch_options':
 * @property string $id
 * @property string $network_type
 * @property string $material
 * @property string $material_id
 * @property string $latch_option
 * @property string $latch_price
 * @property string $latch_item
 * @property string $latch_sku
 * @property string $created_at
 * @property string $modified_at
 */
class GateLatchOptions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GateLatchOptions the static model class
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
		return 'gate_latch_options';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('network_type', 'length', 'max'=>12),
			array('material', 'length', 'max'=>9),
			array('material_id', 'length', 'max'=>20),
			array('latch_option, latch_price, latch_item, latch_sku', 'length', 'max'=>255),
			array('created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, network_type, material, material_id, latch_option, latch_price, latch_item, latch_sku, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'network_type' => 'Network Type',
			'material' => 'Material Type',
			'material_id' => 'Material ID',
			'latch_option' => 'Latch Option',
			'latch_price' => 'Latch Price',
			'latch_item' => 'ITEM #',
			'latch_sku' => 'SKU #',
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
		$criteria->compare('network_type',$this->network_type,true);
		$criteria->compare('material',$this->material,true);
		$criteria->compare('material_id',$this->material_id,true);
		$criteria->compare('latch_option',$this->latch_option,true);
		$criteria->compare('latch_price',$this->latch_price,true);
		$criteria->compare('latch_item',$this->latch_item,true);
		$criteria->compare('latch_sku',$this->latch_sku,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}