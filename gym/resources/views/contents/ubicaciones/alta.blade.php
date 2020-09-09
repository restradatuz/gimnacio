<style>

		#formulario{overflow-y: auto; height: 500px;}
		#formulario .formulario-cont:hover{cursor: pointer;}
		#formulario .formulario-cont h2{font-size: 18px; color: #4D148C;}
		.izq{width: 25%; padding: 1%;}
		.der{width: 75%; height: 670px}
		.map {
			width: 100%;
			height: 100%;
			background-color: grey;
		}
		@media  screen and (max-width:768px) {
			.div-suc{width: 100%;}
		}
</style>

<div class="row" id="contenedor-formulario">
		<div class="div-suc izq">

			<form class="form-horizontal" method="POST" action="{{route('updatestore')}}" role="form">
				{{ csrf_field() }}
				

			<input type="hidden" name="id" id="id" class="form-control" value="">

			<div class="row">

				<label for="nombre" class="col-md-3">Nombre</label>

				<div class="form-group col-md-12 has-feedback">

					<input type="text" name="nombre" id="nombre" class="form-control text-uppercase"  value="{{ $ubicacion->nombre }}" autofocus="">

					@if ($errors->has('nombre'))

						<span class="text-danger">

	                         <strong class="errores">{{ $errors->first('nombre') }}</strong>

	                    </span>

					@endif

				</div>

			</div>

			<div class="row">

				<label for="cordenadas1" class="col-md-3">Ubicación</label>

				<div class="form-group col-md-12 has-feedback">

					<input type="text" name="cordenadas1" id="cordenadas1" class="form-control" value="{{ $ubicacion->cordenadas1 }}" placeholder="Selecciona un punto del mapa">

					@if ($errors->has('cordenadas1'))

						<span class="text-danger">

	                         <strong class="errores">{{ $errors->first('cordenadas1') }}</strong>

	                    </span>

                    @endif

				</div>

			</div>


			<br>	

				<div class="form-group">
                        <label for=""></label>
                        <input type="submit" value="Guardar" class="btn btn-primary btn-block" id="boton-Guardar">
                </div>
			</form>
	</div>
<div class="div-suc der">
	<div id="map" class="map"></div>
</div>


</div>

<script>
		var map;
		function initMap() {
			$coordenadas = '{{ $ubicacion->cordenadas1}},{{ $ubicacion->cordenadas2}}';
		 	$coord = $coordenadas.split(',');
		 	
			$myLatLng = {lat: parseFloat($coord[0]),lng: parseFloat($coord[1])};
			map = new google.maps.Map(document.getElementById('map'), {
				zoom: 15,
				center: $myLatLng,
				mapTypeId: 'roadmap'
			});
			addMarker($myLatLng);	//Este solo lo ejecuta la 1a vez
			$('#cordenadas1').val('('+ $coordenadas +')');
			// This event listener will call addMarker() when the map is clicked.
			map.addListener('click', function(event) {
				addMarker(event.latLng);	
			});
		}
		
		// Adds a marker to the map and push to the array.
		function addMarker(location) {
			var marker = new google.maps.Marker({
				position: location,
				map: map
			});
			$('#cordenadas1').val(location);
			map.addListener('click', function(event) {
				marker.setMap(null);
			});
		}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjICb5xkiHyX9op_2qe-s3zVxJo-zimNM&callback=initMap"></script>

<script>
		
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} }); 
			setTimeout( function() {
	        $(".co").fadeOut(1000);
	    },2000);
</script>
		{{--  Se incluyen scripts del modal de los catalogos (estan en la carpeta public)  --}} 
<script type="text/javascript" src="/js/scripts-modal.js"></script>