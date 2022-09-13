<div class="form-row">

<div class="form-group col-md-6">
    <label for="nome">Nome:</label>
    <input type="text" class="form-control" name="nome" id="nome"
        value="<?= old('nome', esc($extra->nome)); ?>">
</div>
<div class="form-group col-md-6">
    <label for="preco">Preço de venda:</label>
    <input type="text" class="money form-control" name="preco" id="preco"
        value="<?= old('preco', esc($extra->preco)); ?>">
</div>
<div class="form-group col-md-12">
    <label for="descricao">Descrição:</label>
    <textarea class="form-control" name="descricao" id="descricao" rows="4"><?= old('descricao', esc($extra->descricao)); ?></textarea>

</div>

</div>

<div class="form-group col-md-4">
<label for="email">Ativo:</label>
<select class="form-control" name="ativo">

    <?php if($extra->id): ?>

    <option value="1" <?= set_select('ativo', '1')?> <?= ($extra->ativo ? 'selected' : ''); ?>>Sim</option>
    <option value="0" <?= set_select('ativo', '0')?> <?= (!$extra->ativo ? 'selected' : ''); ?>>Não</option>


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