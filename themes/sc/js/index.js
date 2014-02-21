require.config({
  baseUrl: baseThemePath + '/js',
  paths: {
    'jquery': 'lib/jquery.min',
    'underscore': 'lib/underscore.min',
    'mustache': 'lib/mustache',
    'jquery_ui':'lib/jquery_ui',
    'bootstrap': 'lib/bootstrap',
    'sortable':'lib/jquery.sortable',
    'formvalidation':'plugin/jquery.formValidation.1.1',
    'handleList':'plugin/jquery.handleList',
    'jqpagination':'plugin/jquery.jqpagination',
    'renderTemplate':'global/renderTemplate',
    'KindEditor' : 'kindeditor/kindeditor-min',
    'KindEditorLang' : 'kindeditor/lang/zh_CN'
  },
 shim: {
    'underscore': {
      exports: '_'
    },
    'mustache': {
      exports: 'mustache'
    },
    'sortable':{
      deps:['jquery','jquery_ui']
    },
    'formvalidation':{
      deps:['jquery']
    },
    'handleList':{
      deps:['jquery']
    },
    'bootstrap':{
      deps:['jquery']
    },
    'jqpagination': {
      deps:['jquery', 'handleList']
    },
    'KindEditor' : {
      deps: ['jquery'],
      exports: 'KindEditor'
    },
    'KindEditorLang' : {
      deps: ['KindEditor']
    }
  }
});


require(['jquery', 'underscore','bootstrap'], function($, _) {
  
    $(function() {
      // load module for each page
      var dataStart = $("script[data-main][data-start]").attr("data-start") || '';
      var startModules = dataStart.split(',');
      _.each(startModules, function(module) {
        require([module], function(moduleObj) {
          if (moduleObj && moduleObj.init) {
            moduleObj.init();
          }
        });
      });
    });
  });
