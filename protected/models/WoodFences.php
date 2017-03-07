<?php

/**
 * This is the model class for table "wood_fences".
 *
 * The followings are the available columns in table 'wood_fences':
 * @property string $id
 * @property string $system_name
 * @property string $system_id
 * @property string $network_type
 * @property string $store_id
 * @property string $short_description
 * @property string $description
 * @property string $fence_style
 * @property string $construction_type
 * @property string $height
 * @property integer $is_hide
 * @property string $assign_categories
 * @property integer $is_blank
 * @property string $group_material_id
 * @property string $section_post_spacing
 * @property string $section_division_style
 * @property string $wood_type
 * @property string $pricing
 * @property string $pricing_value
 * @property string $section_specs
 * @property string $section_price
 * @property string $section_item
 * @property string $section_sku
 * @property string $post_specs
 * @property string $post_price
 * @property string $post_item
 * @property string $post_sku
 * @property string $runner_specs
 * @property string $runner_price
 * @property string $runner_item
 * @property string $runner_sku
 * @property string $runner_length
 * @property string $no_of_runner
 * @property string $rail_specs
 * @property string $rail_price
 * @property string $rail_item
 * @property string $rail_sku
 * @property string $rail_length
 * @property string $no_of_rails
 * @property string $picket_specs
 * @property string $picket_price
 * @property string $picket_item
 * @property string $picket_sku
 * @property string $picket_size
 * @property string $picket_spacing
 * @property integer $is_shadowbox
 * @property string $fastener_specs
 * @property string $fastener_price
 * @property string $fastener_item
 * @property string $fastener_sku
 * @property string $no_of_fastener
 * @property string $labor_cost_type
 * @property string $labor_cost
 * @property string $removal_cost
 * @property string $bags_of_concrete
 * @property string $post_caps_id
 * @property string $single_gates_id
 * @property string $double_gates_id
 * @property string $install_labor_cost
 * @property string $material_markup_percent
 * @property string $product_image
 * @property string $product_document
 * @property string $featured_image
 * @property string $created_at
 * @property string $modified_at
 */
