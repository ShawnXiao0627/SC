<script data-main="<?php echo $this->module->assetsUrl; ?>/js/index.js" 
  data-start="controller/comment.controller" 
  src="<?php echo $this->module->assetsUrl; ?>/js/lib/require.js">
</script>
<link rel="stylesheet" href="<?php echo $this->module->assetsUrl . '/css/comment/commentmain.css';?>" />

<div class="l-head head-index clearfix">
    <div class="head-index__title icon pull-left"></div>
    <h3 class="pull-left">评论</h3>
</div>
<div class="js-comment-cms">
<div class="l-top-toolbar top-toolbar clearfix">
  <div class="top-toolbar__search clearfix js-comment-count-status">
    <span><a href="#" class="js-comment-status-list" data-content="all">全部</a></span>
    <span>|</span>
    <span class="published"><a href="#" class="js-comment-status-list" data-content="pending">待审<span>（<span class="js-comment-count-pending">0</span>）</span></a></span >
    <span>|</span>
    <span class="published"><a href="#" class="js-comment-status-list" data-content="approved">获准</a></span >
    <span>|</span>
    <span class="published"><a href="#" class="js-comment-status-list" data-content="spam">垃圾评论<span>（<span class="js-comment-count-spam">0</span >）</span></a></span >
    <span>|</span>
    <span class="published"><a href="#" class="js-comment-status-list" data-content="trash">回收站<span>（<span class="js-comment-count-recyclebin">0</span >）</span></a></span >
    <button class="head-index__search-btn btn btn-default btn-xs pull-right">搜索评论</button>
    <input type="text" class="top-toolbar__search-text form-control pull-right"/>
  </div>
  <div class="top-toolbar__btnbar ">
    <form action="" class="form-inline right clearfix">
       <select class="btnbar__select bach-opeate form-control">
         <option>批量操作</option>
         <option>编辑</option>
         <option>移至回收站</option>
       </select>
       <button class="btn btn-default btn-sm">应 用</button>
       <select class="btnbar__select display-date form-control form-inline">
         <option>显示所有评论类型</option>
         <option>2013年十一月</option>
       </select>
       <select class="btnbar__select view-type form-control form-inline">
         <option>查看所有分类目录</option>
         <option>未分类</option>
       </select>
       <button class="btn btn-default btn-sm">筛 选</button>
    </form>
    <div class="one-page">
      <span>一个项目</span>
    </div>
  </div>
</div>
<div class="l-list-content list-content">
  <table class="table table-striped table-hover table-condensed">
    <thead>
      <tr class="list-content__table-head">
        <td>
          <input type="checkbox" class="js_check_all">
        </td>
        <td class="col-lg-6">作者</td>
        <td>评论</td>
        <td>回应给</td>
      </tr>
    </thead>
    <tbody class="js-comment-list">

    </tbody>
  </table>
</div>
<div class="l-bottom-toolbar bottom-toolbar clearfix">
  <div class="bottom-toolbar__opeate pull-left">
    <form class="form-inline">
      <select class="btnbar__select bach-opeate form-control">
        <option>批量操作</option>
        <option>编辑</option>
        <option>移至回收站</option>
      </select>
      <button class="btn btn-default btn-sm">应 用</button>
    </form>
  </div>
  <div class="pull-right">
    <div class="pagination table-pagination tablenav-pages">
        <a href="#" class="first" data-action="first">&laquo;</a>
        <a href="#" class="previous" data-action="previous">&lsaquo;</a>
        <input type="text" readonly="readonly" />
        <a href="#" class="next" data-action="next">&rsaquo;</a>
        <a href="#" class="last" data-action="last">&raquo;</a>
    </div>
  </div>
</div>
</div>
