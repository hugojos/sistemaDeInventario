@extends('inc.inc')
@section('content')
    <div class="container bg-white">
      <div class="row">
        <div class="col-12 text-center h1 mt-3">Consulta los precios</div>
      </div>
        <div class="row mt-5 mb-2 ">
          <div class="col-12 d-flex justify-content-between flex-wrap">
            <div class="col-sm-6 col-md-6">
              <div class="row">
                <div class="col-md-4 col-lg-3 col-xs-12 px-1">
                  <button type="button" class="btn-block btn btn-primary" name="button" id="añadir">Añadir</button>
                </div>
                <div class="col-md-4 col-lg-3 col-xs-12 px-1">
                  <button type="button" class="btn-block btn btn-secondary" name="button">Modificar</button>
                </div>
                <div class="col-md-4 col-lg-3 col-xs-12 px-1">
                  <a class="btn-block btn btn-danger" href="/deleteProducts" name="button">Eliminar</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" name="" value="" autofocus id="buscador" placeholder="Buscar articulo...">
                </div>
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
                  <td>${{$value->price}}</td>
                </tr>
              @endforeach
          </table>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      var $botonAñadir = $('#añadir'),
          $añadirArticulo= $('#añadirArticulo'),
          token = document.querySelector('meta[name="csrf-token"]').content;
          $botonAñadir.click(function(){
            $('#form').slideToggle();
          });
  /*-----------------------------------------BUSCADOR-----------------------------------------*/

var buscador = document.querySelector('#buscador'),
    ul = document.querySelector('tbody'),
    xhr = new XMLHttpRequest(),
    attach=$(ul).children().detach();
    $(ul).append(attach)
  buscador.addEventListener('input',function(event){
    xhr.onreadystatechange = function(){
      ul.innerHTML=""
      if (this.readyState == 4) {
        if (this.status == 200) {
          xhr.response.forEach(function (value, key){
            var li = document.createElement('tr');
            var a1 = document.createElement('td');
            var a2 = document.createElement('td');
            var a3 = document.createElement('td');
            var a4 = document.createElement('td');
            a1.append(document.createTextNode(value.id))
            a2.append(document.createTextNode(value.name))
            a3.append(document.createTextNode(value.title))
            a4.append(document.createTextNode('$'+value.price))
            li.append(a1);
            li.append(a2);
            li.append(a3);
            li.append(a4);
            ul.append(li)
          });
        }
      }
    };
    xhr.open("GET","/searchGet/"+buscador.value, true);
    xhr.responseType = 'json';
    xhr.setRequestHeader('X-CSRF-TOKEN', token);
    if (!buscador.value=="") {
      xhr.send();
    }else {
      $(ul).append(attach);
    }
  })

    </script>
@endsection
