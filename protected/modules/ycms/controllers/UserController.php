<?php
/**
 * @author Denny.chen
 * @createTime 2013.12.03
 * @version 1.0.1
 */
class UserController extends Controller {

    //public $layout = '//admin_layouts/main';
    public $layout = '//layouts/main';
    //public $layout = '//layouts/login';

    /**
     * Creates User.
     */
    public function actionCreate()
    {
        $httprequest = $this->_request;
        $userAttributes = $httprequest->getPost('user');

        try
        {
            $this->_validateUser($userAttributes);
            User::model()->saveUser($userAttributes);
        }
        catch (Exception $e)
        {
            Yii::log('Register user fail', CLogger::LEVEL_ERROR, 'yiicms.base.UserController.actionRegister');
            $this->responseJSON(array('status' => STATUS_FAIL));
        }
        
        $this->redirect(array('user/login'));
    }

    /**
     * Register a user.
     */
    public function actionRegister()
    {
        $this->render('register');
    }

    public function actionMain()
    {
        $this->layout = '//layouts/main';
        $this->render('/site/index');
    }

    /**
     * Deal with user login.
     */
    public function actionLogin()
    {
        $request = $this->_request;

        $user_login = $request->getParam('user_login');
        $user_pass = $request->getParam('user_pass');
        $result = User::model()->authenticate($user_login, $user_pass);

        if (!$result)
        {
            $this->redirect(array('user/main'));
        }
        $this->render('login');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('User');
        $this->render('login');
    }

    private function _validateUser($userAttributes)
    {
        $user = User::model()->findByAttributes(array(
            'user_login' => $userAttributes['user_login']));
        if ($user != null)
        {
            throw new CException('User is already exist.', ERROR_CODE);
        }
        else if ($userAttributes['user_pass'] != $userAttributes['passwordConfirm'])
        {
            throw new CException('Password do not match.', ERROR_CODE);
        }
    }

}
