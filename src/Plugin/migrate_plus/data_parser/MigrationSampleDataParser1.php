<?php

namespace Drupal\migration_samples\Plugin\migrate_plus\data_parser;

use Drupal\migrate_plus\Plugin\migrate_plus\data_parser\Xml;

/**
 * Data parser for the XML source.
 *
 * @DataParser(
 *   id = "migration_sample_1",
 *   title = @Translation("XML data parser")
 * )
 */
class MigrationSampleDataParser1 extends Xml {

  /**
   * {@inheritdoc}
   */
  protected function fetchNextRow() {
    parent::fetchNextRow();
    // Set the file name as one of property in source.
    if (isset($this->currentItem) && !empty($this->currentItem)) {
      $this->currentItem['dummy_unique_id'] = $this->getFileName();
    }
  }

  /**
   * Get XML file name without extension.
   *
   * @return string
   *   xml filename.
   */
  protected function getFileName() {
    // Full file path.
    $path = $this->urls[$this->activeUrl];

    // Explode with the '/' to get the last element.
    $files = explode('/', $path);

    // File name without extension.
    $file_name = explode('.', end($files))[0];
    return $file_name;
  }

}
