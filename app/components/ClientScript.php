<?php
/**
 * @author Smotrov Dmitriy <dsxack@gmail.com>
 */

class ClientScript extends CClientScript{
    use \Traits\ClassName;

    public function init() {
        foreach ($this->packages ? : array() as $name => $config) {
            if (!empty($config['sourcePath']) && !isset($config['baseUrl'])) {
                $config['baseUrl'] = $this->_assertManager()->publish($config['sourcePath']);
                $this->packages[$name] = $config;
            }
        }
    }

    /**
     * @return CAssetManager
     */
    private function _assertManager() {
        return Yii::app()->assetManager;
    }
} 