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

/**
 * Returns a string with the appropriate fields for Google reCAPTCHA;
 * @author Claudio Souza Jr. <claudio@uerr.edu.br>
 * @todo You should print this result in a form as a form-group, as specified in bootstrap CSS documentation;
 * @uses https://getbootstrap.com/docs/4.5/components/forms/#form-groups;
 * @return String A Bootstrap "form-group" component to print in the HTML document;
 */
function form_fields_recaptcha()
{
  $recaptcha = new \Config\Recaptcha;
  $field = '<div class="form-group">';
  $field .= "<script src='" . $recaptcha->api . "' charset='UTF-8'></script>\n";
  $field .= '<label class="sr-only" for="g-recaptcha">&nbsp;</label>';
  $field .= '<div class="g-recaptcha" data-sitekey="' . $recaptcha->sitekey . '"></div>';
  $field .= '</div>';
  return $field;
}
