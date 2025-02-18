<!-- resources/views/profile/partials/profile.blade.php -->
<div>
    <h5>Mis datos</h5>
    <form id="datosForm" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="last_name" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                @error('last_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row g-3 mt-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="phone_number" class="form-label">Teléfono</label>
                <div class="input-group">
                    <span class="input-group-text">+34</span>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                    @error('phone_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row g-3 mt-3">
            <div class="col-md-6">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="••••••">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="••••••">
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
</div>
