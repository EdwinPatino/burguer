@extends('web.plantilla')
@section('contenido')

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Take away
        </h2>
      </div>

      @if(isset($msg))
              <div class="alert alert-{{ $msg['estado'] }}" role="alert">
                {{$msg["mensaje"]}}
              </div>
              @endif
      <ul class="filters_menu">
        <li class="active" data-filter="*">Todos</li>
        @foreach($aCategorias as $item)
            <li data-filter=".{{ $item->nombre}}"> {{ $item->nombre}} </li>
        @endforeach
        
      </ul>

      <div class="filters-content">
        <div class="row grid">

        @foreach($aProductos as $item)
          @foreach($aCategorias as $itemCategoria)
            @if($item->fk_idcategoria == $itemCategoria->idcategoria)
              <div class="col-sm-6 col-lg-4 all {{$itemCategoria->nombre}}">
            @endif
          @endforeach
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="/files/{{ $item->imagen }}" alt=""> 
                </div>
                <div class="detail-box">
                  <h5>
                  {{ $item->nombre }}
                  </h5>
                  <p>
                  {{ $item->descripcion }}
                  </p>
                  <div class="options">
                    <h6>
                    {{ $item->precio }}
                    </h6>
                    <form action="" method="POST">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                      <div class="btn selecCant" style="background: #f1f2f3; border-radius: 30px;margin-top: 2px;padding-bottom: 4px;padding-top: 4px;">
                        <input type="hidden" name="txtIdProducto" value="{{ $item->idproducto }}">
                        <input type="number" name="txtCantidadProducto" id="" class="text-center" style="border: 0;outline: none; background-color:  #f1f2f3; cursor: pointer; " min="1" value="1" max="10">
                      </div>
                      <button type="submit"><i class="fa-solid fa-cart-plus"></i></button>
                      
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        @endforeach
         
                
        </div>
      </div>
    </div>
  </section>

  <!-- end food section -->
@endsection