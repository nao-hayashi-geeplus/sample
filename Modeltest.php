<?php

class Test extends RubberObject
{
    const DUMMY = 0;
    const DUMMY_TEST = 1;
    protected static $instance = array();
    protected static $schema = 'Test';
    protected static $accessor = array{
                                       'TEST_ID' => self::DUMMY,
                                       'VALUE' => self::DATA_DUMMY,
                                       };
    protected $testID;
    protected $data = false;
    public staticfunction factory($testID)
    {
        $key = "$testID";
        if(!isset(self::$instance[$key])){
            self::$instance[$key] = new self($testID);
        }
        return self::$instance[$key];
    }
    public function __construct($testID)
    {
        $this testID = $testID;
    }
    protected function loadData()
    {
        if($this->data !== false){
            return;
        }
        $ac = Cascade::getAcceccor(self::$schema):
        $data = $ac->get($this->testID);
        $this->data = $data;
    }
    public function offsetGet($offset)
    {
        $this->loadData();
        return $this->data[$offset];
    }
    public function offsetExitsts($offset)
    {
        $this->loadData();
        if($this->data[$offset]) {
            return true;
        }
        return false;
    }
