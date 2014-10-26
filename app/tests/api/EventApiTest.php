<?php

/**
 * 
 *
 * @author Komov Roman
 */
class EventApiTest extends RESTfulApiTestCase
{

    public $modelName = 'Event';
    public $resourse = '/api/Event';
    public $data = [
        'name' => 'best future development',
        'stat_date'=>'2014-12-01 17:00:00',
        'end_date'=>'2014-12-03 19:00:00',
    ];
    public $filter = [
        'name' => 'best'
    ];
}
