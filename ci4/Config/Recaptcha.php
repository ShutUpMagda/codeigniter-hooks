<?php

/* 
 * 2020 @author Claudio Souza Jr. <claudio@uerr.edu.br>
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

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Recaptcha extends BaseConfig
{
  public $field = 'g-recaptcha-response';
  public $sitekey = 'your_recaptcha_site_key';
  public $secret = 'your_recaptcha_secret_key';
  public $uri = 'https://www.google.com/recaptcha/api/siteverify';
  public $api = 'https://www.google.com/recaptcha/api.js';
}
