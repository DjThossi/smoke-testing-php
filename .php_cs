<?php

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules(array(
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'combine_consecutive_unsets' => true,
        'array_syntax' => array('syntax' => 'short'),
        'no_extra_consecutive_blank_lines' => array('break', 'continue', 'extra', 'return', 'throw', 'use', 'parenthesis_brace_block', 'square_brace_block', 'curly_brace_block'),
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_class_elements' => true,
        'ordered_imports' => true,
        'php_unit_strict' => false,
        'phpdoc_add_missing_param_annotation' => true,
        'psr4' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'single_blank_line_before_namespace' => false,
        'no_blank_lines_before_namespace' => true,
        'phpdoc_align' => false,
        'pre_increment' => false,
        'phpdoc_order' => true,
        'concat_space' => ['spacing' => 'one'],
    ))
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__ . '/src')
            ->in(__DIR__ . '/tests')
    )
;