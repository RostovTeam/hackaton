<?php

/**
 * 
 *
 * @author Komov Roman
 */
class MemberRole extends ActiveRecord
{
    public function tableName()
    {
        return 'member_roles';
    }
    
    public function rules()
    {
        return [
            ['itemname,userid','required']
        ];
    }
}
