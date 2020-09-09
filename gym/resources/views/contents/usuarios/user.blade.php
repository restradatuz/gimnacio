<div class="card">
    <div class="card-body">
        {{-- Pills --}}
        <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-user-tab" data-toggle="pill" href="#pills-user" role="tab" aria-controls="pills-user" aria-selected="true">
                <i class="fa fa-user"></i> Usuario</a>
            </li>
            
        </ul>

        {{-- Divs --}}
        <div class="tab-content mt-5" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
            <form action="{{route('actualizar_usuario')}}" method="POST">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="nombre">Nombre(s):</label>
                                <input class="form-control @error("nombre") border-danger @enderror" type="text" name="nombre" id="nombre" value="{{ !empty(old('nombre')) ? old('nombre') : $user->nombre }}">
                                @error("nombre")
                                    <p class="text-danger animated flipInX">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido(s):</label>
                                <input class="form-control @error("apellido") border-danger @enderror" type="text" name="apellido" id="apellido" value="{{ !empty(old("apellido")) ? old("apellido") : $user->apellido }}">
                                @error("apellido")
                                    <p class="text-danger animated flipInX">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input class="form-control @error("email") border-danger @enderror" type="email" name="email" id="email" value="{{ !empty(old("email")) ? old("email") : $user->email }}">
                                @error("email")
                                    <p class="text-danger animated flipInX">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tel">Teléfono de Contacto:</label>
                                <input class="form-control @error("tel") border-danger @enderror" type="text" name="tel" id="tel" value="{{ !empty(old("tel")) ? old("tel") : $user->tel }}">
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
                                     @if(Auth::user()->user_type == 4)

                                        @if($t->id == 1)
                                        @else
                                        <option value="{{ $t->id }}" {{ !empty(old("user_type")) ? ($t->id == old("user_type") ? 'selected' : '') : $t->id == $user->user_type ? 'selected' : ''  }}> {{ $t->nombre }}</option>
                                        @endif

                                     @else  

                                      
                                        <option value="{{ $t->id }}" {{ !empty(old("user_type")) ? ($t->id == old("user_type") ? 'selected' : '') : $t->id == $user->user_type ? 'selected' : ''  }}> {{ $t->nombre }}</option>
                                        

                                     @endif
                                    @endforeach

                                       

                                    

                                       
                                    
                                </select>
                                @error("user_type")
                                    <p class="text-danger animated flipInX">{{ $message }}</p>
                                @enderror
                            </div>
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="form-group">
                                <input type="submit" value="Actualizar Usuario" class="btn btn-primary btn-block">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
