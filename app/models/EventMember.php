<?php

/**
 * This is the model class for table "event_members".
 *
 * The followings are the available columns in table 'event_members':
 * @property integer $event_id
 * @property integer $members_id
 * @property integer $status
 */
class EventMember extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event_members';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('event_id, members_id', 'required'),
			array('event_id, members_id, status', 'numerical', 'integerOnly'=>true),
			array('event_id, members_id, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'event_id' => 'Event',
			'members_id' => 'Members',
			'status' => 'Status',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EventMembers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
