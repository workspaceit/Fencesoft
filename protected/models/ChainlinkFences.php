<?php

/**
 * This is the model class for table "chainlink_fences".
 *
 * The followings are the available columns in table 'chainlink_fences':
 * @property string $id
 * @property string $system_name
 * @property string $system_id
 * @property string $network_type
 * @property string $store_id
 * @property string $short_description
 * @property string $description
 * @property string $fence_grad
 * @property string $height
 * @property integer $is_hide
 * @property string $assign_categories
 * @property integer $is_blank
 * @property string $group_material_id
 * @property string $section_post_spacing
 * @property string $section_division_style
 * @property string $pricing
 * @property string $pricing_value
 * @property string $line_post_specs
 * @property string $line_post_price
 * @property string $line_post_item
 * @property string $line_post_sku
 * @property string $terminal_post_specs
 * @property string $terminal_post_price
 * @property string $terminal_post_item
 * @property string $terminal_post_sku
 * @property string $rail_specs
 * @property string $rail_price
 * @property string $rail_item
 * @property string $rail_sku
 * @property string $fabric_specs
 * @property string $fabric_price
 * @property string $fabric_item
 * @property string $fabric_sku
 * @property string $loop_caps_specs
 * @property string $loop_caps_price
 * @property string $loop_caps_item
 * @property string $loop_caps_sku
 * @property string $dome_caps_specs
 * @property string $dome_caps_price
 * @property string $dome_caps_item
 * @property string $dome_caps_sku
 * @property string $tension_bars_specs
 * @property string $tension_bars_price
 * @property string $tension_bars_item
 * @property string $tension_bars_sku
 * @property string $wire_ties_specs
 * @property string $wire_ties_price
 * @property string $wire_ties_item
 * @property string $wire_ties_sku
 * @property string $wire_ties_per_unit
 * @property string $nuts_bolts_specs
 * @property string $nuts_bolts_price
 * @property string $nuts_bolts_item
 * @property string $nuts_bolts_sku
 * @property string $nuts_bolts_per_unit
 * @property string $brace_band_specs
 * @property string $brace_band_price
 * @property string $brace_band_item
 * @property string $brace_band_sku
 * @property string $rail_end_specs
 * @property string $rail_end_price
 * @property string $rail_end_item
 * @property string $rail_end_sku
 * @property string $tension_band_specs
 * @property string $tension_band_price
 * @property string $tension_band_item
 * @property string $tension_band_sku
 * @property string $tension_band_perpost
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
class ChainlinkFences extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChainlinkFences the static model class
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
		return 'chainlink_fences';
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
			array('system_id, section_division_style, pricing_value, line_post_specs, line_post_item, line_post_sku, terminal_post_specs, terminal_post_item, terminal_post_sku, rail_specs, rail_item, rail_sku, fabric_specs, fabric_item, fabric_sku, loop_caps_specs, loop_caps_item, loop_caps_sku, dome_caps_specs, dome_caps_item, dome_caps_sku, tension_bars_specs, tension_bars_item, tension_bars_sku, wire_ties_specs, wire_ties_item, wire_ties_sku, nuts_bolts_specs, nuts_bolts_item, nuts_bolts_sku, brace_band_specs, brace_band_item, brace_band_sku, tension_band_specs, tension_band_item, tension_band_sku, tension_band_perpost, labor_cost_type, removal_cost, post_caps_id, single_gates_id, double_gates_id, install_labor_cost, material_markup_percent', 'length', 'max'=>100),
			array('network_type', 'length', 'max'=>12),
			array('store_id, short_description, assign_categories, wire_ties_per_unit, nuts_bolts_per_unit, rail_end_specs, rail_end_price, rail_end_item, rail_end_sku, product_image, product_document, featured_image', 'length', 'max'=>255),
			array('fence_grad, bags_of_concrete', 'length', 'max'=>11),
			array('height, group_material_id, pricing', 'length', 'max'=>20),
			array('section_post_spacing', 'length', 'max'=>10),
			array('line_post_price, terminal_post_price, rail_price, fabric_price, loop_caps_price, dome_caps_price, tension_bars_price, wire_ties_price, nuts_bolts_price, brace_band_price, tension_band_price', 'length', 'max'=>50),
			array('labor_cost', 'length', 'max'=>200),
			array('description, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, system_name, system_id, network_type, store_id, short_description, description, fence_grad, height, is_hide, assign_categories, is_blank, group_material_id, section_post_spacing, section_division_style, pricing, pricing_value, line_post_specs, line_post_price, line_post_item, line_post_sku, terminal_post_specs, terminal_post_price, terminal_post_item, terminal_post_sku, rail_specs, rail_price, rail_item, rail_sku, fabric_specs, fabric_price, fabric_item, fabric_sku, loop_caps_specs, loop_caps_price, loop_caps_item, loop_caps_sku, dome_caps_specs, dome_caps_price, dome_caps_item, dome_caps_sku, tension_bars_specs, tension_bars_price, tension_bars_item, tension_bars_sku, wire_ties_specs, wire_ties_price, wire_ties_item, wire_ties_sku, wire_ties_per_unit, nuts_bolts_specs, nuts_bolts_price, nuts_bolts_item, nuts_bolts_sku, nuts_bolts_per_unit, brace_band_specs, brace_band_price, brace_band_item, brace_band_sku, rail_end_specs, rail_end_price, rail_end_item, rail_end_sku, tension_band_specs, tension_band_price, tension_band_item, tension_band_sku, tension_band_perpost, labor_cost_type, labor_cost, removal_cost, bags_of_concrete, post_caps_id, single_gates_id, double_gates_id, install_labor_cost, material_markup_percent, product_image, product_document, featured_image, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'fence_grad' => 'Fence Grad',
			'height' => 'Height',
			'is_hide' => 'Is Hide',
			'assign_categories' => 'Assign Categories',
			'is_blank' => 'Is Blank',
			'group_material_id' => 'Group Material',
			'section_post_spacing' => 'Section Post Spacing',
			'section_division_style' => 'Section Division Style',
			'pricing' => 'Pricing',
			'pricing_value' => 'Pricing Value',
			'line_post_specs' => 'Line Post Specs',
			'line_post_price' => 'Line Post Price',
			'line_post_item' => 'Line Post Item',
			'line_post_sku' => 'Line Post Sku',
			'terminal_post_specs' => 'Terminal Post Specs',
			'terminal_post_price' => 'Terminal Post Price',
			'terminal_post_item' => 'Terminal Post Item',
			'terminal_post_sku' => 'Terminal Post Sku',
			'rail_specs' => 'Rail Specs',
			'rail_price' => 'Rail Price',
			'rail_item' => 'Rail Item',
			'rail_sku' => 'Rail Sku',
			'fabric_specs' => 'Fabric Specs',
			'fabric_price' => 'Fabric Price',
			'fabric_item' => 'Fabric Item',
			'fabric_sku' => 'Fabric Sku',
			'loop_caps_specs' => 'Loop Caps Specs',
			'loop_caps_price' => 'Loop Caps Price',
			'loop_caps_item' => 'Loop Caps Item',
			'loop_caps_sku' => 'Loop Caps Sku',
			'dome_caps_specs' => 'Dome Caps Specs',
			'dome_caps_price' => 'Dome Caps Price',
			'dome_caps_item' => 'Dome Caps Item',
			'dome_caps_sku' => 'Dome Caps Sku',
			'tension_bars_specs' => 'Tension Bars Specs',
			'tension_bars_price' => 'Tension Bars Price',
			'tension_bars_item' => 'Tension Bars Item',
			'tension_bars_sku' => 'Tension Bars Sku',
			'wire_ties_specs' => 'Wire Ties Specs',
			'wire_ties_price' => 'Wire Ties Price',
			'wire_ties_item' => 'Wire Ties Item',
			'wire_ties_sku' => 'Wire Ties Sku',
			'wire_ties_per_unit' => 'Wire Ties Per Unit',
			'nuts_bolts_specs' => 'Nuts Bolts Specs',
			'nuts_bolts_price' => 'Nuts Bolts Price',
			'nuts_bolts_item' => 'Nuts Bolts Item',
			'nuts_bolts_sku' => 'Nuts Bolts Sku',
			'nuts_bolts_per_unit' => 'Nuts Bolts Per Unit',
			'brace_band_specs' => 'Brace Band Specs',
			'brace_band_price' => 'Brace Band Price',
			'brace_band_item' => 'Brace Band Item',
			'brace_band_sku' => 'Brace Band Sku',
			'rail_end_specs' => 'Rail End Specs',
			'rail_end_price' => 'Rail End Price',
			'rail_end_item' => 'Rail End Item',
			'rail_end_sku' => 'Rail End Sku',
			'tension_band_specs' => 'Tension Band Specs',
			'tension_band_price' => 'Tension Band Price',
			'tension_band_item' => 'Tension Band Item',
			'tension_band_sku' => 'Tension Band Sku',
			'tension_band_perpost' => 'Tension Band Perpost',
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
		$criteria->compare('fence_grad',$this->fence_grad,true);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('is_hide',$this->is_hide);
		$criteria->compare('assign_categories',$this->assign_categories,true);
		$criteria->compare('is_blank',$this->is_blank);
		$criteria->compare('group_material_id',$this->group_material_id,true);
		$criteria->compare('section_post_spacing',$this->section_post_spacing,true);
		$criteria->compare('section_division_style',$this->section_division_style,true);
		$criteria->compare('pricing',$this->pricing,true);
		$criteria->compare('pricing_value',$this->pricing_value,true);
		$criteria->compare('line_post_specs',$this->line_post_specs,true);
		$criteria->compare('line_post_price',$this->line_post_price,true);
		$criteria->compare('line_post_item',$this->line_post_item,true);
		$criteria->compare('line_post_sku',$this->line_post_sku,true);
		$criteria->compare('terminal_post_specs',$this->terminal_post_specs,true);
		$criteria->compare('terminal_post_price',$this->terminal_post_price,true);
		$criteria->compare('terminal_post_item',$this->terminal_post_item,true);
		$criteria->compare('terminal_post_sku',$this->terminal_post_sku,true);
		$criteria->compare('rail_specs',$this->rail_specs,true);
		$criteria->compare('rail_price',$this->rail_price,true);
		$criteria->compare('rail_item',$this->rail_item,true);
		$criteria->compare('rail_sku',$this->rail_sku,true);
		$criteria->compare('fabric_specs',$this->fabric_specs,true);
		$criteria->compare('fabric_price',$this->fabric_price,true);
		$criteria->compare('fabric_item',$this->fabric_item,true);
		$criteria->compare('fabric_sku',$this->fabric_sku,true);
		$criteria->compare('loop_caps_specs',$this->loop_caps_specs,true);
		$criteria->compare('loop_caps_price',$this->loop_caps_price,true);
		$criteria->compare('loop_caps_item',$this->loop_caps_item,true);
		$criteria->compare('loop_caps_sku',$this->loop_caps_sku,true);
		$criteria->compare('dome_caps_specs',$this->dome_caps_specs,true);
		$criteria->compare('dome_caps_price',$this->dome_caps_price,true);
		$criteria->compare('dome_caps_item',$this->dome_caps_item,true);
		$criteria->compare('dome_caps_sku',$this->dome_caps_sku,true);
		$criteria->compare('tension_bars_specs',$this->tension_bars_specs,true);
		$criteria->compare('tension_bars_price',$this->tension_bars_price,true);
		$criteria->compare('tension_bars_item',$this->tension_bars_item,true);
		$criteria->compare('tension_bars_sku',$this->tension_bars_sku,true);
		$criteria->compare('wire_ties_specs',$this->wire_ties_specs,true);
		$criteria->compare('wire_ties_price',$this->wire_ties_price,true);
		$criteria->compare('wire_ties_item',$this->wire_ties_item,true);
		$criteria->compare('wire_ties_sku',$this->wire_ties_sku,true);
		$criteria->compare('wire_ties_per_unit',$this->wire_ties_per_unit,true);
		$criteria->compare('nuts_bolts_specs',$this->nuts_bolts_specs,true);
		$criteria->compare('nuts_bolts_price',$this->nuts_bolts_price,true);
		$criteria->compare('nuts_bolts_item',$this->nuts_bolts_item,true);
		$criteria->compare('nuts_bolts_sku',$this->nuts_bolts_sku,true);
		$criteria->compare('nuts_bolts_per_unit',$this->nuts_bolts_per_unit,true);
		$criteria->compare('brace_band_specs',$this->brace_band_specs,true);
		$criteria->compare('brace_band_price',$this->brace_band_price,true);
		$criteria->compare('brace_band_item',$this->brace_band_item,true);
		$criteria->compare('brace_band_sku',$this->brace_band_sku,true);
		$criteria->compare('rail_end_specs',$this->rail_end_specs,true);
		$criteria->compare('rail_end_price',$this->rail_end_price,true);
		$criteria->compare('rail_end_item',$this->rail_end_item,true);
		$criteria->compare('rail_end_sku',$this->rail_end_sku,true);
		$criteria->compare('tension_band_specs',$this->tension_band_specs,true);
		$criteria->compare('tension_band_price',$this->tension_band_price,true);
		$criteria->compare('tension_band_item',$this->tension_band_item,true);
		$criteria->compare('tension_band_sku',$this->tension_band_sku,true);
		$criteria->compare('tension_band_perpost',$this->tension_band_perpost,true);
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