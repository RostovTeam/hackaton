<?php

/**
 * 
 *
 * @author Komov Roman
 */
class ExpertApiTest extends RESTfulApiTestCase
{
    public $modelName = 'Expert';
    public $resourse = '/api/Expert';
    public $data = [
        'full_name' => 'Elon Mask',
        'phone' => '79054447777',
    ];
    public $filter = [
        'full_name' => 'Elon'
    ];
}
