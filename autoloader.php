<?php
class ClassAutoloader
{
    protected static $map = array(
                           'UserTest'               => 'UserTest',
                           'Test'                   => 'Test.php',
                           'UserMultiTest'          => 'UserMultiTest.php',
                            );

    public static function regist($file, array $classList)
    {
        if (!is_array($classList)) {
            $classList = array($classList);
        }
        foreach ($classList as $cls) {
            if (isset(self::$map[$cls])) {
                throw new Exception('オートローダーエラー');
            }
            self::$map[$cls] = $file;
        }
    }

    public function __construct()
    {
        spl_autoload_register(array($this, 'loader'));
        Cascade::registerAutoload(SRC . DS . 'Cascade');
        if (!__RELEASE__) {
            self::$map['DebugInvite'] = 'debug/DebugInvite.php';
            self::$map['DebugTutorial'] = 'debug/DebugTutorial.php';
        }
    }

    protected function loader($className)
    {
        if (isset(self::$map[$className]) && !class_exists($className)) {
            $fileName = self::$map[$className];
            require_once($fileName);
        }
    }
};
