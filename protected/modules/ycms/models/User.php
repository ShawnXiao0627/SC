<?php
/**
 * @author Denny.chen
 * @createTime 2013.12.03
 * @version 1.0.1
 */
/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $user_login
 * @property string $user_pass
 * @property string $user_nickname
 * @property string $user_email
 * @property string $user_url
 * @property string $user_registered
 * @property string $user_status
 */
class User extends CActiveRecord {

    const ERROR_NONE = 0;
    const ERROR_USERNAME_INVALID = 1;
    const ERROR_PASSWORD_INVALID = 2;

    public $verifyCode;
    public $userId;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
                array('user_login, user_pass, passwordConfir, verifyCode',
                        'required'),
                array('user_login, user_pass', 'length', 'max' => 45),
                array('user_email, user_nickname', 'length', 'max' => 50),
                array('user_nickname', 'unique'),
                array('verifyCode', 'captcha'),
                array('passwordConfirm', 'compare',
                        'compareAttribute' => 'user_pass'),);
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array();
    }

    /**
     * Register an user.
     * @param array $userAttributes Parameters from request.
     * @throws CException If register user fail
     */
    public function saveUser($userAttributes)
    {
        $user = new User();
        $user->user_login = $userAttributes['user_login'];
        $user->user_pass = md5($userAttributes['user_pass']);
        $user->user_email = $userAttributes['user_email'];
        $user->user_nickname = $userAttributes['user_nickname'];
        $user->user_registered = date(DATE_FORMAT, time());

        if (!$user->save(false))
        {
            throw new CException('User register fail.', ERROR_CODE);
        }
    }

    /**
     * Authenticate if the current user is valid
     * @param string $user_login
     * @param string $user_pass
     */
    public function authenticate($user_login, $user_pass)
    {
        $user = User::model()->findByAttributes(array(
            'user_login' => $user_login));

        if ($user === null)
        {
            $errorCode = self::ERROR_USERNAME_INVALID;
        }
        else if ($user->user_pass != md5($user_pass))
        {
            $errorCode = self::ERROR_PASSWROD_INVALID;
        }
        else 
        {
            Yii::app()->session['userId'] = $user->id;
            $errorCode = self::ERROR_NONE;
        }

        return $errorCode;
    }

    /**
     * Get email by user id.
     * @param integer $userId
     */
    public function getEmailByUserId($userId)
    {
        $user = User::model()->findByPk($userId);
        $email = $user->user_email;
        return $email;
    }
    
    /**
     * Get username by user id.
     * @param integer $userId
     */
    public function getUsernameById($userId)
    {
        $user = User::model()->findByPk($userId);
        $userName = $user->user_login;
        return $userName;
    }

    /**
     * Get all users
     */
    public function getAllUsers()
    {
        $sql = 'SELECT * FROM `' . $this->tableName() . '` ';

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $list = $command->queryAll();

        return array('list' => $list);
    }
}
