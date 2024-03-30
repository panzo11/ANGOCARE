
<div class="container">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" class="form-control" name="titulo" placeholder="titulo"
                value="{{ isset($financiamento->titulo) ? $financiamento->titulo : '' }}">
        </div>
       <!-- Campos adicionados -->
        <div class="form-group col-md-6">
            <label for="valores">Valores</label>
            <input type="text" id="valores" class="form-control" name="valores" placeholder="Valores"
                value="{{ isset($financiamento->valores) ? $financiamento->valores : '' }}">
        </div>
        
   
        
        <div class="form-group col-md-6">
            <label for="categoria">Categoria</label>
            <input type="text" id="categoria" class="form-control" name="categoria" placeholder="Categoria"
                value="{{ isset($financiamento->categoria) ? $financiamento->categoria : '' }}">
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label fw-semibold">Usuário Responsável*</label>
                <select class="form-select mb-3 shadow-none" name="users_id">
                    <option selected disabled>Selecione o usuário responsável</option>
                    <!-- Incluir opções dinamicamente com dados de usuários -->
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('users_id') == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="capa">Capa</label>
            <input type="file" id="capa" class="form-control" name="capa" placeholder="capa"
                value="{{ isset($financiamento->capa) ? $financiamento->capa : '' }}">
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label fw-semibold">Descrição*</label>
                <textarea  id="summernote" name="motivo" placeholder="Digite a descrição da organização">{{ old('motivo') }} </textarea>
            </div>
        </div>
    </div>
</div>
