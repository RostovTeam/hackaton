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
 * The followings are the available model relations:
 * @property Commits[] $commits
 * @property Events[] $events
 * @property Users $user
 * @property Projects[] $projects
 * @property Teams[] $teams
 */
class Member extends ActiveRecord
{

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
            array('user_id', 'required'),
            array('user_id', 'numerical', 'integerOnly' => true),
            array('full_name', 'length', 'max' => 450),
            array('email', 'length', 'max' => 200),
            array('phone', 'length', 'max' => 20),
            array('git_nickname', 'length', 'max' => 50),
            array('vk_link', 'length', 'max' => 100),
            array('created', 'safe'),
            array('id, user_id, full_name, email, phone, created, git_nickname, vk_link',
                'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'commits' => array(self::HAS_MANY, Commit::className(), 'member_id'),
            'events' => array(self::MANY_MANY, Event::className(), 'event_members(members_id, event_id)'),
            'user' => array(self::BELONGS_TO, User::className(), 'user_id'),
            'projects' => array(self::HAS_MANY, Project::className(), 'owner_id'),
            'teams' => array(self::MANY_MANY, Team::className(), 'team_members(members_id, team_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'full_name' => 'Full Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'created' => 'Created',
            'git_nickname' => 'Git Nickname',
            'vk_link' => 'Vk Link',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Members the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
