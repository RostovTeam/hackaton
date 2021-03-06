<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    private $_id;

    /**
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $user = Member::model()->find('login=?', array($this->username));

        if ($user === null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } 
        elseif (!$user->validatePassword($this->password))
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } 
        else
        {
            $this->_id = $user->id;
            $this->username = $user->login;
            $this->errorCode = self::ERROR_NONE;

            $this->setState('active_event', $user->active_event);
            $this->setState('role', $user->roles ? $user->roles[0]->name : '');
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

}
