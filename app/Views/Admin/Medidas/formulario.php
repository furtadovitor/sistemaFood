<div class="form-row">

<div class="form-group col-md-12">
    <label for="nome">Nome:</label>
    <input type="text" class="form-control" name="nome" id="nome"
        value="<?= old('nome', esc($medida->nome)); ?>">
</div>

<div class="form-group col-md-12">
    <label for="descricao">Descrição:</label>
    <textarea class="form-control" name="descricao" id="descricao" rows="4"><?= old('descricao', esc($medida->descricao)); ?></textarea>

</div>

</div>

<div class="form-group col-md-4">
<label for="email">Ativo:</label>
<select class="form-control" name="ativo">

    <?php if($medida->id): ?>

    <option value="1" <?= set_select('ativo', '1')?> <?= ($medida->ativo ? 'selected' : ''); ?>>Sim</option>
    <option value="0" <?= set_select('ativo', '0')?> <?= (!$medida->ativo ? 'selected' : ''); ?>>Não</option>


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