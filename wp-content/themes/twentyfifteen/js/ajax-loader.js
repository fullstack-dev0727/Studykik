/**
 * Created by kp on 12/28/15.
 */

jQuery.fn.addLoadingIndicator = function (options) {
    this.css('position', 'relative')
        .append('<div class="action-area-indicator"></div>');
};

jQuery.fn.removeLoadingIndicator = function (options) {
    this.find('.action-area-indicator').remove();
};