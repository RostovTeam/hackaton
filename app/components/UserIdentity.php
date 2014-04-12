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
        $user = User::model()->find('login=?', array($this->username));

        if ($user === null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif (!$user->validatePassword($this->password))
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else
        {
            $this->_id = $user->user_id;
            $this->username = $user->login;
            $this->errorCode = self::ERROR_NONE;

            $arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2,
                    $user->user_id);
            $roles = array_keys($arrayAuthRoleItems);

            if ($roles[0])
            {
                $role = strtolower($roles[0]);
                $this->setState('role', $role);
            }
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

}
