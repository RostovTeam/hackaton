<?php

/**
 * 
 *
 * @author Komov Roman
 */
class Role extends ActiveRecord
{

    public function tableName()
    {
        return 'roles';
    }

    public function rules()
    {
        return [
            ['name,type', 'required']
        ];
    }

}
