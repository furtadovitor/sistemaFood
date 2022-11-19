<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Pedido extends Entity
{
    protected $datamap = [];
    protected $dates   = ['criado_em', 'atualizado_em', 'deletado_em'];
    protected $casts   = [];

    public function exibeSituacaoPedido(){

        switch($this->situacao){
            case 0:

                echo "<i class='fa fa-thumbs-up' aria-hidden='true'></i>&nbsp; Pedido realizado";

                break;

            case 1:

                echo "<i class='fa fa-motorcycle' aria-hidden='true'></i>&nbsp; Saiu para entrega";
    
                break;

            case 2:

                echo "<i class='fa fa-money' aria-hidden='true'></i>&nbsp; Pedido entregue";
        
                break; 
                
            case 3:

                echo "<i class='fa fa-thumbs-down' aria-hidden='true'></i>&nbsp; Pedido cancelado";
            
                break; 

           
        }
        

    }

}

  