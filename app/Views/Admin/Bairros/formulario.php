<div class="form-row">

    <?php if(!$bairro->id) : ?>

    <div class="form-group col-md-4">
        <label for="cep">Nome</label>
        <input type="text" class="cep form-control" name="cep" value="<?= old('cep', esc($bairro->nome)); ?>">
        <div id="cep"></div>
   
    </div>

    <?php endif; ?>

    <div class="form-group col-md-4">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" value="<?= old('nome', esc($bairro->nome)); ?>" readonly="">
    </div>

    <div class="form-group col-md-4">
        <label for="cidade">Cidade</label>
        <input type="text" class="form-control" name="cidade" id="cidade" value="<?= old('cidade', esc($bairro->cidade)); ?>" readonly="">
    </div>

    <?php if(!$bairro->id) : ?>

    <div class="form-group col-md-3">
        <label for="estado">Estado</label>
        <input type="text" class="uf form-control" name="estado" id="estado" readonly="">
    </div>

    <?php endif; ?>



    <div class="form-group col-md-3">
        <label for="valor_entrega">Valor de entrega</label>
        <input type="text" class="money form-control" name="valor_entrega" id="valor_entrega"
            value="<?= old('valor_entrega', esc(number_format($bairro->valor_entrega,2))); ?>">
    </div>
 
</div>

<div class="form-group col-md-4">
    <label for="email">Ativo:</label>
    <select class="form-control" name="ativo">

        <?php if($bairro->id): ?>

        <option value="1" <?= set_select('ativo', '1')?> <?= ($bairro->ativo ? 'selected' : ''); ?>>Sim</option>
        <option value="0" <?= set_select('ativo', '0')?> <?= (!$bairro->ativo ? 'selected' : ''); ?>>Não</option>


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