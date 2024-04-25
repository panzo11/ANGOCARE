
<div class="container">
    
<div class="row">
<div class="form-group col-md-12">
    <label for="inputState">Nivel de acesso</label>
    <select id="vc_tipo_utilizador" class="form-control" name="vc_tipo_utilizador" style="width: 100%;" >
      <option name="vc_tipo_utilizador" value="1">Doador</option>
        <option name="vc_tipo_utilizador" value="4">Empresa</option>
        <!-- <option name="vc_tipo_utilizador" value="4">Necessitado</option> -->
        <option name="vc_tipo_utilizador" value="3">centro de caridade</option>
    </select>
  </div>
 <div class="form-group col-md-6">
    <label for="vc_path">Nome</label>
       <input type="text" id="name" class="form-control" name="name"
           placeholder="Sub-Categoria" value="{{ isset($user->name) ? $user->name : "" }}">
           @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
         @endif

 </div>
 <div class="form-group col-md-6">
    <label for="vc_path">Telefone</label>
       <input type="text" id="email" class="form-control" name="email"
           placeholder="Sub-Categoria" value="{{ isset($user->email) ? $user->email : "" }}">

 </div>

 <div class="form-group col-md-6">
    <label for="vc_path">Email</label>
       <input type="email" id="email" class="form-control" name="email"
           placeholder="Sub-Categoria" value="{{ isset($user->email) ? $user->email : "" }}">

 </div>
 <div class="form-group col-md-6">
    <label for="vc_path">Password</label>
       <input type="password" id="password" class="form-control" name="password"
           placeholder="Sub-Categoria" >

 </div>
 <div class="form-group col-md-6">
    <label for="vc_path">Confirmar Password</label>
       <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
           placeholder="Sub-Categoria" >
 </div>

 
 <div class="form-group col-md-6 ">

       <label for="vc_path">Imagem</label>
        <input type="file" id="vc_path" class="form-control" name="vc_path"
            placeholder="vc_path" value="{{ isset($galeria->vc_path) ? $galeria->vc_path : "" }}">
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
                        </div>
                    </div>



