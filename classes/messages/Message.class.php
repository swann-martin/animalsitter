<?php

namespace animalsitter\messages;

use equal\orm\Model;

/**
 * @property integer $sender Id of the sender.
 * @property integer $responder Id of the responder.
 * @property string $content Content of the message.
 * @property integer $user_id
 */
class Message extends Model
{
    public static function getColumns()
    {
        return [
            'sender' => [
                'type' => 'many2one',
                'description' => 'Id of the sender.',
                'foreign_object' => 'animalsitter\\User',
            ],
            'responder' => [
                'type' => 'many2one',
                'description' => 'Id of the responder.',
                'foreign_object' => 'animalsitter\\User',
            ],
            'content' => [
                'type' => 'string',
                'usage' => 'text/plain',
                'description' => 'Content of the message.',
            ],
            'user_id' => [
                'type' => 'many2one',
                'required' => true,
                'foreign_object' => 'animalsitter\\User',
                'ondelete' => 'cascade',
            ],
        ];
    }
}
