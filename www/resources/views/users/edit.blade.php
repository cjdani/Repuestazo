@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm p-4">
                    <h2 class="mb-4 text-center">Editar Usuario</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h5 class="fw-bold">Se encontraron errores:</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="@if(Auth::user()->id === $user->id) {{ route('user.editSelf') }} @else {{ route('user.edit', $user->id) }} @endif">
                        @csrf

                        <div class="d-flex flex-column align-items-center gap-2 mb-4">
                            <div id="profile-container" class="position-relative d-inline-block">
                                <img id="profileImage" src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                     width="150" height="150" class="rounded-circle"
                                     onclick="changeClick()" style="cursor:pointer; object-fit:cover;">
                                <input id="imageUpload" type="file" name="avatar" hidden>
                            </div>
                            <small id="clickHint" class="form-text text-muted">Haz clic en la imagen para subir una foto</small>
                            <button type="button" id="revertBtn" class="btn btn-sm btn-outline-secondary d-none" onclick="revertImage()">
                                Revertir cambio
                            </button>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control"
                                   value="{{ old('email', $user->email) }}" required>
                        </div>

                        @if(Auth::user()->role === 'admin' && $user->role !== 'empleado')
                            <div class="mb-3 form-check">
                                <input type="checkbox"
                                       class="form-check-input"
                                       id="is_admin"
                                       name="is_admin"
                                       value="1"
                                    {{ $user->role === 'admin' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_admin">Hacer administrador</label>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const imageInput = document.getElementById('imageUpload');
        const profileImage = document.getElementById('profileImage');
        const clickHint = document.getElementById('clickHint');
        const revertBtn = document.getElementById('revertBtn');

        const defaultImagePath = "{{ asset('storage/' . $user->avatar) }}";

        function changeClick() {
            imageInput.click();
        }

        function fasterPreview(uploader) {
            if (uploader.files && uploader.files[0]) {
                profileImage.src = window.URL.createObjectURL(uploader.files[0]);
                clickHint.classList.add('d-none');
                revertBtn.classList.remove('d-none');
            }
        }

        function revertImage() {
            imageInput.value = '';
            profileImage.src = defaultImagePath;
            revertBtn.classList.add('d-none');
            clickHint.classList.remove('d-none');
        }

        imageInput.addEventListener('change', function () {
            fasterPreview(this);
        });
    </script>

@endsection
