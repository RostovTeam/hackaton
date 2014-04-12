<?php

abstract class RESTfulController extends Controller
{

    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers 
     */
    Const APPLICATION_ID = 'ASCCPE';

    private $format = 'json';
    protected $model;

    /**
     * Defines criteria that is used to search models.
     * Return null means search is not needed;
     * 
     * @return CDbCriteria
     */
    protected function getFilterCriteria()
    {
        return new CDbCriteria();
    }

    protected function serializeView($model)
    {
        return $model->attributes;
    }

    protected function serializeList(array $models)
    {
        $result = array();
        foreach ($models as $model)
        {
            $result[] = $this->serializeView($model);
        }
        return $result;
    }

    protected function transform(&$model)
    {
        return $model;
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array('accessControl');
    }

    public function accessRules()
    {
        return array(
            array('deny',
                'users' => array('*'),
                'deniedCallback' => array($this, 'apiAccessDenied')),
        );
    }

    public function apiAccessDenied($rule)
    {
        $this->_sendResponse(403, (array('error' => 'access_denied')));
    }

    public function actionIndex()
    {
        echo CJSON::encode(array());
    }

    public function actionList()
    {
        $modelname = $this->model;

        $criteria = $this->getFilterCriteria();

        if ($criteria == null)
        {
            $this->_sendResponse(400, array());
        }

        $models = $modelname::model()->findAll($criteria);

        if (is_null($models))
        {
            $this->_sendResponse(200, array());
        } else
        {
            $this->_sendResponse(200, $this->serializeList($models));
        }
    }

    /** Shows a single item
     * 
     * @access public
     * @return void
     */
    public function actionView($id)
    {
        $modelname = $this->model;

        $model = $modelname::model()->findByPk($id);

        if (!$model)
        {
            $this->_sendResponse(404, array('error' => "Couldn't find model."));
        } else
        {
            $this->_sendResponse(200, $this->serializeView($model));
        }
    }

    /**
     * Creates a new item
     * 
     * @access public
     * @return void
     */
    public function actionCreate()
    {
        $modelname = $this->model;

        $model = new $modelname('create');

        $params = Yii::app()->request->getJsonData();

        if (!$params)
        {
            $this->_sendResponse(400, array('error' => 'empty request'));
        }

        $model->attributes = $params;

        $this->transform($model);

        if (!$model->validate())
        {
            $this->_sendResponse(500,
                    array('error' => 'validation_errors', 'errors_list' => $model->errors));
        }


        if (!$model->save())
        {
            $this->_sendResponse(500, array('error' => 'internal_error'));
        }

        $this->_sendResponse(200, $model->attributes);
    }

    /**
     * Update a single iten
     * 
     * @access public
     * @return void
     */
    public function actionUpdate($id)
    {
        $modelname = $this->model;

        $model = $modelname::model()->findByPk($id);

        if (!$model)
                $this->_sendResponse(400,
                    array('error' => "Couldn't find model."));

        $params = $params = Yii::app()->request->getJsonData();

        if (!$params)
        {
            $this->_sendResponse(400,
                    array('error' => 'PUT array should contain model name as key'));
        }

        $model->attributes = $params;

        $this->transform($model);
        
        if (!$model->validate())
        {
            $this->_sendResponse(500,
                    array('error' => 'validation_errors', 'errors_list' => $model->errors));
        }

        if (!$model->save())
        {
            $this->_sendResponse(500, array('error' => 'internal_error'));
        }

        $this->_sendResponse(200, $model->attributes);
    }

    /**
     * Deletes a single item
     * 
     * @access public
     * @return void
     */
    public function actionDelete($id)
    {
        $modelname = $this->model;

        $model = $modelname::model()->findByPk($id);

        if (!$model)
        {
            // No, raise an error
            $this->_sendResponse(400, array('error' => "Couldn't find model."));
        }

        $num = $model->delete();
        if ($num > 0) $this->_sendResponse(200, array('error' => 0));
        else
                $this->_sendResponse(500,
                    array('error' => "Couldn't delete model."));
    }

    /**
     * Sends the API response 
     * 
     * @param int $status 
     * @param string $body 
     * @param string $content_type 
     * @access protected
     * @return void
     */
    public function _sendResponse($status = 200, $body = '',
            $content_type = 'application/json')
    {
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        // set the status
        header($status_header);
        // set the content type
        header('Content-type: ' . $content_type);

        // pages with body are easy
        if ($body != '')
        {
            // send the body
            echo $this->_getObjectEncoded($body);
            exit;
        }
        // we need to create the body if none is passed
        else
        {
            // create some body messages
            $message = '';

            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain
            switch ($status)
            {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            // servers don't always have a signature turned on (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

            // this should be templatized in a real-world solution
            $body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                        <html>
                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                                <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
                            </head>
                            <body>
                                <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
                                <p>' . $message . '</p>
                                <hr />
                                <address>' . $signature . '</address>
                            </body>
                        </html>';

            echo $body;
            exit();
        }
    }

    /**
     * Gets the message for a status code
     * 
     * @param mixed $status 
     * @access protected
     * @return string
     */
    protected function _getStatusCodeMessage($status)
    {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );

        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    /**
     * Checks if a request is authorized
     * 
     * @access private
     * @return void
     */
    protected function _checkAuth()
    {
        // Check if we have the USERNAME and PASSWORD HTTP headers set?
        if (!(isset($_SERVER['HTTP_X_' . self::APPLICATION_ID . '_USERNAME']) and isset($_SERVER['HTTP_X_' . self::APPLICATION_ID . '_PASSWORD'])))
        {
            // Error: Unauthorized
            $this->_sendResponse(401);
        }
        $username = $_SERVER['HTTP_X_' . self::APPLICATION_ID . '_USERNAME'];
        $password = $_SERVER['HTTP_X_' . self::APPLICATION_ID . '_PASSWORD'];
        // Find the user
        $user = User::model()->find('LOWER(username)=?',
                array(strtolower($username)));
        if ($user === null)
        {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Name is invalid');
        } else if (!$user->validatePassword($password))
        {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Password is invalid');
        }
    }

    /**
     * Returns the json or xml encoded array
     * 
     * @param mixed $model 
     * @param mixed $array Data to be encoded
     * @access protected
     * @return void
     */
    protected function _getObjectEncoded($array)
    {
        if (isset($_GET['format'])) $this->format = $_GET['format'];

        if ($this->format == 'json')
        {
            return CJSON::encode($array);
        } elseif ($this->format == 'xml')
        {
            $result = '<?xml version="1.0">';
            $result .= "\n<model>\n";
            foreach ($array as $key => $value)
                $result .= "    <$key>" . utf8_encode($value) . "</$key>\n";
            $result .= '</model>';
            return $result;
        } else
        {
            return false;
        }
    }

}
