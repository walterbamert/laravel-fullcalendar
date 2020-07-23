@if($include_scripts)
    @include('fullcalendar::files')
@endif

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('{{ $id }}');
        var calendar = new FullCalendar.Calendar(calendarEl,
            {!! $options !!}
        );
        calendar.render();
    });
</script>
