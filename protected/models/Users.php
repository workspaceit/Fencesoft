<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $full_name
 * @property string $user_email
 * @property string $profile_img
 * @property string $login_name
 * @property string $password
 * @property string $user_type
 * @property string $network_type
 * @property string $site_id
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip_code
 * @property string $phone
 * @property string $status
 * @property string $created_at
 * @property string $modified_at
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
	        array('login_name, password, user_email, full_name', 'required'),
	        array('user_email', 'unique', 'message' => 'Email already in use'),
	        array('login_name', 'unique', 'message' => 'Login Name already in use'),
			array('full_name, user_email, profile_img, login_name, password, site_id, city, state, zip_code, phone', 'length', 'max'=>255),
			array('user_type', 'length', 'max'=>11),
			array('network_type', 'length', 'max'=>12),
			array('status', 'length', 'max'=>8),
			array('address, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, full_name, user_email, profile_img, login_name, password, user_type, network_type, site_id, address, city, state, zip_code, phone, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'full_name' => 'Full Name',
			'user_email' => 'Email',
			'profile_img' => 'Image',
			'login_name' => 'Login Name',
			'password' => 'Password',
			'user_type' => 'User Type',
			'network_type' => 'Network Type',
			'site_id' => 'Site ID',
			'address' => 'Address',
			'city' => 'City',
			'state' => 'State',
			'zip_code' => 'Zip Code',
			'phone' => 'Phone',
			'status' => 'Status',
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
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('profile_img',$this->profile_img,true);
		$criteria->compare('login_name',$this->login_name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('user_type',$this->user_type,true);
		$criteria->compare('network_type',$this->network_type,true);
		$criteria->compare('site_id',$this->site_id,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('zip_code',$this->zip_code,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}