@extends('layouts.wordpress')



@section('content')

    <form action="https://appaboproc.com/api/contact" method="post">
        @csrf
        <input class="form-control mb-3" placeholder="E-mail" id="email" name="email" type="email">
        <input class="form-control mb-3" placeholder="Nombre" id="name" name="name" type="name">
        <input class="form-control mb-3" placeholder="Teléfono" id="name" name="phone" type="name">
        <input class="form-control mb-3" id="date" name="day" type="date">
        <select class="form-control"  name="hour"   id="hora">
            <option value="">Selecciona una hora</option>
            <option value="09:00 - 09:30">9:00 - 9:30</option>
            <option value="09:30 - 10:30">09:30 - 10:30</option>
            <option value="10:30 - 11:00">10:30 - 11:00</option>
            <option value="11:30 - 12:00">11:30 - 12:00</option>
            <option value="12:30 - 13:00">12:30 - 13:00</option>
            <option value="13:30 - 14:00">13:30 - 14:00</option>
            <option value="14:30 - 15:00">14:30 - 15:00</option>
            <option value="15:30 - 16:00">15:30 - 16:00</option>
            <option value="16:30 - 17:00">16:30 - 17:00</option>
        </select>

        <p  id="error">Esta hora esta ocupada, favor de elegir otro horario</p>
    </form>
    <p id="submit" class="active btn btn-primary mt-3">Enviar</p>
@endsection

@section('scripts')
 <script>
     $('#submit').click(function(){
         console.log('sibmir')
        fetch('api/contact', {
                method: "POST",
                body: JSON.stringify({
                    hour:$('#hora').val(),
                    day:$('#date').val(),
                    name:$('#name').val(),
                    email:$('#email').val()
                }),
                headers: {"Content-type": "application/json; charset=UTF-8",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

            }).then(response => response.json())
            .then(json =>{
                location.reload();
                console.log(json)
            }
            );
     })
    $('#hora').change( function(){
        let hora = $('#hora').val().split('-');

        fetch('/getDates?date='+$('#date').val() + '&hora='+hora[0], {
                method: "GET",
                headers: {"Content-type": "application/json; charset=UTF-8",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

            }).then(response => response.json())
            .then(json =>{
                if(json > 1){
                    $('#error').show()
                    $('.active').hide()
                }else{
                    $('#error').hide()
                    $('.active').show()
                }
                console.log(json)
            }
            );
    });

</script>
<style>
    #error{
        color: red;
        margin-top:10px;
        display: none
    }
    .active{
        display: none
    }
</style>
@endsection
