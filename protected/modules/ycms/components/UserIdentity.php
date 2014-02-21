<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
    
    private $_id;
    private $_username;
    
    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $user = User::model()->findByAttributes(array(
            'user_login' => $this->username));
        if ($user === null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else if ($user->user_pass != md5($this->password))
        {
            $this->errorCode = self::ERROR_PASSWROD_INVALID;
        }
        else 
        {
            $this->_id = $user->id;
            $this->_username = $user->user_login;
            $this->setState('id', $user->id);
            $this->setState('user_login', $user->user_login);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
}
