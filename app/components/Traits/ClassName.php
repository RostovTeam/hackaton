<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 24.09.13
 * Time: 11:08
 */

namespace Traits;


trait ClassName {
    static public function className() {
        return get_called_class();
    }
} 