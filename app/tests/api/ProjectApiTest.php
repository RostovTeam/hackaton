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
        'owner_id'=>1,
        'event_id'=>1
        
    ];
    public $filter = [
        'name' => 'tesla'
    ];
    
    public $fixtures=[
        'members'=>'Member',
        'events'=>'Event'
    ];
}