<?php

/**
 * This is the model class for table "terms".
 *
 * The followings are the available columns in table 'terms':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $term_group
 */

class Menu extends CActiveRecord
{
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
        return 'terms';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('name', 'length', 'max' => 200),
        );
    }

    public function attributeLabels()
    {
        return array('name' => 'MenuName','id' => 'ID');
    }

    /**
     * Get menu list.
     */
    public function getMenusList()
    {
        $sql = 'SELECT `id`, `name` FROM `terms` ORDER BY `id` DESC';
        try
        {
            $connection = $this->dbConnection;
            $command = $connection->createCommand($sql);
            $list = $command->queryAll();
            return array('list' => $list);
        }
        catch (Exception $e)
        {
            Yii::log($e, CLogger::LEVEL_ERROR, 'yiicms.base.menu.getMenuList');
            throw new Exception($e);
        }
    }
    
    /**
     * List thee menuItems by the menuId
     * @param int $menuId
     * @return list of the MenuItems
     */
    public function getMenuItemById($menuId = 0)
    {
        $sql = 'SELECT `pm`.`meta_value` AS `menu_parent` ,`tst`.`id` AS `post_id` ,
        `tst`.`post_title` AS `post_title`,`tst`.`term_order` AS `menu_order`, 
        `pmm`.`guid` AS `link` ,`pmm`.`id` AS `page_id`,`pmm`.`post_title` AS `page_title`,
         `pmm`.`post_type` AS `post_type` FROM 
        (SELECT p.* ,`ttt`.`term_order` FROM `posts` `p` INNER JOIN 
        (SELECT `tr`.`term_order`,`tr`.`object_id` FROM `term_relationships` `tr` 
        WHERE `tr`.`term_taxonomy_id`=(SELECT `tt`.`id` FROM `terms` `tm` 
        INNER JOIN `term_taxonomy` `tt` ON `tm`.`id`=`tt`.`term_id` WHERE `tm`.`id`=:menuId)) `ttt` 
        ON `ttt`.`object_id`=`p`.`id`) `tst` INNER JOIN `postmeta` `pm` ON 
        `tst`.`id`=`pm`.`post_id` INNER JOIN(SELECT ps.*,`m`.`meta_value`,`m`.`post_id` 
        FROM `posts` `ps` INNER JOIN `postmeta` `m` WHERE `meta_key`=:menuObject AND `ps`.`id`
        =`m`.`meta_value`)`pmm` ON `pmm`.`post_id`=`tst`.`id` WHERE `pm`.`meta_key`=:menuParentKey';
        $connection = $this->dbConnection;
        $command = $connection->createCommand($sql);
        $command->bindValue(':menuId', $menuId);
        $command->bindValue(':menuParentKey', MENU_ITEM_PARENT);
        $command->bindValue(':menuObject', MENU_ITEM_OBJECT_ID);
        $menueItems = $command->queryAll();
        return $menueItems;
    }
    
    /**
     * Enter description here ...
     */
    public function getFirstMenu()
    {
        $sql = 'SELECT * FROM `terms` ORDER BY `id` DESC LIMIT 1 ';
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $menuItems = $command->queryRow();
        return $menuItems;
    }
    /**
     * Add itmes to the menu by the pageId
     * @param int $menuId
     * @param int $pageId
     */
    public function addItems($menuId, $pageId)
    {
        $currentTime = time();
        $page = Posts::model()->findByPk($pageId);
        $menuItem = new Posts;
        $menuItem->post_author = $page->post_author;
        $menuItem->post_date = $currentTime;
        $menuItem->post_date_gmt = $currentTime;
        $menuItem->post_title = $page->post_title;
        $menuItem->post_status = STATUS_PUBLISH;
        $menuItem->comment_status = STATUS_OPEN;
        $menuItem->post_content = '';
        $menuItem->post_excerpt = '';
        $menuItem->post_name = '';
        $menuItem->post_modified = $currentTime;
        $menuItem->post_modified_gmt = $currentTime;
        $menuItem->post_type = POST_TYPE_MENU;
        $menuItem->post_mime_type = '';
        $menuItem->guid = '';
        $menuItem->save(false);
        $menuItem->post_name = $menuItem->getPrimaryKey();
        $menuItemId=$menuItem->getPrimaryKey();
        $this->_saveTermRelationShips($menuId, $menuItemId);
        $this->_savePostMeta($menuItemId, $pageId);
    }

    /**
     * Find max order by the menuId.
     * @param int $menuId
     * @return int maxOrder
     */
    private function _findMaxOrder($menuId)
    {
        $sql = 'SELECT MAX(`term_order`) FROM `term_relationships`
        WHERE `term_taxonomy_id`= (SELECT `id` FROM `term_taxonomy` WHERE `term_id`=:menuId)';
        $connection = $this->dbConnection;
        $command = $connection->createCommand($sql);
        $command->bindValue(':menuId', $menuId);
        $maxOrder = $command->queryScalar();
        return $maxOrder ? $maxOrder : 0;
    }

    /**
     * Save the data to the termrelationship table by the menuid and menuItemId
     * @param int $menuId
     * @param int $menuItemId
     */
    private function _saveTermRelationShips($menuId, $menuItemId)
    {
        $sql = 'INSERT INTO `term_relationships`(`object_id`, `term_taxonomy_id`, `term_order`) VALUES (:menuItemId,:termTaxId,:termOrder)';
        $termTaxId = TermTaxonomy::model()->findTermTaxIdByTermId($menuId);
        $maxOrder = $this->_findMaxOrder($menuId);
        $connection = $this->dbConnection;
        $command = $connection->createCommand($sql);
        $command->bindValue(':menuItemId', $menuItemId);
        $command->bindValue(':termTaxId', $termTaxId);
        
        if ($maxOrder)
        {
            $command->bindValue(':termOrder', $maxOrder+1, PDO::PARAM_INT);
        }
        else
        {
            $command->bindValue(':termOrder', 1, PDO::PARAM_INT);
        }
        $command->execute();
    }
    
    private function _savePostMeta($itemId, $pageId)
    {
        $sql = 'INSERT INTO `postmeta` (`post_id`,`meta_key`,`meta_value`) VALUES (:post_id,:menu_parent_key,:menu_parent_id),
        (:post_id,:menu_object_key_type,:menu_object_value),(:post_id,:menu_object_key_id,:menu_object_id),(:post_id,:menu_post_key_type,:menu_post_type)';
        $connection = $this->dbConnection;
        $command = $connection->createCommand($sql);
        $command->bindValue(':post_id', $itemId);
        $command->bindValue(':menu_parent_key', MENU_ITEM_PARENT);
        $command->bindValue(':menu_parent_id', 0, PDO::PARAM_INT);
        $command->bindValue(':menu_object_key_type', MENU_ITEM_OBJECT_TYPE);
        $command->bindValue(':menu_object_value', POST);
        $command->bindValue(':menu_object_key_id', MENU_ITEM_OBJECT_ID);
        $command->bindValue(':menu_object_id', $pageId);
        $command->bindValue(':menu_post_key_type', MENU_ITEM_TYPE);
        $command->bindValue(':menu_post_type', POST_TYPE);
        $command->execute();
    }
    /**
     * Reset the menu order list
     * @param array $params
     * @throws Exception
     */
    public function updateMenuOrder($params)
    {
        $sql_order = 'UPDATE `term_relationships` AS `relation` SET `relation`.`term_order` = CASE `relation`.`object_id` ';
        $sql_parent = 'UPDATE `postmeta` AS `meta` SET `meta`.`meta_value` = CASE `meta`.`post_id` ';
        try
        {
            $idList = array();
            foreach ($params as $item)
            {
                $postId = $item['post_id'];
                array_push($idList, $postId);
                
                if (isset($item['order']))
                {
                    $order = $item['order'];
                    $sql_order .= ' WHEN '.$postId .' THEN '. $order;
                }
                
                if (isset($item['parent_id']))
                {
                    $parent_id = $item['parent_id'];
                    $sql_parent .= ' WHEN '.$postId . ' THEN ' . $parent_id;
                }
            }
            $sql_order .= ' END WHERE `relation`.`id` IN ('. implode(',', $idList).')';
            $sql_parent .= ' END WHERE `meta`.`post_id` IN ('. implode(',', $idList).') AND `meta`.`meta_key` =:menu_parent';
            $command_order = Yii::app()->db->createCommand($sql_order);
            $command_parent = Yii::app()->db->createCommand($sql_parent);
            $command_parent->bindValue(':menu_parent', MENU_ITEM_PARENT, PDO::PARAM_STR);
            $command_order->execute();
            $command_parent->execute();
        }
        catch (Exception $e)
        {   
            Yii::log($e, CLogger::LEVEL_ERROR, 'yiicms.base.updatemenuorder');
            throw new Exception($e);
        }
    }
    
    /**
     * Delete menu and cascade delete other related tables
     * @param integer $termId
     * @throws Exception
     */
    public function deleteMenuAndCascadeOthers($termId)
    {   
        $sql='DELETE `t`,`tr`,`tt`,`p`,`pm` FROM ((((
             `terms` `t` LEFT JOIN `term_taxonomy` `tt` ON `t`.`id`=`tt`.`term_id`)
             LEFT JOIN `term_relationships` `tr` ON `tt`.`id`=`tr`.`term_taxonomy_id` ) 
             LEFT JOIN `posts` `p` ON `tr`.`object_id`=`p`.`id`)
             LEFT JOIN `postmeta` `pm` ON `p`.`id`=`pm`.`post_id`)
             WHERE `t`.`id`=:termId ';
        $connection = $this->dbConnection;
        $command = $connection->createCommand($sql);
        $command->bindValue(':termId', $termId);
        return $command->execute();
    }
    
    /**
     * Delete the item of the menu
     * @param int $itemId
     */
    public function deleteMenuItem($itemId)
    {
        $sql = 'DELETE p,r,m FROM `posts` `p`  INNER JOIN `term_relationships` `r` ON `p`.`id`=`r`.`object_id`
                INNER JOIN `postmeta` `m` ON `p`.`id`=`m`.`post_id` WHERE `p`.`id`=:itemId';
        $connection = $this->dbConnection;
        $command = $connection->createCommand($sql);
        $command->bindValue(':itemId', $itemId);
        $command->execute();
    }
    /**
     * Create new menu to source
     * @param str $menuName
     */
    public function createMenu($menuName)
    {
        $menu = new Menu();
        $menu->name = $menuName;
        $menu->slug = $menuName;
        $menu->term_group = 0;
        
        try 
        {
            $menu->save();
        } catch (Exception $e) 
        {
            Yii::log($e, CLogger::LEVEL_ERROR, 'yiicms.base.createmenu');
            throw new Exception($e);
        }
        $termId = $menu->id;
        $termTax = new TermTaxonomy();
        $termTax->term_id = $termId;
        $termTax->taxonomy = TAXONOMY_NAV_MENU;
        $termTax->description = '';
        $termTax->parent = 0;
        $termTax->count = 0;
        
        try 
        {
            $termTax->save(false);
        } catch (Exception $e) 
        {
            Yii::log($e, CLogger::LEVEL_ERROR, 'yiicms.base.savetermTaxonomy');
            throw new Exception($e);
        }

    }
    
    public function getTermsByCategory($category)
    {
        $sql = 'SELECT * FROM `' . $this->tableName() . '` `t` '
               . ' JOIN `term_taxonomy` `tt` ON `t`.`id` = `tt`.`term_id` '
               . ' WHERE `tt`.`taxonomy` = :category ';
        /*select * from terms t
        join term_taxonomy tt on t.id = tt.term_id
        where tt.taxonomy = 'post_tag';
        */
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindValue(':category', $category);
        $list = $command->queryAll();
        return array('list' => $list);
    }
}