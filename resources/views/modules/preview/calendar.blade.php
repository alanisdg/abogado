@extends('layouts.calendar')
<style>
.fc-daygrid-event-harness {
    margin-bottom: 12px;
    margin: 7px;
    padding: 2px;
    border-radius: 7px;
    border: 1px solid #d1d8e0;
}
</style>
<div class="contenedor" style="margin:100px ">
    <div class="row">
        <div class="col-md-3 mb-3">
            <form action="/calendar" method="get">
                <input type="text" name="search" placeholder="Escribe un criterio de busqueda" class="form-control">
                <input class="btn btn-primary btn-sm mt-1" type="submit" value="Buscar">
            </form>
            <a href="/calendar" class="btn btn-secondary btn-sm mt-1" type="submit"  >Borrar Filtros </a>
        </div>
    </div>
        @if ($error != false)
            {{ $error }}
        @endif
      <div id='calendar'></div>
</div>

<div class="modal" id="exampleModal"  tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-body">
          <div id="dia"></div>
            <div id="elevent2"></div>
        </div>

        <!--Este es el pie del modal aqui puedes agregar mas botones-->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@section('content')
@endsection

@section("scripts")
<script>
  document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: '/events?search={{$search}}',
          initialDate: '{{$date}}',
          dateClick: function(info ) {
                console.log(info)
              $('#dia').html(info.dateStr)
              $('#elevent2').html(info.dayEl.innerText)
              $("#exampleModal").modal();
  		    }
        });
        calendar.render();
      });

 </script>

@endsection
