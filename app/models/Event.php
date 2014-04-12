<?php

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Members[] $members
 * @property Projects[] $projects
 */
class Event extends ActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'events';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'length', 'max' => 45),
            array('start_date, end_date, created', 'safe'),
            array('id, name, start_date, end_date, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'members' => array(self::MANY_MANY, Member::className(), 'event_members(event_id, members_id)'),
            'projects' => array(self::HAS_MANY, Project::className(), 'event_id'),
            'commits'=>[self::HAS_MANY,Commit::className(),['id'=>'project_id'],'through'=>'projects']
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'created' => 'Created',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Events the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
