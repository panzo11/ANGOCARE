
<div class="container">
    <div class="row">
       <!-- Campos adicionados -->
       <div class="form-group col-md-6">
        <label for="titulo">Titulo</label>
        <input type="text" id="titulo" class="form-control" name="titulo" placeholder="titulo"
            value="{{ isset($produto->titulo) ? $produto->titulo : '' }}">
    </div>
   
        
     
        
        <div class="form-group col-md-6">
            <label for="categoria">Categoria</label>
            <select class="form-select mb-3 shadow-none" name="categoria">
            <option selected disabled>Selecione a categoria</option>
                <option value="Alimentação">Alimentação</option>
                <option value="Saúde">Saúde</option>
                <option value="Educação">Educação</option>
                <option value="Materias de Ajuda humanitária">Materias de Ajuda humanitária</option>
                <option value="Outros">Outros</option>
            </select>
        </div>
      
        
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label fw-semibold">Usuário Responsável*</label>
                <select class="form-select mb-3 shadow-none" name="users_id">
                    @if(Auth::user()->it_tipo_utilizador==0)
                    <option selected disabled>Selecione o usuário responsável</option>
                    @endif
                    <!-- Incluir opções dinamicamente com dados de usuários -->
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('users_id') == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-group col-md-6">
            <label for="capa">Foto de Capa</label>
            <input type="file" id="capa" class="form-control" name="capa" placeholder="capa"
                value="{{ isset($produto->capa) ? $produto->capa : '' }}">
        </div>
        <div class="form-group col-md-6">
            <label for="produtos">Produtos</label>
            {{-- <input type="text" id="produtos" class="form-control" name="produtos" placeholder="produtos1, produto2, produto3"
                value="{{ isset($produto->produtos) ? $produto->produtos : '' }}"> --}}

                <textarea   name="produtos" cols="30" rows="5" class="form-control" placeholder="Produto : Quantidade">{{ old('motivo') }}</textarea>
            
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label fw-semibold">Descrição*</label>
                <textarea  id="summernote" name="motivo" placeholder="Digite a descrição da organização">{{ old('motivo') }} </textarea>
            </div>
        </div>
    </div>
</div>
