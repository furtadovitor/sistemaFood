    <div class="form-row">

        <div class="form-group col-md-5">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome"
                value="<?= old('nome', esc($entregador->nome)); ?>">
        </div>

        <div class="form-group col-md-3">
            <label for="cnh">CNH:</label>
            <input type="text" class="form-control cnh" name="cnh" id="cnh"
                value="<?= old('cnh', esc($entregador->cnh)); ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control cpf" name="cpf" id="cpf"
                value="<?= old('cpf', esc($entregador->cpf)); ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="telefone">Telefone:</label>
            <input type="text" class="form-control sp_celphones" name="telefone" id="telefone" placeholder="telefone"
                value="<?= old('telefone',esc($entregador->telefone)); ?>">

        </div>

        <div class="form-group col-md-5">
            <label for="email">E-mail:</label>
            <input type="text" class="form-control" name="email" id="email"
                value="<?= old('email', esc($entregador->email)); ?>">
        </div>


        <div class="form-group col-md-4">
            <label for="veiculo">Veículo:</label>
            <input type="text" class="form-control" name="veiculo" id="veiculo" placeholder="veiculo"
                value="<?= old('veiculo',esc($entregador->veiculo)); ?>">

        </div>

        <div class="form-group col-md-3">
            <label for="placa">Placa:</label>
            <input type="text" class="form-control placa" name="placa" id="placa" placeholder="placa"
                value="<?= old('placa',esc($entregador->placa)); ?>">

        </div>

        <div class="form-group col-md-12">
            <label for="endereco">Endereço:</label>
            <input type="text" class="form-control" name="endereco" id="endereco" placeholder="endereco"
                value="<?= old('endereco',esc($entregador->endereco)); ?>">

        </div>

      

    </div>






    <div class="form-group col-md-3">
        <label for="email">Ativo:</label>
        <select class="form-control" name="ativo">

            <?php if($entregador->id): ?>

            <option value="1" <?= set_select('ativo', '1')?> <?= ($entregador->ativo ? 'selected' : ''); ?>>Sim</option>
            <option value="0" <?= set_select('ativo', '0')?> <?= (!$entregador->ativo ? 'selected' : ''); ?>>Não
            </option>


            <?php else: ?>

            <option value="1" <?= set_select('ativo', '1')?>>Sim</option>
            <option value="0" <?= set_select('ativo', '0')?>selected="">Não</option>

            <?php endif; ?>


        </select>







    </div>



    <button type="submit" class="btn btn-primary mr-2 btn-sm">
        <i class="mdi mdi-check btn-icon-prepend"></i>
        Salvar
    </button>