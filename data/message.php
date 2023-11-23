<?php

use animalsitter\Message;

list($params, $providers) = eQual::announce([
    'description'   => 'This is the animalsitter_message controller it retrieves messages.',
    'response'      => [
        'charset'       => 'utf-8',
        'accept-origin' => '*'
    ],
    'params'        => [
        'view_id' => [
            'description' => 'Message',
            'type' => 'string',
            'default' => 'list.default'
        ],
        "domain" => [
            "name"=> "domain",
            "description"=> "",
            "type"=> "array",
            "usage"=> "array/domain",
            "default"=> ["app_users_ids","contains","sender_id"],
         ]
    ],

    'access'        => [
        'visibility'    => 'protected',
        'groups'        => ['users']
    ],
    'providers'         => ['context', 'orm']
]);
/**
 * @var \equal\php\context  Context
 */
$context = $providers['context'];

$list = Message::search([])
        ->read(['name', 'responder_id',"sender_id", "id", "app_users_ids", "content"])
        ->adapt('json')
        ->get(true);

$context->httpResponse()
        ->body($list)
        ->status(200)
        ->send();