
    <div class="card">
    Agenda

    <form action="/api/contact" method="get">
        @csrf
        <input type="text" name="name">
        <input type="text" name="email">
        <input type="text" name="day">
        <input type="text" name="hour">
        <input type="submit" value="enviar">
    </form>
    </div>

@section('scripts')
    <script>

    </script>
@endsection
