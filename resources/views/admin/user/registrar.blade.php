@extends('layouts.admin.index')
@section('conteudo')


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
        const tipoEstabelecimentoSelect = document.getElementById("vc_tipo_utilizador");
        const divEmpresa = document.querySelector(".empresa");
        const divIndividual = document.querySelector(".individual");
    
        // Adicione um ouvinte de evento para detectar mudanças na seleção
        tipoEstabelecimentoSelect.addEventListener("change", function() {
            if (tipoEstabelecimentoSelect.value === "4") {
              //  Se "Empresa" for selecionado, exiba a div "empresa" e oculte a div "individual"
                divEmpresa.style.display = "block";
                divIndividual.style.display = "none";
            } else if (tipoEstabelecimentoSelect.value === "3") {
                // Se "Individual" for selecionado, exiba a div "individual" e oculte a div "empresa"
                divEmpresa.style.display = "none";
                divIndividual.style.display = "block";
            } else {
                // Se "Selecione o Tipo de Empresa" for selecionado, oculte ambas as divs
                divEmpresa.style.display = "none";
                divIndividual.style.display = "none";
            }
        });
    });
    </script>

    <script>
      $('#summernote').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 100
      });
    </script>
@endsection
