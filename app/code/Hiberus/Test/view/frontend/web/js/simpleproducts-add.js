define(['jquery'], function($) {
    'use strict';
    return function(config, element) {
        
        $(element).click(function(){
            let qtyInput = $(this).closest('li').find('.input');
            qtyInput.val(parseInt(qtyInput.val()) + 1);
        });

    }
});
