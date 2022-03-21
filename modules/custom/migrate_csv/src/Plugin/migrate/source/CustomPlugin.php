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
 *   id = "custom_plugin"
 * )
 */

class CustomPlugin extends SqlBase
{
    public function query()
    {
        $db = Database::getConnection('default', 'migrate');
        $query = $db->select('wp_posts', 'u');
        $query->fields('u', [
            'ID',
            'post_title',
            'post_content'
        ]);
        return $query;
    }
    public function fields()
    {
        $fields = [
            'post_title'   => $this->t('post_title'),
            'post_content'   => $this->t('post_content'),
        ];
        return $fields;
    }

    public function getIds()
    {
        return [
            'ID' => [
                'type' => 'integer',
                'alias' => 'u',
            ],
        ];
    }
    public function prepareRow(Row $row)
    {
        $id = $row->getSourceProperty('ID');
        $row->setSourceProperty('ID', $id);
        return parent::prepareRow($row);
    }
}
