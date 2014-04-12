<?php
/**
 * @author Smotrov Dmitriy <dsxack@gmail.com>
 */

class BaseController extends \CController{
    use \Traits\ClassName;

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