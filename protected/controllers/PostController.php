<?php
class PostController extends Controller
{
   /**
   * This is the default 'index' action that is invoked
   * when an action is not explicitly requested by users.
   */
    public function actionIndex()
    {
      $this->render('index');
    }

    /**
     * Find post list by page
     * 
     */
    public function actionAdminList()
    {
        $currentPage = $this->_request->getQuery('pageNum');

        if (!isset($currentPage))
        {
            $currentPage = 1;
        }
        
        $offset = ($currentPage - 1) * ITEMS_PER_PAGE;
        $listAndCount = Posts::model()->getPostsList(POST_ORDER_COLUMN, SQL_SORT_DESC, PAGE, $offset);

        $this->responseJSON(array(
                'data' => $listAndCount['list'],
                'totalPages' => ceil($listAndCount['count'] / ITEMS_PER_PAGE),
                'status' => STATUS_SUCCESS));
    }
    
    /**
     * When click the create button, render the create page
     * 
     */
    public function actionCreate()
    {
        $userId = Yii::app()->session['userId'];

        if (!$userId)
        {
            $this->render('/user/login', array('model' => new LoginForm));
        }
        else
        {
            $postAttributes = $this->_request->getPost('post');
            $post = new Posts();
            
            if (isset($postAttributes) && !empty($postAttributes))
            {
                $post->post_author = $postAttributes['post_author'];
                $post->guid = $postAttributes['guid'];
                $post->post_content = $postAttributes['post_content'];
                $post->post_title = $postAttributes['post_title'];
                $post->post_type = $postAttributes['post_type'];
                $post->post_excerpt = $postAttributes['post_excerpt'];
                $post->post_date = date(DATE_FORMAT, time());
                $post->comment_status = $postAttributes['comment_status'];
                $post->post_status = $postAttributes['post_status'];
                $post->post_name = $postAttributes['post_name'];

                if ($post->save())
                {
                    $post->guid .= '/post/' . $post->id;
                    $post->save();
                    
                    // build the relationship of post and category.
                    if (isset($postAttributes['post_category']))
                    {
                        try
                        {
                            $this->_buildRelationshipWithCategory($postAttributes['post_category'], $post->id);
                        }
                        catch (Exception $e)
                        {
                            Yii::log($e, CLogger::LEVEL_ERROR, 'yiicms.base.PostController.save post');
                            $this->render('create', array('model' => $post));
                        }
                    }
                    
                    $this->redirect(array('index'));
                }
            }
            else
            {
                $this->render('create', array('model' => $post));
            }
        }
    }

    /**
     * Build relationship between post and category
     * 
     * @param integer $CategoryId
     * @param integer $postId
     */
    private function _buildRelationshipWithCategory($CategoryId, $postId)
    {
        $termRelationship = new TermRelationships();
        $termRelationship->term_taxonomy_id = TermTaxonomy::model()->findTermTaxIdByTermId($CategoryId);
        $termRelationship->object_id = $postId;
        
        try 
        {
            $termRelationship->save();
        }
        catch (Exception $e) 
        {
            Yii::log($e, CLogger::LEVEL_ERROR, 'yiicms.base.PostController post');
            throw new CDbException('save term relationship error!');
        }
    }

    /**
     * When click the update button, render the update page
     * 
     * @param integer $id the ID of the model to be update
     */
    public function actionRenderUpdate($id)
    {

        $userId = Yii::app()->session['userId'];

        if (!$userId)
        {
            $this->render('/user/login', array('model' => new LoginForm));
        }
        else
        {
            $model = Posts::model()->findByPk($id);
            $taxonmyIdAndTermId = TermTaxonomy::model()->findCategoryIdByPostId($id);
            if ($model)
            {
                $this->render('update', array('model' => $model, 'categoryId' => $taxonmyIdAndTermId['term_id']));
            }
            else
            {
                Yii::log('Render edit page fail', 'error', 'yiicms.base.PostController.actionRenderUpdate');
                $this->render('index', array('success' => false, 'msg' => 'The parameter id is null'));
            }
        }
    }
    
