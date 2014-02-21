<?php
class Util 
{
    public static  function getMenuStructure(&$menu, &$menuItems, $parentId=0, $parentMenuOrder = 0)
    {
        $unsetIdList = array();
        $size = sizeof($menu);
        for ($i = 0; $i < $size; $i++)
        {
            if ($parentId == trim($menu[$i]['menu_parent']))
            {
                //$menuList[$menu[$i]['post_id']] = $menu[$i];
                array_push($unsetIdList, $menu[$i]['post_id']);
            }
        }
       
        for ($i = 0; $i < $size; $i++)
        {
            $child_menu_id = $menu[$i]['post_id'];
            $child_menu_order = $menu[$i]['menu_order'];
            if (in_array($child_menu_id, $unsetIdList))
            {
                if ($parentId == 0)
                {
                    $menuItems[$menu[$i]['menu_order']] = $menu[$i];
                    Util::getMenuStructure($menu, $menuItems, $child_menu_id, $menu[$i]['menu_order']);
                }
                else
                {
                    $menuItems[$parentMenuOrder]['submenu'][$child_menu_order] = $menu[$i];
                    Util::getMenuStructure($menu, $menuItems[$parentMenuOrder]['submenu'], $child_menu_id, $child_menu_order);
                }
                 
            }
        }
    }
}