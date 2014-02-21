(function($) {
  var defaultOptions = {
    pageNum: 1,
    status: 'all',
    updated: function () {}
  };
  
  $.fn.handleList = function() {
    var base = {}, options;
    //init the list
    if (arguments[0] === 'option') {
      base = $(this).data('handlviewist');
      if (arguments.length === 2) {
        switch (arguments[1]) {
          case 'condition': return jQuery.extend({}, (base.params)); break;
        }
        return '';
      } else if (arguments.length === 3) {
        if (base.params[arguments[1]]) {
          base.params[arguments[1]] = arguments[2];
          update();
        }
      }
    } else {
      options = arguments[0];
      base.options = $.extend({}, defaultOptions, options);
      base.$view = $(this);
      base.el = {};
      base.params = {
        pageNum: base.options.pageNum,
        status: base.options.status
      };
      
      mapElements();
      bindActions();
      base.$view.data('handlviewist', base);
      update();
    }

    function mapElements() {
      base.el = {
        $search: base.$view.find('.search'),
        $searchBtn: base.$view.find('.search-btn'),
        $filter: base.$view.find('.list__filter'),
        $sorts: base.$view.find('.sortable')
      };
    }
    
    function bindActions() {
      base.el.$searchBtn.on('click', handleSearch);
      base.el.$filter.on('change', handleFilter);
      base.el.$sorts.on('click', handleSort);
    }
    
    function handleSearch() {
      base.params.search = base.el.$search.val();
      update();
    }
    
    function handleFilter() {
      base.params.status = base.el.$filter.val();
      update();
    }
    
    function handleSort() {
      var $this = $(this);
      base.params.order  = $this.attr('data-sort');
      base.params.orderBy = $this.attr('name');
      this.setAttribute('data-sort', ((base.params.order == 'desc') ? 'asc' : 'desc'));
      update();
      $icons = base.$view.find('.glyphicon');
      $icons.removeClass();
      $icons.addClass('glyphicon');
      var $icon = $this.find('.glyphicon');
      var arrowClass = {
        DOWN: 'glyphicon-chevron-down',
        UP: 'glyphicon-chevron-up'
      };
      if ('asc' == base.params.order) {
        $icon.removeClass(arrowClass.UP);
        $icon.addClass(arrowClass.DOWN);
      } else {
        $icon.removeClass(arrowClass.DOWN);
        $icon.addClass(arrowClass.UP);
      }
    }
    
    function update() {
      base.el.$search.val(base.params.search)
      base.options.updated(jQuery.param(base.params));
    }
  };

})(jQuery);