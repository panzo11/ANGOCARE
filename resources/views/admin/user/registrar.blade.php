@extends('layouts.admin.index')
@section('conteudo')
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif


<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="card" style="border-radius: 15px;">

        <div class="card-body">
        <form action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                                
                @include('admin.user.form')
                <!-- fim -->

                        <input type="submit" value="Cadastrar" class="btn btn-primary">
  
              
               
            </form>
        </div>
    </div>
</div>


<script>
   document.addEventListener("DOMContentLoaded", function() {
    const radioDoador = document.querySelector('input[name="vc_tipo_utilizador"][value="1"]');
    const radioEmpresa = document.querySelector('input[name="vc_tipo_utilizador"][value="4"]');
    const radioCaridade = document.querySelector('input[name="vc_tipo_utilizador"][value="3"]');
    const divEmpresa = document.querySelector(".empresa");
    const divIndividual = document.querySelector(".individual");

    // Adicione um ouvinte de evento para os botões de rádio
    radioDoador.addEventListener("click", function() {
        divEmpresa.style.display = "none";
        divIndividual.style.display = "none";
    });

    radioEmpresa.addEventListener("click", function() {
        divEmpresa.style.display = "block";
        divIndividual.style.display = "none";
    });

    radioCaridade.addEventListener("click", function() {
        divEmpresa.style.display = "none";
        divIndividual.style.display = "block";
    });
});

    </script>

@include('admin.organizacao.editor')
<script>
  $('#summernote').summernote({
    placeholder: 'Hello Bootstrap 4',
    tabsize: 2,
    height: 100
  });
</script>
@endsection
