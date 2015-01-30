
var DataTabels = function (){
    
    var handelDynamicTables = function() {
        var oTable = $('.DynamicTable').dataTable({
            "aoColumnDefs": [{
                    "aTargets": [0]
                }],
            "oLanguage": {
                "sLengthMenu": "_MENU_ Rows",
                "sSearch": ""                
            },
            "aaSorting": [
                [1, 'asc']
            ],
            "aLengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10
        });
        
        $('.dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('.dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('.dataTables_length select').select2({minimumResultsForSearch: -1 });
        
    };
    
    return {
        init: function() {
            handelDynamicTables();
        }
        
    }
}();    // Dynamic Data Tabels

var LaddaSpinner = function (){
    
    var handelLaddaSpinner = function() {
        // Bind normal buttons
        Ladda.bind('.ladda-button', {timeout: 2000});

        // Bind progress buttons and simulate loading progress
        Ladda.bind('.progress-demo button', {
            callback: function(instance) {
                var progress = 0;
                var interval = setInterval(function() {
                    progress = Math.min(progress + Math.random() * 0.1, 1);
                    instance.setProgress(progress);

                    if (progress === 1) {
                        instance.stop();
                        clearInterval(interval);
                    }
                }, 200);
            }
        });
    };
    
    return {
        init: function() {
            handelLaddaSpinner();
        }
        
    };
}();    // Handel Ladda Spinner

var FormWizard = function (){
    
    var handelFormWizard = function() {
        var $wizard = $('#fuelux-wizard'),
                $btnPrev = $('.wizard-actions .btn-prev'),
                $btnNext = $('.wizard-actions .btn-next'),
                $btnFinish = $(".wizard-actions .btn-finish");

        $wizard.wizard().on('finished', function(e) {
            // wizard complete code
        }).on("changed", function(e) {
            var step = $wizard.wizard("selectedItem");
            // reset states
            $btnNext.removeAttr("disabled");
            $btnPrev.removeAttr("disabled");
            $btnNext.show();
            $btnFinish.hide();

            if (step.step === 1) {
                $btnPrev.attr("disabled", "disabled");
            } else if (step.step === 4) {
                $btnNext.hide();
                $btnFinish.show();
            }
        });

        $btnPrev.on('click', function() {
            $wizard.wizard('previous');
        });
        $btnNext.on('click', function() {
            $wizard.wizard('next');
        });
    };
    
    return {
        init: function() {
            handelFormWizard();
        }
        
    };
}();    // Handel Form Wizard

var FormValidationInline = function (){
    
    var handelFormValidation = function() {
        
        // validate signup form on keyup and submit
	$(".form-validate").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            
            rules: {
                firstname: "required",
                lastname: "required",
                email: {
                        required: true,
                        email: true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                passwordc: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                url: {
                    required: true,
                    url: true
                },
                numbers: {
                    required: true,
                    digits: true
                }
            },
            
            messages: {
                firstname: "Please enter your First Name",
                lastname: "Please enter your Last Name",
                email: "Please enter Correct E-mail Address",
                password: "Please enter password",
                passwordc: "Please enter password",
                url: "Please enter valid URL",
                numbers: "Please enter Numbers only"

            }
	});
    };
    
    return {
        init: function() {
            handelFormValidation();
        }
        
    };
}();    // Handel Form Validation

var FormValidationTooltip = function (){
    
    var handelFormValidation = function() {
        $("#formvalidationtooltip").validationEngine();
    };
    
    return {
        init: function() {
            handelFormValidation();
        }
        
    };
}();    // Handel Form Validation

var UISliders = function (){
    
    var handelSliders = function() {
        //  Basic Slider
        $("#slider").slider();

        // setup graphic EQ
        $("#eq > span").each(function() {
            // read initial values from markup and remove that
            var value = parseInt($(this).text(), 10);
            $(this).empty().slider({
                value: value,
                range: "min",
                animate: true,
                orientation: "vertical"
            });
        });
        
        //  Range Slider
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 500,
            values: [75, 300],
            slide: function(event, ui) {
                $("#amount").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
            }
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                " - $" + $("#slider-range").slider("values", 1));

        //  Max Value Slider
        $("#sliderMAX").slider({
            value: 100,
            min: 0,
            max: 500,
            step: 50,
            slide: function(event, ui) {
                $("#amountMAX").val("$" + ui.value);
            }
        });
        $("#amountMAX").val("$" + $("#slider").slider("value"));
    };
    
    return {
        init: function() {
            handelSliders();
        }
        
    };
}();    // Handel Jquery Ui Sliders

