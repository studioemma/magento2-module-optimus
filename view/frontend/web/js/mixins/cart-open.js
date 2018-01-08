define([
    'jquery',
    'Magento_Customer/js/customer-data'
], function ($, customerData) {
    'use strict';

    var minicart = $('[data-block="minicart"]');

    var openTO = 0;

    var updateCount = 0;

    minicart.on('contentLoading', function () {
        updateCount++;
    });

    var mixin = {

        update: function (updatedCart) {

            console.log('update');

            this._super(updatedCart);

            if (updateCount >= 1) {
                minicart.find('[data-role="dropdownDialog"]').dropdownDialog("open");
                clearTimeout(openTO);
                openTO = setTimeout(function() {
                    minicart.find('[data-role="dropdownDialog"]').dropdownDialog("close");
                }, 10000);
            }
        }
    };

    var cartOpenData = customerData.get('cartOpenData');

    if (!cartOpenData().openCartAfterAddingProduct) {
        // do not extend
        return function (target) {
            if (cartOpenData().openCartAfterAddingProduct === undefined) {
                // extend later
                cartOpenData.subscribe(function (newData) {
                    console.log('later');
                    if (newData.openCartAfterAddingProduct) {
                        console.log('extend');
                        target.extend(mixin);
                    }
                });
            }
            return target;
        };
    }

    return function (target) {
        return target.extend(mixin);
    };
});
