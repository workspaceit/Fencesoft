<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $user_fname
 * @property string $user_lname
 * @property string $email
 * @property string $password
 * @property string $site_id
 * @property string $address
 * @property string $status
 * @property string $last_login
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
			array('user_fname, user_lname, password', 'length', 'max'=>100),
			array('email', 'length', 'max'=>255),
			array('site_id, status', 'length', 'max'=>11),
			array('address, last_login, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_fname, user_lname, email, password, site_id, address, status, last_login, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'user_fname' => 'First name',
			'user_lname' => 'Last name',
			'email' => 'Email *',
			'password' => 'Password *',
			'site_id' => 'Site',
			'address' => 'Address',
			'status' => 'Status',
			'last_login' => 'Last Login',
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
		$criteria->compare('user_fname',$this->user_fname,true);
		$criteria->compare('user_lname',$this->user_lname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('site_id',$this->site_id,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}