<?php
final class DataFormat_Test extends DataFormat_PublicDB
{
    protected $table_name = 'DATA_TEST';
    protected $primary_key = 'TEST_ID';
    protected $field_names = array(
                                   'TEST_ID',
                                   'VALUE',
                                   'CTIME',
                                   );
    protected $queries = array(
                               'by_test_id_and_value' => array('sql' => 'SELECT * FROM __TABLE_NAME__ WHERE TEST_ID=:TEST_ID AND VALUE_ID=:VALUE'),
                               );
};
