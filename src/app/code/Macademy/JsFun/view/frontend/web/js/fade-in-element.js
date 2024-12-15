define(['jquery'], function ($) {
    'use strict'

    return function (className, duration) {
        $(className).hide().fadeIn(duration || 2000)
    }
})
