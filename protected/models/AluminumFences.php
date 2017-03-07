<?php

/**
 * This is the model class for table "aluminum_fences".
 *
 * The followings are the available columns in table 'aluminum_fences':
 * @property string $id
 * @property string $system_name
 * @property string $system_id
 * @property string $network_type
 * @property string $store_id
 * @property string $short_description
 * @property string $description
 * @property string $fence_style
 * @property string $section_mount
 * @property string $height
 * @property integer $is_hide
 * @property string $assign_categories
 * @property integer $is_blank
 * @property string $group_material_id
 * @property string $section_post_spacing
 * @property string $section_division_style
 * @property string $color
 * @property string $pricing
 * @property string $pricing_value
 * @property string $section_specs
 * @property string $section_price
 * @property string $section_item
 * @property string $section_sku
 * @property string $line_post_specs
 * @property string $line_post_price
 * @property string $line_post_item
 * @property string $line_post_sku
 * @property string $corner_post_specs
 * @property string $corner_post_price
 * @property string $corner_post_item
 * @property string $corner_post_sku
 * @property string $end_post_specs
 * @property string $end_post_price
 * @property string $end_post_item
 * @property string $end_post_sku
 * @property string $blank_post_specs
 * @property string $blank_post_price
 * @property string $blank_post_item
 * @property string $blank_post_sku
 * @property string $bracket_kits_price
 * @property string $bracket_kits_item
 * @property string $bracket_kits_sku
 * @property string $gate_post_specs
 * @property string $gate_post_price
 * @property string $gate_post_item
 * @property string $gate_post_sku
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
class AluminumFences extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AluminumFences the static model class
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
		return 'aluminum_fences';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(			
			array('is_hide, is_blank', 'numerical', 'integerOnly'=>true),
			array('system_name', 'length', 'max'=>180),
			array('system_id, section_division_style, section_specs, section_item, section_sku, line_post_specs, line_post_item, line_post_sku, corner_post_specs, corner_post_item, corner_post_sku, end_post_specs, end_post_item, end_post_sku, blank_post_specs, blank_post_item, blank_post_sku, bracket_kits_item, bracket_kits_sku, labor_cost_type, removal_cost, post_caps_id, single_gates_id, double_gates_id, install_labor_cost, material_markup_percent', 'length', 'max'=>100),
			array('network_type, fence_style', 'length', 'max'=>12),
			array('store_id, short_description, assign_categories, gate_post_specs, gate_post_price, gate_post_item, gate_post_sku, product_image, product_document, featured_image', 'length', 'max'=>255),
			array('section_mount', 'length', 'max'=>14),
			array('height, group_material_id, color, pricing', 'length', 'max'=>20),
			array('section_post_spacing', 'length', 'max'=>10),
			array('pricing_value, section_price, line_post_price, corner_post_price, end_post_price, blank_post_price, bracket_kits_price', 'length', 'max'=>50),
			array('labor_cost', 'length', 'max'=>200),
			array('bags_of_concrete', 'length', 'max'=>11),
			array('description, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, system_name, system_id, network_type, store_id, short_description, description, fence_style, section_mount, height, is_hide, assign_categories, is_blank, group_material_id, section_post_spacing, section_division_style, color, pricing, pricing_value, section_specs, section_price, section_item, section_sku, line_post_specs, line_post_price, line_post_item, line_post_sku, corner_post_specs, corner_post_price, corner_post_item, corner_post_sku, end_post_specs, end_post_price, end_post_item, end_post_sku, blank_post_specs, blank_post_price, blank_post_item, blank_post_sku, bracket_kits_price, bracket_kits_item, bracket_kits_sku, gate_post_specs, gate_post_price, gate_post_item, gate_post_sku, labor_cost_type, labor_cost, removal_cost, bags_of_concrete, post_caps_id, single_gates_id, double_gates_id, install_labor_cost, material_markup_percent, product_image, product_document, featured_image, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'system_name' => 'Fence System Name',
			'system_id' => 'Fence System ID',
			'network_type' => 'Network Type',
			'short_description' => 'Short Description',
			'description' => 'Description',
			'fence_style' => 'Fence Style',
			'section_mount' => 'Type of Section Mount',
			'height' => 'Fence Height(ft)',
			'section_post_spacing' => 'Post Spacing',
			'section_division_style' => 'Division Style',
			'color' => 'Fence Color',
			'pricing' => 'Pricing',
			'pricing_value' => '',
			'is_hide' => 'Hide Material ?',
			'assign_categories' => 'Assign Categories',
			'is_blank' => 'Blank Material ?',
			'group_material_id' => 'Group Material Name',
			'section_specs' => 'Section Specs',
			'section_price' => 'Section Price',
			'section_item' => 'ITEM #',
			'section_sku' => 'SKU #',
			'line_post_specs' => 'Post Specs',
			'line_post_price' => 'Post Price',
			'line_post_item' => 'ITEM #',
			'line_post_sku' => 'SKU #',
			'corner_post_specs' => 'Post Specs',
			'corner_post_price' => 'Post Price',
			'corner_post_item' => 'ITEM #',
			'corner_post_sku' => 'SKU #',
			'end_post_specs' => 'Post Specs',
			'end_post_price' => 'Post Price',
			'end_post_item' => 'ITEM #',
			'end_post_sku' => 'SKU #',
			'blank_post_specs' => 'Post Specs',
			'blank_post_price' => 'Post Price',
			'blank_post_item' => 'ITEM #',
			'blank_post_sku' => 'SKU #',
			'bracket_kits_price' => 'Kits Price',
			'bracket_kits_item' => 'ITEM #',
			'bracket_kits_sku' => 'SKU #',
			'gate_post_specs' => 'Post Specs',
			'gate_post_price' => 'Post Price',
			'gate_post_item' => 'ITEM #',
			'gate_post_sku' => 'SKU #',
			'labor_cost_type' => 'Type',
			'labor_cost' => 'Cost',
			'removal_cost' => 'Removal',
			'bags_of_concrete' => 'Bags Of Concrete(per post)',
			'post_caps_id' => 'Post Caps',
			'single_gates_id' => 'Single Gates',
			'double_gates_id' => 'Double Gates',
			'install_labor_cost' => 'Install Labor Cost per-foot',
			'material_markup_percent' => 'Material Markup Percent(%)',
			'product_image' => 'Product Image',
			'product_document' => 'Product Document',
		    'featured_image' => 'Featured Image',
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
		$criteria->compare('system_name',$this->system_name,true);
		$criteria->compare('system_id',$this->system_id,true);
		$criteria->compare('network_type',$this->network_type,true);
		$criteria->compare('store_id',$this->store_id,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('fence_style',$this->fence_style,true);
		$criteria->compare('section_mount',$this->section_mount,true);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('is_hide',$this->is_hide);
		$criteria->compare('assign_categories',$this->assign_categories,true);
		$criteria->compare('is_blank',$this->is_blank);
		$criteria->compare('group_material_id',$this->group_material_id,true);
		$criteria->compare('section_post_spacing',$this->section_post_spacing,true);
		$criteria->compare('section_division_style',$this->section_division_style,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('pricing',$this->pricing,true);
		$criteria->compare('pricing_value',$this->pricing_value,true);
		$criteria->compare('section_specs',$this->section_specs,true);
		$criteria->compare('section_price',$this->section_price,true);
		$criteria->compare('section_item',$this->section_item,true);
		$criteria->compare('section_sku',$this->section_sku,true);
		$criteria->compare('line_post_specs',$this->line_post_specs,true);
		$criteria->compare('line_post_price',$this->line_post_price,true);
		$criteria->compare('line_post_item',$this->line_post_item,true);
		$criteria->compare('line_post_sku',$this->line_post_sku,true);
		$criteria->compare('corner_post_specs',$this->corner_post_specs,true);
		$criteria->compare('corner_post_price',$this->corner_post_price,true);
		$criteria->compare('corner_post_item',$this->corner_post_item,true);
		$criteria->compare('corner_post_sku',$this->corner_post_sku,true);
		$criteria->compare('end_post_specs',$this->end_post_specs,true);
		$criteria->compare('end_post_price',$this->end_post_price,true);
		$criteria->compare('end_post_item',$this->end_post_item,true);
		$criteria->compare('end_post_sku',$this->end_post_sku,true);
		$criteria->compare('blank_post_specs',$this->blank_post_specs,true);
		$criteria->compare('blank_post_price',$this->blank_post_price,true);
		$criteria->compare('blank_post_item',$this->blank_post_item,true);
		$criteria->compare('blank_post_sku',$this->blank_post_sku,true);
		$criteria->compare('bracket_kits_price',$this->bracket_kits_price,true);
		$criteria->compare('bracket_kits_item',$this->bracket_kits_item,true);
		$criteria->compare('bracket_kits_sku',$this->bracket_kits_sku,true);
		$criteria->compare('gate_post_specs',$this->gate_post_specs,true);
		$criteria->compare('gate_post_price',$this->gate_post_price,true);
		$criteria->compare('gate_post_item',$this->gate_post_item,true);
		$criteria->compare('gate_post_sku',$this->gate_post_sku,true);
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