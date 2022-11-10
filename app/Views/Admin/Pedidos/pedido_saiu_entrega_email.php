<h1>Uhuuuuuul, o seu pedido<?php echo $pedido->codigo ?> saiu para entrega</h1>

<p>Olá <strong><?php esc($pedido->nome); ?>, o seu pedido <?php echo $pedido->codigo ?> saiu para entrega, logo ele chegará e você irá poder se deliciar com toda gostosura.</strong> no link abaixo para ativação da conta.</p>
<p>A forma de pagamento na entrega é <strong><?php echo esc($pedido->forma_pagamento); ?></strong></p>
<p>Ele será entregue no endereço:<strong><?php echo esc($pedido->endereco_entrega); ?></strong></p>
<p>Observações do pedido: <strong><?php echo esc($pedido->observacoes); ?></strong></p>
<hr>
<p>O <strong><?php echo esc($pedido->entregador->nome); ?></strong> será o responsável para a sua entrega.</p>

<hr>
<p>Se puder, compartilhar os protudos no instagram e nos marcar, ficaremos muito felizes. <strong><?php echo esc($pedido->entregador->nome); ?></strong> será o responsável para a sua entrega.</p>

<p><strong>@braseironobre</strong></p>
<p>

Aproveite para ver os seus 
    <a href="<?php echo site_url('conta'); ?>"> pedidos </a>
</p>