@extends('inc.inc')
@section('content')
  <style media="screen">
    .eliminar {
      display:flex;
      justify-content:space-between;
      align-items:center
    }
    .eliminar i{
      width:1%;
      color:red;
      margin-right: 8px;
    }
    .eliminar i:hover {
      transform: scale(1.2);
    }
  </style>
  <div class="container bg-white">
    <div class="row">
      <div class="col-12 text-center h1 mt-3">Consulta los precios</div>
    </div>
      <div class="row mt-5 mb-2 ">
        <div class="col-12 d-flex justify-content-between flex-wrap">
          <div class="col-sm-6 col-md-6">
            <div class="row">
              <div class="col-md-4 col-lg-3 col-xs-12 px-1">
                <a class="btn-block btn btn-success" href="/">Listo</a>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="row">
              <form class="" action="index.html" method="post">
                <input type="text" class="form-control" name="" value="" id="buscador" placeholder="Buscar articulo..."  autofocus>
              </form>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
      <div class="col">
        <form action="/addProduct" class="mt-2 w-100" id="form" style="display:none" method="post">
          {{ csrf_field() }}
          <div class="form-group d-flex">
            <input type="text" name="name" class="form-control" placeholder="Nombre" id="name" value="">
            <select class="form-control" name="category_id" id="category">
              <option value="1" selected>CATEGORIA</option>
              @foreach ($category as $key => $value)
              <option value="{{$value->id}}">{{$value->title}}</option>
              @endforeach
            </select>
            <input type="text" name="price" class="form-control" placeholder="Precio" id="price" value="">
          </div>
          <div class="form-group">
            <input type="submit" class="mt-1 px-5 btn btn-success" id="añadirArticulo" name="" value="Enviar">
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <table class="table table-striped table-bordered">
          <thead>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>CATEGORIA</th>
            <th>PRECIO</th>
          </thead>
            @foreach ($products as $key => $value)
              <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->category->title}}</td>
                <td class="eliminar">${{$value->price}}<i class="fa fa-times" aria-hidden="true"></i></td>
              </tr>
            @endforeach
        </table>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    var $botonEliminar = $('td.eliminar'),
        $filas = $('tr'),
        token = document.querySelector('meta[name="csrf-token"]').content;

        $botonEliminar.each(function(e){
          e = $(this);
          $(this).click(function(){
            $.ajax({
              'type':'POST',
              'url':'/deleteProducts',
              'data':{
                'id': e.siblings().first().text(),
                '_token': token
              }
            }).done(function(){
              e.parent().remove();
              console.log('todo bien')
            })
          })
        });

  </script>
@endsection
