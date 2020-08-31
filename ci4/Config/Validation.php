<?php

namespace Config;

class Validation
{
  //--------------------------------------------------------------------
  // Setup
  //--------------------------------------------------------------------

  /**
   * Stores the classes that contain the
   * rules that are available.
   *
   * @var array
   */
  public $ruleSets = [
    \CodeIgniter\Validation\Rules::class,
    \CodeIgniter\Validation\FormatRules::class,
    \CodeIgniter\Validation\FileRules::class,
    \CodeIgniter\Validation\CreditCardRules::class,
    \App\Libraries\LogonRules::class
  ];

  /**
   * Specifies the views that are used to display the
   * errors.
   *
   * @var array
   */
  public $templates = [
    'list'   => 'CodeIgniter\Validation\Views\list',
    'single' => 'CodeIgniter\Validation\Views\single',
  ];

  //--------------------------------------------------------------------
  // Rules
  //--------------------------------------------------------------------

  public $formLogon = [
    'cpf' => [
      'rules'  => 'required|min_length[11]|logon_validate_cpf',
      'errors' => [
        'required' => 'You must inform a CPF code.',
        'min_length' => 'The code must contain minimally 11 numbers.'
      ]
    ],
    'password'    => [
      'rules'  => 'required|min_length[8]|logon_validate_password',
      'errors' => [
        'min_length' => 'The password must contain minimally 8 digits.'
      ]
    ],
    'g-recaptcha-response' => [
      'rules' => 'required|logon_validate_recaptcha',
      'errors' => [
        'required' => 'You must check the reCAPTCHA textbox!'
      ]
    ]
  ];
}
