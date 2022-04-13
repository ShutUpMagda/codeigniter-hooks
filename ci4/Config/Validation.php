<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use App\Libraries\LogonRules;
use App\Libraries\Recaptcha;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        LogonRules::class,
        Recaptcha::class
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
    public $logon = [
        'login' => [
            'rules'  => 'required|min_length[11]|logon_validate_login',
            'errors' => [
				'required' => 'You must inform a CPF code.',
				'min_length' => 'The code must contain minimally 11 numbers.'
            ]
        ],
        'password'    => [
            'rules'  => 'required|min_length[8]',
            'errors' => [
				'min_length' => 'The password must contain minimally 8 digits.'
            ]
		],
		'g-recaptcha-response' => [
			'rules' => 'required|recaptcha_validate',
			'errors' => [
				'required' => 'You must check the reCAPTCHA textbox!'
			]
		]
	];
}
