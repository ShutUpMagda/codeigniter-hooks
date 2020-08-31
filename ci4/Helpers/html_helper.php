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

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Creates JavaScript variables to use in the application's global context;
 * @author Claudio Souza Jr. <claudio@uerr.edu.br>
 * @uses CodeIgniter Framework Version v4.0.4
 * @return String A string with variables to incorporate in the code;
 */
function html_get_js_vars()
{
  $app = new \Config\App();
  $vars = "<script type='text/javascript'>\n";
  $vars .= "var csrf_field_name = '" . csrf_token() . "';\n";
  $vars .= "var csrf_meta_name = '" . csrf_header() . "';\n";
  $vars .= "var csrf_cookie_name = '" . $app->cookiePrefix . $app->CSRFCookieName . "';\n";
  $vars .= "</script>\n";
  return $vars;
}

/**
 * Displays the validation error messages only when in an $_POST request;
 * @author Claudio Souza Jr. <claudio@uerr.edu.br>;
 * @param Object $listErrors Object with the errors list
 * @return string|boolean
 */
function html_show_validation_errors($listErrors)
{
  $request = service('request');
  $requestMethod = $request->getMethod();
  if ($requestMethod == 'post') {
    echo '<div class="alert alert-danger" role="alert">';
    echo $listErrors;
    echo '</div>';
  }
  return FALSE;
}

/**
 * Inserts metatags in the HTML document;
 * @author Claudio Souza Jr. <claudio@uerr.edu.br>;
 * @todo Create an ARRAY to manipulate these meta tags in the app conf so that they are dynamic and can be changed from a FORM;
 * @uses \Config\SystemInfo.php. You need to create this file;
 * @see https://codeigniter.com/user_guide/general/configuration.html?highlight=configuration#creating-configuration-files;
 * @return String
 */
function html_insert_metatags()
{
  $systemInfo = new \Config\SystemInfo();
  $metatags = "";
  $metatags .= "<meta charset='utf-8'>\n";
  $metatags .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>\n";
  $metatags .= "<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>\n";
  $metatags .= "<meta name='description' content='" . $systemInfo->siteDescription . "'>\n";
  $metatags .= "<meta name='keywords' content='" . $systemInfo->siteKeywords . "'>\n";
  $metatags .= "<meta name='author' content='" . $systemInfo->siteAuthor . "'>\n";
  $metatags .= csrf_meta();
  $metatags .= "\n";
  return $metatags;
}
