var config = {
    paths: {
        selectqty: 'StudioEmma_Optimus/js/selectqty',
        accountmenutoggle: 'StudioEmma_Optimus/js/accountmenutoggle',
    },
    config: {
        mixins: {
            'Magento_Checkout/js/view/minicart': {
                'StudioEmma_Optimus/js/mixins/cart-open': true
            }
        }
    }
};
