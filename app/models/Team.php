<?php

/**
 * This is the model class for table "teams".
 *
 * The followings are the available columns in table 'teams':
 * @property integer $id
 * @property integer $project_id
 *
 * The followings are the available model relations:
 * @property Members[] $members
 * @property Projects $project
 */
class Team extends ActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'teams';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array(' project_id', 'required'),
            array(' project_id', 'numerical', 'integerOnly' => true),
            array('id, project_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'members' => array(self::MANY_MANY, Member::className(), 'team_members(team_id, members_id)'),
            'project' => array(self::BELONGS_TO, Project::className(), 'project_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'project_id' => 'Project',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Teams the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
