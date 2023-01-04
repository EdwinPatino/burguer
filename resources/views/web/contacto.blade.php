@extends('web.plantilla')
@section('contenido')
<?php
$pg = "contacto"; ?>
  <!-- about section -->

  <!-- book section -->
  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Déjenos su mensaje
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
          <form method="POST" action="" enctype="multipart/form-data">
               <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
              <div>
                <input type="text" class="form-control" placeholder="Nombre y Apellido*" name="txtNombre" required />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Numero de telefono*" name="txtTelefono" required />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Correo electronico*" name="txtCorreo" required />
              </div>
              <label for="txtMensaje">Mensaje*:</label>
              <textarea name="txtMensaje" id="txtMensaje" cols="38" rows="18" class="form-control" placeholder="Escribe aquí tu mensaje" required></textarea>
              <div>
              </div>
              <div class="btn_box">
                <button id="btnEnviar" name="btnEnviar">
                  Enviar
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container ">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6568.027399440776!2d-58.38945463299751!3d-34.60381508458803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bccacf173150fb%3A0x591a909a423087d4!2sMcDonald&#39;s!5e0!3m2!1ses-419!2sar!4v1658445336232!5m2!1ses-419!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end book section -->

@endsection