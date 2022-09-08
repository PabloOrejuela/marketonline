<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig{
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
    public $login = [
        'user'  => 'required',
        'password'   => 'required',
    ];

    public $login_errors = [
        'user' => [
            'required' => 'El campo "Usuario" es obligatorio',
        ],
        'password' => [
            'required' => 'El campo "Contraseña" es obligatorio',
        ]
    ];

    public $registro_influencer = [
        'nombre'  => 'required',
        'cedula'   => 'required|min_length[10]',
        'email'   => 'required|valid_email',
        'telefono'   => 'required|min_length[8]',
        'pais'   => 'required',
    ];

    public $registro_influencer_errors = [
        'nombre' => [
            'required' => 'El campo {field} es obligatorio',
        ],
        'cedula' => [
            'required' => 'El campo {field} es obligatorio',
            'min_length' => 'El campo {field} debe tener al menos 10 digitos',
        ],
        'email' => [
            'required' => 'El campo {field} es obligatorio',
            'valid_email' => 'El campo {field} debe ser un email válido',
        ],
        'telefono' => [
            'required' => 'El campo {field} es obligatorio',
            'min_length' => 'El campo {field} debe tener al menos 10 digitos',
        ],
        'pais' => [
            'required' => 'El campo {field} es obligatorio',
        ]
    ];
}
