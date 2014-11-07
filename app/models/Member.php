<?php

/**
 * This is the model class for table "members".
 *
 * The followings are the available columns in table 'members':
 * @property integer $id
 * @property integer $user_id
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property string $created
 * @property string $git_nickname
 * @property string $vk_link
 *
 * @property Events[] $events
 * @property Projects[] $projects
 */
class Member extends ActiveRecord
{

    const MEMBER_TYPE_MEMBER = 'member';
    const MEMBER_TYPE_MANAGER = 'manager';
    const MEMBER_TYPE_EXPERT = 'expert';

    public $event_id;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'members';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('full_name', 'required'),
            array('login,password', 'required', 'on' => 'change_password'),
            array('full_name', 'length', 'max' => 450),
            array('occupation', 'safe',),
            array('email', 'length', 'max' => 200),
            array('phone', 'length', 'max' => 20),
            array('git_nickname', 'length', 'max' => 50),
            array('vk_link', 'length', 'max' => 100),
            array('vk_link', 'unsafe'),
            array('active_event', 'numerical', 'integerOnly' => true),
            array('type', 'in', 'range' => ['member', 'manager', 'expert']),
            array('type', 'unsafe'),
            array('type', 'required'),
            array('login', 'length', 'max' => 45),
            array('password, salt', 'length', 'max' => 400),
            array('id, login, password, salt', 'safe', 'on' => 'search'),
            array('id, full_name, email, phone, created, git_nickname, vk_link',
                'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'events' => array(self::MANY_MANY, Event::className(), 'event_members(members_id, event_id)'),
            'projects' => array(self::HAS_MANY, Project::className(), 'owner_id'),
            'roles' => array(self::MANY_MANY, Role::className(), 'member_roles(userid,itemname)'),
            'activeEvent' => array(self::BELONGS_TO, Event::className(), 'active_event')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
        );
    }

    public function afterSave()
    {
        parent::afterSave();

        if ($this->isNewRecord)
        {
            $member_role = new MemberRole();
            $member_role->userid = $this->id;
            $member_role->itemname = $this->type;
            $member_role->save();
        }
    }

    /**
     * 
     * 
     * @return boolean
     */
    public function beforeSave()
    {
        parent::beforeSave();
        if ($this->password && $this->login && ($this->isNewRecord || $this->scenario === 'change_password'))
        {
            $this->salt = $this->generateSalt();
            $this->password = $this->hashPassword($this->password, $this->salt);
        }

        if ($this->isNewRecord && $this->event_id)
        {
            $this->addToEvent($this->event_id);
        }
        
        $tihs->full_name= self::normalizeFullName($this->full_name);
                

        return true;
    }

    public function addToEvent($event_id)
    {
        return Yii::app()->db->createCommand()->insert('event_members',
                        ['members_id' => $this->id, 'event_id' => $event_id]);
    }

    /**
     * Check if given passwrod matches hashed password
     * 
     * @param String $password
     * @return Bool  
     */
    public function validatePassword($password)
    {
        return $this->hashPassword($password, $this->salt) === $this->password;
    }

    /**
     * Hash passwod with salt
     * 
     * @param String $password
     * @param String $salt
     * @return String 
     */
    public function hashPassword($password, $salt)
    {
        return md5(md5($salt) . $password);
    }

    /**
     * Generates additional hash 
     * @return uuid
     */
    protected function generateSalt()
    {
        return uniqid('', true);
    }

    /**
     * Returns the static model of the specified AR class.
     * 
     * @param string $className active record class name.
     * @return Members the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function normalizeFullName($fullname)
    {
        $_i = trim(preg_replace('/\s+/', ' ', $fullname));

        $parts = explode(' ', $_i);

        if (count($parts) >= 2)
        {
            return $parts[0] . ' ' . $parts[1];
        } else
        {
            return $i;
        }
    }

}
