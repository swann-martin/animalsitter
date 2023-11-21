<?php

namespace animalsitter\animal;

use equal\orm\Model;

/**
 * @property string $name Name of the animal.
 * @property string $color Color of the animal.
 * @property date $birthday Birthday of the animal if know.
 * @property integer $age Age of the animal in months if known.
 * @property string $description Description and extra information about the animal.
 * @property string $picture Picture of the animal.
 * @property boolean $vaccinated Indicates true if the animal is vaccinated.
 * @property integer $user_id
 */
class Animal extends Model
{
    public static function getColumns()
    {
        return [
            'user_id' => [
                'type' => 'many2one',
                'required' => true,
                'foreign_object' => 'animalsitter\\User',
                'ondelete' => 'cascade',
            ],
            'name' => [
                'usage' => '',
                'type' => 'string',
                'description' => 'Name of the animal.',
                'required' => true,
            ],
            'color' => [
                'usage' => '',
                'type' => 'string',
                'description' => 'Color of the animal.',
                'required' => true,
            ],
            'description' => [
                'usage' => '',
                'type' => 'string',
                'description' => 'Description and extra information about the animal.',
                'default' => 'This animal is very nice and will love you',
            ],
            'picture' => [
                'type' => 'string',
                'usage' => 'url',
                'description' => 'Picture of the animal.',
            ],
            'vaccinated' => [
                'default' => false,
                'usage' => '',
                'type' => 'boolean',
                'description' => 'Indicates true if the animal is vaccinated.',
            ],
            'birthday' => [
                'type' => 'date',
                'usage' => 'date',
                'description' => 'Birthday of the animal if know.',
                'default' => '2023-11-21T15:19:17+00:00',
                'dependencies' => [
                    0 => 'age',
                ],
            ],
            'age' => [
                'type' => 'computed',
                'description' => 'Age of the animal in months if known.',
                'store' => true,
                'result_type' => 'integer',
                'function' => 'calcAge',
            ],
        ];
    }

    /**
     * Compute the value of the calcAge of the animal from birthday.
     *
     * @param \equal\orm\Collection $self  An instance of a Animal collection.
     */
    public static function calcAge($self)
    {
        $result = [];
        $self->read(['birthday']);
        foreach ($self as $id => $animal) {
            $result[$id] = self::computeAge($animal['birthday']);
        }
        return $result;
    }

    /**
     * onchange $event checks if the entry birthday has changed and execute the method computeAge.
     * @param $event : Array
     * @param \equal\orm\Collection $self  An instance of a Animal collection.
     */
    public static function onchange($self, $event = [])
    {
        $result = [];
        if (isset($event['birthday'])) {
            $result['age'] = self::computeAge($event['birthday']);
        }
        return $result;
    }

    /**
     * Difference between birthday and time()
     * @param $birthday : date
     * return the age of the animal in years
   */
    private static function computeAge($birthday)
    {
        return floor((time() - $birthday) / (86400 * 30));
    }
}
