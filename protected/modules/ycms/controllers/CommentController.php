<?php
/**
 * @author Denny.chen
 * @createTime 2013.12.03
 * @version 1.0.1
 */
class CommentController extends Controller
{

    public function actionIndex()
    {
        $this->render("index");
    }

    /**
     * Get comment list.
     */
    public function actionList()
    {
        $request = array();
        $commentList = Comment::model()->getCommentList();
        $request['commentList'] = isset($commentList['commentList']) ?
            $commentList['commentList'] : array();

        //Statistics the count of the comment status(approved, new, reject, spam, trash).
        $statusCountList = Comment::model()->statusCountList();
        $result = $this->_countStatus($statusCountList);
        $request['statusCountList'] = $result;

        $this->responseJSON($request);
    }

    /**
     * Operate comment status(approved, reject, spam, trash)
     */
    public function actionOperate()
    {
        $commentId = $this->_request->getPost('commentId');
        $commentStatus = $this->_request->getPost('commentStatus');
        $result = $this->_operateComment($commentId, $commentStatus);

        $this->responseJSON($result);
    }

    /**
     * Save comment
     */
    public function actionSave()
    {
        $userId = Yii::app()->session['userId'];
        $commentAttributes = $this->_request->getPost('comment');
        $postId = $commentAttributes['post_id'];

        try
        {
            if (isset($userId))
            {
                $commentAttributes['commentAuthor'] = User::model()->getUsernameById($userId);
                $commentAttributes['userEmail'] = User::model()->getEmailByUserId($userId);
                $commentAttributes['comment_url'] = EMPTY_VALUE;
            }
            else
            {
                $commentAttributes['commentAuthor'] = $commentAttributes['comment_author'];
                $commentAttributes['userEmail'] = $commentAttributes['comment_author_email'];
                $commentAttributes['commentAuthorUrl'] = COMMENT_AUTHOR_URL_HTTP + $commentAttributes['comment_author_url'];
                Yii::app()->session['tourist_name'] = $commentAttributes['commentAuthor'];
            }
            Comment::model()->saveComment($commentAttributes);
        }
        catch (Exception $e)
        {
            Yii::log('Create comment fail', CLogger::LEVEL_ERROR, 'yiicms.base.CommentController.actionSave');
        }
        Yii::app()->runController('post/' . $postId);
    }

    /**
     * Get specific status list.
     */
    public function actionStatusList()
    {
        $status = $this->_request->getQuery('categoryStatus');

        try
        {
            $statusList = $this->_showStatusList($status);
        }
        catch (Exception $e)
        {
            Yii::log('Exception occurred in statusList action.', CLogger::LEVEL_ERROR, 'yiicms.base.CommentController.actionStatusList');
        }

        $this->responseJSON(array(
            'statusList' => $statusList
        ));
    }

    /**
     * Judge the user's operation about comment.
     * @param integer $commentId The comment id get from request.
     * @param string $commentStatus The specific operation of user.
     */
    public function _operateComment($commentId, $commentStatus)
    {
        switch ($commentStatus)
        {
            case COMMENT_REJECT_OPERATION:
                return $this->_changeCommentStatus($commentId, COMMENT_STATUA_REJECT);
                break;
            case COMMENT_APPROVE_OPERATION:
                return $this->_changeCommentStatus($commentId, COMMENT_STATUA_APPROVE);
                break;
            case COMMENT_SPAM_OPERATION:
                return $this->_changeCommentStatus($commentId, COMMENT_STATUA_SPAM);
                break;
            case COMMENT_TRASH_OPERATION:
                return $this->_changeCommentStatus($commentId, COMMENT_STATUA_TRASH);
                break;
            default:
                break;
        }
    }

    /**
     * Change the comment status.
     * @param integer $commentId The commetn id get from request.
     * @param string $operation The The specific operation of user.
     */
    private function _changeCommentStatus($commentId, $operation)
    {
        $returnDate = array();
        $comment = Comment::model()->findByPk(array('id' => $commentId));
        $comment->comment_approved = $operation;
        $updateStatus = $comment->update() ? $operation : STATUS_FAIL;

        $result = Comment::model()->statusCountList();
        $returnDate['status'] = $updateStatus;
        $returnDate['statusCountList'] = $this->_countStatus($result);

        return $returnDate;
    }

    private function _showStatusList($status)
    {
        $ifPendingCondition = 'IN (\'new\', \'reject\')';
        $exceptPendingCondition = '=:status';
        switch ($status)
        {
            case COMMENT_STATUA_PENDING:
                $status = '';
                return $this->_getStatusList($status, $ifPendingCondition);
                break;
            case COMMENT_STATUA_APPROVE:
                return $this->_getStatusList($status, $exceptPendingCondition);
                break;
            case COMMENT_STATUA_SPAM:
                return $this->_getStatusList($status, $exceptPendingCondition);
                break;
            case COMMENT_STATUA_TRASH:
                return $this->_getStatusList($status, $exceptPendingCondition);
                break;
            default:
                break;
        }
    }

    private function _getStatusList($status, $condition = '')
    {
        try
        {
            $result = Comment::model()->getStatusList($status, $condition);
            $statusList = isset($result) ? $result : array();
        }
        catch (Exception $e)
        {
            Yii::log('Get status list fail', CLogger::LEVEL_ERROR, 'yiicms.base.CommentController._getStatusList');
        }

        return $statusList;
    }

    public function _countStatus($statusCountList)
    {
        if (!empty($statusCountList))
        {
            $statusCountList['pending_count'] = 0;
            foreach ($statusCountList as $key => $value)
            {
                if ($value['comment_approved'] == COMMENT_STATUA_REJECT ||
                    $value['comment_approved'] == COMMENT_STATUA_NEW)
                {
                    $statusCountList['pending_count'] += $value['count'];
                }
                else if ($value['comment_approved'] == COMMENT_STATUA_SPAM)
                {
                    $statusCountList['spam_count'] =
                        ($value['comment_approved'] == COMMENT_STATUA_SPAM) ? $value['count'] : 0;
                }
                else
                {
                    $statusCountList['trash_count'] =
                        ($value['comment_approved'] == COMMENT_STATUA_TRASH) ? $value['count'] : 0;
                }
            }
        }
        return $statusCountList;
    }

}