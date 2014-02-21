<?php
class YcmsModule extends CWebModule
{
    private $_assetsUrl;
    
    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()
                    ->publish(
                            Yii::getPathOfAlias(
                                    'application.modules.ycms.static'));
        return $this->_assetsUrl;
    }

    public function setAssetsUrl($value)
    {
        $this->_assetsUrl = $value;
    }

    public function init()
    {
        $this->setImport(array('ycms.models.*', 'ycms.components.*',));
        $this->defaultController = 'site/index';
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action))
        {
            return true;
        } else
        {
            return false;
        }
    }
}
