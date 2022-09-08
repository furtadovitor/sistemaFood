    
    <div class="form-row">

      <div class="form-group col-md-4">
          <label for="nome">Nome:</label>
          <input type="text" class="form-control" name="nome" id="nome" value="<?= old('nome', esc($usuario->nome)); ?>" >     
      </div>

      <div class="form-group col-md-2">
          <label for="cpf">CPF:</label>
          <input type="text" class="form-control cpf" name="cpf" id="cpf" value="<?= old('cpf', esc($usuario->cpf)); ?>" >     
      </div>

      <div class="form-group col-md-3">
          <label for="telefone">Telefone:</label>
          <input type="text" class="form-control sp_celphones" name="telefone" id="telefone" placeholder="telefone" value="<?= old('telefone',esc($usuario->telefone)); ?>">
        
      </div>

      <div class="form-group col-md-3">
          <label for="email">E-mail:</label>
          <input type="text" class="form-control" name="email" id="email" value="<?= old('email', esc($usuario->email)); ?>" >     
      </div>


    </div>
    
    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="password" class="col-sm-3 col-form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
        </div>

        <div class="form-group col-md-6">
            <label for="confirmPassword" class="col-sm-3 col-form-label">Confirmação de senha:</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirme sua senha">
        </div>

        <div class="form-group col-md-3">
          <label for="email">Perfil de Acesso:</label>
            <select class="form-control" name="is_admin">
                
            <?php if($usuario->id): ?>

                <option value="1" <?= ($usuario->is_admin ? 'selected' : ''); ?> <?= set_select('is_admin', '1')?>>Administrador</option>
                <option value="0" <?= (!$usuario->is_admin ? 'selected' : ''); ?> <?= set_select('is_admin', '0')?>>Cliente</option>


            <?php else: ?>

                <option value="1" <?= set_select('is_admin', '1')?>>Administrador</option>
                <option value="0" <?= set_select('is_admin', '0')?> selected="">Cliente</option>

            <?php endif; ?>


            </select>

      </div>

        <div class="form-group col-md-3">
          <label for="email">Ativo:</label>
            <select class="form-control" name="ativo">
                
            <?php if($usuario->id): ?>

                <option value="1" <?= set_select('ativo', '1')?> <?= ($usuario->ativo ? 'selected' : ''); ?> >Sim</option>
                <option value="0" <?= set_select('ativo', '0')?> <?= (!$usuario->ativo ? 'selected' : ''); ?> >Não</option>


            <?php else: ?>

                <option value="1" <?= set_select('ativo', '1')?>>Sim</option>
                <option value="0" <?= set_select('ativo', '0')?>selected="">Não</option>

            <?php endif; ?>


            </select>

      </div>

      



    </div>
   
  

    <button type="submit" class="btn btn-primary mr-2 btn-sm">
    <i class="mdi mdi-check btn-icon-prepend"></i>
        Salvar
    </button>

  