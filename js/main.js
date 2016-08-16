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

  },

  onResize: function() {
    var _this = this;

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
      _this.paramArray = _this.paramList.split(',');

      _this.toggleCats(_this.paramArray);
    }

    if ($('.js-sort-toggle').length) {
      _this.bindToggle();
    }

  },

  bindToggle: function() {
    var _this = this;

    $('.js-sort-toggle').on('click', function(event) {
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

        newUrl += '?' + _this.queryVar + '=' + _this.paramArray.join();

      } else if (!foundInQuery) {
        _this.paramArray.push(toggleParam);

        newUrl += '?' + _this.queryVar + '=' + _this.paramArray.join();

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

  toggleCats(slugArray) {
    var _this = this;

    $('.js-sort-toggle').removeClass('active');
    
    if (slugArray.length > 0) {
      $('.post').hide();

      for(var i = 0; i < slugArray.length; i++) {
        $('.post.category-' + slugArray[i]).show();

        $('.js-sort-toggle[data-cat=' + slugArray[i] + ']').addClass('active');
      }
    } else {
      $('.post').show();
    }
  }
}

jQuery(document).ready(function () {
  'use strict';

  Site.init();

});