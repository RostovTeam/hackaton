<?php
/**
 * @author Smotrov Dmitriy <dsxack@gmail.com>
 */

class Controller extends \CController{
    /**
     * @return HttpRequest
     */
    public function request() {
        return \Yii::app()->request;
    }

    /**
     * @return \CWebUser
     */
    protected function user() {
        return \Yii::app()->getUser();
    }
} 