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
                    $(this).siblings('.small-save-button').css('display','inline-block');
                } else {
                    $(this).next(".qty").val($(this).val());
                    if ($('#form-validate').length) {
                        $('#form-validate').submit();
                    }
                }
            });
        }
    };
    return {
        selectqty: SelectQty.init
    };
});
