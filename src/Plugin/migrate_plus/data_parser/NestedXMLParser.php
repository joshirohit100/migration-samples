<?php

namespace Drupal\migration_samples\Plugin\migrate_plus\data_parser;

use Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException;
use Drupal\migrate_plus\Plugin\migrate_plus\data_parser\Xml;

/**
 * Data parser to read nested xml structure and create linear array data.
 *
 * @DataParser(
 *   id = "nested_xml_data",
 *   title = @Translation("Nested xml data")
 * )
 */
class NestedXMLParser extends Xml {

  /**
   * Iterator object.
   *
   * @var \Iterator
   */
  protected $iterator;

  /**
   * Array data converted from the XML.
   *
   * @var array
   */
  protected $arrayData = [];

  /**
   * Key which contains the inner data.
   *
   * @var string
   */
  protected $childDataKey;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    if (empty($configuration['inner_child_key'])) {
      throw new InvalidPluginDefinitionException('nested_xml_data','Inner child key in source plugin missing.');
    }
  }

  /**
   * {@inheritdoc}
   */
  protected function openSourceUrl($url) {
    try {
      $response = \Drupal::httpClient()->request('GET', $url)->getBody();
      $xml = new \SimpleXMLElement($response);
      $xmlNodes = $xml->xpath($this->configuration['item_selector']);
      foreach ($xmlNodes as $xmlNode) {
        $this->arrayData[] = $this->prepareArray($xmlNode);
      }
      $this->iterator = new \ArrayIterator($this->arrayData);
      return TRUE;
    }
    catch (\Exception $e) {
      throw new \Exception($e->getMessage(), $e->getCode(), $e);
    }
  }

  /**
   * {@inheritdoc}
   */
  protected function fetchNextRow() {
    $current = $this->iterator->current();
    if ($current) {
      foreach ($this->fieldSelectors() as $field_name => $selector) {
        $this->currentItem[$field_name] = $current[$selector];
      }
      $this->iterator->next();
    }
  }

  /**
   * Process the given xml object and returns array from it.
   *
   * @param $xml
   * @return array
   */
  protected function prepareArray($xml) {
    $xml_data = (array) $xml;
    return [
      'id' => $xml_data['id'],
      'title' => $xml_data['title'],
      'body' => $xml_data['body'],
    ];
  }

}
