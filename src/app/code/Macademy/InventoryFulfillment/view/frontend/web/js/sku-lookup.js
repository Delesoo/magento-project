define([
    'uiComponent',
    'ko',
    'mage/storage',
    'jquery',
    'mage/translate'
], function (
    Component,
    ko,
    storage,
    $,
    $t
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Macademy_InventoryFulfillment/sku-lookup',
            placeholder: $t('Example: %1').replace('%1', '24-MB01'),
            sku: ko.observable('24-MB01'),
            messageResponse: ko.observable(''),
            isSuccess: ko.observable(false),
        },
        initialize() {
            this._super();

            console.log('The skuLookup component has been loaded.');
        },
        handleSubmit() {
            $('body').trigger('processStart');
            this.messageResponse('');
            this.isSuccess(false);

            storage.get(`rest/V1/products/${this.sku()}`)
                .done(response => {
                    this.messageResponse($t('Product Find! %1').replace('%1', `<strong>${response.name}</strong>`));
                    this.isSuccess(true);
                })
                .fail(() => {
                    this.messageResponse($t('Product not found homie, go find it urself.'));
                    this.isSuccess(false);
                })
                .always(() => {
                    $('body').trigger('processStop');
                });
        }
    });
});