var NestableList = function (){
    
    var handleNestableList = function () {

        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };

        // activate Nestable for list 1
        $('#nestable_list_1').nestable({
            group: 1
        })
        .on('change', updateOutput);



        // output initial serialised data
        updateOutput($('#nestable_list_1').data('output', $('#nestable_list_1_output')));

        $('#nestable_list_menu').on('click', function (e) {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });

        $('#nestable_list_3').nestable();
        
        $('#nestable_list_2').nestable();

    };
    
    return {
        init: function() {
            handleNestableList();
        }
        
    };
}();    // handle Nestable List

var UITree = function () {

    return {
        //main function to initiate the module
        init: function () {

            var DataSourceTree = function (options) {
                this._data  = options.data;
                this._delay = options.delay;
            };

            DataSourceTree.prototype = {

                data: function (options, callback) {
                    var self = this;

                    setTimeout(function () {
                        var data = $.extend(true, [], self._data);

                        callback({ data: data });

                    }, this._delay)
                }
            };
            
            // INITIALIZING TREE
            var treeDataSource = new DataSourceTree({
                data: [
                    { name: 'Sales', type: 'folder', additionalParameters: { id: 'F1' } },
                    { name: 'Projects', type: 'folder', additionalParameters: { id: 'F2' } },
                    { name: 'Reports', type: 'item', additionalParameters: { id: 'I1' } },
                    { name: 'Finance', type: 'item', additionalParameters: { id: 'I2' } }
                ],
                delay: 400
            });

            var treeDataSource2 = new DataSourceTree({
                data: [
                    { name: 'System Logs <div class="tree-actions"></div>', type: 'folder', additionalParameters: { id: 'F11' } },
                    { name: 'Notifications <div class="tree-actions"></div>', type: 'folder', additionalParameters: { id: 'F12' } },
                    { name: '<i class="fa fa-bell"></i> Alerts', type: 'item', additionalParameters: { id: 'I11' } },
                    { name: '<i class="fa fa-bar-chart-o"></i> Tasks', type: 'item', additionalParameters: { id: 'I12' } }
                ],
                delay: 400
            });

            var treeDataSource3 = new DataSourceTree({
                data: [
                    { name: 'Resources <div class="tree-actions"></div>', type: 'folder', additionalParameters: { id: 'F11' } },
                    { name: 'Projects <div class="tree-actions"></div>', type: 'folder', additionalParameters: { id: 'F12' } },
                    { name: 'Nike Promo 2013', type: 'item', additionalParameters: { id: 'I11' } },
                    { name: 'IPO Reports', type: 'item', additionalParameters: { id: 'I12' } }
                ],
                delay: 400
            });

            var treeDataSource4 = new DataSourceTree({
                data: [
                    { name: 'Projects<div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'folder', additionalParameters: { id: 'F11' } },
                    { name: 'Reports<div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'folder', additionalParameters: { id: 'F12' } },
                    { name: '<i class="fa fa-user"></i> Member <div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div><div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'item', additionalParameters: { id: 'I11' } },
                    { name: '<i class="fa fa-calendar"></i> Events <div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'item', additionalParameters: { id: 'I12' } },
                    { name: '<i class="fa fa-suitcase"></i> Portfolio <div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'item', additionalParameters: { id: 'I12' } }
                ],
                delay: 400
            });

            var treeDataSource5 = new DataSourceTree({
                data: [
                    { name: 'Projects<div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'folder', additionalParameters: { id: 'F11' } },
                    { name: 'Reports<div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'folder', additionalParameters: { id: 'F12' } },
                    { name: '<i class="fa fa-user"></i> Member <div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div><div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'item', additionalParameters: { id: 'I11' } },
                    { name: '<i class="fa fa-calendar"></i> Events <div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'item', additionalParameters: { id: 'I12' } },
                    { name: '<i class="fa fa-suitcase"></i> Portfolio <div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'item', additionalParameters: { id: 'I12' } }
                ],
                delay: 400
            });  

            var treeDataSource6 = new DataSourceTree({
                data: [
                    { name: 'Projects<div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'folder', additionalParameters: { id: 'F11' } },
                    { name: 'Reports<div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'folder', additionalParameters: { id: 'F12' } },
                    { name: '<i class="fa fa-user"></i> Member <div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div><div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'item', additionalParameters: { id: 'I11' } },
                    { name: '<i class="fa fa-calendar"></i> Events <div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'item', additionalParameters: { id: 'I12' } },
                    { name: '<i class="fa fa-suitcase"></i> Portfolio <div class="tree-actions"><i class="fa fa-plus"></i><i class="fa fa-trash-o"></i><i class="fa fa-refresh"></i></div>', type: 'item', additionalParameters: { id: 'I12' } }
                ],
                delay: 400
            });    

            $('#MyTree').tree({
                dataSource: treeDataSource,
                loadingHTML: '<img src="assets/images/input-spinner.gif"/>',
            });


            $('#MyTree2').tree({
                dataSource: treeDataSource2,
                loadingHTML: '<img src="assets/images/input-spinner.gif"/>',
            });

            $('#MyTree3').tree({
                dataSource: treeDataSource3,
                loadingHTML: '<img src="assets/images/input-spinner.gif"/>',
            });

            $('#MyTree4').tree({
                selectable: false,
                dataSource: treeDataSource4,
                loadingHTML: '<img src="assets/images/input-spinner.gif"/>',
            });

            $('#MyTree5').tree({
                selectable: false,
                dataSource: treeDataSource5,
                loadingHTML: '<img src="assets/images/input-spinner.gif"/>',
            });

            $('#MyTree6').tree({
                selectable: false,
                dataSource: treeDataSource6,
                loadingHTML: '<img src="assets/images/input-spinner.gif"/>',
            });
        }

    };

}();    // Handel UI Tree with Bootstrap

var GoogleMap = function () {

    return {
        //main function to initiate the module
        init: function () {
            
            $("#responsive_map").gMap({
                maptype: google.maps.MapTypeId.ROADMAP,
                zoom: 14,
                markers: [{
                        latitude: -37.81621134854578,
                        longitude: 144.9559023693115,
                        html: "<img src='assets/images/demo/envoto.png' width='147' height='29'><h3>121 King St</h3>Melbourne VIC 3000",
                        popup: true,
                        flat: true,
                        icon: {
                            image: "assets/images/map-marker.png",
                            iconsize: [32, 37],
                            iconanchor: [15, 30],
                            shadowsize: [32, 37],
                            shadowanchor: null}
                    }
                ],
                panControl: true,
                zoomControl: true,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: true,
                scrollwheel: false,
                styles: [{"stylers": [{"hue": "#4dd4fd"}, {"gamma": 1.58}]}],
                onComplete: function() {
                    // Resize and re-center the map on window resize event
                    var gmap = $("#responsive_map").data('gmap').gmap;
                    window.onresize = function() {
                        google.maps.event.trigger(gmap, 'resize');
                        $("#responsive_map").gMap('fixAfterResize');
                    };
                }
            });
        
        }

    };

}();    // Handel UI Tree with Bootstrap

var VectorMaps = function (){
    
    var handleAllJQVMAP = function() {
        
        $('#world-map-gdp').vectorMap({
            map: 'world_mill_en',
            backgroundColor : '#eeeeee',
            series: {
                regions: [{
                        values: gdpData,
                        scale: ['#C8EEFF', '#0071A4'],
                        normalizeFunction: 'polynomial'
                    }]
            },
            onRegionLabelShow: function(e, el, code) {
                el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
            }
        });     // For World Map GDP
        
        $('#us_aea_en').vectorMap({
            map: 'us_aea_en',
            backgroundColor : '#eeeeee',
            regionStyle: {
              initial: {
                fill: '#8d8d8d'
              }
            }
        });     // For USA Map GDP
        
        $('#uk_mill_en').vectorMap({
            map: 'uk_mill_en',
            backgroundColor : '#eeeeee',
            regionStyle: {
              initial: {
                fill: '#8d8d8d'
              }
            }
        });     // For UK Map
    };
    
    return {
        init: function() {
            handleAllJQVMAP();
        }
        
    };
}();    // Function to handle Vector Maps

var Gallery = function (){
    
    var handleGallery = function() {
        
        $('#filters a').hover(function() {
            $(this).parent().prev().css('background', 'none');
        },
        function() {
            if ($(this).hasClass('selected')) {
                return false;
            }
            else {
                $(this).parent().prev().css('background', 'url("images/filter_sep.png") no-repeat scroll right center transparent');
            }
        });
        
        $('#filters a').click(function() {
            var a = $('#filters a');
            $(a).each(function() {
                $(this).parent().prev().css('background', 'url("images/filter_sep.png") no-repeat scroll right center transparent');
            });
            $(this).parent().prev().css('background', 'none');
        });
        
        $('.space').each(function() {
            var space = $(this).data('space');
            $(this).height(space);
        });
        
        $('.feature_title').wrapInner('<span></span>');
        var over_h = $('.portfolio_over').height() / 2;
        var over_link = $('.portfolio_over a').height() / 2;
        $('.portfolio_over a').css('top', over_h - over_link);
        
        $('.portfolio_inner').hover(function() {
            $(this).find('.portfolio-tags').removeClass('animated fadeOutDown');
            $(this).find('h2').removeClass('animated fadeOutUp');
            $(this).find('h5').removeClass('animated fadeOutUp');
            $(this).find('.portfolio-link').removeClass('animated fadeOutLeftBig');
            $(this).find('.portfolio-zoom').removeClass('animated fadeOutRightBig');
            $(this).find('.portfolio_over').animate({opacity: 1}, 1000);
            $(this).find('.portfolio-tags').addClass('animated fadeInUp');
            $(this).find('h2').addClass('animated fadeInDown');
            $(this).find('h5').addClass('animated fadeInDown');
            $(this).find('.portfolio-link').addClass('animated fadeInLeftBig');
            $(this).find('.portfolio-zoom').addClass('animated fadeInRightBig');
        },
        
        function() {
            $(this).find('.portfolio-tags').removeClass('animated fadeInUp');
            $(this).find('h2').removeClass('animated fadeInDown');
            $(this).find('h5').removeClass('animated fadeInDown');
            $(this).find('.portfolio-link').removeClass('animated fadeInLeftBig');
            $(this).find('.portfolio-zoom').removeClass('animated fadeInRightBig');
            $(this).find('.portfolio-tags').addClass('animated fadeOutDown');
            $(this).find('h2').addClass('animated fadeOutUp');
            $(this).find('h5').addClass('animated fadeOutUp');
            $(this).find('.portfolio-link').addClass('animated fadeOutLeftBig');
            $(this).find('.portfolio-zoom').addClass('animated fadeOutRightBig');
            $(this).find('.portfolio_over').animate({opacity: 0}, 1000);
        });
        
        "use strict";
        var $container = $('#IMGcontainer');

        $container.isotope({
            itemSelector: '.portfolio-item'
        });
        
        var $optionSets = $('#options .option-set'),
            $optionLinks = $optionSets.find('a');
            
        $optionLinks.click(function(){
            var $this = $(this);
            // don't proceed if already selected
            if ( $this.hasClass('selected') ) {
                return false;
            }
            
            var $optionSet = $this.parents('.option-set');
            $optionSet.find('.selected').removeClass('selected');
            $this.addClass('selected');

            // make option object dynamically, i.e. { filter: '.my-filter-class' }
            var options = {},
                key = $optionSet.attr('data-option-key'),
                value = $this.attr('data-option-value');

                // parse 'false' as false boolean
                value = value === 'false' ? false : value;
                options[ key ] = value;
                $container.isotope(options);
                return false;
            });
        
    };
    
    return {
        init: function() {
            handleGallery();
        }
        
    }
}();    // Draggable Portlets

var LoginPage = function (){
    
    var handleLoginForm = function () {

       jQuery('#forget-password').click(function () {
            jQuery('.login-form').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#back-btn').click(function () {
            jQuery('.login-form').show();
            jQuery('.forget-form').hide();
        });

        jQuery('#register-btn').click(function () {
            jQuery('.login-form').hide();
            jQuery('.register-form').show();
        });

        jQuery('#register-back-btn').click(function () {
            jQuery('.login-form').show();
            jQuery('.register-form').hide();
        });
    }       //  Function to handle LoginForm
    
    return {
        init: function() {
            handleLoginForm();
        }
        
    }
}();    // Function for Handel Login Page