<?php

/**
 * 
 *
 * @author Komov Roman
 */
class FullNameUserIdentity extends CUserIdentity
{

    protected $_id;
    protected $fullname;
    protected $phone;

    public function __construct($fullname, $phone)
    {
        $this->fullname = $fullname;
        $this->phone = $phone;
        parent::__construct($fullname, '');
    }

    public function authenticate()
    {
        $normalized = Member::normalizeFullName($this->fullname);
        $user = Member::model()->find('LOWER(full_name)=:fullname and phone=:phone',
                [
            ':fullname' => strtolower($normalized),
            ':phone' => $this->phone
        ]);

        if (!$user)
        {
            $parts = explode(' ', $normalized);

            if (count($parts) >= 2)
                    $user = Member::model()->find('LOWER(full_name)=:fullname and phone=:phone',
                        [
                    ':fullname' => strtolower($parts[1] . ' ' . $parts[0]),
                    ':phone' => $this->phone
                ]);
        }

        if ($user === null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        }

        if ($user->is_perfomed_simple_login && $user->login && $user->password)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        }

        $this->_id = $user->id;

        $this->errorCode = UserIdentity::ERROR_NONE;

        $this->setState('active_event', $user->active_event);
        $this->setState('role', $user->roles ? $user->roles[0]->name : '');

        return true;
    }

    public function getId()
    {
        return $this->_id;
    }

}
