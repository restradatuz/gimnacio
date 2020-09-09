<div class="card">
    <div class="card-body">
        {{-- Pills --}}
        <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-user-tab" data-toggle="pill" href="#pills-user" role="tab" aria-controls="pills-user" aria-selected="true">
                <i class="fa fa-user"></i> Usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-docs-tab" data-toggle="pill" href="#pills-docs" role="tab" aria-controls="pills-docs" aria-selected="false">
                <i class="fa fa-briefcase"></i> Documentación</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-car-tab" data-toggle="pill" href="#pills-car" role="tab" aria-controls="pills-car" aria-selected="false">
                <i class="fa fa-car"></i> Vehículo </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-paymets-tab" data-toggle="pill" href="#pills-paymets" role="tab" aria-controls="pills-payments" aria-selected="false">
                <i class="fa fa-credit-card"></i> Pagos </a>
            </li>
        </ul>

        {{-- Divs --}}
        <div class="tab-content mt-5" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
            <form action="/usuarios/{{ $user->id }}/actualizar" method="POST">
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
                                        <option value="{{ $t->id }}" {{ !empty(old("user_type")) ? ($t->id == old("user_type") ? 'selected' : '') : $t->id == $user->user_type ? 'selected' : ''  }}> {{ $t->nombre }}</option>
                                    @endforeach
                                </select>
                                @error("user_type")
                                    <p class="text-danger animated flipInX">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Actualizar Usuario" class="btn btn-primary btn-block">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-docs" role="tabpanel" aria-labelledby="pills-docs-tab">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <table class="table">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Peso</th>
                                    <th>Descargar</th>
                                </thead>
                                <tbody>
                                    @foreach (Storage::files('public/'.$user->id) as $f)
                                        <tr>
                                            <td>{{ basename($f) }}</td>
                                            <td>{{ number_format(Storage::size($f) / 1000000, 2, '.', ',' ) ." MB" }}</td>
                                            {{-- <td>{{ date('d-m-Y', strtotime(Storage::lastModified($f))) }}</td> --}}
                                            <td>
                                                <a href="{{ asset('storage/'.$user->id.'/'.basename($f)) }}" target='_blank'>
                                                    <button type="button" class="btn btn-sm btn-danger btn-icon-text">
                                                        <i class="icon-cloud-download btn-icon-prepend"></i> Descargar
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <form action="/subir_archivos/{{ $user->id }}" enctype="multipart/form-data" method="POST">
                                <div class="form-group">
                                    <label>INE Frente</label>
                                    <input type="file" name="ine_frente" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Seleccionar Archivo">
                                        <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Subir Archivo</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>INE Reverso</label>
                                    <input type="file" name="ine_reverso" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Seleccionar Archivo">
                                        <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Subir Archivo</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Licencia</label>
                                    <input type="file" name="licencia" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Seleccionar Archivo">
                                        <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Subir Archivo</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Carta Antecedentes no Penales</label>
                                    <input type="file" name="carta_antecedentes" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Seleccionar Archivo">
                                        <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Subir Archivo</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Póliza de Seguro</label>
                                    <input type="file" name="poliza" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Seleccionar Archivo">
                                        <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Subir Archivo</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Comprobante de Domicilio</label>
                                    <input type="file" name="comprobante_domicilio" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Seleccionar Archivo">
                                        <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Subir Archivo</button>
                                        </span>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block" > <i class="icon-cloud-upload"></i>&nbsp;Procesar Archivos</button>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    (function($) {
                        'use strict';
                        $(function() {
                            $('.file-upload-browse').on('click', function() {
                            var file = $(this).parent().parent().parent().find('.file-upload-default');
                            file.trigger('click');
                            });
                            $('.file-upload-default').on('change', function() {
                            $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
                            });
                        });
                    })(jQuery);
                </script>
            </div>
            <div class="tab-pane fade" id="pills-car" role="tabpanel" aria-labelledby="pills-car-tab">
                <h2>Datos del Vehículo</h2>
                <h4>(Solo Conductores)</h4>
            </div>
            <div class="tab-pane fade" id="pills-paymets" role="tabpanel" aria-labelledby="pills-paymets-tab">
                <h2>Historial de Pagos</h2>
                <h4>(Solo Conductores)</h4>
            </div>
        </div>
    </div>
</div>
