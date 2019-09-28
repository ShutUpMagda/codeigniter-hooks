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

/**
 * Captura os methods de todos os controllers do sistema e armazena num objeto/item de configuração;
 * @author Claudio Souza Jr. <claudio@uerr.edu.br>;
 * @uses CodeIgniter Framework Version 3.1.11;
 * @return object|void
 */

 /*
   Esta entrada deve ser adicionada em 'config/hooks.php':
   $hook['post_controller_constructor'][] = array(
       'function' => 'controllers_methods',
       'filename' => 'controllers_methods.php',
       'filepath' => 'hooks'
   );
  */
function controllers_methods() {
    # Variáveis de configuração;
    $ci = & get_instance();
    $dir = APPPATH . "controllers/";
    $iteractor = new DirectoryIterator($dir);
    $ext = ['php'];
    $resp = [];
    # Criando o ARRAY com todos os controladores e métodos
    foreach ($iteractor as $entry) {
        if ($entry->isFile()) {
            if (in_array($entry->getExtension(), $ext)) {
                $filepath = $dir . $entry->getFilename();
                include_once $filepath;
                $entry_name = strtolower(
                    str_replace('.php', '', $entry->getFilename())
                );
                $resp[$entry_name] = get_class_methods($entry_name);
            }
        }
    }
    # Declaração dos itens de configuração para o sistema;
    $ci->config->set_item('methods', $resp);
    # Remova o comentário para ver o objeto com todos os methods;
    //print_r($ci->config->item('methods'));
}