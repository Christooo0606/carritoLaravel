@if(\Session::get("success"))
    <div class="alert alert-success">
        <p>{{ \Session::get("success") }}</p> <!-- Corregido el cierre de la etiqueta <p> -->
    </div>
@endif
