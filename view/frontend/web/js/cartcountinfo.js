define([
    'uiComponent',
    'Magento_Customer/js/customer-data',
    'jquery',
    'knockout',
    'mage/translate'
], function (Component, customerData, $, ko, mediaCheck) {

    return Component.extend({
        initialize: function () {
            this._super();

            this.cartCountInfoText = ko.observable($.mage.__('Cart contains %1 products').replace('%1', 0));

            var cartCountInfoData = customerData.get('cart');
            var count = cartCountInfoData().summary_count;

            if (count === undefined) {
                var that = this;
                cartCountInfoData.subscribe(function (newData) {
                    that.cartCountInfoText($.mage.__('Cart contains %1 products').replace('%1', newData.summary_count));
                });
            } else {
                this.cartCountInfoText($.mage.__('Cart contains %1 products').replace('%1', count));
            }
        }
    });
});