    /**
     * Update the post
     */
    public function actionUpdate()
    {
        $postAttributes = $this->_request->getPost('post');
        $id = $this->_request->getQuery('id');
        $post = Posts::model()->findByPk($id);
        
        if (isset($postAttributes) && !empty($postAttributes))
        {
            $post->post_author = $postAttributes['post_author'];
            $post->post_content = $postAttributes['post_content'];
            $post->post_title = $postAttributes['post_title'];
            $post->post_type = $postAttributes['post_type'];
            $post->post_excerpt = $postAttributes['post_excerpt'];
            $post->post_modified = date(DATE_FORMAT, time());
            $post->comment_status = $postAttributes['comment_status'];
            $post->post_status = $postAttributes['post_status'];
            $post->post_name = $postAttributes['post_name'];

            // update the relationship between post and category.
            if (isset($postAttributes['post_category']))
            {
                // Get the category id and relationship id.
                $taxonmyIdAndTermId = TermTaxonomy:: model()->findCategoryIdByPostId($post->id);
                
                if (!$taxonmyIdAndTermId || ($taxonmyIdAndTermId['term_id'] !== $postAttributes['post_category']))
                {
                    // delete the old relationship.
                    if ($taxonmyIdAndTermId)
                    {
                        $termRelationships = TermRelationships:: model()->findByPk($taxonmyIdAndTermId['id']);
                        $termRelationships->delete();
                    }
                    
                    try
                    {
                        $this->_buildRelationshipWithCategory($postAttributes['post_category'], $post->id);
                    }
                    catch (Exception $e)
                    {
                        Yii::log($e, CLogger::LEVEL_ERROR, 'yiicms.base.PostController.update post');
                        $this->render('update', array('post' => $post));
                    }
                    
                }
            }

            if ($post->update())
            {
                $this->redirect(array('index'));
            }
        }
        else
        {
            $this->render('update', array('post' => $post));
        }
    }
    
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete()
    {
        $id = $this->_request->getPost('id');

        //logic delete
        $post = Posts::model()->findByPk($id);
        
        if ($post)
        {
            $post->post_status = POST_DELETE;
            $post->update();
            $this->responseJSON(array('status' => STATUS_SUCCESS));
        }
        else
        {
            Yii::log('Post is not exist!', 'error', 'yiicms.base.PostController.actiondDelete');
            $this->responseJSON(array('status' => STATUS_ERROR));
        }
    }

    /**
     * Get the all page
     */
    public function actionGetAllPage()
    {
        $listAndCount = Posts::model()->getAllPage();

        $this->responseJSON(array(
                'data' => $listAndCount['list'],
                'count' => $listAndCount['count'],
                'status' => STATUS_SUCCESS));
    }
    
    /**
     * Get the near page
     */
    public function actionGetNewPage()
    {
        $listAndCount = Posts::model()->getNewPage(date(DATE_FORMAT, strtotime('-1 day')), date(DATE_FORMAT, time()));

        $this->responseJSON(array(
                'data' => $listAndCount['list'],
                'count' => $listAndCount['count'],
                'status' => STATUS_SUCCESS));
    }
    
    /**
     * According to the post id, show post in the detail page
     */
    public function actionView($id)
    {
        $post = Posts::model()->getPostById($id);
        $commentList = Comment::model()->getCommentsByPostId($id);
        $this->layout = '//user_layouts/main';
 
        $this->render('view', array('model' => $post[0], 'comments' => $commentList));
    }
    
    public function actionLoadInitFormData()
    {
        $userList = User::model()->getAllUsers();
        $categoryList = Menu::model()->getTermsByCategory(TAXONOMY_CATEGORY);
        $postMouduleFileDir = scandir(POST_MODULE_FILE);
        
        // Delete the first and the second element in array
        array_splice($postMouduleFileDir, 0, 2);
        
        $this->responseJSON(array(
                'users' => $userList['list'],
                'category' => $categoryList['list'],
                'moduleFiles' => $postMouduleFileDir,
                'status' => STATUS_SUCCESS));
    }
}
