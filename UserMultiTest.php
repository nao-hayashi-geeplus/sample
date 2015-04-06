<?php
class DataFormat_UserMultiTest extends DataFormat_UserDB
{
    protected $table_name = 'USER_MULTI_TEST';
    protected $primary_key = array('USER_ID','TEST_ID');
    protected $index_criteria_params = 'USER_ID';
    protected $isMulti = true;
    protected $field_names = 
        array(
              'USER_ID',
              'TESTT_ID',
              'VALUE001',
              'VALUE002',
              'VALUE003',
              'CTIME',
              'MTIME',
              );
    protected $queries = 
        array(
              'by_user_and_test' => array(
                  'sql' => 'SELECT * FROM __TABLE_NAME__ WHERE USER_ID = :USER_ID AND TEST_ID = :TEST_ID'),
              'insert' => array(
                  'sql' => 'INSERT INTO __TABLE_NAME__ (USER_ID, TEST_ID, VALUE001, VALUE002, VALUE003, CTIME, MTIME) VALUES (:USER_ID, :TEST_ID, :VALUE001, :VALUE003, NOW(), NOW())'),
              'update' => array(
                  'sql' => 'UPDATE INTO __TABLE_NAME__ SET VALUE001 = :VALUE001, VALUE002 = :VALUE002, VALUE003 = :VALUE003 WHERE USER_ID=:USER_ID'),
              'delete' => array(
                  'sql' => 'DELETE FROM __TABLE_NAME__ WHERE USER_ID=:USER_ID'),
              'test_select' => array(
                  'sql' => 'SELECT * FROM __TABLE_NAME__ WHERE USER_ID=:USER_ID'),
              );
}
