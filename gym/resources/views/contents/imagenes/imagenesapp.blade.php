<div class="card">
    <div class="card-body">
        {{-- Pills --}}
        <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
            
            <li class="nav-item">
                <a class="nav-link active" id="pills-docs-tab" data-toggle="pill" href="#pills-docs" role="tab" aria-controls="pills-docs" aria-selected="false">
                <i class="fa fa-briefcase"></i>Subir Imagenes</a>
            </li>
            
        </ul>

        {{-- Divs --}}
        <div class="tab-content mt-5" id="pills-tabContent">
            
            <div class="tab-pane fade show active" id="pills-docs" role="tabpanel" aria-labelledby="pills-docs-tab">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <table class="table">
                                <thead>
                                    <th>Nombre</th>
                                    <th>ver</th>
                                    <th>Eliminar</th>
                                </thead>
                                <tbody>
                                    @foreach ($imagen as $f)
                                        @if($f->estatus === 1)

                                        <tr>
                                            <td>{{  ($f->estatus === 1 ? $f->nombre : "") }}</td>
                                            <td>
                                                <a href="{{ asset('imgapp2/'.basename($f->nombre)) }}" target='_blank'>
                                                    <button type="button" class="btn btn-sm btn-success btn-icon-text">
                                                        <i class="icon-cloud-download btn-icon-prepend"></i>Ver
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="eliminar/{{$f->id}}" target='_blank'>
                                                    <button type="button" class="btn btn-sm btn-danger btn-icon-text">
                                                        <i class="icon-cloud-download btn-icon-prepend"></i>eliminar
                                                    </button>
                                                </a>
                                                
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <form action="subir_archivosApp" enctype="multipart/form-data" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Imagen 1</label>
                                    <input type="file" name="imagen1" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Seleccionar Archivo">
                                        <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Subir Archivo</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Iamegen 2</label>
                                    <input type="file" name="imagen2" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Seleccionar Archivo">
                                        <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Subir Archivo</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Imagen 3</label>
                                    <input type="file" name="imagen3" class="file-upload-default">
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
           
        </div>
    </div>
</div>
