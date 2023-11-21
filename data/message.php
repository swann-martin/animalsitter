<?php

use animalsitter\messages\Message;

list($params, $providers) = eQual::announce([
    'description'   => 'This is the animalsitter_message controller created with core_config_create-controller.',
    'response'      => [
        'charset'       => 'utf-8',
        'accept-origin' => '*'
    ],
    'params'        => [],
    'access'        => [
        'visibility'    => 'protected',
        'groups'        => ['users']
    ],
    'providers'         => ['context']
]);
/**
 * @var \equal\php\context  Context
 */
$context = $providers['context'];

$list = Message::search([])
        ->read(['name', 'responder'])
        ->adapt('txt')
        ->get(true);

$context->httpResponse()
        ->status(200)
        ->send();