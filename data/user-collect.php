<?php
/*
    This file is part of the Discope property management software.
    Author: Yesbabylon SRL, 2020-2022
    License: GNU AGPL 3 license <http://www.gnu.org/licenses/>
*/

use equal\orm\Domain;

list($params, $providers) = eQual::announce([
    'description'   => 'Advanced search for Reports: returns a collection of Reports according to extra paramaters.',
    'extends'       => 'core_model_collect',
    'params'        => [
        'entity' =>  [
            'description'   => 'name',
            'type'          => 'string',
            'default'       => 'animalsitter\User'
        ],
        'city' => [
            'type'          => 'string',
            'description'   => 'User city.',
            'default'       => null
        ]
    ],
    'response'      => [
        'content-type'  => 'application/json',
        'charset'       => 'utf-8',
        'accept-origin' => '*'
    ],
    'providers'     => [ 'context', 'orm' ]
]);
/**
 * @var \equal\php\Context $context
 * @var \equal\orm\ObjectManager $orm
 */
list($context, $orm) = [ $providers['context'], $providers['orm'] ];

//   Add conditions to the domain to consider advanced parameters
$domain = $params['domain'];

if(isset($params['city']) && strlen($params['city']) > 0 ) {
    $domain = Domain::conditionAdd($domain, ['city', 'like','%'.$params['city'].'%']);
}

$params['domain'] = $domain;
$result = eQual::run('get', 'model_collect', $params, true); //always true, it return array.

$context->httpResponse()
        ->body($result)
        ->send();