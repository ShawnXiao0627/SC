<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl . '/css/global/header.css';?>" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl . '/css/bootstrap.min.css'; ?>" />

<div class="sidebar-menu  bs-docs-sidenav affix-top">
    <a href="#home" class="nav-header menu-first collapsed" data-toggle="collapse">
      <i class="icon-home icon-large"></i> 仪表盘</a>
    <ul id="home" class="nav nav-list collapse menu-second in">
      <li><a href="<?php echo Yii::app()->createUrl('site/index')?>"><i class="icon-home"></i> 首页</a></li>
      <li><a href="#"><i class="icon-refresh"></i> 更新</a></li>
    </ul>
    <a href="#articleMenu" class="nav-header menu-first collapsed" data-toggle="collapse">
    <i class="icon-book icon-large"></i> 文章管理</a>
    <ul id="articleMenu" class="nav nav-list collapse menu-second">
      <li><a href="<?php echo Yii::app()->createUrl('post/index')?>">
      <i class="icon-list-alt"></i> 所有文章</a></li>
      <li><a href="<?php echo Yii::app()->createUrl('post/create');?>"><i class="icon-pencil"></i> 写文章</a></li>
      <li><a href="#"><i class="icon-columns"></i> 分类目录</a></li>
      <li><a href="#"><i class="icon-bookmark"></i> 标签</a></li>
    </ul>
    <a href="#media" class="nav-header menu-first collapsed" data-toggle="collapse">
      <i class="icon-camera icon-large"></i> 多媒体</a>
    <ul id="media" class="nav nav-list collapse menu-second">
      <li><a href="#"><i class="icon-camera-retro"></i> 媒体库</a></li>
      <li><a href="#"><i class="icon-plus"></i> 添加</a></li>
    </ul>
    
    <a href="#pages" class="nav-header menu-first collapsed" data-toggle="collapse">
      <i class="icon-file-alt icon-large"></i> 页面</a>
    <ul id="pages" class="nav nav-list collapse menu-second">
      <li><a href="#"><i class="icon-th-list"></i> 所有页面</a></li>
      <li><a href="#"><i class="icon-edit"></i> 新建页面</a></li>
    </ul>
    
    <a href="<?php echo Yii::app()->createUrl('comment/index')?>" class="nav-header menu-first collapsed">
      <i class="icon-comment icon-large"></i> 评论</a>
    <a href="#view" class="nav-header menu-first collapsed" data-toggle="collapse">
      <i class="icon-user-md icon-large"></i> 外观</a>
    <ul id="view" class="nav nav-list collapse menu-second">
      <li><a href="#"><i class="icon-user"></i> 主题</a></li>
      <li><a href="#"><i class="icon-edit"></i> 自定义</a></li>
      <li><a href="#"><i class="icon-wrench"></i> 小工具</a></li>
      <li><a href="<?php echo Yii::app()->createUrl('menu/index')?>"><i class="icon-tasks"></i> 菜单</a></li>
      <li><a href="#"><i class="icon-pushpin"></i> 顶部</a></li>
      <li><a href="#"><i class="icon-edit"></i> 编辑</a></li>
    </ul>
    <a href="#plugin" class="nav-header menu-first collapsed" data-toggle="collapse">
      <i class="icon-file-alt icon-large"></i> 插件</a>
    <ul id="plugin" class="nav nav-list collapse menu-second">
      <li><a href="#"><i class="icon-th-list"></i> 已安装插件</a></li>
      <li><a href="#"><i class="icon-edit"></i> 安装插件</a></li>
      <li><a href="#"><i class="icon-edit"></i> 编辑</a></li>
    </ul>
    <a href="#userMeun" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-user-md icon-large"></i> 用户管理</a>
    <ul id="userMeun" class="nav nav-list collapse menu-second">
      <li><a href="#"><i class="icon-list"></i> 所有用户</a></li>
      <li><a href="#"><i class="icon-user"></i> 添加用户</a></li>
      <li><a href="#"><i class="icon-eye-open"></i> 我的个人资料</a></li>
    </ul>
    <a href="#tool" class="nav-header menu-first collapsed" data-toggle="collapse">
    <i class="icon-legal icon-large"></i> 工具</a>
    <ul id="tool" class="nav nav-list collapse menu-second">
      <li><a href="#"><i class="icon-wrench"></i> 可用工具</a></li>
      <li><a href="#"><i class="icon-reply"></i> 导入</a></li>
      <li><a href="#"><i class="icon-share"></i> 导出</a></li>
    </ul>
    <a href="#set" class="nav-header menu-first collapsed" data-toggle="collapse">
    <i class="icon-wrench icon-large"></i> 设置</a>
    <ul id="set" class="nav nav-list collapse menu-second">
      <li><a href="#"><i class="icon-list"></i> 常规</a></li>
      <li><a href="#"><i class="icon-paper-clip"></i> 撰写</a></li>
      <li><a href="#"><i class="icon-eye-open"></i> 阅读</a></li>
      <li><a href="#"><i class="icon-comments"></i> 讨论</a></li>
      <li><a href="#"><i class="icon-camera"></i> 多媒体</a></li>
      <li><a href="#"><i class="icon-external-link"></i> 固定链接</a></li>
    </ul>
</div>