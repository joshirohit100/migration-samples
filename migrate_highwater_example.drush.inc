<?php

/**
 * @file
 */

/**
 * Implements hook_drush_command().
 */
function migrate_highwater_example_drush_command() {
  $commands['migration-preprocessing'] = [
    'description' => 'Upgrade drupal 7 theme to drupal 8.',
    'aliases' => ['mpp'],
    'examples' => [
      'drush migration-preprocessing' => 'Preprocessing the data.',
      'drush mmp' => 'Preprocessing the data.',
    ],
  ];

  return $commands;
}

/**
 * Drush command to pre-process json data.
 */
function drush_migrate_highwater_example_migration_preprocessing() {
  drush_print(dt('Pre-processing the data...'));
  $file_path = DRUPAL_ROOT . "/migration_files/preprocess_data.json";

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
