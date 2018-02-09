<?php

/**
 * @file
 */

/**
 * Implements hook_drush_command().
 */
function migration_samples_drush_command() {
  $commands['migration-preprocessing'] = [
    'description' => 'Preprocessing the json source',
    'aliases' => ['mpp'],
    'examples' => [
      'drush migration-preprocessing' => 'Preprocessing the data.',
      'drush mpp' => 'Preprocessing the data.',
    ],
  ];

  $commands['migration-preprocessing-xml'] = [
    'description' => 'Preprocessing the xml.',
    'aliases' => ['mppx'],
    'examples' => [
      'drush migration-preprocessing-xml' => 'Preprocessing the xml.',
      'drush mppx' => 'Preprocessing the xml.',
    ],
  ];

  return $commands;
}

/**
 * Drush command to pre-process json data.
 */
function drush_migration_samples_migration_preprocessing() {
  drush_print(dt('Pre-processing the data...'));
  $file_path = "Path to the json source file.";

  // Read the file content.
  $jsonString = file_get_contents($file_path);
  $data = json_decode($jsonString, true);

  // Processing data here.
  foreach ($data['pages']['page'] as &$page) {
    if (is_array($page['name'])) {
      $page['name'] = implode(' ', $page['name']);
    }
  }

  // Saving updated data.
  $newJsonData = json_encode($data);
  file_put_contents($file_path, $newJsonData);

  // Pre-processing done.
  drush_log('Pre-processing is completed.','success');
}

/**
 * Drush command to pre-process xml data.
 */
function drush_migration_samples_migration_preprocessing_xml() {
  drush_print(dt('Pre-processing the xmls...'));
  $files = [
    'wrong_pattern.xml',
    'right_pattern.xml',
  ];

  foreach ($files as $file) {
    // Read the file content.
    $file_path = DRUPAL_ROOT . '/migration_files/' . $file;
    $xml_string = file_get_contents($file_path);

    $xml_string = str_replace('my_page', 'page', $xml_string);
    // Saving updated data.
    file_put_contents($file_path, $xml_string);
  }

  // Pre-processing done.
  drush_log('Pre-processing is completed.','success');
}
