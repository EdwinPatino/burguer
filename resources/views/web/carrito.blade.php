@extends('web.plantilla')
@section('contenido')
<section class="food_section layout_padding carrito">
      <form action="" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
      <div class="container">
            <div class="heading_container heading_center">
                  <h2>Mi Carrito</h2>
            </div>

            @if(isset($msg))
                  <div class="alert alert-{{ $msg['estado'] }}" role="alert"><?php echo $msg["mensaje"]; ?></div>
            @endif
            <div class="row">
                  <div class="col-12 my-5">
                        <table class="table table-hover border">
                              <thead>
                                    <tr>
                                          <th class="lead">Imagen</th>
                                          <th class="lead">Producto</th>
                                          <th class="lead">Precio</th>
                                          <th class="lead">Cantidad</th>
                                          <th class="lead">Total</th>
                                          <th></th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <?php $total = 0?>
                                    @foreach($aCarrito_productos as $item)
                                     <?php $subtotal = $item->precioproducto * $item->cantidad;?>
                                    <tr>
                                          <td><img src="/files/{{ $item->imagenproducto }}" alt="" width="100" height="100" class="rounded img-thumbnail"></td>
                                          <td>{{ $item->nombreproducto}}</td>
                                          <td>${{ number_format($item->precioproducto, 2, ",", ".")}}</td>
                                          <td>{{ $item->cantidad}}</td>
                                          <td>${{ number_format($subtotal, 2, ",", ".") }}</td>
                                          <td><i class="fa-solid fa-ban"></i></td>
                                    </tr>
                                    <?php $total += $subtotal;?>
                                    @endforeach
                              </tbody>
                        </table>
                        <div class="float-right lead">
                              <h4>TOTAL: ${{$total}}</h2>
                        </div>
                  </div>
                  <div class="col-12">
                        <label for="" class="d-block">Selecciona la sucursal donde retirar el pedido:</label>
                        <select name="lstSucursal" id="lstSucursal" class="form-control">
                        @foreach($aSucursales as $sucursal)
                              <option value="{{ $sucursal->idsucursal }}">{{ $sucursal->nombre }}</option>
                        @endforeach
                        </select>
                  </div>
                  <div class="col-12">
                        <label for="" class="d-block">Selecciona el medio de pago:</label>
                        <select name="lstMedioDePago" id="lstMedioDePago" class="form-control">
                              <option value="mercadopago">Mercadopago</option>
                              <option value="sucursal">Pago en sucursal</option>
                        </select>
                  </div>
                  <div class="col-6">
                        <a href="/takeaway" class=" lead" >AGREGAR MAS PRODUCTOS</a>
                  </div>
                  <div class="col-6">
                        <button type="submit" class=" float-right btn btn-primary lead" >FINALIZAR MI COMPRA</button>
                  </div>
            </div>
      </div>
</form>
</section>

  <!-- end food section -->
@endsection