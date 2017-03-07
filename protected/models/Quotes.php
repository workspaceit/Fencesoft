<?php

/**
 * This is the model class for table "quotes".
 *
 * The followings are the available columns in table 'quotes':
 * @property string $id
 * @property string $user_id
 * @property string $assigned_id
 * @property string $network_type
 * @property string $store_id
 * @property string $material_id
 * @property string $material_type
 * @property string $post_cap_id
 * @property string $gate_latch_id
 * @property string $removal_fence
 * @property string $removal_fence_cost
 * @property string $feet_removal
 * @property string $quotes_data
 * @property string $extra_data
 * @property string $payment_status
 * @property string $upfront_payment
 * @property string $full_payment
 * @property string $notes
 * @property integer $adjustment_price
 * @property string $created_at
 * @property string $modified_at
 * @property string $pdf_file
 */
class Quotes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'quotes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('adjustment_price', 'numerical', 'integerOnly'=>true),
			array('user_id, assigned_id, material_id, post_cap_id, gate_latch_id', 'length', 'max'=>20),
			array('network_type', 'length', 'max'=>12),
			array('store_id, upfront_payment, full_payment, pdf_file', 'length', 'max'=>255),
			array('material_type', 'length', 'max'=>9),
			array('removal_fence, removal_fence_cost, feet_removal', 'length', 'max'=>100),
			array('payment_status', 'length', 'max'=>10),
			array('quotes_data, extra_data, notes, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, assigned_id, network_type, store_id, material_id, material_type, post_cap_id, gate_latch_id, removal_fence, removal_fence_cost, feet_removal, quotes_data, extra_data, payment_status, upfront_payment, full_payment, notes, adjustment_price, created_at, modified_at, pdf_file', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'assigned_id' => 'Assigned',
			'network_type' => 'Network Type',
			'store_id' => 'Store',
			'material_id' => 'Material',
			'material_type' => 'Material Type',
			'post_cap_id' => 'Post Cap',
			'gate_latch_id' => 'Gate Latch',
			'removal_fence' => 'Removal Fence',
			'removal_fence_cost' => 'Removal Fence Cost',
			'feet_removal' => 'Feet Removal',
			'quotes_data' => 'Quotes Data',
			'extra_data' => 'Extra Data',
			'payment_status' => 'Payment Status',
			'upfront_payment' => 'Upfront Payment',
			'full_payment' => 'Full Payment',
			'notes' => 'Notes',
			'adjustment_price' => 'Adjustment Price',
			'created_at' => 'Created At',
			'modified_at' => 'Modified At',
			'pdf_file' => 'Pdf File',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('assigned_id',$this->assigned_id,true);
		$criteria->compare('network_type',$this->network_type,true);
		$criteria->compare('store_id',$this->store_id,true);
		$criteria->compare('material_id',$this->material_id,true);
		$criteria->compare('material_type',$this->material_type,true);
		$criteria->compare('post_cap_id',$this->post_cap_id,true);
		$criteria->compare('gate_latch_id',$this->gate_latch_id,true);
		$criteria->compare('removal_fence',$this->removal_fence,true);
		$criteria->compare('removal_fence_cost',$this->removal_fence_cost,true);
		$criteria->compare('feet_removal',$this->feet_removal,true);
		$criteria->compare('quotes_data',$this->quotes_data,true);
		$criteria->compare('extra_data',$this->extra_data,true);
		$criteria->compare('payment_status',$this->payment_status,true);
		$criteria->compare('upfront_payment',$this->upfront_payment,true);
		$criteria->compare('full_payment',$this->full_payment,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('adjustment_price',$this->adjustment_price);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);
		$criteria->compare('pdf_file',$this->pdf_file,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Quotes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
