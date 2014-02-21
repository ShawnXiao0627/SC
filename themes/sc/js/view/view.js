define(function(){
  var view = [];

  view['menuSelect'] = '<select id="js-choose-menu-select" class="menu-select">{{#data}}'
    +'<option value="{{id}}">'
    +'{{name}}'
    +'</option>'
    +'{{/data}}</select>';

  view['postList'] = '{{#data}}<tr><td><input type="checkbox" class="js-check-record"></td>'
    + '<td><span>{{post_title}}</span><span class="record-operate js-record-operate">'
    + '<a href="/yiicms/index.php/post/renderUpdate/{{id}}">Edit</a> | <a class="js-delete-post" data-id="{{id}}">Move to dustbin</a> | <a href="/yiicms/index.php/post/{{id}}">View</a></span></td>'
    + '<td>{{username}}</td><td>{{category}}</td><td>{{post_tag}}</td>'
    + '<td><a href="#" class="comment-count" title=""><span>{{comment_count}}</span></a></td>'
    + '<td><span>{{post_date}}</span><span class="record-operate">{{post_status}}</span></td></tr>{{/data}}';

  view['menuItem'] = '<li class="js-menu-items" data-id = "{{post_id}}" data-parentId = "{{menu_parent}}" data-order = "{{menu_order}}" >'
    +'<dl class="menu-item-bar"> <dt class="menu-item-handle"><span class="item-title"><span class="menu-item-title">{{post_title}}</span></span>'
    +'<span class="item-controls"> <span class="item-type">{{post_type}}</span><a data-toggle="collapse" class="item-edit" id="edit-{{post_id}}" href="#menu-item-setting-{{post_id}}"></a></span></dt></dl>'
    +'<div class="menu-item-settings collapse" id="menu-item-setting-{{post_id}}"><p class="description description-thin">'
    +'<label for="">导航标签<br><input type="text" class="widefat edit-menu-item-title"  value="{{post_title}}"></label>'
    +'</p><p class="description description-thin"><label for="">标题属性<br>'
    +'<input type="text"  class="widefat edit-menu-item-attr-title" name="" value="{{post_type}}"></label></p>'
    +'<div class="menu-item-actions description-wide submitbox"><p class="link-to-original">原始：'
    +' <a href="{{link}}" class="link-page">{{page_title}}</a> </p> <a class="item-delete submitdelete deletion js-delete-item"  href="javascript:void(0);" data-id="{{post_id}}">移除</a><span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js"  href="javascript:void(0)">取消</a></div></div></li>';

  view['menuPageList'] = '{{#data}}<li data-id="{{id}}"><label class="menu-item-title"><input type="checkbox"/>{{post_title}}</label></li>{{/data}}';

  view['confirmDialog'] = '<div class="modal fade l-dialog" id="confirmDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'
      + '<div class="modal-dialog dialog_modal"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'
      + '<h4 class="modal-title" id="myModalLabel">{{title}}</h4></div><div class="modal-body">&nbsp;&nbsp;{{content}}</div>'
      + '<div class="modal-footer"><button type="button" class="btn btn-default js-confirm-ok" data-dismiss="modal">OK</button>'
      + '<button type="button" class="btn btn-primary js-confirm-cancel" data-dismiss="modal">Cancel</button></div></div></div></div>';

  view['commentList'] = '{{#data}}<tr class="comment-record js-comment-record"><td><input type="checkbox" class="js-check-record" data-id="{{id}}"></td>'
    +'<td><span>{{comment_author}}</span><span class="record-operate" data-id="{{id}}">'
    +'<a class="js-comment-email">{{comment_author_email}}</a> | <a class="js-comment-ip">{{comment_author_ip}}</a></span></td>'
    +'<td><span class="record-operate" data-id="{{id}}"><a class="">提交于{{comment_date}}</a>'
    +'| {{#Response_to_author}}回复给{{/Response_to_author}}<a class="js-comment-response">{{Response_to_author}}</a></span>'
    +'<span>{{comment_content}}</span><div class="operation"><span class="record-operate showOperate js-comment-showOperate" data-id="{{id}}">'
    +'<a class="js-comment-operation" data-status="{{comment_approved}}">{{comment_approved}}</a> | <a class="js-comment-replay">回复</a> | <a class="js-comment-quickEdit">快速编辑</a>'
    +'| <a class="js-comment-edit">编辑</a> | <a class="js-comment-operation" data-status="Spam">垃圾评论</a> | <a class="js-comment-operation" data-status="Trash">移至回收站</a></span></div>'
    +'</td><td><span class="record-operate js-record-operate" data-id="{{post_id}}"><a class="js-comment-postTitle">{{post_title}}</a>'
    +'</br><a class="js-comment-viewPost">查看文章</a></td>{{/data}}';

  view['userMenuItem'] = '<li data-id="{{post_id}}"  data-parentId="{{menu_parent}}" data-order="{{menu_order}}"><a href="{{link}}" class="js-menu-item">{{post_title}}</a></li>'

  view['postFormUserList'] = '{{#data}}<option value="{{id}}" {{checked}}>{{user_login}}</option>{{/data}}';

  view['postFormSelectCategory'] = '{{#data}}<option value="{{id}}" {{checked}}>{{name}}</option>{{/data}}';
  
  view['errorMsgDialog'] = '<div class="modal fade l-dialog" id="errorDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'
    + '<div class="modal-dialog dialog_modal"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'
    + '<h4 class="modal-title" id="myModalLabel">{{title}}</h4></div><div class="modal-body">&nbsp;&nbsp;{{content}}</div>'
    + '<div class="modal-footer">'
    + '<button type="button" class="btn btn-primary js-confirm-cancel" data-dismiss="modal">Cancel</button></div></div></div></div>';

  view['postFormModuleFile'] = '{{#data}}<option value="{{.}}">{{.}}</option>{{/data}}'
  return view;
});
