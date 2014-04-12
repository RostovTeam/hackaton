<?php

/**
 * 
 *
 * @author Komov Roman
 */
class BaseHttpRequest extends CHttpRequest 
{
    
    public function getJsonData()
    {
        $request_body=$this->getRawBody();
        
        return CJSON::decode($request_body);
    }
}
