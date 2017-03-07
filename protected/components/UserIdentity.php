<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	/* public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	} */
	
	private $_id;
	private $_role;
	
	public function authenticate()
	{
	
	    $record = Users::model()->findByAttributes(array('login_name'=>$this->username));
	
	    if($record===null)
	        $this->errorCode=self::ERROR_USERNAME_INVALID;
	    else if($record->password!==md5($this->password))
	        $this->errorCode=self::ERROR_PASSWORD_INVALID;
	    else
	    {
	        $this->_id = $record->id;
	        $this->_role = $record->user_type;
	        //Yii::app()->user->role = $record->user_type;
	        $this->setState('roles', $record->user_type);
	        $this->errorCode=self::ERROR_NONE;
	        	
	        Yii::app()->session['isLogin'] = true;
	        Yii::app()->session['id'] = $record->id;
	        Yii::app()->session['username']=$this->username;
	        Yii::app()->session['role']=$record->user_type;
	
	        $profile['id'] = $record->id;
	        $profile['full_name'] = $record->full_name;
	        //$profile['user_lname'] = $record->user_lname;
	        $profile['login_name'] = $record->login_name;
	        $profile['profile_img'] = $record->profile_img;
	        $profile['email'] = $record->user_email;
	        $profile['user_type'] = $record->user_type;
	        $profile['network_type'] = $record->network_type;
	        $profile['site_id'] = $record->site_id;
	        $profile['status'] = $record->status;
	        $profile['address'] = $record->address;
	        $profile['city'] = $record->city;
	        $profile['state'] = $record->state;
	        $profile['zip_code'] = $record->zip_code;
	        $profile['phone'] = $record->phone;
	
	        Yii::app()->session['profile'] = $profile;
	    }
	
	    return !$this->errorCode;
	}
	
	public function getId(){
	    return $this->_id;
	}
	
	public function getRole() {
	    return $this->_role;
	}
}