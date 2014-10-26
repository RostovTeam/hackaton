<?php

/**
 * 
 *
 * @author Komov Roman
 */
class ProjectApiTest extends RESTfulApiTestCase
{
    public $modelName = 'Project';
    public $resourse = '/api/Project';
    public $data = [
        'name' => 'Tesla Motors',
        'description'=>'revolution in auto industry',
    ];
    public $filter = [
        'name' => 'tesla'
    ];
}