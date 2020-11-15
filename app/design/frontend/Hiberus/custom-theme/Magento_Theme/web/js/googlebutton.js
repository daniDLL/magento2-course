define(['jquery',  'Magento_Ui/js/modal/confirm'], function($, confirmation) {
    return function(config, element) {

        $(element).click(function(){
            confirmation({
                title: $.mage.__('Are you sure you wanna go to Google?'),
                content: $.mage.__('Please confirm to be redirected out of this site.'),
                actions: {
                    confirm: function(){
                        window.location.href = "https://google.es";
                    }
                }
            });

        });

    }
});
