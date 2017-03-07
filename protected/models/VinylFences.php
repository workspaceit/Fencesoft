<?php

/**
 * This is the model class for table "vinyl_fences".
 *
 * The followings are the available columns in table 'vinyl_fences':
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
 * @property string $rail_specs
 * @property string $rail_price
 * @property string $rail_item
 * @property string $rail_sku
 * @property string $rail_length
 * @property string $no_of_rails
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
 * @property string $labor_cost_type
 * @property string $labor_cost
 * @property string $removal_cost
 * @property string $bracket_kits_specs
 * @property string $bracket_kits_price
 * @property string $bracket_kits_item
 * @property string $bracket_kits_sku
 * @property string $bags_of_concrete
 * @property string $use_post_cap_clips
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
class VinylFences extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VinylFences the static model class
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
		return 'vinyl_fences';
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
			array('system_id, section_division_style, pricing_value, section_specs, section_item, section_sku, rail_specs, rail_item, rail_sku, line_post_specs, line_post_item, line_post_sku, corner_post_specs, corner_post_item, corner_post_sku, end_post_specs, end_post_item, end_post_sku, blank_post_specs, blank_post_item, blank_post_sku, removal_cost, bracket_kits_item, bracket_kits_sku, post_caps_id, single_gates_id, double_gates_id, install_labor_cost, material_markup_percent', 'length', 'max'=>100),
			array('network_type, fence_style', 'length', 'max'=>12),
			array('store_id, short_description, assign_categories, labor_cost_type, bracket_kits_specs, product_image, product_document, featured_image', 'length', 'max'=>255),
			array('section_mount', 'length', 'max'=>14),
			array('height, group_material_id, color, pricing, no_of_rails', 'length', 'max'=>20),
			array('section_post_spacing', 'length', 'max'=>10),
			array('section_price, rail_price, line_post_price, corner_post_price, end_post_price, blank_post_price, bracket_kits_price', 'length', 'max'=>50),
			array('rail_length, bags_of_concrete', 'length', 'max'=>11),
			array('labor_cost', 'length', 'max'=>200),
			array('use_post_cap_clips', 'length', 'max'=>3),
			array('description, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, system_name, system_id, network_type, store_id, short_description, description, fence_style, section_mount, height, is_hide, assign_categories, is_blank, group_material_id, section_post_spacing, section_division_style, color, pricing, pricing_value, section_specs, section_price, section_item, section_sku, rail_specs, rail_price, rail_item, rail_sku, rail_length, no_of_rails, line_post_specs, line_post_price, line_post_item, line_post_sku, corner_post_specs, corner_post_price, corner_post_item, corner_post_sku, end_post_specs, end_post_price, end_post_item, end_post_sku, blank_post_specs, blank_post_price, blank_post_item, blank_post_sku, labor_cost_type, labor_cost, removal_cost, bracket_kits_specs, bracket_kits_price, bracket_kits_item, bracket_kits_sku, bags_of_concrete, use_post_cap_clips, post_caps_id, single_gates_id, double_gates_id, install_labor_cost, material_markup_percent, product_image, product_document, featured_image, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'section_mount' => 'Section Mount',
			'height' => 'Height',
			'is_hide' => 'Is Hide',
			'assign_categories' => 'Assign Categories',
			'is_blank' => 'Is Blank',
			'group_material_id' => 'Group Material',
			'section_post_spacing' => 'Section Post Spacing',
			'section_division_style' => 'Section Division Style',
			'color' => 'Color',
			'pricing' => 'Pricing',
			'pricing_value' => 'Pricing Value',
			'section_specs' => 'Section Specs',
			'section_price' => 'Section Price',
			'section_item' => 'Section Item',
			'section_sku' => 'Section Sku',
			'rail_specs' => 'Rail Specs',
			'rail_price' => 'Rail Price',
			'rail_item' => 'Rail Item',
			'rail_sku' => 'Rail Sku',
			'rail_length' => 'Rail Length',
			'no_of_rails' => 'No Of Rails',
			'line_post_specs' => 'Line Post Specs',
			'line_post_price' => 'Line Post Price',
			'line_post_item' => 'Line Post Item',
			'line_post_sku' => 'Line Post Sku',
			'corner_post_specs' => 'Corner Post Specs',
			'corner_post_price' => 'Corner Post Price',
			'corner_post_item' => 'Corner Post Item',
			'corner_post_sku' => 'Corner Post Sku',
			'end_post_specs' => 'End Post Specs',
			'end_post_price' => 'End Post Price',
			'end_post_item' => 'End Post Item',
			'end_post_sku' => 'End Post Sku',
			'blank_post_specs' => 'Blank Post Specs',
			'blank_post_price' => 'Blank Post Price',
			'blank_post_item' => 'Blank Post Item',
			'blank_post_sku' => 'Blank Post Sku',
			'labor_cost_type' => 'Labor Cost Type',
			'labor_cost' => 'Labor Cost',
			'removal_cost' => 'Removal Cost',
			'bracket_kits_specs' => 'Bracket Kits Specs',
			'bracket_kits_price' => 'Bracket Kits Price',
			'bracket_kits_item' => 'Bracket Kits Item',
			'bracket_kits_sku' => 'Bracket Kits Sku',
			'bags_of_concrete' => 'Bags Of Concrete',
			'use_post_cap_clips' => 'Use Post Cap Clips',
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
		$criteria->compare('rail_specs',$this->rail_specs,true);
		$criteria->compare('rail_price',$this->rail_price,true);
		$criteria->compare('rail_item',$this->rail_item,true);
		$criteria->compare('rail_sku',$this->rail_sku,true);
		$criteria->compare('rail_length',$this->rail_length,true);
		$criteria->compare('no_of_rails',$this->no_of_rails,true);
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
		$criteria->compare('labor_cost_type',$this->labor_cost_type,true);
		$criteria->compare('labor_cost',$this->labor_cost,true);
		$criteria->compare('removal_cost',$this->removal_cost,true);
		$criteria->compare('bracket_kits_specs',$this->bracket_kits_specs,true);
		$criteria->compare('bracket_kits_price',$this->bracket_kits_price,true);
		$criteria->compare('bracket_kits_item',$this->bracket_kits_item,true);
		$criteria->compare('bracket_kits_sku',$this->bracket_kits_sku,true);
		$criteria->compare('bags_of_concrete',$this->bags_of_concrete,true);
		$criteria->compare('use_post_cap_clips',$this->use_post_cap_clips,true);
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