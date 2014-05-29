<?php

use Phalcon\Security as Security;

class Auth {

	protected $username;
	protected $password;
	public $user;

	public function attempt($username, $password)
	{

		$user = Users::findFirstByUsername($username);

		if( $this->checkUsername($user) ){

			if( $this->checkPassword($password, $user) ){
				return true;
			}
			return false;
		}else{
			return false;
		}

	}

	private function checkUsername($user)
	{

		if($user){
			return true;
		}
		return null;

	}

	private function checkPassword($password, $user)
	{
		$security = new Security;

		// Check that password supplied matches the password in the database for that user
        $varified = $security->checkHash($password, $user->password);

        if($varified){
        	return true;
        }

        return false;

	}

}

