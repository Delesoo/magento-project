define([], function () {
    'use strict'

    return function (originalMessages) {
        originalMessages.defaults.hideTimeout = 1000;
        return originalMessages;
    }
})
