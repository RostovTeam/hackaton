<?php

/**
 * 
 *
 * @author Komov Roman
 */
class PhoneUserIdentity extends CUserIdentity
{

    protected $_id;
    protected $phone;

    public function __construct($phone)
    {
        $this->phone = $phone;
        parent::__construct($phone, '');
    }

    public function authenticate()
    {
        $user = User::model()->findByAttributes(['login' => $this->phone]);

        if ($user === null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        }
        $this->_id = $user->id;

        $this->errorCode = UserIdentity::ERROR_NONE;
        $arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, $user->id);

        $roles = array_keys($arrayAuthRoleItems);

        $role = '';
        if ($roles[0])
        {
            $role = strtolower($roles[0]);
            $this->setState('role', $role);
        }

        if ($role == 'expert')
        {
            $profile = Expert::model()->findByAttributes(['user_id' => $user->id]);

            $this->setState('profile_id', $profile->id);
            $this->setState('username', $profile->full_name);
            $this->username = $profile->full_name;
        }

        return true;
    }

    public function getId()
    {
        return $this->_id;
    }

}
