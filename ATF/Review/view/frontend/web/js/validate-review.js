/**
 * Copyright © ATF, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'jquery/validate',
    'mage/translate'
], function ($) {
    'use strict';

    $.validator.addMethod(
        'rating-required', function (value) {
            return value !== undefined;
        }, $.mage.__('Please select one of each of the ratings above.'));

        $.validator.addMethod(
        'dash-validation', function (value) {
            if(value.includes('-')){
                return false;
            }else {
                return true;
            }
        }, $.mage.__('Please Remove dash from nickname.'));
});
