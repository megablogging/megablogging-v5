

var Dashboard = function (){
    
    var handelMainHeader = function() {
        //Sparkline
        $('#visits').sparkline([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21, 10, 15, 18, 25, 9], {
            type: 'bar',
            barColor: '#f66764',
            height: '35px',
            weight: '96px'
        });
        $('#balances').sparkline([220, 160, 189, 156, 201, 220, 104, 242, 221, 111, 164, 242, 183, 165], {
            type: 'bar',
            barColor: '#92cf5c',
            height: '35px',
            weight: '96px'
        });
    };  //  Function Has the sparkline Js
    
    var handelNumberAnimation = function() {
        //Number Animation
        var currentVisitor = $('#currentVisitor').text();

        $({numberValue: 0}).animate({numberValue: currentVisitor}, {
            duration: 2500,
            easing: 'linear',
            step: function() {
                $('#currentVisitor').text(Math.ceil(this.numberValue));
            }
        });

        var currentBalance = $('#currentBalance').text();

        $({numberValue: 0}).animate({numberValue: currentBalance}, {
            duration: 2500,
            easing: 'linear',
            step: function() {
                $('#currentBalance').text(Math.ceil(this.numberValue));
            }
        });
    };  //  Function to handel animation in Main Heading 
    
    var handelColordPanelAnimation = function() {
        //Number Animation        
        var currentOrder = $('#orderCount').text();
        $({numberValue: 0}).animate({numberValue: currentOrder}, {
            duration: 2500,
            easing: 'linear',
            step: function() {
                $('#orderCount').text(Math.ceil(this.numberValue));
            }
        });

        var currentVisitor = $('#visitorCount').text();
        $({numberValue: 0}).animate({numberValue: currentVisitor}, {
            duration: 2500,
            easing: 'linear',
            step: function() {
                $('#visitorCount').text(Math.ceil(this.numberValue));
            }
        });

        setInterval(function() {
            var currentNumber = $('#userCount').text();
            var randomNumber = Math.floor(Math.random() * 20) + 1;
            var newNumber = parseInt(currentNumber, 10) + parseInt(randomNumber, 10);

            $({numberValue: currentNumber}).animate({numberValue: newNumber}, {
                duration: 500,
                easing: 'linear',
                step: function() {
                    $('#userCount').text(Math.ceil(this.numberValue));
                }
            });
        }, 3000);

        setInterval(function() {
            var currentNumber = $('#visitorCount').text();
            var randomNumber = Math.floor(Math.random() * 50) + 1;
            var newNumber = parseInt(currentNumber, 10) + parseInt(randomNumber, 10);

            $({numberValue: currentNumber}).animate({numberValue: newNumber}, {
                duration: 500,
                easing: 'linear',
                step: function() {
                    $('#visitorCount').text(Math.ceil(this.numberValue));
                }
            });
        }, 5000);
    };  //  Function to handel animation in visit colord Panel
    
    var handelTrafficWidget = function() {
        //Website traffic chart				
        var init = {data: [[0, 5], [1, 8], [2, 5], [3, 8], [4, 7], [5, 9], [6, 8], [7, 8], [8, 10], [9, 12], [10, 10]],
            label: "Visitor"
        },
        options = {
            series: {
                lines: {
                    show: true,
                    fill: true,
                    fillColor: 'rgba(141,187,62,0.2)'
                },
                points: {
                    show: true,
                    radius: '4.5'
                }
            },
            grid: {
                hoverable: true,
                clickable: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "Visits : %y"
            },
            colors: ["#8dbb3e"]
        },
        plot;

        plot = $.plot($('#trafficWidget'), [init], options);

               
        $("#trafficWidget").bind("plotclick", function(event, pos, item) {
            if (item) {
                $("#clickdata").text(" - click point " + item.dataIndex + " in " + item.series.label);
                plot.highlight(item.series, item.datapoint);
            }
        });

        var animate = function() {
            $('#trafficWidget').animate({tabIndex: 0}, {
                duration: 3000,
                step: function(now, fx) {

                    var r = $.map(init.data, function(o) {
                        return [[o[0], o[1] * fx.pos]];
                    });

                    plot.setData([{data: r}]);
                    plot.draw();
                }
            });
        }

        animate();
    };  //  Function Handel Trafic Widget        

    var handleChat = function() {
        var cont = $('#chats');
        var list = $('.chats', cont);
        var form = $('.chat-form', cont);
        var input = $('input', form);
        var btn = $('.btn', form);

        var handleClick = function() {
            var text = input.val();
            if (text.length == 0) {
                return;
            }

            var time = new Date();
            var time_str = time.toString('MMM dd, yyyy HH:MM');
            var tpl = '';
            tpl += '<li class="out">';
            tpl += '<img class="avatar" alt="" src="assets/images/demo/avatar-1.jpg"/>';
            tpl += '<div class="message">';
            tpl += '<span class="arrow"></span>';
            tpl += '<a href="#" class="name">Prakasam Mathaiyan</a>&nbsp;';
            tpl += '<span class="datetime">at ' + time_str + '</span>';
            tpl += '<span class="body">';
            tpl += text;
            tpl += '</span>';
            tpl += '</div>';
            tpl += '</li>';

            var msg = list.append(tpl);
            input.val("");
            $('.scroller', cont).slimScroll({
                scrollTo: list.height()
            });
        }

        btn.click(handleClick);
        input.keypress(function (e) {
            if (e.which == 13) {
                handleClick();
                return false; //<---- Add this line
            }
        });
    };   // Function To Handel Dashboard Chat
    
    var handelTodoList = function() {
        $('.task-finish').click(function() {
            if ($(this).is(':checked')) {
                $(this).parent().parent().addClass('selected');
            }
            else {
                $(this).parent().parent().removeClass('selected');
            }
        });
        
        //Delete to do list
        $('.task-del').click(function() {
            var activeList = $(this).parent().parent();

            activeList.addClass('removed');

            setTimeout(function() {
                activeList.remove();
            }, 1000);

            return false;
        });
    };  //  Function to Handel To do list
    
    
    return {
        init: function() {
            handelMainHeader();
            handelNumberAnimation();
            handelColordPanelAnimation();
            handelTrafficWidget();
            handleChat();
            handelTodoList();
        }
        
    };
}();    // Handel Form Validation