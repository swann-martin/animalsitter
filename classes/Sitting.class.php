<?php

namespace animalsitter;

use equal\orm\Model;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Time;

/**
 * @property datetime $time_from Time the sitter is available to sit an animal from.
 * @property datetime $time_to Time the sitting should stop.
 * @property array $sitter_id The sitter's id.
 * @property array $animals_ids Relation between animals and sittings.
 */
class Sitting extends Model
{
    public static function getColumns()
    {
        return [
            'date' => [
                'type' => 'date',
                'description' => 'Date of the sitting.',
                'default' => time(),
            ],
            'time_from' => [
                'type' => 'time',
                'description' => 'Time the sitter is available to sit an animal from.',
                "default" => "09:00:00"
            ],
            'time_to' => [
                'type' => 'time',
                'description' => 'Time the sitting should stop.',
                "default" => "11:00:00"
            ],
            'sitter_id' => [
                'type' => 'many2one',
                'description' => 'Id of the sitter.',
                'foreign_object' => 'animalsitter\\AppUser',
            ],
            'animals_ids' => [
                'type' => 'many2many',
                'description' => 'Relation between animals and sitting.',
                'foreign_object' => 'animalsitter\\animal\\Animal',
                'foreign_field' => 'sittings_ids',  //select amongst fields of other class + ability to create a new one (many2many) : temporary creation in one of both ways !
                'rel_table' => 'animal_rel_animals_sittings',  // rel_table -> check amongst existing rel tables ({package}_rel_local_foreign or rel_foreign_local) if no table exists it creates one
                'rel_local_key' => 'sitting_id', // rel_local_key -> {local_class}_id
                'rel_foreign_key' => 'animal_id', // rel_foreign_key -> {foreign_class}_id
            ],
        ];
    }
}
