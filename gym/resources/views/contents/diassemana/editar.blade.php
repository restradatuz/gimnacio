<div class="card">
    <div class="card-body">
        <form action="{{route('guardarhorarioelegir')}}" method="POST">
            {{ csrf_field() }}
            <div class="row">

                <div class="col-sm-12 col-lg-12">
                    <div class="form-group">
                        <br>
                        <br>
                        <H2>{{$dia}}</h2>
                        
                    </div>


                    <div class="row">
                        <div class="col-sm-12 col-lg-5">
                            <div class="form-group">
                            <label for="password">Horarios a elegir:</label>
                                <select class="form-control" name="horario" id="horario">
                                <option value="">- Selecciona una opción -</option>
                                    @foreach ($horario as $t)
                                        <option value="{{ $t->id }}" > {{ $t->nombre_horario }}</option>
                                    @endforeach
                                </select>
                             
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-5">
                             
                        </div>

                        
                    </div>

                    <input type="hidden" name="idhorario" id="idhorario" value="{{$idhorario}}">


                        
                       


                    <div class="form-group">
                        <label for=""></label>
                        <input type="submit" value="Guardar horario" class="btn btn-primary btn-block">
                    </div>
                    
                </div>
                
            </div>
        </form>
    </div>
</div>