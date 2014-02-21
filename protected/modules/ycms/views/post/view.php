<link rel="stylesheet" href="<?php echo $this->module->assetsUrl . '/css/post/postview.css';?>" />
<div class="l-site-content clearfix">
  <div class='site-content_title'>
    <h1><?php echo $model['post_title']; ?></h1>
    <div class="sub-title">
      <span>
        <a href="<?php echo $model['guid']; ?>" title="链向<?php echo $model['post_title']; ?>的固定链接" rel="bookmark">
          <?php echo $model['post_date']; ?>
        </a>
      </span>
      <span>
        <a href="#" title="查看php中的全部文章"><?php echo $model['category']; ?></a>
      </span>
      <span>
        <a href="#"><?php echo $model['post_tag']; ?></a>
      </span>
    </div>
  </div>
  <div class="site-content">
    <p><?php echo $model['post_content']; ?></p>
  </div>
  <div class="l-comment-content">
    <ol class="comment-list">
      <li id="comment-1" class="comment">
        <div class="l-comment-body comment-body">
          <div class="comment-body__commentmeta  clearfix">
            <div class="comment-author">
              <img alt class="author-img">
              <span class="author-name">wordpress先生</span>
            </div>
            <div class="comment-data">
              <span>2012年3月8号</span>
            </div>
            <div class="comment-content">
              <p>哈哈发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论</p>
            </div>
            <div class="comment-reply">
              <a class="comment-replay-link" href="#">回复：</a>
            </div>
          </div>
        </div>
        <ol class="comment-children">
          <li id="comment-2" class="children">
            <div class="l-comment-body comment-body">
              <div class="comment-body__commentmeta  clearfix">
                <div class="comment-author">
                  <img alt class="author-img">
                  <span class="author-name">wordpress先生</span>
                </div>
                <div class="comment-data">
                  <span>2012年3月8号</span>
                </div>
                <div class="comment-content">
                  <p>哈哈发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论</p>
                </div>
                <div class="comment-reply">
                  <a class="comment-replay-link" href="#">回复：</a>
                </div>
              </div>
            </div>
          </li>
          <li id="comment-3" class="children">
            <div class="l-comment-body comment-body">
              <div class="comment-body__commentmeta  clearfix">
                <div class="comment-author">
                  <img alt class="author-img">
                  <span class="author-name">wordpress先生</span>
                </div>
                <div class="comment-data">
                  <span>2012年3月8号</span>
                </div>
                <p class="comment-wait-approve">评论正在等待审核</p>
                <div class="comment-content">
                  <p>哈哈发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论</p>
                </div>
                <div class="comment-reply">
                  <a class="comment-replay-link" href="#">回复：</a>
                </div>
              </div>
            </div>
          </li>
        </ol>
      </li>
      <li id="comment-2" class="comment">
        <div class="l-comment-body comment-body">
          <div class="comment-body__commentmeta  clearfix">
            <div class="comment-author">
              <img alt class="author-img">
              <span class="author-name">wordpress先生</span>
            </div>
            <div class="comment-data">
              <span>2012年3月8号</span>
            </div>
            <div class="comment-content">
              <p>哈哈发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论发表评论</p>
            </div>
            <div class="comment-reply">
              <a class="comment-replay-link" href="#">回复：</a>
            </div>
          </div>
        </div>
      </li>
    </ol>
  </div>
  <div id="comments" class="comments-area">
    <div id="publish_comment" class="publish-comment">
      <h3>发表评论 </h3>
      <form action="<?php echo Yii::app()->createUrl('comment/save'); ?>" method="post" class="comment-form">
        <p>电子邮件地址不会被公开。 必填项已用<span class="required">*</span>标注</p>
        <p>
         <label for="author">姓名 <span class="required">*</span></label>
         <input id="author" name="comment[comment_author]" type="text" value="" size="30">
        </p>
        <p>
          <label for="email">电子邮件 <span class="required">*</span></label>
          <input id="email" name="comment[comment_author_email]" type="text" value="" size="30">
        </p>
        <p>
          <label for="url">站点</label> 
          <input id="url" name="comment[comment_author_url]" type="text" value="" size="30">
        </p>
        <p>
          <label for="comment">评论</label>
          <textarea id="comment" name="comment[comment_content]" cols="45" rows="8"></textarea>
        </p>
        <input type="hidden" name="comment[post_id]" value="<?php echo $model['id']; ?>"/>
        <!-- TODO -->
        <input type="hidden" name="comment[comment_parent]" value="0"/>
        <button type="submit" class="btn btn-danger">发表评论</button>
      </form>
    </div>
  </div>
</div>