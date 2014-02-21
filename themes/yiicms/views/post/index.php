<script data-main="<?php echo Yii::app()->theme->baseUrl; ?>/js/index.js" data-start="controller/post.controller" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/lib/require.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl . '/css/post/postmain.css';?>" />
<div class="l-head head-index clearfix">
    <div class="head-index__title icon pull-left"></div>
    <h3 class="pull-left">文章</h3>
    <a href="<?php echo Yii::app()->createUrl('post/create');?>" class="head-index__create-btn btn btn-default btn-xs pull-left js-create-button">写文章</a>
</div>
<div class="l-top-toolbar top-toolbar clearfix">
  <div class="top-toolbar__search clearfix">
    <span><a href="#">全部</a>（1）</span>
    <span>|</span>
    <span class="published"><a href="#">已发布</a>（1）</span>
    <button class="head-index__search-btn btn btn-default btn-xs pull-right">搜索文章</button>
    <input type="text" class="top-toolbar__search-text form-control pull-right"/>
  </div>
  <div class="top-toolbar__btnbar">
    <form action="" class="form-inline">
       <select class="btnbar__select bach-opeate form-control">
         <option>批量操作</option>
         <option>编辑</option>
         <option>移至回收站</option>
       </select>
       <button class="btn btn-default btn-sm">应 用</button>
       <select class="btnbar__select display-date form-control form-inline">
         <option>显示所有日期</option>
         <option>2013年十一月</option>
       </select>
       <select class="btnbar__select view-type form-control form-inline">
         <option>查看所有分类目录</option>
         <option>未分类</option>
       </select>
       <button class="btn btn-default btn-sm">筛 选</button>
    </form>
  </div>
</div>
<div class="js-page-cms">
  <div class="l-list-content list-content">
  <table class="table table-striped table-hover table-condensed">
    <thead>
      <tr class="list-content__table-head">
        <td>
          <input type="checkbox" class="js-check-all">
        </td>
        <td class="col-lg-6">标题</td>
        <td>作者</td>
        <td>分类目录</td>
        <td>标签</td>
        <td><div title="评论" class="list-content__th-comment"></div></td>
        <td>日期</td>
      </tr>
    </thead>
    <tbody class="js-page-list">
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