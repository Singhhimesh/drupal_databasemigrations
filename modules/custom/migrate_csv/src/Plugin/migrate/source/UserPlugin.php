<?php

namespace Drupal\migrate_csv\Plugin\migrate\source;

use Drupal\Core\Database\Database;
use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;
use Drupal\user\Entity\User;

/**
 * Source plugin for Article
 * 
 * @MigrateSource(
 *   id = "user_plugin"
 * )
 */
class UserPlugin extends SqlBase
{

    public function query()
    {

        $db = Database::getConnection('default', 'laravel_db');

        $query = $db->select('users', 'u');
        $query->fields('u', [
            'id',
            'surname',
            'first_name',
            'last_name',
            'username',
            'email',
        ]);

        return $query;
    }

    public function fields()
    {
        $fields = [
            'surname' => $this->t('surname'),
            'first_name' => $this->t('first_name'),
            'last_name' => $this->t('last_name'),
            'username' => $this->t('username'),
            'email' => $this->t('email'),
        ];
        
        return $fields;
    }

    public function getIds()
    {
        return [
            'id' => [
                'type' => 'integer',
                'alias' => 'u',
            ],
        ];
    }

 
    public function prepareRow(Row $row)
    {

        $id = $row->getSourceProperty('id');
        $row->setSourceProperty('id', $id);
        return parent::prepareRow($row);
 
    }
}
