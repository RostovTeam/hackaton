<?php

/**
 * This is the model class for table "experts".
 *
 * The followings are the available columns in table 'experts':
 * @property integer $id
 * @property string $full_name
 * @property string $created
 *
 * The followings are the available model relations:
 * @property ProjectCriterias[] $projectCriteriases
 */
class Expert extends ActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'members';
    }

    public function defaultScope()
    {
        return [
            'condition' => 'type=:expert',
            'params' => [':expert' => Member::MEMBER_TYPE_EXPERT]
        ];
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('full_name,phone', 'required'),
            array('full_name', 'length', 'max' => 400),
            array('created', 'safe'),
            array('id, full_name, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'projectCriterias' => array(self::HAS_MANY, ProjectCriteria::className(),
                'expert_id'),
        );
    }

    public function beforeValidate()
    {
        parent::beforeValidate();
        $this->login = $this->phone;
        return true;
    }

    public function afterConstruct()
    {
        parent::afterConstruct();
        $this->type = Member::MEMBER_TYPE_EXPERT;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Experts the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
