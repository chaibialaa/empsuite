
<style>
    .fc-time-grid .fc-slats td {
        height: 0.8em;
    }
</style>
<script>


    function verifyClassroom(event) {

        var start = new Date(event.start._d - 3599000).toLocaleTimeString();
        var classroom = event.classroom;
        var end = new Date(event.end - 3601000).toLocaleTimeString();
        var dayFull = event.start.toLocaleString();

        $.ajax({
            url: "/admin/timetable/verifyC",
            headers: {
                'X-CSRF-TOKEN': $('#crsf').val()
            },
            type: "GET",
            contentType: "application/json",
            data: {"start": start, "end": end, "classroom": classroom, "date": dayFull,"type":2,"iii":{{ $iii  }}},
            dataType: "json",
            success: function (response) {
                if (response['state'] === 0)
                    toastr.error('The classroom is already used in same chosen time by class '+ response['class']);
            },
            error: function (e) {
                console.log(e.responseText);
            }

        });


    }

    $(function () {

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
        var date = new Date();
        $('#calendar').fullCalendar({
            eventSources: [
                {
                    events: [
                            @foreach ($iniEvents as $i)
                            {
                            title  : '{{$i->subject}} \n Classroom : {{$i->classroom}}',
                            start  : '{{$i->date}}T{{$i->startTime}}',
                            end  : '{{$i->date}}T{{$i->endTime}}',
                            backgroundColor : '{{$i->color}}',
                            borderColor : '{{$i->color}}',
                            spc : '{{$i->spc}}',
                            classroom : '{{$i->classid}}'
                        },@endforeach

                        ]
                }
            ],
            businessHours: {
                start: '07:00',
                end: '19:00',
                dow: [1, 2, 3, 4, 5, 6]
            },
            slotLabelInterval : '01:00,00',
            minTime: '07:00',
            maxTime: '19:00',
            hiddenDays: [0],
            slotDuration: '00:05:00',
            allDaySlot: false,
            defaultView: 'agendaWeek',
            columnFormat: 'dddd',
            titleFormat: 'DD MMMM YYYY ',
            timezone: false,
            axisFormat: 'HH:mm',
            timeFormat: 'HH:mm',
            defaultTimedEventDuration: '01:00:00',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true,
            eventConstraint: {
                start: '07:00',
                end: '19:00'
            },
            eventResize: function (event, delta, revertFunc) {
                if ((new Date(event.end) - new Date(event.start)) < 900000){
                    revertFunc();
                    toastr.error('A subject exam can not be less than 15 Minutes')}
                else {
                    verifyClassroom(event);
                }

            },
            eventDrop: function (calEvent) {

                verifyClassroom(calEvent);

            },
            eventClick: function(calEvent) {
                $('#calendar').fullCalendar('removeEvents', function (event) {
                    return event == calEvent;
                });

            },
            drop: function (date) {

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.end = date + 3600000;
                copiedEventObject.spc = $(this).attr('subject_pc');
                copiedEventObject.classroom = $(this).attr('classroom');
                copiedEventObject.backgroundColor = $(this).css("background-color");
                copiedEventObject.borderColor = $(this).css("background-color");

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                verifyClassroom(copiedEventObject);

                // here we should do the test between duration and the max duration
                if ($('#drop-remove').is(':checked')) {
                    $(this).remove();
                }

            }
        });
        $("#printTimetable").click(function (e) {

            $("#calendar").print({
                mediaPrint : true,
                stylesheet : '{{ asset("/assets/libraries/fullcalendar/fullcalendar.print.css")}}',
                timeout: 0
            });


        });

        $("#saveTimetable").click(function (e) {

            var events = $('#calendar').fullCalendar('clientEvents');
            var fE = [];
            $.each(events, function (key, value) {
                fE.push({


                    bg: value.backgroundColor,
                    classroom: value.classroom,
                    spc: value.spc,
                    start: new Date(value.start._d - 3600000),
                    end: new Date(value.end._d - 3600000)
                });
            });

            $.ajax({
                url: "/admin/timetable/update",
                headers: {
                    'X-CSRF-TOKEN': $('#crsf').val()
                },
                type: "GET",

                contentType: "application/json",
                data: {"events": fE,"classid":{{ $class->id  }},"type":2,"iii":{{ $iii  }}},
                dataType: "json",
                success: function (response) {
                    if (response['state'] === 5){
                        toastr.success('Timetable updated');
                        setTimeout(function(){
                            window.location.href = "/admin/timetable"; }, 2000);}
                    if (response['state'] === 9){
                        toastr.warning('Timetable is empty');}
                },
                error: function (e) {
                    console.log(e.responseText);
                }

            });
        });
        var currColor = "#3c8dbc";
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
            e.preventDefault();
            currColor = $(this).css("color");
            $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        });
        $("#add-new-event").click(function (e) {
            e.preventDefault();

            var val = $("#event option:selected").text() + ' <br>\n Classroom : ' + $("#classroom option:selected").text();
            if (val.length == 0) {
                return;
            }

            //Create events
            var event = $("<div />");
            event.css({
                "background-color": currColor,
                "border-color": currColor,
                "color": "#fff"
            }).addClass("external-event");
            event.attr('subject_pc', $("#event option:selected").val());
            event.attr('classroom', $("#classroom option:selected").val());

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
                <h3 class="panel-title"><i class="fa fa-calendar"></i> Class {{ $class->title }} Exams </h3>
            </div>
            <div class="panel-body">

                <div id='calendar'></div>

            </div>
        </div>
    </div>

    <div class="col-md-3">

        <input type="button" id="saveTimetable" class="btn btn-primary btn-block" value="Update Timetable">
        <input type="button" id="printTimetable" class="btn btn-primary btn-block" value="Print & Export">
        <br>

        <div class="panel panel-default ">
            <div class="panel-heading">

                <h3 class="panel-title"><i class="fa fa-list"></i> Create Events</h3>

            </div>
            <div class="panel-body">
                <form>
                    <label>Available Subjects : </label>
                    <input type="hidden" value="{!! csrf_token() !!}" id="crsf">
                    <select class="form-control" name="event" id="event">
                        @foreach($feList as $m=>$value)
                            @foreach($value as $sub_value=>$element)
                                <optgroup label="Module : {{$m}}">
                                    @foreach($element as $sub_element=>$val)
                                        <option value="{{$val->subject_pc}}">{{$val->subject}}</option>

                                        <input type="hidden" name="duration" value="{{$val->duration}}" id="{{$val->subject_pc}}">
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
                                        <option @if ($val->st == 2) disabled
                                                @endif value="{{$val->id}}">{{$val->title}}</option>
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

                    <button id="add-new-event" type="button" class="btn btn-primary btn-block">Create</button>

                    <!-- /btn-group -->
                </form>
            </div>
        </div>

        <div class="panel panel-default ">
            <div class="panel-heading">

                <h3 class="panel-title"><i class="fa fa-list"></i> Events List</h3>

            </div>
            <div class="panel-body">

                <div id="external-events">

                </div>
            </div>
        </div>
    </div>
</div>
