<?php

/**
 * Base API test case class
 * 
 * @author Polosin Maxim <polosinms@mail.ru>
 * @copyright Budist, 2012
 * @package Budist
 */
class ApiTestCase extends CDbTestCase
{

    /**
     * @var string - base url for request
     */
    private $_base_url = 'http://job.loc';

    /**
     * @var array - store data from server
     */
    private $_client = array(
        'raw' => '',
        'cookie' => array(),
        'headers' => '',
        'json' => array(),
    );
    protected $method = 'POST';

    /**
     * @var cURL handle
     */
    private $_ch;

    /**
     * Sets up before each test method runs
     * 
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    protected function setUp()
    {
        parent::setUp();

        $this->setBaseUrl(Yii::app()->params['test_base_url']);
    }

    /**
     * Set base URL for request
     *
     * @param string $_url - base url
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    protected function setBaseUrl($_url)
    {
        $this->_base_url = $_url;
    }

    /**
     * Get base URL for request
     *
     * @return string
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    protected function getBaseUrl()
    {
        return $this->_base_url;
    }

    /**
     * Send request to API
     *
     * @param array $_options - request input params
     * @return array
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    protected function request($_opt = array())
    {
        $opt = array_merge(array(
            'url' => '',
            'data' => array(),
            'version' => '1.0',
            'client_version' => Yii::app()->params['version'],
            'platform' => 'web',
            'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/534.55.3 (KHTML, like Gecko) Version/5.1.5 Safari/534.55.3',
            'content_type' => 'multipart/form-data',
            'request_with' => 'XMLHttpRequest',
            'accept' => 'application/json',
            'signature' => '',
                ), $_opt);

        $ch = $this->_curl();

        switch ($this->method)
        {
            case 'GET':
                break;
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                $pf = null;
                if (isset($opt['data']['files']))
                {
                    $_f = $opt['data']['files'];
                    unset($opt['data']['files']);
                    $pf['json'] = CJSON::encode($opt['data']);
                    foreach ($_f as $k => $v)
                        $pf[$k] = $v;
                } else
                {
                    $pf = CJSON::encode($opt['data']);
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $pf);
                break;
            case 'PUT':
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                //TODO: get rid of copy-paste
                $pf = null;
                if (isset($opt['data']['files']))
                {
                    $_f = $opt['data']['files'];
                    unset($opt['data']['files']);
                    $pf['json'] = CJSON::encode($opt['data']);
                    foreach ($_f as $k => $v)
                        $pf[$k] = $v;
                    $pf['_method']='PUT';
                } else
                {
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                    $pf = CJSON::encode($opt['data']);
                }
                //var_dump($pf);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $pf);

                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }
        curl_setopt($ch, CURLOPT_URL, 'http://hackaton.loc' . $opt['url']);

        curl_setopt($ch, CURLOPT_COOKIE, $this->getCookieString());
        curl_setopt($ch, CURLOPT_HTTPHEADER,
                array(
            "Accept:{$opt['accept']}",
            "Content-Type:{$opt['content_type']}",
            "X-Requested-With:{$opt['request_with']}",
            "User-Agent:{$opt['user_agent']}",
            "Api-Version:{$opt['version']}",
            "X-Client-Version:{$opt['client_version']}",
            "X-Platform:{$opt['platform']}",
            "X-Signature:{$opt['signature']}",
            'Expect:'
        ));

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3600);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        $this->_client['url'] = $opt['url'];
        $this->_client['raw'] = curl_exec($ch);
        $this->_client['error'] = curl_error($ch);
        $buff = explode("\r\n\r\n", $this->_client['raw']);

        $this->_client['headers'] = $buff[0];
        $this->_client['json'] = CJSON::decode($buff[count($buff) - 1]);

        $this->_parseCookie();

        $this->_curlClose();

        return $this->_client;
    }

    /**
     * Simply GET-request
     * Support reirect (Location header)
     *
     * @param string $_url - request URL
     * @return string - response content
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    public function requestGet($_url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->getBaseUrl() . $_url);
        curl_setopt($ch, CURLOPT_COOKIE, $this->getCookieString());
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        $raw = explode("\r\n\r\n", curl_exec($ch));

        // Check redirect
        $m = array();
        if (preg_match('/Location\: (.+)\r\n/m', $raw[0], $m))
        {
            $url = preg_replace('/^http\:\/\/[^\/]+/', '/', $m[1]);
            $raw[1] = $this->requestGet($url);
        }

        curl_close($ch);

        return $raw[1];
    }

    /**
     * Get cookie value
     *
     * @param string $_name - name of cookie value
     * @return string - success
     * @return bool false - fail
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    protected function getCookie($_name)
    {
        return isset($this->_client['cookie'][$_name]) ? $this->_client['cookie'][$_name] : false;
    }

    /**
     * Get cookie as string
     *
     * @return string
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    protected function getCookieString()
    {
        return implode('; ',
                array_map(function($a, $b)
                {
                    return "$a=$b";
                }, array_keys($this->_client['cookie']),
                        array_values($this->_client['cookie'])));
    }

    /**
     * Clear cookie
     *
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    protected function clearCookie()
    {
        $this->_client['cookie'] = array();
    }

    /**
     * Set cookie value
     *
     * @param string $_name - name of cookie value
     * @param string $_value - cookie value
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    protected function setCookie($_name, $_value)
    {
        $this->_client['cookie'][$_name] = $_value;
    }

    /**
     * Delete cookie
     *
     * @param string $_name - cookie name
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    protected function deleteCookie($_name)
    {
        if (isset($this->_client['cookie'][$_name]))
        {
            unset($this->_client['cookie'][$_name]);
        }
    }

    /**
     * Assert cookie
     *
     * @param string $_name - cookie name
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    protected function assertCookie($_name)
    {
        $c = $this->getCookie($_name);
        $this->assertFalse($c === false);
        $this->assertFalse(empty($c));
    }

    /**
     * Out response data
     *
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    protected function d()
    {
        $str = var_export($this->_client, true);
        $str = str_replace('\\\\n', "\n", $str);
        $str = preg_replace_callback('/\\\\\\\\u([0-9a-f]{4})/i',
                function($match)
        {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }, $str);
        $str = str_replace('\\\\', '', $str);

        echo $str;
    }

    protected function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * Parse cookie in response header
     *
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    private function _parseCookie()
    {
        if (!$this->_client['headers'])
        {
            return;
        }

        preg_match_all('/^Set-Cookie: (.*?);/m', $this->_client['headers'], $m);
        if (!isset($m[1]) || count($m[1]) == 0)
        {
            return;
        }

        foreach ($m[1] as $v)
        {
            $v = explode('=', $v);

            $this->setCookie($v[0], $v[1]);
        }
    }

    /**
     * Init cURL handle
     * 
     * @return cURL handle
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    private function _curl()
    {
        if ($this->_ch)
        {
            return $this->_ch;
        }

        $this->_ch = curl_init();

        return $this->_ch;
    }

    /**
     * Close cURL handle
     * 
     * @author Polosin Maxim <polosinms@mail.ru>
     */
    private function _curlClose()
    {
        curl_close($this->_ch);
        $this->_ch = null;
    }

}
