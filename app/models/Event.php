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

    public $is_active = 1;

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
            array('name,creator,is_active', 'length', 'max' => 45),
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
            'members' => array(self::MANY_MANY, Member::className(), 'event_members(event_id, members_id)',
                'condition' => 'members.type=:type', 'params' => [':type' => Member::MEMBER_TYPE_MEMBER]),
            'managers' => array(self::MANY_MANY, Member::className(), 'event_members(event_id, members_id)',
                'condition' => 'managers.type=:type', 'params' => [ ':type' => Member::MEMBER_TYPE_MANAGER]),
            'experts' => array(self::MANY_MANY, Member::className(), 'event_members(event_id, members_id)',
                'condition' => 'experts.type=:type', 'params' => [':type' => Member::MEMBER_TYPE_EXPERT]),
            'projects' => array(self::HAS_MANY, Project::className(), 'event_id'),
            'criterias' => array(self::MANY_MANY, Criteria::className(), 'event_criterias(event_id, criteria_id)'),
        );
    }

    public function afterSave()
    {
        parent::afterSave();

        if ($this->isNewRecord)
        {
            $this->addMember($this->creator);
        }
    }

    public function addMember($member_id)
    {
        return Yii::app()->db->createCommand()->insert('event_members',
                        ['event_id' => $this->id, 'members_id' => $member_id]);
    }

    public function isActive()
    {
//        $date = date('Y-m-d');
        return $this->is_active; //$date >= $this->start && $date >= $this->end;
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
