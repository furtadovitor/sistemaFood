    <div class="form-row">

        <div class="form-group col-md-4">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome"
                value="<?= old('nome', esc($categoria->nome)); ?>">
        </div>


    </div>



    <div class="form-group col-md-3">
        <label for="email">Ativo:</label>
        <select class="form-control" name="ativo">

            <?php if($categoria->id): ?>

            <option value="1" <?= set_select('ativo', '1')?> <?= ($categoria->ativo ? 'selected' : ''); ?>>Sim</option>
            <option value="0" <?= set_select('ativo', '0')?> <?= (!$categoria->ativo ? 'selected' : ''); ?>>Não</option>


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
    
    <a href="<?= site_url("admin/categorias/show/$categoria->id"); ?>" class="btn btn-info btn-sm mr-2">
        <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
        Voltar
    </a>


    </div>