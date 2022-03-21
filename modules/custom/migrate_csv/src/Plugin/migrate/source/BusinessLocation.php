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
 *   id = "business_location"
 * )
 */
class BusinessLocation extends SqlBase
{

    public function query()
    {

        $db = Database::getConnection('default', 'laravel_db');

        $query = $db->select('business_locations', 'u');
        $query->fields('u', [
            'id',
            'name',
            'landmark',
            'country',
            'state',
            'zip_code',
            'default_payment_accounts'
        ]);

        return $query;
    }

    public function fields()
    {
        $fields = [
            'name' => $this->t('name'),
            'landmark' => $this->t('landmark'),
            'country' => $this->t('country'),
            'state' => $this->t('state'),
            'zip_code' => $this->t('zip_code'),
            'default_payment_accounts' => $this->t('default_payment_accounts'),
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
