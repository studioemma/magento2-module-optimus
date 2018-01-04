define(["jquery"], function($){
    "use strict";
    var SelectQty = {
        init: function(config, element) {
            $(element).change(function() {
                if($(this).val() == "more") {
                    $(this).hide();
                    $(this).next(".qty").css('display', 'inline-block');
                    $(this).next(".qty").focus();
                    $(this).next(".qty").select();
                } else {
                    $(this).next(".qty").val($(this).val());
                }
                $(this).siblings('.small-save-button').css('display','inline-block');
            });
        }
    };
    return {
        selectqty: SelectQty.init
    };
});
