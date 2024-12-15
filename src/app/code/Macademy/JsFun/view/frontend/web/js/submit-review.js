/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'mage/translate'
], function ($, $t) {
    'use strict';

    return function (config, element) {
        $(element).on('submit', function (e) {
            if ($(this).valid()) {
                if (confirm($t('you sure, you wanna submit homie?'))) {
                    $(this).find('.submit').attr('disabled', true);
                } else {
                    e.preventDefault();
                }
            }
        });
    };
});
