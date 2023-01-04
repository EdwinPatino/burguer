@extends("web.plantilla")
@section('contenido')
  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="web/images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                We Are Feane
              </h2>
            </div>
            <p>
            Feane es una franquicia de restaurantes de comida rápida Argentina con sede en CABA, Argentina.​ Sus principales productos son las hamburguesas, las patatas fritas, los menús para el desayuno y los refrescos.
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->
  
  <!-- client section -->

  <section class="client_section pt-5">
    <div class="container">
      <div class="heading_container heading_center psudo_white_primary mb_45">
        <h2>
          Qué dicen nuestros clientes
        </h2>
      </div>
      <div class="carousel-wrap row ">
        <div class="owl-carousel client_owl-carousel">
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                Primero que tiene mesitas que dan al parque y lo hacen más atractivo. Segundo está en una zona que la están reciclando y está quedando muy bonito.
                Tiene sillitas para bebes y jueguitos para los chicos hasta mesitas y sillas.
                La atención es muy buena y son gente muy amable.
                </p>
                <h6>
                  Moana Michell
                </h6>
                <p>
                  magna aliqua
                </p>
              </div>
              <div class="img-box">
                <img src="web/images/client1.jpg" alt="" class="box-img">
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                Qué se puede decir que no se haya dicho? Es oootro local de McDonald's que tiene a su favor la zona donde está ubicada: apenas a cuadras de distancia de los bosques de Palermo, lo que le suma un plus muy grande, al menos en mi opinión.
                </p>
                <h6>
                  Mike Hamell
                </h6>
                <p>
                  magna aliqua
                </p>
              </div>
              <div class="img-box">
                <img src="web/images/client2.jpg" alt="" class="box-img">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>





  </section>
  <!-- end client section -->
  <section class="book_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container text-center">
        <h2>
          ¡Trabaja con nosotros!
        </h2>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form_container">
            <form method="POST" action="" enctype="multipart/form-data">
               <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
              <div>
                <input type="text" class="form-control" placeholder="Nombre y Apellido" name="txtNombre"/>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Numero de Whatsapp" name="txtTelefono" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Correo electronico" name="txtCorreo" />
              </div>
               <div>
                <label for="TxtFechaNac">Mensaje:</label>
                <textarea name="txtMensaje" id="txtMensaje" class="form-control"></textarea>
              </div>
              <div>
                <label for="archivo" class="d-block">Adjunta tu CV:</label>
                <input type="file" name="archivo" id="archivo">
              </div>
              <div class="btn_box text-center">
                <button type="submit">
                  Enviar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection