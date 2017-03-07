<?php

/**
 * This is the model class for table "fences".
 *
 * The followings are the available columns in table 'fences':
 * @property string $id
 * @property integer $siteid
 * @property string $name
 * @property string $description
 * @property string $type
 * @property string $privacy
 * @property double $post_spacing
 * @property integer $concrete_per_post
 * @property double $price_per_foot
 * @property double $section_price
 * @property double $post_price
 * @property integer $height
 * @property integer $width
 * @property string $color
 * @property string $price_style
 * @property string $details
 * @property string $customer_id
 * @property string $labor_cost
 * @property string $size
 * @property string $price
 * @property string $latches
 * @property string $hatches
 * @property string $d_size
 * @property string $d_price
 * @property string $d_latches
 * @property string $d_hatches
 * @property string $drop_rod
 * @property string $terminal_post_price
 * @property string $line_post_price
 * @property double $markup_amount
 * @property string $pdf_name
 * @property string $product_image
 * @property string $s_gate_price3ft
 * @property string $s_gate_price4ft
 * @property string $s_gate_price5ft
 * @property string $s_gate_price6ft
 * @property string $d_gate_price8ft
 * @property string $d_gate_price10ft
 * @property string $d_gate_price12ft
 * @property string $created_at
 * @property string $modified_at
 */
class Fences extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fences the static model class
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
		return 'fences';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type, post_spacing, concrete_per_post, height, customer_id, markup_amount, s_gate_price3ft, s_gate_price4ft, s_gate_price5ft, s_gate_price6ft, d_gate_price8ft, d_gate_price10ft, d_gate_price12ft', 'required'),
			array('siteid, concrete_per_post, height, width', 'numerical', 'integerOnly'=>true),
			array('post_spacing, price_per_foot, section_price, post_price, markup_amount', 'numerical'),
			array('name, pdf_name, product_image', 'length', 'max'=>100),
			array('type', 'length', 'max'=>1),
			array('privacy', 'length', 'max'=>12),
			array('color', 'length', 'max'=>50),
			array('price_style', 'length', 'max'=>5),
			array('customer_id', 'length', 'max'=>18),
			array('labor_cost, size, price, latches, hatches, d_size, d_price, d_latches, d_hatches, drop_rod, terminal_post_price, line_post_price, s_gate_price3ft, s_gate_price4ft, s_gate_price5ft, s_gate_price6ft, d_gate_price8ft, d_gate_price10ft, d_gate_price12ft', 'length', 'max'=>8),
			array('description, details, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, siteid, name, description, type, privacy, post_spacing, concrete_per_post, price_per_foot, section_price, post_price, height, width, color, price_style, details, customer_id, labor_cost, size, price, latches, hatches, d_size, d_price, d_latches, d_hatches, drop_rod, terminal_post_price, line_post_price, markup_amount, pdf_name, product_image, s_gate_price3ft, s_gate_price4ft, s_gate_price5ft, s_gate_price6ft, d_gate_price8ft, d_gate_price10ft, d_gate_price12ft, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'siteid' => 'Siteid',
			'name' => 'Name',
			'description' => 'Description',
			'type' => 'Type',
			'privacy' => 'Privacy',
			'post_spacing' => 'Post Spacing',
			'concrete_per_post' => 'Concrete Per Post',
			'price_per_foot' => 'Price Per Foot',
			'section_price' => 'Section Price',
			'post_price' => 'Post Price',
			'height' => 'Height',
			'width' => 'Width',
			'color' => 'Color',
			'price_style' => 'Price Style',
			'details' => 'Details',
			'customer_id' => 'Customer',
			'labor_cost' => 'Labor Cost',
			'size' => 'Size',
			'price' => 'Price',
			'latches' => 'Latches',
			'hatches' => 'Hatches',
			'd_size' => 'D Size',
			'd_price' => 'D Price',
			'd_latches' => 'D Latches',
			'd_hatches' => 'D Hatches',
			'drop_rod' => 'Drop Rod',
			'terminal_post_price' => 'Terminal Post Price',
			'line_post_price' => 'Line Post Price',
			'markup_amount' => 'Markup Amount',
			'pdf_name' => 'Pdf Name',
			'product_image' => 'Product Image',
			's_gate_price3ft' => 'S Gate Price3ft',
			's_gate_price4ft' => 'S Gate Price4ft',
			's_gate_price5ft' => 'S Gate Price5ft',
			's_gate_price6ft' => 'S Gate Price6ft',
			'd_gate_price8ft' => 'D Gate Price8ft',
			'd_gate_price10ft' => 'D Gate Price10ft',
			'd_gate_price12ft' => 'D Gate Price12ft',
			'created_at' => 'Created At',
			'modified_at' => 'Modified At',
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
		$criteria->compare('siteid',$this->siteid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('privacy',$this->privacy,true);
		$criteria->compare('post_spacing',$this->post_spacing);
		$criteria->compare('concrete_per_post',$this->concrete_per_post);
		$criteria->compare('price_per_foot',$this->price_per_foot);
		$criteria->compare('section_price',$this->section_price);
		$criteria->compare('post_price',$this->post_price);
		$criteria->compare('height',$this->height);
		$criteria->compare('width',$this->width);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('price_style',$this->price_style,true);
		$criteria->compare('details',$this->details,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('labor_cost',$this->labor_cost,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('latches',$this->latches,true);
		$criteria->compare('hatches',$this->hatches,true);
		$criteria->compare('d_size',$this->d_size,true);
		$criteria->compare('d_price',$this->d_price,true);
		$criteria->compare('d_latches',$this->d_latches,true);
		$criteria->compare('d_hatches',$this->d_hatches,true);
		$criteria->compare('drop_rod',$this->drop_rod,true);
		$criteria->compare('terminal_post_price',$this->terminal_post_price,true);
		$criteria->compare('line_post_price',$this->line_post_price,true);
		$criteria->compare('markup_amount',$this->markup_amount);
		$criteria->compare('pdf_name',$this->pdf_name,true);
		$criteria->compare('product_image',$this->product_image,true);
		$criteria->compare('s_gate_price3ft',$this->s_gate_price3ft,true);
		$criteria->compare('s_gate_price4ft',$this->s_gate_price4ft,true);
		$criteria->compare('s_gate_price5ft',$this->s_gate_price5ft,true);
		$criteria->compare('s_gate_price6ft',$this->s_gate_price6ft,true);
		$criteria->compare('d_gate_price8ft',$this->d_gate_price8ft,true);
		$criteria->compare('d_gate_price10ft',$this->d_gate_price10ft,true);
		$criteria->compare('d_gate_price12ft',$this->d_gate_price12ft,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}