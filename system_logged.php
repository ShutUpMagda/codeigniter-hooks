<?php

/* 
 *  2019 @author Claudio Souza Jr. <claudio@uerr.edu.br>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 Esta entrada deve ser adicionada em 'config/hooks.php' como um 'post_controller_constructor';
*/

/**
 * Faz a checagem de logon do usuário ativo com base na SESSION
 * @return void
 */
function logged() {
    $ci = & get_instance();//Instância do CodeIgniter
    $method = $ci->router->fetch_class().'/'.$ci->router->fetch_method();//Método atual
     //Métodos protegidos num array;
    $protegidos = [
        'sistema/clientes'
    ];
    $usuario_logado = $ci->session->userdata('usuario_logado');//Array gerado pelo seu algotitmo de "login" e gravado na SESSION
    if (in_array($method, $protegidos)) {//Verificando se o método é protegido
        if (!$usuario_logado[username]) {//Verificando se o usuário está logado
            $ci->session->set_flashdata('alert', 'Autentique-se, por favor!');//Aqui vc tb pode criar um aviso pro usuário saber o motivo do comportamento da aplicação
            $url = base_url('controller/method_de_logon');
            redirect($url);//usuário não logado direciona para a pagina de login
        }
    }
}