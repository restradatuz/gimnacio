<div class="card">
    <div class="card-body">
        <form action="{{ url ('agregar-usuario')}}" method="POST">
            {{ csrf_field() }}
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
                    <div class="form-group">

                         <label for="password">Password:</label>
                        <input class="form-control @error("password") border-danger @enderror" type="password" name="password" id="password">
                        @error("password")
                            <p class="text-danger animated flipInX">{{ $message }}</p>
                        @enderror
                        


                    </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group">


                        <label for="confirmar_password">Confirmar Password:</label>
                        <input class="form-control @error("confirmar_password") border-danger @enderror" type="password" name="confirmar_password" id="confirmar_password">
                        @error("confirmar_password")
                            <p class="text-danger animated flipInX">{{ $message }}</p>
                        @enderror
                       


                    </div>
                    <div class="form-group">
                        <label for="sucursal">Selecciona la sucursal</label>
                        <select class="form-control @error("sucursal") border-danger @enderror" name="sucursal" id="sucursal" required="">
                            @if(Auth::user()->user_type == 3)

                            <option value="{{ Auth::user()->id_sucursal }}" selected=""> {{ Auth::user()->nombresucursal->nombre }}</option>

                            @endif
                        </select>
                        @error("sucursal")
                            <p class="text-danger animated flipInX">{{ $message }}</p>
                        @enderror
                        
                    </div>
                    <div class="form-group">
                        <label for="user_type">Tipo de Usuario</label>
                        <select class="form-control @error("user_type") border-danger @enderror" name="user_type" id="user_type">
                            <option value="">- Selecciona una opción -</option>
                            @foreach ($user_types as $t)

                                @if(Auth::user()->user_type == 3)

                                        @if($t->id == 2)

                                         <option value="{{ $t->id }}" {{ $t->id == old("user_type") ? 'selected': ''}}> {{ $t->nombre }}</option>
                                        @endif

                                @else

                                <option value="{{ $t->id }}" {{ $t->id == old("user_type") ? 'selected': ''}}> {{ $t->nombre }}</option>

                                @endif
                            @endforeach
                        </select>
                        @error("user_type")
                            <p class="text-danger animated flipInX">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="mensualidad">Mensualidad</label>
                        <select class="form-control @error("mensualidad") border-danger @enderror" name="mensualidad" id="mensualidad" required="">
                            <option value="">- Selecciona una opción -</option>
                                <option value="1"> 1 mes</option>
                                <option value="2"> 2 meses</option>
                                <option value="3"> 3 meses</option>
                                <option value="4"> 4 meses</option>
                                <option value="5"> 5 meses</option>
                                <option value="6"> 6 meses</option>
                                <option value="7"> 7 meses</option>
                                <option value="8"> 8 meses</option>
                                <option value="9"> 9 meses</option>
                                <option value="10"> 10 meses</option>
                                <option value="11"> 11 meses</option>
                                <option value="12"> 12 meses</option>
                        </select>
                        @error("mensualidad")
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
