<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $salt
 *
 * The followings are the available model relations:
 * @property Members[] $members
 */
class User extends ActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('login', 'length', 'max' => 45),
            array('password, salt', 'length', 'max' => 400),
            array('id, login, password, salt', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {

        return array(
            'member' => array(self::HAS_ONE, Member::className(), 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'salt' => 'Salt',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * hash password before save user
     * 
     * @return boolean
     */
    public function beforeSave()
    {
        if (parent::beforeSave())
        {
            $this->salt = $this->generateSalt();
            $this->password = $this->hashPassword($this->password, $this->salt);
            return true;
        }
        return false;
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

}
