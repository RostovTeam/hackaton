<?php
/**
 *
 *
 */

/**
 * Class Yii
 */
class Yii extends YiiBase {

    /**
     * Автолоадер
     *
     * @param string $alias
     * @param bool $forceInclude
     * @return mixed
     */
    public static function import($alias, $forceInclude = false) {
        $arguments = func_get_args();
        return @call_user_func_array(array(get_parent_class(), 'import'), $arguments) ? : $arguments[0];
    }

    /**
     * @return WebApplication
     */
    static public function app() {
        return parent::app();
    }
}