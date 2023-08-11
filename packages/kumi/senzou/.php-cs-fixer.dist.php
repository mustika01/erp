<?php

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP80Migration' => true,
        '@PHP81Migration' => true,
        '@PHP82Migration' => true,
        '@PER' => true,
        '@PER:risky' => true,
        '@PSR12' => true,
        '@PSR12:risky' => true,
        '@PhpCsFixer' => true,

        'concat_space' => [
            'spacing' => 'one',
        ],

        'increment_style' => [
            'style' => 'post',
        ],

        'php_unit_method_casing' => [
            'case' => 'snake_case',
        ],

        'yoda_style' => [
            'equal' => false,
            'identical' => false,
        ],

        'no_alias_functions' => true, // !!! risky
        'not_operator_with_successor_space' => true,
        'php_unit_test_class_requires_covers' => false,
        'psr_autoloading' => true, // !!! risky
        'self_accessor' => true, // !!! risky
        'simplified_null_return' => true,
    ])
;
