<?php

/**
 * 
 *
 * @author Komov Roman
 */
class MemberForm extends FormModel
{

    public $full_name;
    public $event_id;
    public $phone;
    public $email;
    public $git_nickname;
    public $occupation;
    public $vk_link;
    public $active_event;
    public $login;
    public $password;
    public $salt;
    public $type = Member::MEMBER_TYPE_MEMBER;
    public $is_perfomed_simple_login=0;

    public function rules()
    {
        return array_merge(
                Member::model()->rules(),
                [
            ['event_id', 'numerical', 'integerOnly' => true],
            ['login,password,salt', 'unsafe']
                ]
        );
    }

    public function create()
    {
        $member = new Member('create');
        $member->attributes = $this->attributes;
        $member->type = $this->type;

        if ($this->event_id)
        {
            $member->active_event = $this->event_id;
        }

        if (!$member->save())
        {
            $this->addErrors($member->errors);
            return false;
        }

        if ($this->event_id)
        {
            $member->addToEvent($this->event_id);
        }

        return $member;
    }

}
