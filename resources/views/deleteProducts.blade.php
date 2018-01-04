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
      <div class="col-12 text-center h1 mt-3">Eliminar producto</div>
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
              <form class="col" action="index.html" method="post">
                <input type="text" class="form-control" name="" value="" id="buscador" placeholder="Buscar articulo..."  autofocus>
              </form>
            </div>
          </div>
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
                <td class="eliminar">${{$value->price}}<i class="fa fa-times" class="delete"aria-hidden="true" title="Eliminar"></i></td>
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
          $(this).on('click','i',function(){
            $.ajax({
              'type':'POST',
              'url':'/deleteProducts',
              'data':{
                'id': e.siblings().first().text(),
                '_token': token
              }
            }).done(function(){
              e.parent().remove();
            })
          })
        });

        var buscador = document.querySelector('#buscador'),
            ul = document.querySelector('tbody'),
            xhr = new XMLHttpRequest()
            attach=$(ul).children().detach()
            cross = $('<i class="fa fa-times" aria-hidden="true" title="Eliminar"></i>');
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
                    a1.append(document.innerHTML=value.id)
                    a2.append(document.innerHTML=value.name)
                    a3.append(document.innerHTML=value.title)
                    a4.append(document.innerHTML='$'+value.price)
                    cross.clone().appendTo(a4)
                    a4.className = 'eliminar'
                    li.append(a1);
                    li.append(a2);
                    li.append(a3);
                    li.append(a4);
                    ul.append(li)
                  });
                  $botonEliminar = $('td.eliminar')
                  $botonEliminar.each(function(e){
                    e = $(this);
                    $(this).on('click','i',function(){
                      $.ajax({
                        'type':'POST',
                        'url':'/deleteProducts',
                        'data':{
                          'id': e.siblings().first().text(),
                          '_token': token
                        }
                      }).done(function(){
                        e.parent().remove();
                      })
                    })
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
