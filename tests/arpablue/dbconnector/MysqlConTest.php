<?php


include_once ('tests/arpablue/libtest/BaseTest.php');


use PHPUnit\Framework\TestCase;
class TestLog implements \ArpaBlue\interfaces\ILog
{

    public function error($msg)
    {
        // TODO: Implement error() method.
    }

    public function warning($msg)
    {
        // TODO: Implement warning() method.
    }

    public function info($msg)
    {
        // TODO: Implement info() method.
    }

    public function log($msg)
    {
        // TODO: Implement log() method.
    }
}
class MysqlConTest extends BaseTest
{
    protected $mCon = null;

    /**
     * It return the connection to the database.
     * @return mixed It is the connection to the database.
     */
    public function getConnection()
    {

        if( $this->mCon == null ){
            $this->mCon = new \ArpaBlue\dbconnector\MySqlCon();
            $this->mCon->setHost("localhost");
            $this->mCon->setDatabase("test");
            $this->mCon->setUser("noroot");
            $this->mCon->setPassword("noroot");
            $this->mCon->setLog( $this );
        }
        $this->log( $this->mCon->toJSONnicelly() );
        return $this->mCon;

    }
    /**
     * It verify the treepath is generated correctly.
     */
    public function test_DbMysql_toJson()
    {
        $this->title("test_DbMysql_toJson");
        $target = new \ArpaBlue\dbconnector\MySqlCon();
        $target->setLog( $this );
        $target->setHost("localhost");
        $target->setDatabase("test");
        $target->setUser("noroot");
        $target->setPassword("noroot");

        $exp = '{"host":"localhost","database":"test","port":3306,"user":"noroot","password":"noroot"}';
        $cur = $target->toJSON();
        $flag = $this->compare( $cur, $exp );
        $this->assertEquals(true, $flag, 'The JSON is not generated correctly.' );
    }

    /**
     * It verify the connection to the database fora a connection without credentials should be invalid.
     */
    public function test_DbMysql_ConnectionVerification_invalidState()
    {
        $this->title('test_DbMysql_ConnectionVerification_invalidState');
        $target = new \ArpaBlue\dbconnector\MySqlCon();
        $flag = $target->open();
        $this->assertEquals( false, $flag, 'The connection to the database is valid, but it should be not.');
    }
    /**
     * It verify the connection to the database fora a connection without credentials should be invalid.
     */
//    public function test_DbMysql_ConnectionVerification_invalidDatabase()
//    {
//        $this->title('test_DbMysql_ConnectionVerification_invalidDatabase');
//        $test = $this->getConnection();
//        $this->log( 'changin the host to testx' );
//        $test->setHost("testx");
//        $this->log( $test->toJSONnicelly() );
//        $flag = $test->open();
//
//        $this->assertEquals( false, $flag, 'The connection to the database is valid, but it should be not.');
//    }

    /**
     * It verify the connection to the database is valid, the credentials are:
     *      host = localhost
     *      database = test
     *      user = noroot
     *      password = noroot
     *
     */
    public function test_DbMysql_ValidConnection()
    {
        $this->title('test_DbMysql_ValidConnection');
        $test = $this->getConnection();
        $flag = $test->open();
        if( $flag )
        {
            $test->close();
        }
        $this->assertEquals( true, $flag,'The connection to the database fail.');
    }
    public function test_Mysql_Select_query()
    {
        $this->title('test_Mysql_Select_query');
        $test = $this->getConnection();
        $flag = $test->open();
        $this->assertEquals( true, $flag,'The connection to the database fail.');

        $test->executeQuery('select * from users');


        $this->log( $test->toJSONnicellyReuslt() );
        $test->close();
    }

}