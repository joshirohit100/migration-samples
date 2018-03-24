<?php

namespace Drupal\sample_migration_module\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;

/**
 * Defines content type name based on a value.
 *
 * @MigrateProcessPlugin(
 *   id = "content_type_plugin"
 * )
 */
class ContentTypePlugin extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    if ($value == 'ac') {
      return 'article';
    }

    return 'page';
  }

}
