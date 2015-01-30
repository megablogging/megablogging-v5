var GeneralCalendar = function() {

    var handlecalenderGeneral = function() {

        /* initialize the calendar */
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();


        var calendar = $('#calendarGen').fullCalendar({
            buttonText: {
                prev: '<i class="fa fa-step-backward"></i>',
                next: '<i class="fa fa-step-forward"></i>'
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: [{
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    backgroundColor: '#627586',
                    borderColor: '#627586',
                    textColor: '#ffffff'
                }, {
                    title: 'Long Event',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2),
                    backgroundColor: '#ed511b',
                    borderColor: '#ed511b',
                    textColor: '#ffffff'
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d - 3, 16, 0),
                    allDay: false,
                    backgroundColor: '#a000fc',
                    borderColor: '#a000fc',
                    textColor: '#ffffff'
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d + 4, 16, 0),
                    allDay: false,
                    backgroundColor: '#6500fc',
                    borderColor: '#6500fc',
                    textColor: '#ffffff'
                }, {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false,
                    backgroundColor: '#00a6fc',
                    borderColor: '#00a6fc',
                    textColor: '#ffffff'
                }, {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false,
                    backgroundColor: '#56d1a4',
                    borderColor: '#56d1a4',
                    textColor: '#ffffff'
                }, {
                    title: 'Birthday Party',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false,
                    backgroundColor: '#a1c277',
                    borderColor: '#a1c277',
                    textColor: '#ffffff'
                }, {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/',
                    backgroundColor: '#ffc000',
                    borderColor: '#ffc000',
                    textColor: '#ffffff'
                }]
            ,
            editable: true,            
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {

                bootbox.prompt("New Event Title", function(title) {
                    if (title !== null) {
                        calendar.fullCalendar('renderEvent', {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            },
                            true // make the event "stick"
                        );
                    }
                });

                calendar.fullCalendar('unselect');
            },
            
            eventClick: function(calEvent, jsEvent, view) {

                var form = $("<form class='form-inline'><label>Change event name &nbsp;</label></form>");                
                form.append("<input class='editEvent form-control' autocomplete=off type='text' value='" + calEvent.title + "' /> ");
                form.append("<button type='submit' class='btn btn-sm btn-success'><i class='fs-checkmark-2'></i> Save</button>");

                var div = bootbox.dialog({
                    message: form,
                    buttons: {
                        "delete": {
                            "label": "<i class='icon-trash'></i> Delete Event",
                            "className": "btn-sm btn-danger",
                            "callback": function() {
                                calendar.fullCalendar('removeEvents', function(ev) {
                                    return (ev._id == calEvent._id);
                                })
                            }
                        },
                        "close": {
                            "label": "<i class='fs-close-3'></i> Close",
                            "className": "btn-sm"
                        }
                    }

                });

                form.on('submit', function() {
                    calEvent.title = form.find("input[type=text]").val();
                    calendar.fullCalendar('updateEvent', calEvent);
                    div.modal("hide");
                    return false;
                });
            }

        });
        
        $('.fc-button').removeClass('fc-state-default');
        $('.fc-button-prev').addClass("btn btn-info");
        $('.fc-button-next').addClass("btn btn-info");
        $('.fc-button-today').addClass("btn disabled");
        

    };  // Calendar General

    return {        
        init: function() {
            handlecalenderGeneral();
        }
              
    };
}();

var DraggableCalendar = function() {

    var handlecalenderDraggable = function() {

        /* initialize the external events   */

        $('#external-events div.external-event').each(function() {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });


        /* initialize the calendar  */

        $('#calendarDrag').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendarDrag').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            }
        });
        
        $('.fc-button').removeClass('fc-state-default');
        $('.fc-button-prev').addClass("btn btn-info");
        $('.fc-button-next').addClass("btn btn-info");
        $('.fc-button-today').addClass("btn disabled");
        
    };  // Calendar General

    return {        
        init: function() {
            handlecalenderDraggable();
        }
              
    };
}();
