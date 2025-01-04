define([
    'uiComponent',
    'ko',
    'Macademy_InventoryFulfillment/js/model/sku',
    'Macademy_InventoryFulfillment/js/model/box-configurations',
    'mage/url'
], function (
    Component,
    ko,
    skuModel,
    boxConfigurationsModel,
    url
) {
    'use strict';

    return Component.extend({
        defaults: {
            numberOfBoxes: boxConfigurationsModel.numberOfBoxes(),
            shipmentWeight: boxConfigurationsModel.shipmentWeight(),
            billableWeight: boxConfigurationsModel.billableWeight(),
            isTermsChecked: ko.observable(false),
            boxConfigurationsIsSuccess: boxConfigurationsModel.isSuccess,
            boxConfigurations: boxConfigurationsModel.boxConfigurations,
            sku: skuModel.sku,
        },
        initialize() {
            this._super();

            console.log('reviewSubmit loaded');

            this.canSubmit = ko.computed(() => {
                return skuModel.isSuccess()
                    && boxConfigurationsModel.isSuccess()
                    && this.isTermsChecked();
            });
        },
        handleSubmit() {
            if (this.canSubmit()) {
                console.log('The review submit for has been submitted');
                return true;
            } else {
                console.log('The review submit has an error');
            }
        },
        getUrl() {
            return url.build('inventory-fulfillment/index/post');
        }
    });
});
