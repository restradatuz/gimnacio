<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="card">
    <div class="card-body">
        <table class="table table-datatable table-bordered table-bordered table-hover">
            <thead class="table-primary">
                <th class="text-center">Dias Semana</th>
                <th class="text-center">Horario Asignado</th>
                <th class="text-center">Estatus</th>
                <th class="text-center">Acciones</th>
            </thead>
            <tbody>
                @foreach ($diassemana as $u)
                    <tr class="table-light table-bordered">
                        <th class="text-center">{{ strtoupper($u->dia_semana) }}</th>
                        <th class="text-center">{{ $u->id_horario == 0 ? "" : $u->nombrehorario->nombre_horario }}</th>
                        <th class="text-center">
                            
                            @if ($u->estatus == 1) ACTIVO
                            @elseif($u->estatus == 0) INACTIVO
                            @endif

                        </th>
                        
                        <th class="text-center">
                            
                           @if($u->estatus == 1)
                            <label class="switch">
                              <input type="checkbox" checked 
                              id="<?php echo e($u->id); ?>" value="0" >
                              <span class="slider round"></span>
                            </label>

                            @elseif($u->estatus == 0)
                            
                              <label class="switch">
                              <input type="checkbox" 
                              id="<?php echo e($u->id); ?>" value="1">
                              <span class="slider round"></span>

                            </label>
                            @endif

                            <a href="editarhorario/{{$u->id}}/{{$u->dia_semana}}" class="btn btn-sm btn-primary" style="margin-top: 15px;"><i class="icon-pencil"></i></a>

                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
$(function(){
    $('.table-datatable').DataTable({
        info: false,
        order:[],
        language: {
            "decimal":        ".",
            "emptyTable":     "No hay datos disponibles",
            "thousands":      ",",
            "lengthMenu":     "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron coincidencias",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });
})

$(document).on('change','input[type="checkbox"]' ,function(e) {


          $.ajax({
            url: "{{ url('actualizasemana') }}",
            type:'POST',
            dataType:'json',
            data:{  id : this.id,value :this.value },



           success:  function (response) {
            window.location.reload();
            console.log(response);

           },
           statusCode: {
              404: function() {
                 alert('web not found');
              }
           },
           error:function(x,xs,xt){
              console.log('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
             window.location.reload();
           }
       });
  
});
</script>