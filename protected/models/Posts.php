<?php

/**
 * This is the model class for table "{{posts}}".
 *
 * The followings are the available columns in table '{{posts}}':
 * @property integer $id
 * @property integer $post_author
 * @property date $post_date
 * @property string $post_date_gmt
 * @property string $post_content
 * @property string $post_title
 * @property string $post_excerpt
 * @property string $post_status
 * @property string $comment_status
 * @property string $post_name
 * @property string $post_modified
 * @property string $post_modified_gmt
 * @property string $post_parent
 * @property string $guid
 * @property string $post_type
 * @property string $post_mime_type
 */
class Posts extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Game the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{posts}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('post_title, post_content, post_type', 'required'),
            array('post_title', 'length', 'max' => 130)
        );
    }

    /**
     * Get the terams name and put into list array
     *
     * @param array $list
     */
    private function getWholePostLists($list)
    {
        $sql = 'SELECT `p`.`id`, `tt`.`taxonomy`,`term`.`name` FROM  `' . $this->tableName() . '` `p`'
                    . 'LEFT OUTER JOIN `term_relationships` `tr` ON `p`.`id` = `tr`.`object_id`'
                    . 'LEFT OUTER JOIN `term_taxonomy` `tt` ON `tr`.`term_taxonomy_id` = `tt`.`id`'
                    . 'LEFT OUTER JOIN `terms` `term` ON `tt`.`term_id` = `term`.`id`'
                    . 'WHERE `tt`.`taxonomy` = :category OR `tt`.`taxonomy` IS NULL OR `tt`.`taxonomy` = :post_tag';

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
    
        $command->bindValue(':category', TAXONOMY_CATEGORY, PDO::PARAM_STR);
        $command->bindValue(':post_tag', TAXONOMY_POST_TAG, PDO::PARAM_STR);
        $terms = $command->queryAll();
        
        $listSize = count($list);
        for ($i = 0; $i < $listSize; $i++)
        {
            $category = '';
            $postTag = '';
            foreach ($terms as $term)
            {
                if ($term['id'] === $list[$i]['id'] && $term['taxonomy'] === TAXONOMY_CATEGORY)
                {
                    $category .= ($category === '' ? $term['name'] : '|' . $term['name']);
                }

                if ($term['id'] === $list[$i]['id'] && $term['taxonomy'] === TAXONOMY_POST_TAG)
                {
                    $postTag .= ($postTag === '' ? $term['name'] : '|' . $term['name']);
                }
            }

            if ($list[$i]['comment_count'] === NULL)
            {
                $list[$i]['comment_count'] = 0;
            }

            $list[$i] = array_merge_recursive($list[$i], array(TAXONOMY_CATEGORY => $category));
            $list[$i] = array_merge_recursive($list[$i], array(TAXONOMY_POST_TAG => $postTag));
        }
        
        return $list;
    }

    /**
     * Get the post by pagination
     * 
     * @param string $orderBy order column
     * @param string $order DESC or ESC
     * @param String $postType post type
     * @param int $offset
     * @param int $limit
     * @return Array post list
     */
    public function getPostsList($orderBy, $order = SQL_SORT_DESC, $postType = PAGE, $offset = 0, $limit = ITEMS_PER_PAGE)
    {
        $sql = 'SELECT SQL_CALC_FOUND_ROWS `a`.*,`u`.`user_login` AS `username`,MAX(`c`.`id`) as comment_count
                         FROM `' . $this->tableName() . '` `a` 
                         LEFT JOIN `comments` AS `c` ON `a`.`id` = `c`.`comment_post_id`
                         JOIN `users` AS `u` ON `a`.`post_author` = `u`.`id` WHERE 1=1'
                         . ' AND `a`.`post_status` != :status '
                         . ($postType ? ' AND `a`.`post_type` = :type' : '')
                         . ' GROUP BY `a`.`id`'
                         . ' ORDER BY `a`.`'
                         . ($orderBy ? $orderBy : ID) . '` '
                         . ($order ? $order : 'DESC')
                         . ' LIMIT :offset,:limit';

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);

        $command->bindValue(':type', $postType, PDO::PARAM_STR);
        $command->bindValue(':status', POST_DELETE, PDO::PARAM_STR);
        $command->bindValue(':offset', $offset, PDO::PARAM_INT);
        $command->bindValue(':limit', $limit, PDO::PARAM_INT);
        $commandCount = $connection->createCommand('SELECT FOUND_ROWS()');
        $list = $command->queryAll();
        $count = $commandCount->queryScalar();

        return array('list' => $this->getWholePostLists($list), 'count' => $count);
    }

    /**
     * Get the max id
     * 
     * @return max id
     */
    public function getMaxId()
    {
        $sql = 'SELECT MAX(`id`) FROM `' . $this->tableName() . '`';
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);

        return $command->queryScalar();
    }
    
    /**
     * Get all page
     * 
     * @param int $id current user id
     * @return array list
     */
    public function getAllPage()
    {
        $sql = 'SELECT SQL_CALC_FOUND_ROWS `a`.`id`,`a`.`post_title`
                FROM `' . $this->tableName() . '` `a` where 1=1'
                . ' AND `a`.`post_status` != :status '
                . ' AND `a`.`post_type` = :type';
        
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);

        $command->bindValue(':type', PAGE, PDO::PARAM_STR);
        $command->bindValue(':status', POST_DELETE, PDO::PARAM_STR);
        $commandCount = $connection->createCommand('SELECT FOUND_ROWS()');
        
        return array('list' => $command->queryAll(), 'count' => $commandCount->queryScalar());
    }
    
    /**
     * Get the nearly page
     * 
     * @param int $id current user id
     * @param string $minDate start time
     * @param String $maxDate end time
     * @return array list
     */
    public function getNewPage($minDate, $maxDate)
    {
        $sql = 'SELECT SQL_CALC_FOUND_ROWS `a`.`id`,`a`.`post_title`
                FROM `'.$this->tableName().'` `a` where 1=1' 
                . ' AND `a`.`post_status` != :status '
                . ' AND `a`.`post_type` = :type'
                . ' AND `a`.`post_date` BETWEEN :from AND :to';

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);

        $command->bindValue(':status', POST_DELETE, PDO::PARAM_STR);
        $command->bindValue(':type', PAGE, PDO::PARAM_STR);
        $command->bindValue(':from', $minDate, PDO::PARAM_STR);
        $command->bindValue(':to', $maxDate, PDO::PARAM_STR);

        $commandCount = $connection->createCommand('SELECT FOUND_ROWS()');

        return array('list' => $command->queryAll(), 'count' => $commandCount->queryScalar());
    }
    
    /**
     * Get post by id
     * 
     * @param unknown_type $id
     * @return multitype:unknown
     */
    public function getPostById($id)
    {
        $sql = 'SELECT SQL_CALC_FOUND_ROWS `a`.*,`u`.`user_login` AS `username`,MAX(`c`.`id`) as comment_count '
            . 'FROM `' . $this->tableName() . '` `a` LEFT JOIN `comments` AS `c` ON `a`.`id` = `c`.`comment_post_id` '
            . 'JOIN `users` AS `u` ON `a`.`post_author` = `u`.`id` WHERE 1=1'
            . ' AND `a`.`id` = :id'
            . ' GROUP BY `a`.`id`';

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);

        $command->bindValue(':id', $id, PDO::PARAM_INT);

        $list = $command->queryRow();

        return $this->getWholePostLists(array($list)); ;
    }
}