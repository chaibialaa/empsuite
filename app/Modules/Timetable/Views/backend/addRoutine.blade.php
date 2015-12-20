<script>
    $(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });
        }

        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        $('#calendar').fullCalendar({
            businessHours: {
                start: '07:00',
                end: '19:00',
                dow: [1, 2, 3, 4, 5, 6]
            },
            minTime: '07:00',
            maxTime: '19:00',
            slotDuration: '00:05:00',
            allDaySlot: false,
            defaultView: 'agendaWeek',
            columnFormat: 'dddd',
            titleFormat: 'YYYY',
            defaultTimedEventDuration: '01:00:00',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date ) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;

                copiedEventObject.backgroundColor = $(this).css("background-color");
                copiedEventObject.borderColor = $(this).css("border-color");

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // here we should do the test between duration and the max duration
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            }
        });

        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
            e.preventDefault();
            //Save color
            currColor = $(this).css("color");
            //Add color effect to button
            $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        });
        $("#add-new-event").click(function (e) {
            e.preventDefault();

            var val = $("#event option:selected").text() + ' <br>Classroom : ' + $("#classroom option:selected").text()+ ' <br><br> Prof. : ' + $("#"+$("#event option:selected").val()).val();
            if (val.length == 0) {
                return;
            }

            //Create events
            var event = $("<div />");
            event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
            event.html(val);
            $('#external-events').prepend(event);

            //Add draggable funtionality
            ini_events(event);

            //Remove event from text input
            $("#new-event").val("");
        });
    });
</script>
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-calendar"></i> Class {{ $class->title }} Timetable </h3>
            </div>
            <div class="panel-body">

                <div id='calendar'></div>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-default ">
            <div class="panel-heading">

                <h3 class="panel-title"><i class="fa fa-list"></i> Create Events</h3>

            </div>
            <div class="panel-body">
                <label>Available Modules : </label>
                <select class="form-control" name="event" id="event">
                    @foreach($feList as $m=>$value)
                        @foreach($value as $sub_value=>$element)
                            <optgroup label="{{$m}}">
                                @foreach($element as $sub_element=>$val)
                                    <option value="{{$val->subject_pc}}">{{$val->subject}}</option>
                                    <input type="hidden" value="{{$val->professor}}" id="{{$val->subject_pc}}">
                                @endforeach
                            </optgroup>
                        @endforeach
                    @endforeach
                </select>
                <label>Classroom : </label>
                <select class="form-control" name="classroom" id="classroom">
                    @foreach($classroom as $m=>$value)
                        <optgroup label="{{$m}}">
                        @foreach($value as $sub_value=>$element)
                                @foreach($element as $sub_element=>$val)
                                    <option @if ($val->st == 2) disabled @endif value="{{$val->id}}">{{$val->title}}</option>
                                @endforeach
                        @endforeach
                        </optgroup>
                    @endforeach
                </select>
                <label>Color</label>
                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                    <ul class="fc-color-picker" id="color-chooser">
                        <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a style="color:#E9967A;" href="#"><i class="fa fa-square"></i></a></li>
                    </ul>
                </div>

                        <button id="add-new-event" type="button" class="btn btn-primary btn-block">Add</button>

                    <!-- /btn-group -->

            </div>
        </div>

        <div class="panel panel-default ">
            <div class="panel-heading">

                <h3 class="panel-title"><i class="fa fa-list"></i> Events Events</h3>

            </div>
            <div class="panel-body">

                <div id="external-events">

                </div>
            </div>
        </div>
    </div>
</div>
