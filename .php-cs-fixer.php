<?php
$finder = PhpCsFixer\Finder::create()
    ->exclude(['bootstrap', 'database', 'node_modules', 'public', 'storage', 'tests', 'vendor'])
    ->notPath('*')
    ->in(__DIR__)
;

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder);
