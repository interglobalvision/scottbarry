/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    _this.Sort.init();

    _this.Header.init();

    _this.Layout.fontExpandedHeight();

  },

  onResize: function() {
    var _this = this;

    _this.Layout.fontExpandedHeight();
  },

  fixWidows: function() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  },
};

Site.Layout = {
  fontExpandedHeight: function() {
    $('.font-expanded').each(function(){
      $(this).parent('.font-expanded-holder').css('height', $(this).outerHeight() * 0.7);
    })
  }
};

Site.Header = {
  $header: $('#header'),
  init: function() {
    var _this = this;

    if ($('.menu-trigger').length) {
      _this.bindMenuToggles();
    }

    _this.hoverSkew();
  },

  bindMenuToggles: function() {
    var _this = this;

    $('.menu-trigger').bind('click', function(event) {
      event.preventDefault();

      if ($(this).hasClass('active')) {
        $(this).removeClass('active');
      } else {
        $('.menu-item.active').removeClass('active');
        $(this).addClass('active');
      } 

      var menu = $(this).attr('data-trigger');

      _this.toggleMenu(menu);
    });

    $('#header').bind('click', function(event) {
      if (!$(event.target).is('#header *')) {
        _this.closeMenu();
        return false;
      }
    });
  },

  closeMenu: function() {
    var _this = this;

    if (_this.$header.hasClass('open')) {
      $('.menu-item.active').removeClass('active');
      _this.$header.removeClass('open projects-open sort-open');
      $('.sub-menu.active').removeClass('active');
    }
  },

  toggleMenu: function(menuName) {
    var _this = this;
    var $menu = $('#' + menuName + '-menu');

    if ($menu.hasClass('active')) {
      $menu.removeClass('active');
      _this.$header.removeClass('open projects-open sort-open');
    } else {
      $('.sub-menu.active').removeClass('active');
      $menu.addClass('active');
      _this.$header.removeClass('projects-open sort-open');
      _this.$header.addClass('open ' + menuName + '-open');
    } 
  },

  hoverSkew: function() {
    var characters;

    if ($('.hover-skew').length) {
      $('.hover-skew').each(function() {
        var $this = $(this);

        characters = $this.text().split("");

        $this.empty();
        $.each(characters, function (i, el) {
          var spaceless = el.replace(/\s+/g, '&nbsp;');
          $this.append("<span>" + spaceless + "</span>");
        });
      });
    }
  }
};

Site.Sort = {
  siteUrl: window.location.origin + window.location.pathname,
  queryVar: 'sort',
  queryString: '',
  paramList: '',
  paramArray: [],

  init: function() {
    var _this = this;

    _this.queryString = window.location.search.substring(1);

    if (_this.queryString) {
      _this.paramList = _this.queryString.replace(_this.queryVar + '=', '');
      _this.paramArray = _this.paramList.split('+');

      _this.toggleCats(_this.paramArray);
    }

    if ($('.sort-toggle').length) {
      _this.bindSortToggle();
    }

  },

  bindSortToggle: function() {
    var _this = this;

    $('.sort-toggle').on('click', function(event) {
      event.preventDefault();

      var catSlug = $(this).attr('data-cat');

      _this.changeSortQuery(catSlug);
    });
  },

  changeSortQuery: function(toggleParam) {
    var _this = this;
    var newUrl = _this.siteUrl;

    _this.queryString = window.location.search.substring(1);

    if(_this.queryString) {
      var foundInQuery = $.inArray(toggleParam, _this.paramArray) > -1;

      if (foundInQuery && _this.paramArray.length > 1) {
        _this.paramArray.splice(_this.paramArray.indexOf(toggleParam), 1);

        newUrl += '?' + _this.queryVar + '=' + _this.paramArray.join('+');

      } else if (!foundInQuery) {
        _this.paramArray.push(toggleParam);

        newUrl += '?' + _this.queryVar + '=' + _this.paramArray.join('+');

      } else {
        _this.paramArray = [];
      }

    } else {
      _this.paramList = toggleParam;
      _this.paramArray = [toggleParam];
      newUrl += '?' + _this.queryVar + '=' + toggleParam;

    }

    _this.toggleCats(_this.paramArray);

    window.history.replaceState(_this.paramList, 'Scott Barry', newUrl);
  },

  toggleCats: function(slugArray) {
    var _this = this;

    $('.sort-toggle').removeClass('active');

    if (slugArray.length > 0) {
      $('.js-sort-item').hide();

      for(var i = 0; i < slugArray.length; i++) {
        $('.js-sort-item.category-' + slugArray[i]).show();

        $('.sort-toggle[data-cat=' + slugArray[i] + ']').addClass('active');
      }
    } else {
      $('.js-sort-item').show();
    }
  }
};

jQuery(document).ready(function () {
  'use strict';

  Site.init();

});