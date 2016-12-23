<?php
$config = new \Symfony\CS\Config\Config('Fury Coding Standard', '');

return $config
    ->level(\Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers(
        [
            'concat_with_spaces',
            'ordered_use',
            'phpdoc_order',
            'short_array_syntax',
            'no_blank_lines_before_namespace',
            '-empty_return',
            '-phpdoc_params',
            '-pre_increment',
            '-single_blank_line_before_namespace',
        ]
    )
    ->setUsingCache(true)
    ->setUsingLinter(false)
    ->finder(
        Symfony\CS\Finder\DefaultFinder::create()
            ->in(__DIR__ . '/src')
            ->in(__DIR__ . '/tests')
    );
