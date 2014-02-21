<?php
/**
 * This is the model class for table "term_taxonomy".
 *
 * The followings are the available columns in table 'term_taxonomy':
 * @property integer $id
 * @property integer $term_id
 * @property string $taxonomy
 * @property string $description
 * @property integer $parent
 * @property integer $count
 */
class TermTaxonomy extends CActiveRecord
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
        return 'term_taxonomy';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
    }

    /**
     * Get TermTaxonomyId by the termId
     * @param int  $termId
     */
    public function findTermTaxIdByTermId($termId)
    {
        $sql = 'SELECT `id` FROM `term_taxonomy` WHERE `term_id`=:termId';
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindValue(':termId', $termId);
        return $command->queryScalar();
    }
    
    /**
     * According to the post id, get the category id.
     * @param int $postId
     */
    public function findCategoryIdByPostId($postId)
    {
        $sql = 'SELECT `t`.`term_id`,`tt`.`id` FROM `' . $this->tableName() 
                .'` `t` JOIN `term_relationships` `tt` ON `t`.`id`=`tt`.`term_taxonomy_id`'
                .' WHERE `t`.`taxonomy`=\'category\' AND `tt`.`object_id`=:postId';

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindValue(':postId', $postId);
        return $command->queryRow();
    }

}