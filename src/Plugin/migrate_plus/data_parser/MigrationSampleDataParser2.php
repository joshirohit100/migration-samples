<?php

namespace Drupal\migration_samples\Plugin\migrate_plus\data_parser;

use Drupal\migrate_plus\Plugin\migrate_plus\data_parser\Xml;

/**
 * Data parser for the XML.
 *
 * @DataParser(
 *   id = "migration_sample_2",
 *   title = @Translation("XML parser plugin")
 * )
 */
class MigrationSampleDataParser2 extends Xml {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    $file_pattern = "Some file pattern that can be specified in migration config yml.";
    $file_paths = glob($file_pattern);
    $configuration['urls'] = [];
    foreach ($file_paths as $file_path) {
      $file_name = end(explode('/', $file_path));
      $file_ext = explode('.', $file_name)[1];
      if ($file_ext == 'xml') {
        $configuration['urls'][] = $file_path;
      }
    }
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

}
