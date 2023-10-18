@extends('layouts.app')

@push('includes')
    
@endpush

@section('content')

    <div class="container mt-5">
        <h1 class="mb-4">Url Generada</h1>

        <form>
            <div class="form-group d-flex align-items-center">
                <label for="url" class="my-2">URL Perfil:</label>
                <textarea class="form-control py-2" id="currentUrl" readonly>{{ $url }}</textarea>
                <button type="button" class="btn btn-primary ml-2" id="copiarUrl">
                    <i class="fas fa-copy"></i>
                </button>
            </div>

            <button type="button" class="btn btn-primary my-5" id="redirigir">Redirigir</button>
        </form>

        <div id="countdown" class="text-warning">
            Redirigiendo en <span id="countdown-number"></span> segundos...
        </div>
    </div>

@endsection

@push('js')
    
<script>
    let duration = 60;
    function redirigir() {
        let url = '{!! $url !!}';
        if (url) {
            window.location.href = url;
        }
    }

    function iniciarCuentaRegresiva() {
        let countdown = document.getElementById('countdown-number');
        let tiempoRestante = duration;
        let interval = setInterval(function() {
            tiempoRestante--;
            countdown.textContent = tiempoRestante;
            if (tiempoRestante <= 0) {
                clearInterval(interval);
                redirigir();
            }
        }, 1000);
    }

    function copiarURL() {
        let currentUrl = document.getElementById('currentUrl');
        currentUrl.select();
        document.execCommand('copy');
    }

    document.getElementById('countdown-number').textContent = duration;
    document.getElementById('redirigir').addEventListener('click', redirigir);
    document.getElementById('copiarUrl').addEventListener('click', copiarURL);
    iniciarCuentaRegresiva();

</script>

@endpush