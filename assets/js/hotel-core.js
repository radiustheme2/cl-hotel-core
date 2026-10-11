(function($) {
    "use strict";

    /* Main Functions */
    var CLHotelCore = {
        init: function() {
            this.Basic.init();
        },
        Basic: {
            init: function() {
                this.HeadroomStickyHeader();
            },
            HeadroomStickyHeader: function(){

                var header = document.querySelector(".headroom-sticky-header");
                if(header) {
                    var headroom = new Headroom(header, {
                        tolerance: {
                            down: 10,
                            up: 20
                        },
                        offset: 15
                    });
                    headroom.init();
                }

                var mobile_header = document.querySelector(".headroom-mobile-sticky-header");
                if(mobile_header) {
                    var mobile_headroom = new Headroom(mobile_header, {
                        tolerance: {
                            down: 10,
                            up: 20
                        },
                        offset: 15
                    });
                    mobile_headroom.init();
                }
            }
        }
    }

    // Window Load+Resize
    $(window).on('load resize', function (){
        // Elementor Frontend Load
        $(window).on('elementor/frontend/init', function () {
            if (elementorFrontend.isEditMode()) {
                elementorFrontend.hooks.addAction('frontend/element_ready/widget', function () {
                    CLHotelCore.init();
                });
            }
        });
    });

    $( document ).ready( function () {
        var header = document.querySelector(".headroom-sticky-header");
        if(header) {
            var headroom = new Headroom(header, {
                tolerance: {
                    down: 10,
                    up: 20
                },
                offset: 15
            });
            headroom.init();
        }
    });

})(jQuery);