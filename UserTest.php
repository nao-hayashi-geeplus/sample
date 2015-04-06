<?php
final class DataFormat_UserTest extends DataFormat_UserDB {
    protected $table_name     = 'USER_TEST';
    protected $primary_key    = 'USER_ID';
    protected $field_names =
        array(
              'USER_ID',
              'VALUE001',
              'VALUE002',
              'VALUE003',
              'CTIME',
              );
    protected $queries =
        array(
              'insert' => array(
                                'sql' => 'INSERT INTO __TABLE_NAME__ (USER_ID, VALUE001, VALUE002, VALUE003, CTIME)
                                          VALUES (:USER_ID, :VALUE001, :VALUE002, :VALUE003, NOW())'),
              'update' => array(
                              'sql' => 'UPDATE __TABLE_NAME__ SET VALUE001 = :VALUE001, VALUE002 = :VALUE002, VALUE003 = :VALUE003 WHERE USER_ID=:USER_ID'),
              'delete' => array(
                              'sql' => 'DELETE FROM __TABLE_NAME__ WHERE USER_ID=:USER_ID'),
              'test_select' => array(
                              'sql' => 'SELECT * FROM __TABLE_NAME__ WHERE USER_ID=:USER_ID'),
        );
};
