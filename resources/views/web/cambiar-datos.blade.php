@extends('web.plantilla')
@section('contenido')

  <!-- book section -->
  <section class="book_section layout_padding">
    <div class="container offset-sm-3">
      <div class="heading_container">
        <h2 class="pb-4">
          Cambiar datos
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="" method="POST">
              @if(isset($msg))
                <div class="alert alert-{{ $msg['estado'] }}" role="alert">
                  {{$msg["msg"]}}
                </div>
              @endif
               <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
              <div>
                <input id="txtNombre" name="txtNombre" type="text" class="form-control" placeholder="Nombre" value="{{ $cliente->nombre }}" />
              </div>
              <div>
                <input id="txtApellido" name="txtApellido" type="text" class="form-control" placeholder="Apellido" value="{{ $cliente->apellido }}" />
              </div>
              <div>
                <input id="txtCorreo" name="txtCorreo" type="email" class="form-control" placeholder="Correo" value="{{ $cliente->correo }}"/>
              </div>
              <div>
                <input id="txtDni" name="txtDni" type="text" class="form-control" placeholder="DNI" value="{{ $cliente->dni }}"/>
              </div>
              <div>
                <input id="txtCelular" name="txtCelular" type="text" class="form-control" placeholder="Celular" value="{{ $cliente->celular }}"/>
              </div>
              <div class="btn_box">
                <button type="submit" id="btnEnviar" name="btnEnviar" href="">Editar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end book section -->

@endsection