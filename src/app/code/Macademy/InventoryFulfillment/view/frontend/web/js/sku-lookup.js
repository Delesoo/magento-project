define([
    'uiComponent',
    'ko',
    'mage/storage'
], function (
    Component,
    ko,
    storage
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Macademy_InventoryFulfillment/sku-lookup',
            sku: ko.observable('24-MB01'),
            messageResponse: ko.observable('')
        },
        initialize() {
            this._super();

            console.log('The skuLookup component has been loaded.');
        },
        handleSubmit() {
            this.messageResponse('');

            storage.get(`rest/V1/products/${this.sku()}`)
                .done(response => {
                    this.messageResponse(`Product found! <strong>${response.name}</strong>`);
                })
                .fail(() => {
                    this.messageResponse('Product not found homie, go find it urself.');
                })
        }
    });
});
