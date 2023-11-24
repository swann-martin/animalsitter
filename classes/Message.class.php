<?php

namespace animalsitter;

use equal\orm\Model;

/**
 * @property integer $sender Id of the sender.
 * @property integer $responder Id of the responder.
 * @property string $content Content of the message.
 * @property array $user_id
 */
class Message extends Model
{
    public static function getColumns()
    {
        return [
            'sender_id' => [
                'type' => 'many2one',
                'description' => 'Id of the sender.',
                'foreign_object' => 'animalsitter\\AppUser'
            ],
            'responder_id' => [
                'type' => 'many2one',
                'description' => 'Id of the responder.',
                'foreign_object' => 'animalsitter\\AppUser',
                'onupdate' => 'onupdateResponderId'
            ],
            'content' => [
                'type' => 'string',
                'usage' => 'text/plain',
                'description' => 'Content of the message.',
            ],
            'app_users_ids' => [
                'type' => 'many2many',
                'foreign_object' => 'animalsitter\\AppUser',
                'foreign_field' => 'messages_ids',
                'rel_table' => 'animal_rel_messages_app_users',
                'rel_local_key' => 'message_id',
                'rel_foreign_key' => 'app_user_id',
            ],
        ];
    }

    public static function onupdateResponderId($self) {
        $messages = $self->read(['id', 'sender_id', 'responder_id']);
        foreach($messages as $message) {
            self::id($message['id'])->update(['app_users_ids' => [$message['sender_id'], $message['responder_id']]]);
        }
    }


}
