<?php

namespace App\Libraries;

class LogonRules
{

    private $request;

    function __construct()
    {
        $this->request = service('request');
    }

    /**
     * Checks the string informed as login
     * @param string $str
     * @return Boolean 
     */
    public function logon_validate_login(string $str, string &$error = null): bool
    {
        $login = $this->request->getPost('login');
        $validates_login_function = validates_login_function($login);

        if (FALSE == $validates_login_function) {
            $error = lang('Errors.invalid_user');
            return FALSE;
        }

        return TRUE;

    }

    /**
     * Checks if the password is valid;
     * @return Boolean 
     */
    public function logon_validate_password(string $str, string &$error = null): bool
    {
        $password = $this->request->getPost('password');
        
        if (FALSE == function_to_test_password($password)) {
            $error = lang('Errors.invalid_password');
            return FALSE;
        }
        
        return TRUE;
    }
}
