<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            businessHours:{
                start: '07:00',
                end: '19:00',
                dow: [ 1, 2, 3, 4, 5, 6 ]
            },
            minTime: '07:00',
            maxTime: '19:00',
            slotDuration: '00:05:00',
            allDaySlot: false,
            defaultView: 'agendaWeek',
            columnFormat: 'dddd',
            titleFormat:'YYYY'
        })
    });
</script>
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i>  Class {{ $class->title }} Timetable </h3>
            </div>
            <div class="panel-body">

                    <div id='calendar'></div>

            </div>
        </div>
    </div>
</div>