class WoodFences extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WoodFences the static model class
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
		return 'wood_fences';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(			
			array('is_hide, is_blank, is_shadowbox', 'numerical', 'integerOnly'=>true),
			array('system_name', 'length', 'max'=>180),
			array('system_id, section_division_style, wood_type, pricing_value, section_specs, section_item, section_sku, post_specs, post_item, post_sku, runner_specs, runner_item, runner_sku, runner_length, no_of_runner, rail_specs, rail_item, rail_sku, picket_specs, picket_item, picket_sku, picket_size, picket_spacing, fastener_specs, fastener_item, fastener_sku, labor_cost_type, removal_cost, post_caps_id, single_gates_id, double_gates_id, install_labor_cost, material_markup_percent', 'length', 'max'=>100),
			array('network_type, fence_style', 'length', 'max'=>12),
			array('store_id, short_description, assign_categories, product_image, product_document, featured_image', 'length', 'max'=>255),
			array('construction_type, rail_length, bags_of_concrete', 'length', 'max'=>11),
			array('height, group_material_id, pricing, no_of_rails, no_of_fastener', 'length', 'max'=>20),
			array('section_post_spacing', 'length', 'max'=>10),
			array('section_price, post_price, runner_price, rail_price, picket_price, fastener_price', 'length', 'max'=>50),
			array('labor_cost', 'length', 'max'=>200),
			array('description, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, system_name, system_id, network_type, store_id, short_description, description, fence_style, construction_type, height, is_hide, assign_categories, is_blank, group_material_id, section_post_spacing, section_division_style, wood_type, pricing, pricing_value, section_specs, section_price, section_item, section_sku, post_specs, post_price, post_item, post_sku, runner_specs, runner_price, runner_item, runner_sku, runner_length, no_of_runner, rail_specs, rail_price, rail_item, rail_sku, rail_length, no_of_rails, picket_specs, picket_price, picket_item, picket_sku, picket_size, picket_spacing, is_shadowbox, fastener_specs, fastener_price, fastener_item, fastener_sku, no_of_fastener, labor_cost_type, labor_cost, removal_cost, bags_of_concrete, post_caps_id, single_gates_id, double_gates_id, install_labor_cost, material_markup_percent, product_image, product_document, featured_image, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'system_name' => 'System Name',
			'system_id' => 'System',
			'network_type' => 'Network Type',
			'store_id' => 'Store',
			'short_description' => 'Short Description',
			'description' => 'Description',
			'fence_style' => 'Fence Style',
			'construction_type' => 'Construction Type',
			'height' => 'Height',
			'is_hide' => 'Is Hide',
			'assign_categories' => 'Assign Categories',
			'is_blank' => 'Is Blank',
			'group_material_id' => 'Group Material',
			'section_post_spacing' => 'Section Post Spacing',
			'section_division_style' => 'Section Division Style',
			'wood_type' => 'Wood Type',
			'pricing' => 'Pricing',
			'pricing_value' => 'Pricing Value',
			'section_specs' => 'Section Specs',
			'section_price' => 'Section Price',
			'section_item' => 'Section Item',
			'section_sku' => 'Section Sku',
			'post_specs' => 'Post Specs',
			'post_price' => 'Post Price',
			'post_item' => 'Post Item',
			'post_sku' => 'Post Sku',
			'runner_specs' => 'Runner Specs',
			'runner_price' => 'Runner Price',
			'runner_item' => 'Runner Item',
			'runner_sku' => 'Runner Sku',
			'runner_length' => 'Runner Length',
			'no_of_runner' => 'No Of Runner',
			'rail_specs' => 'Rail Specs',
			'rail_price' => 'Rail Price',
			'rail_item' => 'Rail Item',
			'rail_sku' => 'Rail Sku',
			'rail_length' => 'Rail Length',
			'no_of_rails' => 'No Of Rails',
			'picket_specs' => 'Picket Specs',
			'picket_price' => 'Picket Price',
			'picket_item' => 'Picket Item',
			'picket_sku' => 'Picket Sku',
			'picket_size' => 'Picket Size',
			'picket_spacing' => 'Picket Spacing',
			'is_shadowbox' => 'Is Shadowbox',
			'fastener_specs' => 'Fastener Specs',
			'fastener_price' => 'Fastener Price',
			'fastener_item' => 'Fastener Item',
			'fastener_sku' => 'Fastener Sku',
			'no_of_fastener' => 'No Of Fastener',
			'labor_cost_type' => 'Labor Cost Type',
			'labor_cost' => 'Labor Cost',
			'removal_cost' => 'Removal Cost',
			'bags_of_concrete' => 'Bags Of Concrete',
			'post_caps_id' => 'Post Caps',
			'single_gates_id' => 'Single Gates',
			'double_gates_id' => 'Double Gates',
			'install_labor_cost' => 'Install Labor Cost',
			'material_markup_percent' => 'Material Markup Percent',
			'product_image' => 'Product Image',
			'product_document' => 'Product Document',
			'featured_image' => 'Featured Image',
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
		$criteria->compare('system_name',$this->system_name,true);
		$criteria->compare('system_id',$this->system_id,true);
		$criteria->compare('network_type',$this->network_type,true);
		$criteria->compare('store_id',$this->store_id,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('fence_style',$this->fence_style,true);
		$criteria->compare('construction_type',$this->construction_type,true);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('is_hide',$this->is_hide);
		$criteria->compare('assign_categories',$this->assign_categories,true);
		$criteria->compare('is_blank',$this->is_blank);
		$criteria->compare('group_material_id',$this->group_material_id,true);
		$criteria->compare('section_post_spacing',$this->section_post_spacing,true);
		$criteria->compare('section_division_style',$this->section_division_style,true);
		$criteria->compare('wood_type',$this->wood_type,true);
		$criteria->compare('pricing',$this->pricing,true);
		$criteria->compare('pricing_value',$this->pricing_value,true);
		$criteria->compare('section_specs',$this->section_specs,true);
		$criteria->compare('section_price',$this->section_price,true);
		$criteria->compare('section_item',$this->section_item,true);
		$criteria->compare('section_sku',$this->section_sku,true);
		$criteria->compare('post_specs',$this->post_specs,true);
		$criteria->compare('post_price',$this->post_price,true);
		$criteria->compare('post_item',$this->post_item,true);
		$criteria->compare('post_sku',$this->post_sku,true);
		$criteria->compare('runner_specs',$this->runner_specs,true);
		$criteria->compare('runner_price',$this->runner_price,true);
		$criteria->compare('runner_item',$this->runner_item,true);
		$criteria->compare('runner_sku',$this->runner_sku,true);
		$criteria->compare('runner_length',$this->runner_length,true);
		$criteria->compare('no_of_runner',$this->no_of_runner,true);
		$criteria->compare('rail_specs',$this->rail_specs,true);
		$criteria->compare('rail_price',$this->rail_price,true);
		$criteria->compare('rail_item',$this->rail_item,true);
		$criteria->compare('rail_sku',$this->rail_sku,true);
		$criteria->compare('rail_length',$this->rail_length,true);
		$criteria->compare('no_of_rails',$this->no_of_rails,true);
		$criteria->compare('picket_specs',$this->picket_specs,true);
		$criteria->compare('picket_price',$this->picket_price,true);
		$criteria->compare('picket_item',$this->picket_item,true);
		$criteria->compare('picket_sku',$this->picket_sku,true);
		$criteria->compare('picket_size',$this->picket_size,true);
		$criteria->compare('picket_spacing',$this->picket_spacing,true);
		$criteria->compare('is_shadowbox',$this->is_shadowbox);
		$criteria->compare('fastener_specs',$this->fastener_specs,true);
		$criteria->compare('fastener_price',$this->fastener_price,true);
		$criteria->compare('fastener_item',$this->fastener_item,true);
		$criteria->compare('fastener_sku',$this->fastener_sku,true);
		$criteria->compare('no_of_fastener',$this->no_of_fastener,true);
		$criteria->compare('labor_cost_type',$this->labor_cost_type,true);
		$criteria->compare('labor_cost',$this->labor_cost,true);
		$criteria->compare('removal_cost',$this->removal_cost,true);
		$criteria->compare('bags_of_concrete',$this->bags_of_concrete,true);
		$criteria->compare('post_caps_id',$this->post_caps_id,true);
		$criteria->compare('single_gates_id',$this->single_gates_id,true);
		$criteria->compare('double_gates_id',$this->double_gates_id,true);
		$criteria->compare('install_labor_cost',$this->install_labor_cost,true);
		$criteria->compare('material_markup_percent',$this->material_markup_percent,true);
		$criteria->compare('product_image',$this->product_image,true);
		$criteria->compare('product_document',$this->product_document,true);
		$criteria->compare('featured_image',$this->featured_image,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}