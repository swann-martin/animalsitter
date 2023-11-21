<?php
use animalsitter\animal\Animal;

list($params, $providers) = announce([
    'description'   => 'Retrieve the list of existing animals',
    'params'        => [],
    'response'      => [
                        'content-type'  => 'application/json',
                        'charset'       => 'utf-8',
                        'accept-origin' => ['*']
                       ],
    'providers'     => ['context']
]);

list($context) = [ $providers['context'] ];

$list = Animal::search([])
        ->read(['id','name', 'age', 'description', 'user_id'])
        ->adapt('txt')
        ->get(true);

$context->httpResponse()
        ->body($list)
        ->send();
