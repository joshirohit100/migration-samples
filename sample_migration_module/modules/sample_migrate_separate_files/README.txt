How to use this module
-------------------------
1. Download and install paragraphs module.
2. Create a new paragraph type with machine name 'test_paragraph'
3. In this paragraph, add a long text formatted field with machine name 'field_paragraph_text'
4. Create a new content type with machine name 'migration_sample'.
5. In this content type, add a user reference field with machine name 'field_author'.
6. In this content type, add a image/file reference field with machine name 'field_boook_image'.
7. In this content type, add a taxonomy reference field with machine name 'field_category'.
8. In this content type, add a Paragraph reference field with machine name 'field_my_body'.
9. This field with refer to the paragraph 'test_paragraph' and having cardinality 1.
10. For the users from '/admin/config/people/accounts/fields', add a text field with machine name 'field_user_name'.
11. Add a new role 'Site Builder' with machine name 'site_builder'.
12. Install this module 'sample_migrate_separate_files'
13. Create a new directory in your project root with name 'migration_files'.
14. Copy the 'sample_module_data' directory from this module to 'migration_files' directory.
15. We assuming that the files in 'migration_files' can be accessed by url 'http://local.drupal8.com/migration_files'.
16. Now just run command for migration 'drush mim books --execute-dependencies'