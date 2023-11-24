<?php

namespace animalsitter;

use equal\orm\Model;

/**
 * @property string $name User name.
 * @property string $avatar User's picture.
 * @property string $city User city.
 * @property array $animals_ids
 * @property array $messages_ids
 * @property boolean $is_pet_sitter True if the user offers to babysit an animal.
 */
class AppUser extends Model
{
    public static function getColumns()
    {
        return [
            'name' => [
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
                'type' => 'string',
                'description' => 'User city.',
            ],
            'animals_ids' => [
                'type' => 'one2many',
                'foreign_object' => 'animalsitter\\animal\\Animal',
                'foreign_field' => 'app_user_id',
                'sort' => 'asc',
            ],
            'messages_ids' => [
                'type' => 'many2many',
                'foreign_object' => 'animalsitter\\Message',
                'foreign_field' => 'app_users_ids',
                'rel_table' => 'animal_rel_messages_app_users',
                'rel_local_key' => 'app_user_id',
                'rel_foreign_key' => 'message_id',
            ],
            'is_pet_sitter' => [
                'default' => false,
                'type' => 'boolean',
                'description' => 'True if the user offers to babysit an animal.',
            ],
            'sittings_ids' => [
                'type' => 'one2many',
                'description' => 'Relation between sitters and sitting.',
                'foreign_object' => 'animalsitter\\Sitting',
                'foreign_field' => 'sitter_id',
            ],
            'sent_messages_ids' => [
                'type' => 'one2many',
                'description' => 'Messages sent by the user.',
                'foreign_object' => 'animalsitter\\Message',
                'foreign_field' => 'sender_id'
            ],
            'received_messages_ids' => [
                'type' => 'one2many',
                'description' => 'Messages received by the user.',
                'foreign_object' => 'animalsitter\\Message',
                'foreign_field' => 'responder_id'
            ],
        ];
    }
}
