<?php

/**
 * 
 *
 * @author Komov Roman
 */
class RESTfulApiTestCase extends ApiTestCase
{

    protected $docFileName;
    protected $module = '';
    protected $filter;
    public $attributes;

    public function __construct()
    {
        $this->docFileName = dirname(__FILE__) . '/../../doc/' . $this->modelName . '.txt';
        $this->docInit();
    }

    public function testApi()
    {
        $this->auth();

        $data = $this->_create();
        $this->_list();
        $this->_view($data['id']);
        $this->_update($data['id']);
        $this->_delete($data['id']);
    }

    public function auth()
    {
        
    }

    public function _create()
    {
        $r = $this->request([
            'url' => $this->resourse,
            'data' => $this->data
        ]);

        $response = $r['json'];
        var_dump($r);
        $this->assertTrue(isset($response['id']));

        $this->docCreate($this->data, $response);

        return $response;
    }

    public function _list()
    {
        $this->method = 'GET';

        $r = $this->request([
            'url' => $this->resourse,
            'data' => $this->data
        ]);

        $response = $r['json'];

        echo json_encode($r, JSON_PRETTY_PRINT);
        $this->assertTrue(isset($response[0]));

        //TODO: test filter
        if ($this->filter) $this->docList($response, array_keys($this->filter));
        else $this->docList($response);

        return $response;
    }

    public function _view($id)
    {
        $this->method = 'GET';
        $this->auth();
        $r = $this->request([
            'url' => $this->resourse . '/' . $id,
            'data' => $this->data
        ]);

        $response = $r['json'];
        var_dump($id);
        var_dump($response);
        $this->assertTrue(isset($response['id']));

        $this->docView($response);

        return $response;
    }

    public function _update($id)
    {

        $this->method = 'PUT';
        $r = $this->request([
            'url' => $this->resourse . '/' . $id,
            'data' => $this->data
        ]);

        $response = $r['json'];
        var_dump($r);
        $this->assertTrue(isset($response['id']));

        $this->docUpdate($this->data, $response);

        return $response;
    }

    public function _delete($id)
    {
        $this->method = 'DELETE';
        $r = $this->request([
            'url' => $this->resourse . '/' . $id,
                //'data' => $this->data
        ]);

        $response = $r['json'];
//        var_dump($response);
        //$this->assertTrue(isset($response['id']));

        $this->docDelete($response);

        return $response;
    }

    public function docInit()
    {
        $fp = fopen($this->docFileName, 'w');

        fwrite($fp, $this->modelName . "\n");

        fclose($fp);

        $this->docAttributes();
    }

    public function docAttributes()
    {
        if (!empty($this->attributes))
        {
            $fp = fopen($this->docFileName, 'a');

            $str = "\n\n ATTRIBUTES \n";

            foreach ($this->attributes as $key => $attr)
            {
                $str.=$key . '  : ' . $attr['value'] . '   ' . $attr['desc'] .
                        ( isset($attr['default']) ? '  DEFAULT: ' . $attr['default'] : '') . "\n";
            }

            $str.="\n\n";
            fwrite($fp, $str);

            fclose($fp);
        }
    }

    public function docCreate($request, $response)
    {
        $fp = fopen($this->docFileName, 'a');

        $str = "\n\n CREATE \n";

        $str.= 'Resourse POST ' . $this->resourse . "\n";

        $str.='Request: ' . "\n";

        if (isset($request['files']))
        {
            $files = array_keys($request['files']);
            unset($request['files']);
            $str.=json_encode($request,
                            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
            $str.= 'Files: ' . implode(', ', $files) . "\n";
        } else
        {
            $str.=json_encode($request,
                            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
        }

        $str.='Response: ' . "\n";

        $str.=json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";

        fwrite($fp, $str);
        fclose($fp);
    }

    public function docUpdate($request, $response)
    {
        $fp = fopen($this->docFileName, 'a');

        $str = "\n\n UPDATE \n";

        $str .= 'Resourse PUT ' . $this->resourse . '/{id}' . "\n";

        $str.='Request: ' . "\n";

        $str.=json_encode($request, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";

        $str.='Response: ' . "\n";

        $str.=json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";

        fwrite($fp, $str);
        fclose($fp);
    }

    public function docList(array $data, $filter = [])
    {
        $fp = fopen($this->docFileName, 'a');

        $str = "\n \n LIST \n";

        $str.= 'Resourse GET ' . $this->resourse . "\n";

        if ($filter) $str.= 'FILTER   ' . implode(', ', $filter) . "\n";

        $str.='Response: ' . "\n";

        $str.=json_encode($data,
                        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";

        fwrite($fp, $str);
        fclose($fp);
    }

    public function docView($data)
    {
        $fp = fopen($this->docFileName, 'a');

        $str = "\n \n VIEW \n";

        $str .= 'Resourse GET ' . $this->resourse . '/{id}' . "\n";

        $str.='Response: ' . "\n";

        $str.=json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";

        fwrite($fp, $str);
        fclose($fp);
    }

    public function docDelete($data)
    {
        $fp = fopen($this->docFileName, 'a');

        $str = "\n \n DELETE \n";

        $str .= 'Resourse DELETE ' . $this->resourse . '/{id}' . "\n";

        $str.='Response: ' . "\n";

        $str.=json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";

        fwrite($fp, $str);
        fclose($fp);
    }

}
