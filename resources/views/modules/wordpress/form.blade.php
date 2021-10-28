@extends('layouts.wordpress')



@section('content')
     <form action="https://appaboproc.com/api/contact" method="post">
        @csrf
        <input class="form-control mb-3" placeholder="E-mail" id="email" name="email" type="email">
        <input class="form-control mb-3" placeholder="Nombre" id="name" name="name" type="name">
        <input class="form-control mb-3" placeholder="Teléfono" id="name" name="phone" type="name">
        <label for="">¿En donde nos conociste?</label>
        <select class="form-control mb-3" id="origen"  name="origen"    >
            <option value="1">Instagram</option>
            <option value="2">Facebook</option>
            <option value="3">Llamadas</option>
            <option value="4">Email</option>
            <option value="5">Mensaje de texto</option>
            <option value="6">Campaña Presencial</option>
        </select>

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


<div id="success" class="alert mt-3 alert-success alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>

        <strong>Gracias por ponerte en contacto con nosotros.</strong>

</div>

    <div class="lds-ring lds"><div></div><div></div><div></div><div></div></div>
    <p id="submit" class="active btn btn-primary mt-3">Enviar</p>
@endsection

@section('scripts')
 <script>
     $('#submit').click(function(){
         console.log('sibmir')
         $('.lds').show()
         $('#submit').hide()
        fetch('api/contact', {
                method: "POST",
                body: JSON.stringify({
                    hour:$('#hora').val(),
                    day:$('#date').val(),
                    name:$('#name').val(),
                    email:$('#email').val(),
                    origen:$('#origen').val()
                }),
                headers: {"Content-type": "application/json; charset=UTF-8",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

            }).then(response => response.json())
            .then(json =>{
                //location.reload();
                console.log(json)
                if(json == 'ok'){
                    $('#success').show();

                    $('.lds').hide()
                    $('#submit').show()
                    setTimeout(location.reload.bind(location), 5000);

            }
        });
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
    #success{
        display: none;
        padding: 10px
    }
    #error{
        color: red;
        margin-top:10px;
        display: none
    }
    .active{
        display: none
    }
    .lds{
        display: none ;
    }

    .lds-ring {
  display: none;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ring div {
  box-sizing: border-box;
  display: block;
  position: absolute;
  width: 64px;
  height: 64px;
  margin: 8px;
  border: 8px solid #fff;
  border-radius: 50%;
  animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  border-color: #7988ef transparent transparent transparent
}
.lds-ring div:nth-child(1) {
  animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
  animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
  animation-delay: -0.15s;
}
@keyframes lds-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

</style>
@endsection
