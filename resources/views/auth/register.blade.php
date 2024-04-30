@extends('auth.layout')
@section('titulo','Login')
@section('conteudo')

{{--  '
        'kisalo',
        'informações',
        'funcionarios', --}}

<?php
$documentos=App\Models\Documento::get();
?>
<div class="wrapper">
	<section class="login-content overflow-hidden">
	   <div class="row no-gutters align-items-center bg-white">
		  <div class="col-md-12 col-lg-6 align-self-center">
			 <a href="{{ route('login') }}" class="navbar-brand d-flex align-items-center mb-3 justify-content-center text-primary">
                <div class="logo-normal">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" width="100px">
                </div>
                <h3>ANGOCARE</h3>
			 </a>
			 <div class="row justify-content-center pt-5">
				<div class="col-md-11">
				   <div class="card  d-flex justify-content-center mb-0 auth-card iq-auth-form">
					  <div class="card-body">
						 <h2 class="mb-2 text-center">Registrar </h2>
						 <p class="text-center">Registra-se</p>
						 <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <<div class="row">
                                {{-- <div class="form-group col-md-12"> --}}
                                    <label class="form-label fw-semibold">NiveL de Acesso*</label>
                                    <div class="row">
                                        <div class="form-check d-block col-md-4">
                                            <input class="form-check-input" type="radio" name="vc_tipo_utilizador" id="flexRadioDefault1"
                                                value="1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Doador
                                            </label>
                                        </div>
                                        <div class="form-check d-block col-md-4">
                                            <input class="form-check-input" type="radio" name="vc_tipo_utilizador" id="flexRadioDefault1"
                                                value="4">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Empresa
                                            </label>
                                        </div>
                                        
                                    </div>
                                </div>
                        
                         
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="mb-4">Dados Pessoais</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Representante*</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required id="name" placeholder="Primeiro Nome">
                                    </div>
                                </div>
                        
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="bi" class="form-label">BI*</label>
                                        <input type="text" class="form-control" name="bi" value="{{ old('bi') }}" required placeholder="BI">
                                        @error('bi')
                                        <span class="invalid-feedback form-control" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">E-mail ou Telefone*</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  aria-describedby="Telefone" placeholder="944837203 or Example@gmail.com">
                                        @error('email')
                                        <span class="invalid-feedback form-control" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                    
                        
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Senha*</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password" id="password" aria-describedby="password" placeholder="xxxx">
                                        @error('password')
                                        <span class="invalid-feedback form-control" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">Confirmar senha*</label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="password_confirmation" id="password_confirmation" aria-describedby="password_confirmation" placeholder="xxxx">
                                        @error('password_confirmation')
                                        <span class="invalid-feedback form-control" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="empresa" style="display: none">
                                <div class="form-card text-start">
                                        <div class="row">
                                        <div class="col-7">
                                            <h3 class="mb-4">Dados Da Empresa</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-semibold">Nome da Empresa*</label>
                                                <input type="text" class="form-control" name="empresa" placeholder="Digite o nome da empresa" value="{{ old('empresa') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-semibold">NIF*</label>
                                                <input type="text" class="form-control" name="nif" placeholder="Digite o NIF da empresa" value="{{ old('nif') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="individual" style="display: none">
                                <div class="form-card text-start">
                                    <div class="row">
                                        <div class="col-7">
                                            <h3 class="mb-4">Dados Da Organização</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-semibold">Nome da Organização*</label>
                                                <input type="text" class="form-control" name="nome" placeholder="Digite o nome da organização" value="{{ old('nome') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-semibold">Logotipo*</label>
                                                <input type="file" class="form-control" name="logotipo">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-semibold">Descrição*</label>
                                                <textarea class="form-control" name="descricao" placeholder="Digite a descrição da organização">{{ old('descricao') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @include('admin.organizacao.form.step2')
                            </div>
                           
                        
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary w-100">Registrar</button>
                            </div>
                        </form>
                        
                         
                         <p class="mt-3 text-center color-primary">
                            Já tens uma conta ? <a href="{{ route('login') }}" class="text-underline color-tertiary">Iniciar Sessão.</a>
                         </p>
					  </div>
				   </div>
				</div>
			 </div>
		  </div>
		  <div class="col-lg-6 d-lg-block d-none bg-primary p-0  overflow-hidden">
			 <img src="../../assets/images/auth/01.png" class="img-fluid gradient-main" alt="images" loading="lazy" >
		  </div>
	   </div>
	</section>
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
    
        @endsection
