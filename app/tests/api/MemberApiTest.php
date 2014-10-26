<?php

/**
 * 
 *
 * @author Komov Roman
 */
class MemberApiTest extends RESTfulApiTestCase
{
    public $modelName = 'Member';
    public $resourse = '/api/Member';
    public $data = [
        'full_name' => 'Elon Mask',
        'phone'=>'79054447777',
    ];
    public $filter = [
        'full_name' => 'Elon'
    ];
}
