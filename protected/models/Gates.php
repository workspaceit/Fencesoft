<?php

/**
 * This is the model class for table "gates".
 *
 * The followings are the available columns in table 'gates':
 * @property string $id
 * @property string $network_type
 * @property string $material
 * @property string $material_id
 * @property string $gate_type
 * @property string $description
 * @property string $gate_style
 * @property string $height
 * @property string $width
 * @property string $gate_price
 * @property string $gate_item
 * @property string $gate_sku
 * @property string $latch_price
 * @property string $latch_item
 * @property string $latch_sku
 * @property string $hinges_price
 * @property string $hinges_item
 * @property string $hinges_sku
 * @property string $drop_rod_price
 * @property string $drop_rod_item
 * @property string $drop_rod_sku
 * @property string $gate_kit_price
 * @property string $gate_kit_item
 * @property string $gate_kit_sku
 * @property string $gate_post_price
 * @property string $gate_post_item
 * @property string $gate_post_sku
 * @property string $created_at
 * @property string $modified_at
 */
class Gates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gates the static model class
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
		return 'gates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('network_type, material', 'required'),
			array('network_type', 'length', 'max'=>12),
			array('material', 'length', 'max'=>9),
			array('material_id', 'length', 'max'=>20),
			array('gate_type', 'length', 'max'=>6),
			array('gate_style, gate_price, gate_item, gate_sku, latch_price, latch_item, latch_sku, hinges_price, hinges_item, hinges_sku, drop_rod_price, drop_rod_item, drop_rod_sku, gate_kit_price, gate_kit_item, gate_kit_sku, gate_post_price, gate_post_item, gate_post_sku', 'length', 'max'=>255),
			array('height, width', 'length', 'max'=>11),
			array('description, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, network_type, material, material_id, gate_type, description, gate_style, height, width, gate_price, gate_item, gate_sku, latch_price, latch_item, latch_sku, hinges_price, hinges_item, hinges_sku, drop_rod_price, drop_rod_item, drop_rod_sku, gate_kit_price, gate_kit_item, gate_kit_sku, gate_post_price, gate_post_item, gate_post_sku, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'gate_type' => 'Gate Type',
			'description' => 'Description',
			'gate_style' => 'Gate Style',
			'height' => 'Height(ft)',
			'width' => 'Width(ft)',
			'gate_price' => 'Gate Price',
			'gate_item' => 'ITEM #',
			'gate_sku' => 'SKU #',
			'latch_price' => 'Latch Price',
			'latch_item' => 'ITEM #',
			'latch_sku' => 'SKU #',
			'hinges_price' => 'Hinges Price',
			'hinges_item' => 'ITEM #',
			'hinges_sku' => 'SKU #',
			'drop_rod_price' => 'Drop-Rod Price',
			'drop_rod_item' => 'ITEM #',
			'drop_rod_sku' => 'SKU #',
			'gate_kit_price' => 'Gate Kit Price',
			'gate_kit_item' => 'ITEM #',
			'gate_kit_sku' => 'SKU #',
			'gate_post_price' => 'Gate Post Price',
			'gate_post_item' => 'ITEM #',
			'gate_post_sku' => 'SKU #',
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
		$criteria->compare('gate_type',$this->gate_type,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('gate_style',$this->gate_style,true);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('width',$this->width,true);
		$criteria->compare('gate_price',$this->gate_price,true);
		$criteria->compare('gate_item',$this->gate_item,true);
		$criteria->compare('gate_sku',$this->gate_sku,true);
		$criteria->compare('latch_price',$this->latch_price,true);
		$criteria->compare('latch_item',$this->latch_item,true);
		$criteria->compare('latch_sku',$this->latch_sku,true);
		$criteria->compare('hinges_price',$this->hinges_price,true);
		$criteria->compare('hinges_item',$this->hinges_item,true);
		$criteria->compare('hinges_sku',$this->hinges_sku,true);
		$criteria->compare('drop_rod_price',$this->drop_rod_price,true);
		$criteria->compare('drop_rod_item',$this->drop_rod_item,true);
		$criteria->compare('drop_rod_sku',$this->drop_rod_sku,true);
		$criteria->compare('gate_kit_price',$this->gate_kit_price,true);
		$criteria->compare('gate_kit_item',$this->gate_kit_item,true);
		$criteria->compare('gate_kit_sku',$this->gate_kit_sku,true);
		$criteria->compare('gate_post_price',$this->gate_post_price,true);
		$criteria->compare('gate_post_item',$this->gate_post_item,true);
		$criteria->compare('gate_post_sku',$this->gate_post_sku,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}