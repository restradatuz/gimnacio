<form action="{{route('actualizarreglas')}}" method="POST">
     {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="dias">Dias a mostrar calendario</label>
                    <input type="text" name="dias" id="dias" class="form-control" value="{{ $reglas->dias }}">
                </div>
                <div class="form-group">
                    <label for="cantidad_gym">Cantidad de personas permitidas x horario</label>
                    <input type="text" name="cantidad_gym" id="cantidad_gym" class="form-control" value="{{ $reglas->cantidad_gym }}">
                </div>

                
            </div>
            <div class="col">

                 <div class="form-group">
                    <label for="cliente_reservacionxdia">Reservaciones cliente x dia</label>
                    <input type="text" name="cliente_reservacionxdia" id="cliente_reservacionxdia" class="form-control" value="{{ $reglas->cliente_reservacionxdia }}">
                </div>
                <div class="form-group">
                    <label for="resevaciones_permitidas">Reservaciones permitidas cliente</label>
                    <input type="text" name="resevaciones_permitidas" id="resevaciones_permitidas" class="form-control" value="{{ $reglas->resevaciones_permitidas }}">
                </div>
                <!--<div class="form-group">
                    <label for="espera">Numero de reservaciones cliente x dia</label>
                    <input type="text" name="espera" id="espera" class="form-control timepicker-tiempo" value="">
                </div>
                <div class="form-group">
                    <label for="espera-noche">Tiempo de Espera Conductor Regular Noche</label>
                    <input type="text" name="espera-noche" id="espera-noche" class="form-control timepicker-tiempo" value="">
                </div>
                <div class="form-group">
                    <label for="tarifa-dia-inicio">Horas Tarifa Día</label>
                    <div class="container">
                        <div class="row">
                            <div class="col pl-0">
                                <input type="text" name="tarifa-dia-inicio" id="tarifa-dia-inicio" class="form-control timepicker-horario" value="">
                            </div>
                            <div class="col pr-0">
                                <input type="text" name="tarifa-dia-fin" id="tarifa-dia-fin" class="form-control timepicker-horario" value="">
                            </div>
                        </div>
                    </div>
                </div>-->
               
            </div>
            <div class="col-12">
                <input type="submit" value="ACTUALIZAR REGLAS" class="btn btn-block btn-lg btn-primary">
            </div>
        </div>
    </div>
</form>
