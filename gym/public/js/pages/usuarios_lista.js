$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} }); 

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

            url:"/actualizasemana",
            type:'POST',
            dataType:'json',
            data:{id:this.id, value:this.value },


           success:  function (response) {
            window.location.reload();
             
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
