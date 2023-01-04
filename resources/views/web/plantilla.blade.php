<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="web/images/favicon.png" type="">

  <title> Burger </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="web/fontawesome/css/all.min.css" rel="stylesheet" />
  <link href="web/fontawesome/css/fontawesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="web/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="web/css/responsive.css" rel="stylesheet" />

</head>
@if(isset($pg) && $pg=="inicio")

<body>
  @else

  <body class="sub_page">
    @endif
    <div class="hero_area">

      <div class="bg-box">
        <img src="web/images/hero-bg.jpg" alt="">
      </div>

      <!-- header section strats -->
      <header class="header_section">
        <div class="container">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.html">
              <span>
                Burger
              </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav  mx-auto ">
                <li class="nav-item <?php echo isset($pg) && $pg == "home" ? "active" : "" ?> ">
                  <a class="nav-link" href="/">Inicio</a>
                </li>
                <li class="nav-item <?php echo isset($pg) && $pg == "takeaway" ? "active" : "" ?>">
                  <a class="nav-link" href="/takeaway">Takeaway</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/nosotros">Nosotros</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/contacto">Contacto</a>
                </li>
                @if(Session::get("idcliente") > 0)
                <li class="nav-item">
                  <a class="nav-link" href="/mi-cuenta">Mi cuenta</a>
                </li>
                @endif
              </ul>
              <div class="user_option">
                @if(Session::get("idcliente") > 0)
                <a class="cart_link" href="/carrito"><i class="fa-solid fa-cart-plus text-white"></i></a>
                @endif
                @if(Session::get("idcliente") > 0)
                <a href="/logout" class="order_online">
                  Salir
                  <i class="fa fa-user" aria-hidden="true"></i>
                </a>
                @else
                <a href="/login" class="order_online">
                  Ingresar
                  <i class="fa fa-user" aria-hidden="true"></i>
                </a>
                @endif
              </div>
            </div>
          </nav>
        </div>
      </header>
      @if(isset($pg) && $pg!="inicio")
    </div>
    @endif

    <!-- end header section -->
    @yield('contenido')

    <!-- footer section -->
    <footer class="footer_section">
      <div class="container">
        <div class="row">
          <div class="col-12 ">
            <h5 class="pb-5">Sucursales</h5>
          </div>
          @foreach($aSucursales as $sucursal)
          <div class="col-3 footer-col">
            <div class="footer_contact ">
              <h4>
                {{ $sucursal->nombre }}
              </h4>
              <div class="contact_link_box">
                <a target="_blank" href="{{ $sucursal->linkmapa }}">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <span>
                    Dirección: {{ $sucursal->direccion }}
                  </span>
                </a>
                <a target="_blank" href="">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <span>
                    Telefono: {{ $sucursal->telefono }}
                  </span>
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="footer-info">
          <p>
            &copy; <span id="displayYear"></span> Restaurante de comida rapida
          </p>
          <p> 
            &copy; <span id="displayYear"></span> Argentina y Colombia
          </p>
        </div>
      </div>
    </footer>
    <!-- footer section -->

    <!-- jQery -->
    <script src="web/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script src="web/js/bootstrap.js"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="web/js/custom.js"></script>

  </body>

</html>