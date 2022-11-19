<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Throwable;

class Seed extends BaseController
{
    public function index()
    {
        
       $seeder = \Config\Database::seeder();

       $seeder->call('UsuarioSeeder');
       $seeder->call('ExpedienteSeeder');
       $seeder->call('FormasPagamentoSeeder');

       echo 'Semeado';



    }
}