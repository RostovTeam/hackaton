<?php
/**
 * @author Smotrov Dmitriy <dsxack@gmail.com>
 */

class ApiControllerBuilder {
    private $_postData = array();
    private $_actionParams = array();
    private $_controllerClass;
    private $_actionId;

    static function create() {
        return new static;
    }

    public function setPostData($data = array()){
        $this->_postData = $data;
        return $this;
    }

    public function setActionParams($params = array()) {
        $this->_actionParams = $params;
        return $this;
    }

    public function setControllerClass($controllerClass) {
        $this->_controllerClass = $controllerClass;
        return $this;
    }

    public function setActionId($actionId){
        $this->_actionId = $actionId;
        return $this;
    }

    public function getResponse() {
        if (empty($this->_controllerClass)) {
            throw new Exception('Не задан класс контроллера');
        }

        if (empty($this->_actionId)) {
            throw new Exception('Не задан идентификатор действия');
        }

        $controllerId = preg_replace("/Controller$/", "", $this->_controllerClass);
        /** @var $controller BaseController */
        $controller = new $this->_controllerClass($controllerId);

        ob_start();
        $controller->actionParams = $this->_actionParams;

        (!empty($this->_postData)) && $_POST = $this->_postData;

        $controller->run($this->_actionId);

        return json_decode(ob_get_clean(), true);
    }
} 