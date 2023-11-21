<?php

namespace animalsitter;

use equal\orm\Model;

/**
 * @property string $name User name.
 * @property string $avatar User's picture.
 * @property string $city User city.
 * @property array $animals_ids
 * @property array $messages_ids
 * @property boolean $ispetsitter True if the user offers to babysit an animal.
 */
class User extends Model
{
    public static function getColumns()
    {
        return [
            'name' => [
                'usage' => '',
                'type' => 'string',
                'description' => 'User name.',
                'required' => true,
                'unique' => true,
            ],
            'avatar' => [
                'type' => 'string',
                'usage' => 'url',
                'description' => 'User\'s picture.',
                'default' => 'https://randomuser.me/api/portraits/lego/1.jpg',
            ],
            'city' => [
                'usage' => '',
                'type' => 'string',
                'description' => 'User city.',
            ],
            'animals_ids' => [
                'type' => 'one2many',
                'foreign_object' => 'animalsitter\\animal\\Animal',
                'foreign_field' => 'user_id',
                'sort' => 'asc',
            ],
            'messages_ids' => [
                'type' => 'one2many',
                'foreign_object' => 'animalsitter\\messages\\Message',
                'foreign_field' => 'user_id',
                'sort' => 'asc',
            ],
            'ispetsitter' => [
                'default' => false,
                'description' => 'True if the user offers to babysit an animal.',
                'type' => 'boolean'
            ],
        ];
    }

    // public static function hasPet($self)
    // {
    //     $result = [];
    //     $self->read(['animals_ids']);
    //     foreach ($self as $index => $user) {
    //         $result[$index] = count($user['animals_ids']) > 0;
    //     }
    //     return $result;
    // }
}
