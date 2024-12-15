define([
    'uiComponent',
    'ko'
], function (
    Component,
    ko
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Macademy_InventoryFulfillment/sku-lookup',
            sku: ko.observable('vaime ariqa'),
            placeholder: 'Example: 24-MB01'
        },
        initialize() {
            this._super();

            console.log('The skuLookup component has been loaded.');
        },
        handleSubmit() {
            console.log(this.sku() + 'SKU confirmed');
        }
    });
});
