<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 * @author Petr Grishin <petr.grishin@grishini.ru>
 */

/**
 * Class WebApplication
 * @property EAuth eauth
 * @property CWebUser user
 */
class WebApplication extends CWebApplication {
    use \Traits\ClassName;
}
