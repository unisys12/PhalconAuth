<?php

use JeremyKendall\Password\PasswordValidator as Validator;

class Auth {

	protected $username;
	protected $password;
	public $user;

	public function attempt($username, $password)
	{

		$user = Users::findFirstByUsername($username);

		if( $this->checkUsername($username, $user) ){

			if( $this->checkPassword($password, $user) ){
				return true;
			}
			return false;
		}else{
			return false;
		}

		//return false; // always returns false just in case anything goes haywire.

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

        $validator = new Validator;

		// Check that password supplied matches the password in the database for that user
        $varified = $validator->isValid($password, $user->password);

        if($varified){
        	return true;
        }

        return false;

	}

}

