<div class="card">
    <br>
    <br>
    <div class="card-body">
         <form action="{{route('buscarreservaciones')}}" method="POST">
            {{ csrf_field() }}
        <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group">
                        <label for="user_type">Elige un horario</label>
                        <select class="form-control" name="reservacion" id="reservacion">
                            <option value="">- Selecciona una opción -</option>
                            @foreach ($horario as $t)
                                <option value="{{ $t->id }}" > {{ $t->horario }}</option>
                            @endforeach
                        </select>
                        
                    </div>

                </div>
                <div class="col-sm-12 col-lg-6">
                    
                    <div class="form-group">
                        <label for=""></label>
                        <input type="submit" value="Buscar" class="btn btn-primary btn-block">
                    </div>
                </div>
        </div>
        </form>

        <table class="table table-datatable table-bordered table-bordered table-hover">
            <thead class="table-primary">
                <th class="text-center">Nombre cliente</th>
                <th class="text-center">Email</th>
                <th class="text-center">Tel. Contacto</th>
                <th class="text-center">Horario</th>
                <th class="text-center">instructor</th>
            </thead>
            <tbody>
                @if($reservaciones != false)
                     @foreach ($reservaciones as $u)
                        <tr class="table-light table-bordered">
                            <th class="text-center">{{ $u->promotor->nombre }} {{$u->promotor->apellido }}</th>
                            <th class="text-center">{{ $u->promotor->email }} </th>
                            <th class="text-center">{{$u->promotor->tel}}</th>
                            <th class="text-center">{{$u->horario}}</th>
                            <th class="text-center">{{$u->intructor}}</th>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

