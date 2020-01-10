<?php 

namespace Paperstreetmedia\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class NatsUser implements Authenticatable {

	public $memberid;
	public $username;
	public $password;
	public $status;
	public $email;
	public $siteid;
	public $identid;
	public $loginid;
	public $networkid;
	public $refurl_lookup_id;	
	public $trial;
	public $joined;
	public $expired;
	public $last_login;
	public $stamp;
	public $ip;
	public $mailok;
	public $flat_price;

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier() {
		return $this->memberid;
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword() {
		return $this->password;
	}

	public function getRememberToken(){
		return md5($_SERVER['REMOTE_ADDR']);
	}

	public function setRememberToken($token){
		return md5($_SERVER['REMOTE_ADDR']);
	}
	public function getRememberTokenName(){
		return md5($_SERVER['REMOTE_ADDR']);
	}
}