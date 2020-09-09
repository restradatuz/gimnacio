<div class="card">
    <div class="card-body">
        <form action="/usuarios/nuevo-usuario/agregar" method="POST">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group">
                        <label for="nombre">Nombre(s):</label>
                        <input class="form-control @error("nombre") border-danger @enderror" type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
                        @error("nombre")
                            <p class="text-danger animated flipInX">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido(s):</label>
                        <input class="form-control @error("apellido") border-danger @enderror" type="text" name="apellido" id="apellido" value="{{ old("apellido") }}">
                        @error("apellido")
                            <p class="text-danger animated flipInX">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input class="form-control @error("email") border-danger @enderror" type="email" name="email" id="email" value="{{ old("email") }}">
                        @error("email")
                            <p class="text-danger animated flipInX">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tel">Teléfono de Contacto:</label>
                        <input class="form-control @error("tel") border-danger @enderror" type="text" name="tel" id="tel" value="{{ old("tel") }}">
                        @error("tel")
                            <p class="text-danger animated flipInX">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input class="form-control @error("password") border-danger @enderror" type="password" name="password" id="password">
                        @error("password")
                            <p class="text-danger animated flipInX">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirmar_password">Confirmar Password:</label>
                        <input class="form-control @error("confirmar_password") border-danger @enderror" type="password" name="confirmar_password" id="confirmar_password">
                        @error("confirmar_password")
                            <p class="text-danger animated flipInX">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="user_type">Tipo de Usuario</label>
                        <select class="form-control @error("user_type") border-danger @enderror" name="user_type" id="user_type">
                            <option value="">- Selecciona una opción -</option>
                            @foreach ($user_types as $t)
                                <option value="{{ $t->id }}" {{ $t->id == old("user_type") ? 'selected': ''}}> {{ $t->nombre }}</option>
                            @endforeach
                        </select>
                        @error("user_type")
                            <p class="text-danger animated flipInX">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <input type="submit" value="Crear Usuario" class="btn btn-primary btn-block">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
