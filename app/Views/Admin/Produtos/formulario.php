<div class="form-row">

    <div class="form-group col-md-8">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" name="nome" id="nome" value="<?= old('nome', esc($produto->nome)); ?>">
    </div>
    <div class="form-group col-md-4">
        <label for="categoria_id">Categoria:</label>

        <select class="custom-select" name="categoria_id">

            <option value="">Escolha a categoria</option>

            <?php foreach ($categorias as $categoria): ?>

            <!--verificando se estou editando ou cadastrando -->
            <?php if($produto->id): ?>

            <option value="<?= $categoria->id; ?>" <?= ($categoria->id == $produto->categoria_id ? 'selected' : ''); ?>>
                <?= esc($categoria->nome); ?></option>
            <?php else: ?>
            <option value="<?= $categoria->id; ?>"> <?= esc($categoria->nome); ?> </option>


            <?php endif; ?>

            <?php endforeach; ?>

        </select>

    </div>
    <div class="form-group col-md-12">
        <label for="ingredientes">Ingredientes:</label>
        <textarea class="form-control" name="ingredientes" id="ingredientes"
            rows="4"><?= old('ingredientes', esc($produto->ingredientes)); ?></textarea>

    </div>

</div>

<div class="form-group col-md-4">
    <label for="email">Ativo:</label>
    <select class="form-control" name="ativo">

        <?php if($produto->id): ?>

        <option value="1" <?= set_select('ativo', '1')?> <?= ($produto->ativo ? 'selected' : ''); ?>>Sim</option>
        <option value="0" <?= set_select('ativo', '0')?> <?= (!$produto->ativo ? 'selected' : ''); ?>>Não</option>


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