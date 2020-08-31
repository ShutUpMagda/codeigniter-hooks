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

namespace App\Libraries;

use App\Libraries\Ldap;

class LogonRules
{

  /**
   * Validates the Google API response reCAPTCHA;
   * @author Claudio Souza Jr. <claudio@uerr.edu.br>
   * @todo: remember to add this rule in FORM validation;
   * @uses \Config\Recapcha
   * @see \Config\validation
   * @see \App\Helpers\form_helper.php
   * @return Boolean 
   */
  function logon_validate_recaptcha(string $str, string &$error = null): bool
  {
    $req = service('request');
    $recaptcha = new \Config\Recaptcha;
    if ($req->getPost('g-recaptcha-response')) {
      $captcha_data = $req->getPost('g-recaptcha-response');
      $recaptcha_secret = $recaptcha->secret;
      $recaptcha_uri = $recaptcha->uri;
      $remote_addr = $req->getServer('REMOTE_ADDR');
      $resposta = json_decode(
        file_get_contents(
          "{$recaptcha_uri}?secret=" .
            $recaptcha_secret .
            "&response=" .
            $captcha_data .
            "&remoteip=" .
            $remote_addr
        )
      );
      if ($resposta->success === TRUE) {
        return TRUE;
      }
    }
    $error = lang('Errors.g-recaptcha-response');
    return FALSE;
  }
}
