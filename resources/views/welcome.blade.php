<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Inventario</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
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
                    <button type="button" class="btn-block btn btn-danger" name="button">Eliminar</button>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="row">
                  <input type="text" class="form-control" name="" value="" id="buscador" placeholder="Buscar articulo...">
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
                <input type="text" name="price" class="form-control" placeholder="Precio" id="price" value="">
                <select class="form-control" name="category_id" id="category">
                  <option value="1" selected>CATEGORIA</option>
                  @foreach ($category as $key => $value)
                  <option value="{{$value->id}}">{{$value->title}}</option>
                  @endforeach
                </select>
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
        var $añadir = $('#añadir'),
            token = document.querySelector('meta[name="csrf-token"]').content
            $añadirArticulo= $('#añadirArticulo');


        $añadir.click(function(){
          $('#form').slideToggle();
        });

        var buscador = document.querySelector('#buscador'),
        ul = document.querySelector('tbody'),
        xhr = new XMLHttpRequest();


    buscador.addEventListener('input',function(event){
      xhr.onreadystatechange = function(){
        if (this.readyState == 4) {
          ul.innerHTML = "";
          if (this.status == 200) {
            xhr.response.forEach(function (value, key){
              var li = document.createElement('tr');
              var a1 = document.createElement('td');
              var a2 = document.createElement('td');
              var a3 = document.createElement('td');
              var a4 = document.createElement('td');
              li.className= 'white';
              console.log(value)
              a1.append(document.createTextNode(value.id))
              a2.append(document.createTextNode(value.name))
              a3.append(document.createTextNode(value.title))
              a4.append(document.createTextNode(value.price))
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
      xhr.send();
    })

      </script>
    </body>
</html>
