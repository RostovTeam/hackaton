<?php

/**
 * This is the model class for table "projects".
 *
 * The followings are the available columns in table 'projects':
 * @property integer $id
 * @property integer $event_id
 * @property integer $owner_id
 * @property string $name
 * @property string $description
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Commits[] $commits
 * @property ProjectCriterias[] $projectCriterias
 * @property Events $event
 * @property Members $owner
 * @property Teams[] $teams
 */
class Project extends ActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'projects';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('event_id, owner_id,git_url', 'required'),
            array('event_id, owner_id', 'numerical', 'integerOnly' => true),
            array('name,git_url', 'length', 'max' => 500),
            array('description, created', 'safe'),
            array('id, event_id, owner_id, name, description, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'projectCriterias' => array(self::HAS_MANY, ProjectCriteria::className(),
                'project_id'),
            'event' => array(self::BELONGS_TO, Event::className(), 'event_id'),
            'owner' => array(self::BELONGS_TO, Member::className(), 'owner_id'),
            'members'=>array(self::MANY_MANY,Member::className(),'project_members(project_id,member_id)')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'event_id' => 'Event',
            'owner_id' => 'Owner',
            'name' => 'Name',
            'description' => 'Description',
            'created' => 'Created',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Projects the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Gets critetias summary value
     * 
     * @return int
     */
    public function getMark()
    {
        return (int) array_sum(array_map(
                                function($v)
                        {
                            return $v->value;
                        }, $this->projectCriterias));
    }

    public function afterSave()
    {
        parent::afterSave();

        Yii::import('application.git.GitHubConnector');

        GitHubConnector::sync();
    }

    public function beforeValidate()
    {
        parent::beforeValidate();
        
        if($existing=$this->findByAttributes(['git_url'=>$this->git_url]))
        {
            $this->id=$existing->id;
            
            $this->setIsNewRecord(false);
        }
        
        return true;
    }
}
