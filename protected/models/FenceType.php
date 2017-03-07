<?php

/**
 * This is the model class for table "fence_type".
 *
 * The followings are the available columns in table 'fence_type':
 * @property string $id
 * @property string $name
 * @property string $tag
 * @property integer $order
 * @property string $created_at
 * @property string $modified_dt
 */
class FenceType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FenceType the static model class
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
		return 'fence_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('tag', 'length', 'max'=>50),
			array('created_at, modified_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, tag, order, created_at, modified_dt', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'tag' => 'Tag',
			'order' => 'Order',
			'created_at' => 'Created At',
			'modified_dt' => 'Modified Dt',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('order',$this->order);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_dt',$this->modified_dt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}