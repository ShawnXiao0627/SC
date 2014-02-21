/**
 *Post form render
 */
define(['jquery', 'underscore', 'renderTemplate', 'global/url', 'global/constants', 'KindEditor', 'KindEditorLang', 'bootstrap'], function($, _, render, URL, constants, KindEditor) {
  var $view, el, controller;

  function mapElements() {
    el = {
      $authorSelect: $view.find('.js-load-all-user'),
      $blockToggleTag: $view.find('.js-bock-content'),
      $allCategoryContent: $view.find('.js-all-category-content'),
      $allModuleFile: $view.find('.js-add-post-module-file')
    };
  }
  
  function bindActions() {
    el.$blockToggleTag.on('click', function() {
      $(this).parent().next().fadeToggle();
    });

  }
  
  function _createKindEditor() {
    KindEditor.create('#post_content', {
      pasteType: 2,
      themeType: 'example1',
      afterChange: function() {
        KindEditor('.js-editor-count').html(this.count());
      }
    });
  }

  function _loadInitData() {
    controller.loadInitData();
  }

  function _filterModuleSuffix(modules) {
    return _.map(modules, function(module) {
      return module.substring(0, module.length - 4);
    });
  }
  
  function initPostFormPage() {
    _loadInitData();
    _createKindEditor();
  }
  
  return {
    init: function(_controller) {
      controller = _controller;
      $view = $('.js-post-form');
      mapElements();
      bindActions();
      initPostFormPage();
    },
    renderInitData: function(response) {
      var currentAuthorId = el.$authorSelect.data('author').toString();
      var currentCatetoryId = el.$allCategoryContent.data('category').toString();
      //show the current user in a select.
      _.map(response.users, function(data) {
        if (data.id === currentAuthorId) {
          data.checked = constants.SELECTED_STRING;
          return data;
        }
      });
      //show the current category in a select.
      _.map(response.category, function(data) {
        if (data.id === currentCatetoryId) {
          data.checked = constants.SELECTED_STRING;
          return data;
        }
      });

      el.$authorSelect.html(render.renderTemplate('postFormUserList', response.users));
      el.$allCategoryContent.append(render.renderTemplate('postFormSelectCategory', response.category));
      el.$allModuleFile.html(render.renderTemplate('postFormModuleFile', _filterModuleSuffix(response.moduleFiles)));
    }
  };
});
