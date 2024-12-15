define([], function () {
    'use strict';

    return function (Component) {
        return Component.extend({
            isItemsBlockExpanded: function () {
                return true;
            }
        });
    };
});
