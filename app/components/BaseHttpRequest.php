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
        
        $json= CJSON::decode($request_body);
        
        Yii::log(json_encode($json,JSON_PRETTY_PRINT));
        
        return $json;
    }
}
