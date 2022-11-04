<h5>Pedido <?php echo esc($pedido->codigo) ?>, realizado com sucesso.!!</h1>

<p>Olá <strong><?php esc($pedido->usuario->nome); ?></strong>, recebemos o seu pedido: <?php echo esc($pedido->codigo) ?></p>

<p>Nossa cozinha já está com a mão na massa para acelerar o processo e torná-lo especial.</p>
<p>Assim que o pedido sair, iremos avisar por e-mail, ok?</p>

<p>
   Enquanto isso, <a href="<?php echo site_url('conta');?>">Clique aqui para ver o andamento dos pedidos.</a>
</p>