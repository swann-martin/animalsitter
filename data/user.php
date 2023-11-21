<?php
use animalsitter\User;

list($params, $providers) = announce([
    'description'   => 'Retrieve the list of existing users',
    'params'        => [],
    'response'      => [
                        'content-type'  => 'application/json',
                        'charset'       => 'utf-8',
                        'accept-origin' => ['*']
                       ],
    'providers'     => ['context']
]);

list($context) = [ $providers['context'] ];

$list = User::search([])
        ->read(['id','name', 'email','city'])
        ->adapt('txt')
        ->get(true);

$context->httpResponse()
        ->body($list)
        ->send();
