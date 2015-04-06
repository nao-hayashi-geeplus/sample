<?php
final class UserMultiTest extends RubberObject
{
    const DUMMY = 0;
    const USER_MULTI_TEST = 1;
    protected static $instances = array();
    protected static $schema = 'UserMultiTest';
    protected static $accessor = array(
        'USER_ID' => self::DUMMY,
        'TEST_ID' => self::DUMMY,
        'VALUE001' => self::USER_MULTI_TEST,
        'VALUE002' => self::USER_MULTI_TEST,
        'VALUE003' => self::USER_MULTI_TEST
    );
    protected $userID;
    protected $data;
    //インスタンス生成
    public static function factory($userID, $testID)
    {
        error_log("UserMultiTest::factory");
        if(!isset(self::$instances[$userID][$testID])){
            self::$instances[$userID][$testID] = new self($userID, $testID);
        }
        return self::$instances[$userID][$testID];
    }
    //コンストラクタ
    public function __construct($userID, $testID)
    {
        error_log("UserMultiTest::__construct");
        parent::__construct();
        $this->userID = $userID;
        $this->testID = $testID;
    }
    //
    public function getCacheKey()
    {
        error_log("UserMultiTest::getCacheKey");
        $cacheKey = self::$schema . '#' . $this->userID . '#' . $this->testID;
        return $cacheKey;
    }
    // load to DB
    protected function loadData()
    {
        error_log("UserMultiTest::loadData");
        if($this->data != null) {
            return;
        }
        $ckey = $this->getCacheKey();
        list($data, $cas) = $this->getCacheDriver()->get($ckey);
        if($data === false){
            $ac = Cascade::getAccessor(self::$schema);
            $args['USER_ID'] = $this->userID;
            $args['TEST_ID'] = $this->testID;
            $data = $ac->get($args, null, true);
            if(empty($data)) {
                $data['USER_ID'] = $this->userID;
                $data['TEST_ID'] = $this->testID;
                $data['VALUE001'] = 0;
                $data['VALUE002'] = 0;
                $data['VALUE003'] = 0;
                $data['IS_NEW'] = true;
            }
            $this->getCacheDriver()->set($ckey, $data);
        }
        $this->data = $data;
    }
    // DB removed
    public function remove()
    {
        error_log("UserMultiTest::remove");

        $ac = Cascade::getAccessor(self::$schema);
        $ac->execute('delete', $this->data);

        $ckey = $this->getCacheKey();
        $this->getCacheDriver()->delete($ckey);
        $this->data = null;
        return true;
    }
    // DB saved
    public function save()
    {
        error_log("UserMultiTest::save");
        if(isset($this->data['MODIFIED'])) {
            unset($this->data['MODIFIED']);
            $ckey = $this->getCacheKey($this->userID);
            $ac = Cascade::getAccessor(self::$schema);
            if(isset($this->data['IS_NEW'])) {
                unset($this->data['IS_NEW']);
                $ac->execute('insert', $this->data);
            } else {
                $ac->execute('update', $this->data);
            }
            $this->getCacheDriver()->delete($ckey);
        }
    }
    // offset data Get
     
    public function offsetGet($offset)
    {
        error_log("UserMultiTest::offsetGet");
        if(isset(self::$accessor[$offset])){
            $schemaID = self::$accessor[$offset];
            if($schemaID == self::DUMMY) {
                if($offset == 'USER_ID') {
                    return $this->userID;
                } else if($offset == 'TEST_ID') {
                    return $this->testID;
                }
            }
            $this->loadData();
            return $this->data[$offset];
        }
        return parent::offsetGet($offset);
    }
    // offset data set
     public function offsetSet($offset, $value)
    {
        error_log("UserMultiTest::offsetSet");
        if(isset(self::$accessor[$offset])) {
            $schemaID = self::$accessor[$offset];
            if($schemaID == self::DUMMY) {
                // PRIMARY KEY ERROR
                error_log("UserMultiTest:offsetSet PrimaryKey ERROR!");
                throw new RubberException('ERROR OCCURED @ offsetSet');
            } else {
                //default data
                $this->loadData();
                $this->data[$offset] = $value;
                $this->data['MODIFIED'] = true;
                return;
            }
        }
        return parent::offsetSet($offset, $value);
    }
}
