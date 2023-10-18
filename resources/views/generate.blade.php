@extends('layouts.app')

@push('includes')
    
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Formulario para generacion de URl</h2>
                <p class="text-danger">Los campos marcados con un asterisco (*) son requeridos.</p>
                <form id="urlForm" action="{{route('upload')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                            <div class="invalid-feedback" id="nombreErrorMessage">
                                @if ($errors->has('nombre'))
                                    {{ $errors->first('nombre') }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="apellidos" class="form-label">Apellidos <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
                            <div class="invalid-feedback" id="apellidosErrorMessage">
                                @if ($errors->has('apellidos'))
                                    {{ $errors->first('apellidos') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 mb-3">
                        <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                        <div><small>Solo digitos y minimo 10 digitos. Ejemplo: 573202919054</small></div>
                        <input type="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" pattern="[0-9]{10,}" value="{{ old('telefono') }}" required>
                        <div class="invalid-feedback" id="telefonoErrorMessage">
                            @if ($errors->has('telefono'))
                                {{ $errors->first('telefono') }}
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 col-12 mb-3">
                        <label for="correo" class "form-label">Correo electrónico <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo" value="{{ old('correo') }}" required>
                        <div class="invalid-feedback" id="emailErrorMessage">
                            @if ($errors->has('correo'))
                                {{ $errors->first('correo') }}
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 col-12 mb-3">
                        <label for="imagen" class="form-label">Subir imagen <span class="text-danger">*</span></label>
                        <div><small>Imagen (.jpg, .jpeg, .png, .gif) y de no mas de {{$maxUploadSize}}MB.</small></div>
                        <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" accept="image/*" required>
                        <div class="invalid-feedback" id="imagenErrorMessage">
                            @if ($errors->has('imagen'))
                                {{ $errors->first('imagen') }}
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Generar</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        document.getElementById('urlForm').addEventListener('submit', function(event) {
            let nombreInput = document.getElementById('nombre');
            let apellidosInput = document.getElementById('apellidos');
            let telefonoInput = document.getElementById('telefono');
            let emailInput = document.getElementById('correo');
            let imagenInput = document.getElementById('imagen');
            let telefonoPattern = /^[0-9]{10,}$/;
            let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            let invalid = false;

            if (nombreInput.value.trim() === '') {
                nombreInput.classList.add('is-invalid');
                invalid = true;
                document.getElementById('nombreErrorMessage').textContent = 'El campo Nombre es obligatorio.';
            } else {
                document.getElementById('nombreErrorMessage').textContent = '';
                nombreInput.classList.remove('is-invalid');
            }

            if (apellidosInput.value.trim() === '') {
                apellidosInput.classList.add('is-invalid');
                invalid = true;
                document.getElementById('nombreErrorMessage').textContent = 'El campo Apellidos es obligatorio.';
            } else {
                document.getElementById('apellidosErrorMessage').textContent = '';
                nombreInput.classList.remove('is-invalid');
            }

            if (!telefonoPattern.test(telefonoInput.value)) {
                telefonoInput.classList.add('is-invalid');
                invalid = true;
                document.getElementById('telefonoErrorMessage').textContent = 'El numero de telefono debe contener solo digitos y minimo 10 digitos.';
            } else {
                document.getElementById('telefonoErrorMessage').textContent = '';
                nombreInput.classList.remove('is-invalid');
            }

            if (emailInput.value.trim() === '' || !isValidEmail(emailInput.value)) {
                emailInput.classList.add('is-invalid');
                invalid = true;
                document.getElementById('emailErrorMessage').textContent = 'El correo debe ser valido.';
            } else {
                document.getElementById('emailErrorMessage').textContent = '';
                nombreInput.classList.remove('is-invalid');
            }

            if (isValidImage(imagenInput.files, allowedExtensions)) {
                imagenInput.classList.add('is-invalid');
                document.getElementById('imagenErrorMessage').textContent = 'La imagen debe ser valida (.jpg, .jpeg, .png, .gif) y de no mas de {{$maxUploadSize}}MB.';
                invalid = true;
            } else {
                document.getElementById('imagenErrorMessage').textContent = '';
                imagenInput.classList.remove('is-invalid');
            }

            if (invalid) {
                event.preventDefault();
            }
        });

        // Función para validar el formato de correo electrónico
        function isValidEmail(email) {
            var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(email);
        }

        function isValidImage(imageCtr, allowedExtensions) {
            return imageCtr.length <= 0 || (imageCtr.length > 0 && (imageCtr[0].size > {{$maxUploadSize}} * 1024 * 1024 || !allowedExtensions.test(imageCtr[0].name)))
        }
    </script>
@endpush