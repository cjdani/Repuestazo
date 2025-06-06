@extends('layouts.app')

@section('title', 'Registro')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Registrarse</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="d-flex flex-column align-items-center gap-2 mb-4">
                                <div id="profile-container" class="position-relative d-inline-block">
                                    <img id="profileImage" src="{{ asset('storage/fotos_perfil/default.svg') }}" alt="Avatar"
                                         width="150" height="150" class="rounded-circle"
                                         onclick="changeClick()" style="cursor:pointer; object-fit:cover;">
                                    <input id="imageUpload" type="file" name="avatar" hidden>
                                </div>
                                <small class="form-text text-muted">Haz clic en la imagen para subir una foto</small>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-user-plus me-1"></i> Registrarse
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        function changeClick() {
            document.getElementById('imageUpload').click()
        }

        function fasterPreview( uploader ) {
            if ( uploader.files && uploader.files[0] ){
                document.getElementById('profileImage').src= window.URL.createObjectURL(uploader.files[0]);
            }
        }

        document.getElementById('imageUpload').addEventListener('change', function(){
            fasterPreview( this );
        })

    </script>
@endsection
