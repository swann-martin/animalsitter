<?php
use animalsitter\AppUser;

list($params, $providers) = eQual::announce([
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

$list = AppUser::search([])
        ->read(['id','name', 'email','city'])
        ->adapt('json')
        ->get(true);

$context->httpResponse()
        ->body($list)
        ->send();
