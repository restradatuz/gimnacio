<div class="card">
    <div class="card-body">
        <form action="{{route('nuevasucursal')}}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="form-group">
                        <label for="nombre">Nombre Sucursal:</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" value="" required="">
                        @error("nombre")
                            <p class="text-danger animated flipInX"></p>
                        @enderror
                    </div>

                    

                        
                       


                    <div class="form-group">
                        <label for=""></label>
                        <input type="submit" value="Crear Sucursal" class="btn btn-primary btn-block">
                    </div>
                    
                </div>
                
            </div>
        </form>
    </div>
</div>