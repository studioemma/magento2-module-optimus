define([
    'uiComponent',
    'Magento_Customer/js/customer-data',
    'jquery',
    'knockout',
    'matchMedia',
    'mage/translate'
], function (Component, customerData, $, ko, mediaCheck) {

    return Component.extend({
        initialize: function () {
            this._super();
            var cartMoreButtonData = customerData.get('cartMoreButtonData');

            this.remainingProducts = ko.observable(0);
            this.remainingProductsMoreText = ko.observable($.mage.__('Show %1 more products').replace('%1', 0));
            this.remainingProductsLessText = ko.observable($.mage.__('Show %1 less products').replace('%1', 0));
            this.remainingProductsShow = ko.observable(false);

            var limit = cartMoreButtonData().showProductsNumber;

            if (limit === undefined) {
                var that = this;
                cartMoreButtonData.subscribe(function (newData) {
                    that.limitProducts(newData.showProductsNumber);
                });
            } else {
                this.limitProducts(limit);
            }
        },
        limitProducts: function (limit) {
            this.limit = limit;
            $('#cart-more-button').appendTo('.cart.table-wrapper');
            var remainingProducts = 0;
            if ($('#shopping-cart-table').length) {
                var $allProducts = $('#shopping-cart-table .cart.item');
                remainingProducts = $allProducts.length - limit;
                if (remainingProducts > 0) {
                    this.remainingProducts(remainingProducts);
                    this.remainingProductsMoreText((remainingProducts === 1) ? $.mage.__('Show 1 more product') : $.mage.__('Show %1 more products').replace('%1', remainingProducts));
                    this.remainingProductsLessText((remainingProducts === 1) ? $.mage.__('Show 1 less product') : $.mage.__('Show %1 less products').replace('%1', remainingProducts));
                    var that = this;
                    mediaCheck({
                        media: '(max-width: 768px)',
                        entry: function () {
                            $('#cart-more-button').show();
                            that.hideRemainingProducts();
                        },
                        exit: function () {
                            $('#cart-more-button').hide();
                            that.showRemainingProducts();
                        }
                    });
               }
            }
        },
        showRemainingProducts: function () {
            this.remainingProductsShow(true);
            var $allProducts = $('#shopping-cart-table .cart.item');
            $allProducts.each(function (index) {
                $(this).show();
            });
        },
        hideRemainingProducts: function () {
            var limit = this.limit;
            if (!limit) {
                return;
            }
            this.remainingProductsShow(false);
            var $allProducts = $('#shopping-cart-table .cart.item');
            $allProducts.each(function (index) {
                if (index >= limit) {
                    $(this).hide();
                }
            });
        }
    });
});
