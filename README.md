# CodeIgniter Scripts

Useful PHP scripts for applications using CodeIgniter

## Google reCAPTCHA API module for CodeIgniter 4

### Dependencies and logic

1. **\App\Config\Recaptcha:** Contains the Google reCAPTCHA keys and other information needed;
2. **\Libraries\LogonRules:** Implements the ‘logon_validate_recaptcha()’ method, witch does a field ‘g-recaptcha-response’ validation according to API rules and returns TRUE or FALSE;
3. **\App\Helpers\form_helper:** Implements the ‘form_fields_recaptcha()’ method, witch loads the field ‘g-recaptcha-respose’ to the FORM;
4. **\App\Config\Validation:** Forces the field ‘g-recaptcha-response’ to be required, and does effectively validation using ‘logon_validate_recaptcha()’;
5. **\App\Language\en\Errors:** Contains the error message indexed as ‘g-recaptcha-response’, witch is shown when the validation does not work;
