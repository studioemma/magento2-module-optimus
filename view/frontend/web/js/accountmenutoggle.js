define(['jquery', 'matchMedia', 'mage/collapsible'], function($, mediaCheck){
    "use strict";
    var AccountMenuToggle = {
        init: function(config, element) {
            $(element).collapsible();

            mediaCheck({
                media: '(min-width: 769px)',
                // Switch to Desktop Version.
                entry: function () {
                    $(element).find('.block.account-nav').prependTo('.sidebar.sidebar-main');
                },
                // Switch to Mobile Version.
                exit: function () {
                    $('.sidebar.sidebar-main').find('.block.account-nav').prependTo($(element).find('.c-account-menu-toggle__content'));
                }
            });

        }
    };
    return {
        accountmenutoggle: AccountMenuToggle.init
    };
});
