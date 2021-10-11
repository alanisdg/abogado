@extends('layouts.app')

<div class="contenedor" style="margin:100px ">
      <div id='calendar'></div>
</div>


@section('content')
@endsection

@section("scripts")
<script>
  document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: '/events',
        });
        calendar.render();
      });
</script>

@endsection
