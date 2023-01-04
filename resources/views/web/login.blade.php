
@extends('web.plantilla')
@section('contenido')

  <!-- book section -->
  <section class="book_section layout_padding">
    <div class="container offset-sm-3">
      <div class="heading_container">
        <h2 class="pb-4">
          Ingreso/Registro
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="" method="POST" class="">
              @if(isset($msg))
              <div class="alert alert-{{ $msg['estado'] }}" role="alert">
                {{$msg["msg"]}}
              </div>
              @endif
               <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
              <div>
                <input id="txtCorreo" name="txtCorreo" type="email" class="form-control" placeholder="Correo" />
              </div>
              <div>
                <input id="txtClave" name="txtClave" type="password" class="form-control" placeholder="Password" />
              </div>
              <div class="btn_box">
                <button type="submit" id="btnIngresar" name="btnIngresar" href="">Ingresar</button>
              </div>
              <div class="mt-4">
                  <a href="/nuevo-registro">Registrarme</a>
              </div>
              <div class="">
                  <a href="/recuperar-clave">Recuperar contraseña</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end book section -->

@endsection