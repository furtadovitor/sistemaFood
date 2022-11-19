<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Throwable;

class Migrate extends Controller
{
    public function index()
    {
        
        $migrate = \Config\Services::migrations();

        try {
            $migrate->latest();

            echo 'Dados Migrados';

        } catch (Throwable $e) {

            echo $e->getMessage();
        }
    }
}