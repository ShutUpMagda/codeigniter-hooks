<?php

/* 
 * 2022 @author Claudio Souza Jr. <claudio@uerr.edu.br>
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

/**
 * Implements Google reCaptcha in CI4
 */
class Recaptcha
{
    private $req;
    private $secret = 'your-private-key';
    public $sitekey = 'your-public-key';
    public $field = 'g-recaptcha-response';
    public $uri = 'https://www.google.com/recaptcha/api/siteverify';
    public $api = 'https://www.google.com/recaptcha/api.js';
    public $curl;
    public $g_recaptcha_response;
    public $response;
    public $remoteip;

    function __construct()
    {
        $this->curl = curl_init();
        $this->req = service('request');
    }

    /**
     * Returns a string with the appropriate fields for Google reCAPTCHA;
     * @author Claudio Souza Jr. <claudio@uerr.edu.br>
     * @return String
     */
    public function recaptcha_form_fields()
    {
        $field = '<div class="form-group">';
        $field .= "<script src='" . $this->api . "' charset='UTF-8'></script>\n";
        $field .= '<label class="sr-only" for="g-recaptcha">&nbsp;</label>';
        $field .= '<div class="g-recaptcha" data-sitekey="' . $this->sitekey . '"></div>';
        $field .= '</div>';
        return $field;
    }

    /**
     * Validates the Google reCAPTCHA API response;
     * OBS: remember to add this rule in FORM validation;
     * @see https://codeigniter.com/user_guide/libraries/validation.html?highlight=validation#creating-custom-rules
     * @author Claudio Souza Jr. <claudio@uerr.edu.br>
     * @return Boolean 
     */
    function recaptcha_validate(string $str, string &$error = null): bool
    {
        if ($this->req->getPost('g-recaptcha-response')) {
            $this->g_recaptcha_response = $this->req->getPost('g-recaptcha-response');
            $this->remoteip = $this->req->getServer('REMOTE_ADDR');
            curl_setopt_array(
                $this->curl, [
                    CURLOPT_URL => $this->uri,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => [
                        'secret' => $this->secret,
                        'response' => $this->g_recaptcha_response,
                        'remoteip' => $this->remoteip
                    ]
                ]
            );
            $this->response = json_decode(curl_exec($this->curl));
            curl_close($this->curl);
            if ($this->response->success === TRUE) {
                return TRUE;
            }
        }
        $error = lang('Errors.g-recaptcha-response');
        return FALSE;
    }
}
