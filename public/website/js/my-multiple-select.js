/**
 * Created by Camille on 13/06/2017.
 */

;(function($){
    function MultipleSelect(options, content) {
        this.options = $.extend({
            select: $(content)
        }, options);
        this.init();
    }
    MultipleSelect.prototype = {
        init: function() {
            if(this.options.holder) {
                this.findElements();
                this.attachEvents();
                this.makeCallback('onInit', this);
            }
        },
        findElements: function() {
            var self = this;
            this.elem = {};
            this.options.select.hide();

            this.elem.listOptions = this.options.select.find('option');
            this.elem.ul = $(document.createElement("ul"));
            this.elem.ul.addClass('multiple-select');


            this.elem.listOptions.each(function(index, option){
                var isSelected = $(option).is(':selected') ? 'selected' : '';
                self.elem.ul.append('<li class="'+ isSelected +'" data-value="'+$(option).val()+'">'+$(option).html()+'</li>');
            });

            this.elem.ul.insertAfter(this.options.select);
            this.elem.listOfLi = this.elem.ul.find('li');
        },

        // attach events
        attachEvents: function() {
            var self = this;

            this.elem.listOfLi.click(function(e){
                var val = $(this).data('value');
               if ($(this).hasClass('selected')) {
                   $(this).removeClass('selected');
                   self.elem.listOptions.each(function(i, option){
                        if($(option).val() == val) {
                            $(option).removeAttr('selected');
                        }
                   });
               } else {
                   $(this).addClass('selected');
                   self.elem.listOptions.each(function(i, option){
                       if($(option).val() == val) {
                           $(option).attr('selected', 'selected');
                           $(option).prop('selected', true);
                       }
                   });
               }

            });

        },

        // execute callback
        makeCallback: function(name) {
            if(typeof this.options[name] === 'function') {
                var args = Array.prototype.slice.call(arguments);
                args.shift();
                this.options[name].apply(this, args);
            }
        }
    };

    // detect device type
    var isTouchDevice = /Windows Phone/.test(navigator.userAgent) || ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch;

    // jquery plugin
    $.fn.MultipleSelect = function(opt){
        var select = this;
        return this.each(function(){
            $(this).data('MultipleSelect', new MultipleSelect($.extend(opt,{holder:this}), select));
        });
    };
}(jQuery));

