<?php
/**
 * @author Denny.chen
 * @createTime 2013.12.03
 * @version 1.0.1
 */
/**
 * This is the model class for table "comments".
 *
 * The followings are the available columns in table 'comments':
 * @property integer $id
 * @property integer $comment_post_id
 * @property string $comment_author
 * @property string $comment_author_email
 * @property string $comment_author_url
 * @property string $comment_author_ip
 * @property date $comment_date
 * @property date $comment_date_gmt
 * @property string $comment_content
 * @property enumeration $comment_approved
 * @property string $comment_type
 * @property integer $comment_parent
 * @property integer $user_id
 */

class Comment extends CActiveRecord
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
        return 'comments';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        array(
            array('id, comment_post_id, comment_author, comment_author_email, 
                   comment_author_url, comment_author_ip, comment_date,
                   comment_date_gmt, comment_content, comment_approved,
                   comment_type, comment_parent, user_id', 'required'),
            array('comment_author', 'length', 'max' => 60),
            array('comment_author_email, comment_author_ip', 'length', 'max' => 100),
            array('comment_author_url', 'length', 'max' => 200),
            array('comment_type', 'length', 'max' => 20)
        );
    }

    /**
     * Get comment list.
     */
    public function getCommentList()
    {
        $sql = 
            'SELECT
            `co`.`id`,
            `co`.`comment_author`,
            `co`.`comment_author_email`,
            `co`.`comment_author_ip`,
            `co`.`comment_date`,
            `comm`.`comment_author` `Response_to_author`,
            `po`.`post_title`,
            `co`.`comment_content` `comment_content`, `co`.`comment_approved`
            FROM `comments` `co`
            LEFT OUTER JOIN `comments` `comm` on `comm`.`id` = `co`.`comment_parent`
            LEFT OUTER JOIN `posts` `po` on `po`.`ID` = `co`.`comment_post_id`
            ORDER BY `co`.`id` DESC';

        $connection = $this->dbConnection;
        $command = $connection->createCommand($sql);
        $commentList = $command->queryAll();

        return array('commentList' => $commentList);
    }

    public function statusCountList()
    {
        $sql = 'SELECT `co`.`comment_approved`, COUNT(`co`.`comment_approved`) count
                FROM `comments` `co`
                GROUP BY `co`.`comment_approved`';

        $connection = $this->dbConnection;
        $command = $connection->createCommand($sql);
        $statusCountList = $command->queryAll();

        return $statusCountList;
    }

    /**
     * Save comment
     */
    public function saveComment($attributes)
    {
        $comment = new Comment();
        $comment->user_id = $userId;
        $comment->comment_post_id = $attributes['post_id'];
        $comment->comment_author = $attributes['commentAuthor'];
        $comment->comment_author_email = $attributes['userEmail'];
        $comment->comment_author_url = $attributes['commentAuthorUrl'];
        $comment->comment_author_ip = $_SERVER['REMOTE_ADDR'];
        $comment->comment_date = date(DATE_FORMAT, time());
        $comment->comment_date_gmt = date(DATE_FORMAT, time());
        $comment->comment_content = $attributes['comment_content'];
        $comment->comment_approved = COMMENT_STATUA_NEW;
        $comment->comment_type = EMPTY_VALUE;
        $comment->comment_parent = $attributes['comment_parent'];

        $comment->save(false);
    }

    public function getStatusList($status, $condition = '')
    {
        $connection = $this->dbConnection;
        $sql =
           'SELECT
            `co`.`id`,
            `co`.`comment_author`,
            `co`.`comment_author_email`,
            `co`.`comment_author_ip`,
            `co`.`comment_date`,
            `comm`.`comment_author` `Response_to_author`,
            `po`.`post_title`,
            `co`.`comment_content` `comment_content`, `co`.`comment_approved`
            FROM `comments` `co`
            LEFT OUTER JOIN `comments` `comm` on `comm`.`id` = `co`.`comment_parent`
            LEFT OUTER JOIN `posts` `po` on `po`.`ID` = `co`.`comment_post_id`
            WHERE `co`.`comment_approved`' . $condition . ' OR `co`.`comment_approved` =:status ORDER BY `co`.`id` DESC';

        $command = $connection->createCommand($sql);
        $command->bindValue(':status', $status);
        $stautsList = $command->queryAll();

        return $stautsList;
    }

    public function getCommentsByPostId($postId)
    {
        $sql = 'SELECT `co`.`id`, `co`.`comment_author`, `co`.`comment_content`,
        `co`.`comment_date`,`co`.`comment_parent`, `co`.`comment_approved`
        FROM `comments` `co` WHERE `co`.`comment_post_id` = :postId';

        $connection = $this->dbConnection;
        $command = $connection->createCommand($sql);
        $command->bindValue(':postId', $postId);
        $comments = $command->queryAll();

        return $comments;
    }

}