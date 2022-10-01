<?php 

if(!function_exists('consultaCep')){

    function consultaCep(string $cep){

        $urlViaCep = "viacep.com.br/ws/{$cep}/json/";

        /* Abre a conexão */
        $ch = curl_init();


        /* Definindo a URL */
        curl_setopt($ch, CURLOPT_URL, $urlViaCep);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        /* Executando o POST */
        $json = curl_exec($ch);

        /* Decodificando o objeto $json */
        

        $resultado = json_decode($json);


        /* Fechando a conexão */
        return $resultado;
        




    }
}