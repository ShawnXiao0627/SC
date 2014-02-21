<?php

class MenuController extends Controller
{
    public function actionIndex()
    {
        $menuItem = Menu::model()->getFirstMenu();
        Yii::app()->session['menuUserItemId'] = $menuItem['id'];
        $this->render('index', array('menuItem' => $menuItem));
    }

    /**
     * Turn to create page.
     */
    public function actionToCreate()
    {
        $this->render('create_menu');
    }
    
    public function actionCreateMenu()
    {   
        $httprequest = $this->_request;
        $menuName = $httprequest->getPost('menu-name');
        if ($menuName && $menuName != '')
        {
            try 
            {
                Menu::model()->createMenu($menuName);
            } catch (Exception $e) 
            {
                //TODO
                Yii::log($e, CLogger::LEVEL_ERROR, 'yiicms.base.createmenu');
            }  
        $menuItem = Menu::model()->getFirstMenu();
        $this->render('index', array('menuItem' => $menuItem));
        }
        
    }
  
    public function actionSelectMenu()
    {
        $httprequest = $this->_request;
        $menuId = $httprequest->getPost('menuId');
        $menu = Menu::model()->findByPk($menuId);
        if (isset($menu)) {
           //$this->responseJSON(array('data'=>$menu));
            Yii::app()->session['menuUserItemId'] = $menuId;
            echo CJSON::encode(array(
                'status' => STATUS_SUCCESS,
                'data' => $menu
            ));
        } 
    }
    
    /**
     * Get menu by id.
     */
    public function actionGetMenu()
    {
        $httprequest = $this->_request;
        $menuId = $httprequest->getQuery('id');
        $menu = Menu::model()->findByPk($menuId);
        
        if ($menu)
        {
            $this->render('update', array('model' => $menu));
        }
    }

    /**
     * Init the Menu list
     */
    public function actionShowMenu()
    { 
        $request = Yii::app()->request;
        $menuId= $request->getPost('menuId');
        
        if($menuId && $menuId != '')
        {
            $menuItems = Menu::model()->getMenuItemById($menuId);
            $menuList = array();
            Util::getMenuStructure($menuItems, $menuList);
            $this->responseJSON(array(
                'status' => STATUS_SUCCESS,
                'data' => $menuList
            ));
           }
        
    }
    
    public function actionAddPageToMenu()
    {
        $request = Yii::app()->request;
        $menuItems = $request->getPost('menuItems');
        
        foreach ($menuItems as $items)
        {
            $menuId = $items['menuId'];
            $pageId = $items['pageId'];
            
            if ($menuId && $pageId)
            {
                try 
                {
                    Menu::model()->addItems($menuId, $pageId);
                } catch (Exception $e) {
                    $this->responseJSON(array(
                       'status'=>STATUS_FAIL
                    ));
                }
              
            }
        }
      $this->responseJSON(array(
          'status'=>STATUS_SUCCESS
      ));
    }

    /**
     * Reset the menu order
     */
    public function actionResetMenuOrder()
    {
        $request = Yii::app()->request;
        $updatMenuOrder = $request->getPost('menuOrderList');
        try 
        {
            Menu::model()->updateMenuOrder($updatMenuOrder);
        } catch (Exception $e) 
        {
            $this->responseJSON(array('status' => STATUS_FAIL));
            Yii::log($e, CLogger::LEVEL_ERROR, 'yiicms.base.MenuController.actionResetMenuOrder');
        }
        $this->responseJSON(array('status' => STATUS_SUCCESS));
    }

    /**
     * Save a new menu.
     */
    public function actionSave()
    {
        $httprequest = $this->_request;
        $menu = new Menu;
        $termTaxonomy = new TermTaxonomy;
        $menu->name = $httprequest->getPost('name');
        $menu->slug = $menu->name;
        
        if (Menu::model()->find('name=:name', array(':name' => $menu->name)))
        {
            $this->render('create');
        }
        else
        {
            if ($menu->save())
            {
                $termTaxonomy->term_id = $menu->id;
                $termTaxonomy->taxonomy = TAXONOMY_NAV_MENU;
                $termTaxonomy->save();
                $this->redirect('index');
            }
            else
            {
                Yii::log('menu create fail', CLogger::LEVEL_ERROR, 'yiicms.base.MenuController.actionSave');
                $this->render('create');
            }
        }
    }
    
    
    /**
     * For update the menu.
     */
    public function actionUpdate()
    {
        $httprequest = $this->_request;
        $termId = $httprequest->getPost('id');
        $newName = $httprequest->getPost('name');
        $menu = Menu::model()->findByPk($termId);
        $menu->name = $newName;
        
        if (!$menu->update())
        {
            Yii::log('menu update fail', CLogger::LEVEL_ERROR, 'yiicms.base.MenuController.Update menu');
            $this->render('update');
        }
        $this->redirect('index');
    }

    /**
     * For delete menu.
     */
    public function actionDelete()
    {
        $httprequest = $this->_request;
        $termId = $httprequest->getParam('id');
        try {
          
            if(Menu::model()->deleteMenuAndCascadeOthers($termId))
            {  
                $menuItem = Menu::model()->getFirstMenu();
                $this->render('index', array('menuItem' => $menuItem));
            }
            else
            {
                Yii::log('menu delete fail', CLogger::LEVEL_ERROR, 'yiicms.base.MenuController.actionDelete');
                //$this->render('index');
               
            }
        } catch (Exception $e) 
        {
            //TODO
            Yii::log($e, CLogger::LEVEL_ERROR, 'yiicms.base.MenuController.Delete menu');
        }
    }

    /**
     * Show menu list.
     */
    public function actionList()
    {
        $httprequest = $this->_request;
        $menuList = Menu::model()->getMenusList();
        $result['data'] = isset($menuList['list']) ? $menuList['list'] : array();
        $this->responseJSON($result);
    }
    
    public function actionShowUserMenu()
    {
      $this->layout = '//user_layouts/main';
      $menuId = $_SESSION['menuUserItemId'];
      
      if ($menuId)
      {
          $menuItems = Menu::model()->getMenuItemById($menuId);
            $menuList = array();
            Util::getMenuStructure($menuItems, $menuList);
            $this->responseJSON(array(
                'status' => STATUS_SUCCESS,
                'data' => $menuList
            ));
      }else {
          $this->responseJSON(array(
                'status' => STATUS_FAIL
            ));
      }
      
            
    }
    public function actionTest(){
      $this->layout = '//user_layouts/main';
      $this->render('test');
    }
    public function actionDeleteItem()
    {
        $httprequest = $this->_request;
        $itemId = $httprequest->getPost('itemId');
        if ($itemId) {
          
            try {
                Menu::model()->deleteMenuItem($itemId);
            }catch(Exception $e) 
            {
                //TODO handle erro information
                $this->responseJSON(array('status' => STATUS_FAIL));
                Yii::log($e, CLogger::LEVEL_ERROR, 'yiicms.base.MenuController.Delete item');
            }
            $this->responseJSON(array('status' => STATUS_SUCCESS));   
        }
    }

}
