<div class="card">
    <div class="card-body">
        <table class="table table-datatable table-bordered table-bordered table-hover">
            <thead class="table-primary">
                <th class="text-center">Cliente</th>
                <th class="text-center">Email</th>
                <th class="text-center">Tel. Contacto</th>
                <th class="text-center">Tipo de Usuario</th>
                <th class="text-center">Sucursal</th>
                <th class="text-center">Acciones</th>
            </thead>
            <tbody>
                @foreach ($usuarios as $u)
                    <tr class="table-light table-bordered">
                        <th class="text-center">{{ $u->nombre." ".$u->apellido }}</th>
                        
                        <th class="text-center">{{ $u->email }}</th>
                        <th class="text-center">{{ $u->tel }}</th>
                        <th class="text-center">{{ ucfirst(strtolower($u->tipousuario->nombre)) }}</th>
                        <th class="text-center">{{  $u->user_type == 1 ? "": $u->nombresucursal->nombre   }}</th>
                        <th class="text-center">
                            <a href="usuario/{{$u->id}}" class="btn btn-sm btn-primary"><i class="icon-pencil"></i></a>
                            <a href="eliminarusuario/{{$u->id}}" class="btn btn-sm btn-danger"><i class="icon-close"></i></a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

