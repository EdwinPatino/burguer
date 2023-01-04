@extends('web.plantilla')
@section('contenido')

  <!-- book section -->
  <section class="book_section layout_padding">
    <div class="container offset-sm-3">
      <div class="heading_container">
        <h2 class="pb-4 ">
          Recuperar Contraseña
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6 ">
          <div class="form_container">
            <form action="" method="POST">
               <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
              <div>
                <input id="txtCorreo" name="txtCorreo" type="email" class="form-control" placeholder="Ingrese correo" />
              </div>
              <div class="btn_box">
                <button type="submit" id="btnEnviar" name="btnEnviar" href="">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end book section -->

@endsection