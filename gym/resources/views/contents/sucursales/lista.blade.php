 @if(Session::has('msg'))
            <div class="co">
            <div class="alert alert-info">
                <strong>{{Session::get('msg')}}</strong>
            </div></div>
@endif

<div class="card">
    <div class="card-body">
        <div class="form-group">
            <form method="get" action="crear-sucursal">
                        <label for=""></label>
                        <input type="submit" value="Crear Sucursal" class="btn btn-primary btn-block">
            </form>
        </div>


        </div>


    <div class="card-body">
        <table class="table table-datatable table-bordered table-bordered table-hover">
            <thead class="table-primary">
                <th class="text-center">Sucursal</th>
                <th class="text-center">Eststus</th>
            </thead>
            <tbody>
                 @foreach ($sucursales as $u)
                    <tr class="table-light table-bordered">
                        <th class="text-center">{{ strtoupper($u->nombre) }}</th>
                        
                        <th class="text-center">


                            {{ $u->nombre == 0 ?"ACTIVO": "INACTIVO" }}
                            <!--<a href="ver_horario/{{$u->id}}" class="btn btn-sm btn-primary"><i class="icon-pencil"></i></a>
                            <button class="btn btn-sm btn-danger"><i class="icon-close"></i></button>
                            <a href="eliminarsucursal/{{$u->id}}" class="btn btn-sm btn-danger"><i class="icon-close"></i></a>

                            -->
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

