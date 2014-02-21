<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
require_once 'Constant.php';
class Controller extends CController
//class Controller extends SBaseController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '/layouts/main';

    /**
    * @var array the breadcrumbs of the current page. The value of this property will
    * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
    * for more details on how to specify this property.
    */
    public $breadcrumbs=array();
  
    protected $_request;
    protected $_baseUrl;
    protected $_session;
    protected $_cookies;
    protected $_params;
    protected $_user;

    public function init()
    {
        $this->_session = new CHttpSession();
        $this->_session->open();
        $this->_cookies = Yii::app()->request->getCookies();
        $this->_request = Yii::app()->request;
        $this->_baseUrl = Yii::app()->baseUrl;
        $this->_params = Yii::app()->params;
        $this->_user = Yii::app()->user;

        parent::init();
    }
    

    public function beforeAction($action)
    {
        /*var_dump($action);
        $userId = Yii::app()->session['userId'];

        if (!$userId)
        {
            $this->render('/user/login', array('model' => new LoginForm));
            Yii::app()->end();
        }*/

        return true;
    }

    /**
     * get the temp file in runtime folder
     * format: runtime/temp/date/username
     */
    public function getTempPath($username)
    {
        return Yii::app()->getRuntimePath() . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . md5($username);
    }

    public function responseJSON($data)
    {
        echo json_encode($data);
        Yii::app()->end();
    }

    /**
     *
     * Log and throw exception devide with type
     *
     * @param unknown_type $type
     * @param unknown_type $message
     */
    public function exceptionHandler($code, $message, $logCategory = null, $type = null)
    {
        $logCategory = $logCategory ? $logCategory : 'ae.base.controller';
        Yii::log($message, CLogger::LEVEL_ERROR, $logCategory);
        if (strtolower($type) === 'json')
        {
            $this->responseJSON(array (
                    'errorCode' => $code, 
                    'message' => $message, 
                    'status' => STATUS_FAIL));
        }
        else
        {
            throw new CHttpException($code, $message);
        }
    }

    /**
     * Generate JSON response data for front end API
     *
     * @param mix $status
     * @param mix $data  data
     * @param int $errorCode error code
     * $param string $message error message
     */
    public function generateJSONData($status, $data, $errorCode = null, $message = null)
    {
        $ret = array();
        if (!$data)
        {
            $data = array();
        }
        if ($status === 200 || $status === true || $status === STATUS_SUCCESS)
        {
            $ret = $data;
            $ret['status'] = STATUS_SUCCESS;
        }
        else
        {
            $ret['status'] = STATUS_FAIL;
            $ret['errorCode'] = $errorCode;
            $ret['message'] = $message;
        }

        return $ret;
    }

    public function registerFile($filePaths)
    {
        if (is_array($filePaths))
        {
            foreach ($filePaths as $filePath)
            {
                $this->registerClientFile($filePath);
            }
        }
        else
        {
            $this->registerClientFile($filePaths);
        }
    }

    private function registerClientFile($filePath)
    {
        $baseUrl = Yii::app()->theme->baseUrl;
        
        $cs = Yii::app()->getClientScript();
        $suffix = substr($filePath, strripos($filePath, '.') + 1);
        if ('css' == strtolower($suffix))
        {
            $cs->registerCssFile($baseUrl . '/css' . $filePath);
        }
        elseif ('js' == strtolower($suffix))
        {
            $cs->registerScriptFile($baseUrl . '/js' . $filePath);
        }
    }

    protected function getParams()
    {
        $args = func_get_args();
        $result = array();
        foreach ($args as $param)
        {
            $value = $this->_request->getParam($param);
            $result[] = $value;
        }
        return $result;
    }

    /**
     * Operate API response, translate to output JSON data
     *
     * @param array $response
     */
    protected  function handleResponse($response)
    {
        if (is_array($response))
        {
            if ((HTTP_CODE_SUCCESS === $response['status']) || (STATUS_SUCCESS === $response['status']))
            {
                return array(
                	'status' => STATUS_SUCCESS, 
                	'data' => $response['data']);
            }
            else
            {
                return array(
                    'status' => STATUS_FAIL, 
                    'message' => $response['message'],
                    'errorCode' => $response['status']);
            }
        }
        else
        {
            return array(
                    'status' => STATUS_FAIL, 
                    'message' => 'API response error',
                    'errorCode' => ERROR_CODE);
        }
    }

}