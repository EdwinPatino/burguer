@extends('web.plantilla')
@section('contenido')

  <!-- book section -->
  <section class="book_section layout_padding">
    <div class="container offset-sm-3">
      <div class="heading_container">
        <h2 class="pb-4">
          Cambiar clave
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
                <input id="txtClave" name="txtClave" type="text" class="form-control" placeholder="Ingresa la nueva clave" />
              </div>
              <div>
                <input id="txtReClave" name="txtReClave" type="text" class="form-control" placeholder="Re-ingresar nueva clave" />
              </div>
              <div class="btn_box">
                <button type="submit" id="btnEnviar" name="btnEnviar" href="">Cambiar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end book section -->

@endsection