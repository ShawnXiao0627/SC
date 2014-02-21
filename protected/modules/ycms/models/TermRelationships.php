<?php
/**
 * This is the model class for table "term_relationships".
 *
 * The followings are the available columns in table 'term_relationships':
 * @property integer $id
 * @property integer $term_taxonomy_id
 * @property integer $term_order
 * @property integer $object_id
 */
class TermRelationships extends CActiveRecord
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
        return '{{term_relationships}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array();
    }

}