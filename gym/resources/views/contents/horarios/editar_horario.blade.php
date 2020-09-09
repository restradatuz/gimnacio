<div class="card">
    <div class="card-body">
        <form action="" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="form-group">
                        <label for="nombre">Nombre horario:</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" value="{{$nombre_horario}}" required="">
                        @error("nombre")
                            <p class="text-danger animated flipInX"></p>
                        @enderror
                    </div>

                    <div class="form-group">
                    <h4 class="m-3">Agregar horario
                        <a href="#" id="creaImpresora" data-toggle="tooltip" title="Agregar impresora"><i class="fa fa-plus-circle"></i></a>
                    </h4>
                    </div>

                     @foreach ($horarios as $u)

                    <div class="row">
                        <div class="col-sm-12 col-lg-5">
                            <div class="form-group">
                            <label for="password">Horario inicial:</label>
                            <input class="form-control timepicker-horario" type="text"  required="" value="{{$u->horario}}">
                             
                            </div>
                        </div>

                       

                        <div class="col-sm-12 col-lg-2">
                            <div class="form-group">
                            <label for="password">Consecutivo:</label>
                            <input class="form-control" type="number" value="{{$u->consecutivo}}">  
                            </div>   
                        </div>

                        <div class="col-sm-12 col-lg-5">
                            <div class="form-group">
                             
                            <a href="actualizarhorario/{{$u->id}}/{{$u->horario}}/{{$u->consecutivo}}" class="btn btn-sm btn-outline-success" style="margin-top: 30px;">ACTUALIZAR</i></a>
                            


                            <a href="ver_horario/{{$u->id}}" class="btn btn-sm btn-outline-danger" style="margin-top: 30px;">ELIMINAR</i></a>
                             
                            </div>
                        </div>
                    </div>
                    
                    @endforeach



                    <input type="hidden" name="cont" id="cont" value="1">
                    <div id="impresoras"></div> 

                        
                       


                    <div class="form-group">
                        <label for=""></label>
                        <input type="submit" value="Guardar horario" class="btn btn-primary btn-block">
                    </div>
                    
                </div>
                
            </div>
        </form>
    </div>
</div>
<script>
function endKey($horarios){

    //Aquí utilizamos end() para poner el puntero
    //en el último elemento, no para devolver su valor
    end($horarios);

    console.log(key($horarios));

}    
var cont = {{$u->consecutivo}} + 1;
$('#creaImpresora').click(function() {
    var texto = "<div class='row'><div class='col-sm-12 col-lg-5'  >";
    texto += "<label>Horario inicial "+cont+":  </label>";
    texto += "<input type='text' class='form-control timepicker-horario' id='hinicial"+cont+"' name='hinicial"+cont+"'>";
    texto += "</div>";


    texto += "<div class='col-sm-12 col-lg-5'  >";
    texto += "<label>Horario inicial "+cont+":</label>";
    texto += "<input type='text' class='form-control timepicker-horario' id='hfinal"+cont+"' name='hfinal"+cont+"'>";
    texto += "</div>";

    texto += "<div class='col-sm-12 col-lg-2'  >";
    texto += "<label>Consecutivo "+cont+":</label>";
    texto += "<input type='number' class='form-control' id='consecutivo"+cont+"' name='consecutivo"+cont+"'  value="+cont+">";
    texto += "</div></div>";


    $('#impresoras').append(texto);
    $('#cont').val(cont);
    $(".timepicker-horario").timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        maxTime: '23:00pm',
        minTime: '4:00am'
    });
    cont++;
});
$(document).ready(function(){
    $(".timepicker-horario").timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        maxTime: '23:00pm',
        minTime: '4:00am'
    });
});        
</script>