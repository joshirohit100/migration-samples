<?php

namespace Drupal\migration_samples\Plugin\migrate_plus\data_parser;

use Drupal\migrate_plus\Plugin\migrate_plus\data_parser\Xml;

/**
 * Data parser for the XML.
 *
 * @DataParser(
 *   id = "migration_sample_1",
 *   title = @Translation("XML parser plugin")
 * )
 */
class MigrationSampleDataParser1 extends Xml {

  /**
   * {@inheritdoc}
   */
  protected function fetchNextRow() {
    parent::fetchNextRow();
    // Set the file name.
    if (isset($this->currentItem) && !empty($this->currentItem)) {
      $this->currentItem['dummy_unique_id'] = $this->getFileName();
    }
  }

  /**
   * Gets the file name of the processing XML without extension.
   *
   * @return string
   *   xml filename without extension.
   */
  protected function getFileName() {
    // Get the current file with full path.
    $file_path = $this->urls[$this->activeUrl];

    // Separate with the '/' and get the last element.
    $files = explode('/', $file_path);

    // Get the file name without extension.
    $file_name = explode('.', end($files))[0];
    return $file_name;
  }

}
