

var App = function() {

    var handleSidebardropdown = function() {
        $('aside li').hover(function() {
            $(this).addClass('open');
        }, function() {
                $(this).removeClass('open');
            }
        );
    };   //  Sidebar menu dropdown
    
    var handleSidebarOpenable = function() {
        $('.openable > a').click(function() {

            if (!$('#wrapper').hasClass('sidebar-mini')) {
                if ($(this).parent().children('.submenu').is(':hidden')) {
                    $(this).parent().siblings().removeClass('open').children('.submenu').slideUp();
                    $(this).parent().addClass('open').children('.submenu').slideDown();
                }
                else {
                    $(this).parent().removeClass('open').children('.submenu').slideUp();
                }
            }

            return false;
        });
    };   //  Collapsible Sidebar Menu
    
    var handleSidebarScroll = function() {
        //scrollable sidebar
	$('.scrollable-sidebar').slimScroll({
		height: '100%',
		size: '3px'
	});
    };   //  Collapsible Sidebar Menu
    
    var handleLoginLink = function() {
        $('.login-link').click(function(e) {
            e.preventDefault();
            href = $(this).attr('href');

            $('.login-wrapper').addClass('fadeOutUp');

            setTimeout(function() {
                window.location = href;
            }, 900);

            return false;
        });
    };   //  Handel Login Link
    
    var handleScrollToTop = function() {
        $("#scroll-to-top").click(function() {
            $("html, body").animate({scrollTop: 0}, 600);
            return false;
        });
    };   //  scroll to top of the page
    
    var handleToggleMenu = function() {
        $('#sidebarToggle').click(function() {
            $('#wrapper').toggleClass('sidebar-display');
            $('.main-menu').find('.openable').removeClass('open');
            $('.main-menu').find('.submenu').removeAttr('style');
        });

        $('#sizeToggle').click(function() {

            $('#wrapper').off("resize");

            $('#wrapper').toggleClass('sidebar-mini');
            $('aside').toggleClass('scrollable');
            $('.main-menu').find('.openable').removeClass('open');
            $('.main-menu').find('.submenu').removeAttr('style');
        });

        if (!$('#wrapper').hasClass('sidebar-mini')) {
            if (Modernizr.mq('(min-width: 768px)') && Modernizr.mq('(max-width: 868px)')) {
                $('#wrapper').addClass('sidebar-mini');
                $('aside').removeClass('scrollable');
            }
            else if (Modernizr.mq('(min-width: 869px)')) {
                if (!$('#wrapper').hasClass('sidebar-mini')) {
                    $('aside').addClass('scrollable');
                }
            }
        }

        $(window).resize(function() {
            if (Modernizr.mq('(min-width: 768px)') && Modernizr.mq('(max-width: 868px)')) {
                $('#wrapper').addClass('sidebar-mini').addClass('window-resize');
                $('aside').removeClass('scrollable');
                $('.main-menu').find('.openable').removeClass('open');
                $('.main-menu').find('.submenu').removeAttr('style');
            }
            else if (Modernizr.mq('(min-width: 869px)')) {
                if ($('#wrapper').hasClass('window-resize')) {
                    $('#wrapper').removeClass('sidebar-mini window-resize');
                    $('aside').addClass('scrollable');
                    $('.main-menu').find('.openable').removeClass('open');
                    $('.main-menu').find('.submenu').removeAttr('style');
                }
            }
            else {
                $('#wrapper').removeClass('sidebar-mini window-resize');
                $('aside').addClass('scrollable');
                $('.main-menu').find('.openable').removeClass('open');
                $('.main-menu').find('.submenu').removeAttr('style');
            }
        });
    };   //  Toggle Menu
    
    var handleHoverTouchDevice = function() {
        $('.image-wrapper').bind('touchstart', function(e) {
            $('.image-wrapper').removeClass('active');
            $(this).addClass('active');
        });
    };   // Hover effect on touch device
    
    var handleDropdownHover = function() {
        $('.hover-dropdown').hover(
                function() {
                    $(this).addClass('open')
                },
                function() {
                    $(this).removeClass('open')
                }
        );
    };   //  Dropdown menu with hover
    
    var handelPanelTools = function() {
        
        //  For full Screen
        $('.panel-tools .panel-expand').bind('click', function(e) {            
            $('.panel-tools a').not(this).hide();
            $('body').append('<div class="full-white-backdrop"></div>');
            $('.main-container').removeAttr('style');
            
            backdrop = $('.full-white-backdrop');
            wbox = $(this).parents('.panel');
            wbox.removeAttr('style');
            if (wbox.hasClass('panel-full-screen')) {
                backdrop.fadeIn(200, function() {
                    $('.panel-tools a').show();
                    wbox.removeClass('panel-full-screen');
                    backdrop.fadeOut(200, function() {
                        backdrop.remove();
                    });
                });
            } else {
                $('body').append('<div class="full-white-backdrop"></div>');
                backdrop.fadeIn(200, function() {
                    $('.main-container').css({
                        'max-height': $(window).outerHeight() - $('header').outerHeight() - $('.footer').outerHeight() - 100,
                        'overflow': 'hidden'
                    });
                    backdrop.fadeOut(200);
                    backdrop.remove();
                    wbox.addClass('panel-full-screen').css({
                        'max-height': $(window).height(),
                        'overflow': 'auto'
                    });
                });
            }
        });
        
        //  Panel Close
        $('.panel-tools .panel-close').bind('click', function(e) {
            $(this).parents(".panel").remove();
            e.preventDefault();
        });
        
        // For Panel Referesh
        $('.panel-tools .panel-refresh').bind('click', function(e) {
            var el = $(this).parents(".panel");
            el.block({
                overlayCSS: {
                    backgroundColor: '#fff'
                },
                message: '<img src="assets/images/loading.gif" />',
                css: {
                    border: 'none',
                    color: '#333',
                    background: 'none'
                }
            });
            window.setTimeout(function() {
                el.unblock();
            }, 1000);
            e.preventDefault();
        });
        
        // For Panel Collapse and expend
        $('.panel-tools .panel-collapse').bind('click', function(e) {
            e.preventDefault();
            var el = jQuery(this).parent().closest(".panel").children(".panel-body");
            if ($(this).hasClass("collapses")) {
                $(this).addClass("expand").removeClass("collapses");
                el.slideUp(200);
            } else {
                $(this).addClass("collapses").removeClass("expand");
                el.slideDown(200);
            }
        });
        
    };  //  function to activate the panel tools
    
    var handelSlimScroll = function() {
        $(".scroller").each(function() {
            $(this).slimScroll({
                size: "5px",
                opacity: "0.6",
                position: $(this).attr("data-position"),
                height: $(this).attr("data-height"),
                alwaysVisible: ($(this).attr("data-always-visible") == "1" ? true : false),
                railVisible: ($(this).attr("data-rail-visible") == "1" ? true : false),
                disableFadeOut: true
            });
        });
    };      // function to Handel Slim Scroll
    
    var handleSummernote = function() {
        if (!jQuery().summernote) {
            return;
        }

        $('.summernote-email').summernote({
            height: 430 //set editable area's height
        });
        
        $('.summernote').summernote({
            height: 150 //set editable area's height
        });
    };   // summernote Text Editor
    
    var handelTooltip = function() {
        $("[data-toggle=tooltip]").tooltip();        
    };        //  function to Handel Bootstrap Tooltip

    var handelPopovers = function() {
        $("[data-toggle=popover]").popover();
    };
    
    var handleInboxMenu = function() {
        $('#inboxMenuToggle').click(function() {
            $('#inboxMenu').toggleClass('menu-display');
        });
        
    };   //Inbox sidebar (inbox.html)
    
    var handelSelect2 = function() {
        
        if (!jQuery().select2) {
            return;
        }
        
        $('.select2').select2({minimumResultsForSearch: -1 });
        
        $('.select2Search').select2();
    };         //  Function to handel  Sclect2
    
    var handelFootable = function() {
        
        if (!jQuery().footable) {
            return;
        }
        
        $('.footable').footable();

    };         //  Footable Responsive Table
    
    var handelSortableTbl = function() {
        
        // sortable tables
        if ($(".js-table-sortable").length) {
            $(".js-table-sortable").sortable({
                
                placeholder: "ui-state-highlight",
                items: "tbody tr",
                handle: ".js-sortable-handle",
                forcePlaceholderSize: true,
                helper: function(e, ui){
                    ui.children().each(function() {
                    $(this).width($(this).width());
                    });
                    return ui;
                },
                start: function(event, ui){
                    if (typeof mainYScroller != 'undefined')
                        mainYScroller.disable();
                        ui.placeholder.html('<td colspan="' + $(this).find('tbody tr:first td').size() + '">&nbsp;</td>');
                },
                stop: function() {
                    if (typeof mainYScroller != 'undefined')
                    mainYScroller.enable();
                }
            });
        }
        
    };  //  Draggable Columns Table
    
    var handleTableCheckBox = function() {
        
  	$(".table th input:checkbox").click(function () {
  		$checks = $(this).closest(".table").find("tbody input:checkbox");
  		if ($(this).is(":checked")) {
  			$checks.prop("checked", true);
  		} else {
  			$checks.prop("checked", false);
  		}  		
  	});

    };  // toggle all checkboxes from a table when header checkbox is clicked
    
    var handelMultiselectBtn = function() {

        if (!jQuery().multiselect) {return;}
        $('.btn-multiselect').multiselect();
    };  // Bootstrap Editor
    
    var handeliCheckbox = function () {
        if (!jQuery().iCheck) {
            return;
        }
        
        $('input.icheck').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        });
    };      //  Function to handel Checkbox
    
    var handleUniform = function () {
        if (!jQuery().uniform) {
            return;
        }
       $('.uniforminpt').uniform();
    };      //  Function to handle Uniform JS
    
    var handelResponsivePagination = function() {
        
        if (!jQuery().rPage) {
            return;
        }
        
        $(".rPage").rPage();        

    };  // Responsive Pagination
    
    var handelTagInput = function () {
        if (!jQuery().tagsinput) {
            return;
        }
        
        $('.tags-labeld').tagsinput({
            tagClass: function(item) {
                switch (item.continent) {
                    case 'Europe'   :
                        return 'label label-primary';
                    case 'America'  :
                        return 'label label-danger label-important';
                    case 'Australia':
                        return 'label label-success';
                    case 'Africa'   :
                        return 'label label-default';
                    case 'Asia'     :
                        return 'label label-warning';
                }
            },
            itemValue: 'value',
            itemText: 'text'
        });
        $('.tags-labeld').tagsinput('add', {"value": 1, "text": "Amsterdam", "continent": "Europe"});
        $('.tags-labeld').tagsinput('add', {"value": 4, "text": "Washington", "continent": "America"});
        $('.tags-labeld').tagsinput('add', {"value": 7, "text": "Sydney", "continent": "Australia"});
        $('.tags-labeld').tagsinput('add', {"value": 10, "text": "Beijing", "continent": "Asia"});
        $('.tags-labeld').tagsinput('add', {"value": 13, "text": "Cairo", "continent": "Africa"});
        
        
    };      //  Function to handel Tags
    
    var handleDateRangePickers = function() {
        if (!jQuery().daterangepicker) {
            return;
        }

        $('#defaultrange').daterangepicker();

        $('#reportrange').daterangepicker({
            opens: 'right',
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '01/01/2014',
            maxDate: '12/31/2024',
            dateLimit: {
                days: 60
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                'Last 7 Days': [moment().subtract('days', 6), moment()],
                'Last 30 Days': [moment().subtract('days', 29), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            buttonClasses: ['btn'],
            applyClass: 'btn-success',
            cancelClass: 'btn-default',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            locale: {
                applyLabel: 'Apply',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom Range',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        },
        function(start, end) {
            console.log("Callback has been called!");
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );
        //Set the initial state of the picker label
        $('#reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        
        
        $('#reportrange-top').daterangepicker({
            opens: 'left',
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '01/01/2014',
            maxDate: '12/31/2024',
            dateLimit: {
                days: 60
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                'Last 7 Days': [moment().subtract('days', 6), moment()],
            },
            buttonClasses: ['btn'],
            applyClass: 'btn-success',
            cancelClass: 'btn-default',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            locale: {
                applyLabel: 'Apply',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom Range',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        },
        function(start, end) {
            $('#reportrange-top span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );
        //Set the initial state of the picker label
        $('#reportrange-top span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        
    };
    
    var handleDatePickers = function() {
        if (!jQuery().datepicker) {
            return;
        }
        
        $('.date-picker').datepicker({
            autoclose: true
        });
        
        $('#sandbox-container .input-group.date-picker').datepicker();
    };
    
    var handleTimePicker = function () {
        if (!jQuery().timepicker) {
            return;
        }
       $('.timepicker').timepicker();
    };      //  Function to handle TimePicker
    
    var handleClockface = function () {
        if (!jQuery().clockface) {
            return;
        }
       $('.clockface').clockface();
    };      //  Function to handle TimePicker
    
    var handleColorbox = function () {
        if (!jQuery().colorbox) {
            return;
        }
        $('.colorbox').colorbox({
            rel: 'group1',
            width: "90%",
            maxWidth: '800px'
        });
    };      //  Function to handle color box

    return {
        init: function() {
            handleSidebardropdown();
            handleSidebarOpenable();
            handleSidebarScroll();
            handleLoginLink();
            handleScrollToTop();
            handleToggleMenu();
            handleHoverTouchDevice();
            handleDropdownHover();
            handelPanelTools();
            handelSlimScroll();
            handleSummernote();
            handelTooltip();
            handelPopovers();
            handleInboxMenu();
            handelSelect2();
            handelFootable();
            handelSortableTbl();
            handleTableCheckBox();
            handelMultiselectBtn();
            handeliCheckbox();
            handleUniform();
            handelResponsivePagination();
            handelTagInput();
            handleDateRangePickers();
            handleDatePickers();
            handleTimePicker();
            handleClockface();
            handleColorbox();
        }

    };
}();    // Handel Application

$(window).scroll(function() {

    var position = $(window).scrollTop();

    //Display a scroll to top button
    if (position >= 200) {
        $('#scroll-to-top').attr('style', 'bottom:8px;');
    }
    else {
        $('#scroll-to-top').removeAttr('style');
    }
});


