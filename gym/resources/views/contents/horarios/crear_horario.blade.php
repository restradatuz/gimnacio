<div class="card">
    <div class="card-body">
        <form action="{{route('horarioguardar')}}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="form-group">
                        <label for="nombre">Nombre horario:</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" value="" required="">
                        @error("nombre")
                            <p class="text-danger animated flipInX"></p>
                        @enderror
                    </div>

                    <div class="form-group">
                    <h4 class="m-3">Agregar horario
                        <a href="#" id="creaImpresora" data-toggle="tooltip" title="Agregar impresora"><i class="fa fa-plus-circle"></i></a>
                    </h4>
                    </div>


                    <div class="row">
                        <div class="col-sm-12 col-lg-5">
                            <div class="form-group">
                            <label for="password">Horario inicial:</label>
                            <input class="form-control timepicker-horario" type="text" name="hinicial1" id="hinicial1" required="">
                             
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-5">
                            <div class="form-group">
                            <label for="password">Horario final:</label>
                            <input class="form-control timepicker-horario" type="text" name="hfinal1" id="hfinal1" required="">  
                            </div>   
                        </div>

                        <div class="col-sm-12 col-lg-2">
                            <div class="form-group">
                            <label for="password">Consecutivo:</label>
                            <input class="form-control" type="number" name="consecutivo1" id="consecutivo1" value="1">  
                            </div>   
                        </div>
                    </div>

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
    
var cont = 2;
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