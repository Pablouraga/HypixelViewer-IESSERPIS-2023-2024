//Mostramos variable de sesion

@if (session('username'))
    <div class="alert alert-success">
        {{ session('username') }}
        {{ session('uuid') }}

    </div>
@endif
