/**
 * jQuery Plugin for formatting thousand number to has separator
 * @version 1.2
 * @requires jQuery 1.4 or later and autoNumeric (http://www.decorplanit.com/plugin/)
 *
 * Copyright (c) 2016 Lucky
 * Licensed under the GPL license:
 * http://www.gnu.org/licenses/gpl.html
 */

(function($) {
  function lazzynumeric(options, field) {
    var settings = options;
    var element = field;

    this.initNumeric = function () {
      // Format all selected elements to have thousand separator.
      element.autoNumeric('init', settings);
    }

    this.cleanNumeric = function () {
      // Get closest form element.
      element.closest("form").submit(function() {
        element.each(function(index) {
          try {
            // Clean all value to be pure number before submitting.
            var obj = $(this);
            obj.val(obj.autoNumeric('get'));
          }
          catch(e) {
            // Do nothing on error.
            // Error can be caused if we remove the element dynamically.
            // For example we are using this plugin in dynamic table.
          }
        });
        return true;
      });
    }
  }

  $.fn.lazzynumeric = function (opts) {
    var options = {
      aSep: ",",
      aDec: "."
    };
    $.extend(options, opts);

    return this.each(function() {
      var obj = new lazzynumeric(options, $(this));
      obj.initNumeric();
      obj.cleanNumeric();
    });
  }
})(jQuery);
