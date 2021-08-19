<?php


include_once ('tests/arpablue/libtest/BaseTest.php');

class UserTest extends \BaseTest
{

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
     * It create a user with default values to be used in the test.
     * @return \Ablb\User\User It is the user object with default values.
     */
    protected function createUser()
    {
        $user = \Ablb\User\User::create();
        $user->setName('Jhonny');
        $user->setLastname('Prove');
        $user->setEmail('jhonny.prove@test.com');
        $user->setUsername('jhonny_01');
        $user->setPwd('control');
        return $user;
    }

    /**
     * It test verify if a user can be instanced and created without problems.
     */
    public function test_UserTest_apply_instance_user()
    {
        $this->title('test_UserTest_apply_instance_user');
        $user = $this->createUser();
        $this->log( $user->toJSONnicelly());
        $this->assertEquals( true, true, 'This fail.');
    }
    /**
     * It test verify if an user can be loaded from the database using an id, it
     * test consume
     * @throws \GuzzleHttp\Exception\GuzzleException It is the
     */
    public function test_UserTest_loadUser()
    {

        $this->title('test_UserTest_loadUser');
        $endPoint = '/api/user/2';
        $url = BaseTest::$HOST.$endPoint;
        $this->log( 'Execute GET to '.$url );
        // Load the REST client
        $client = new GuzzleHttp\Client(['verify' => false]);
        //It execute a GET request.
        $res = $client->request('GET',$url );
        // cconvert the answer to a JSON array.
        $cur = $res->getBody();
        $this->log("Data loaded:");
        $this->log( $cur );

        $exp = "{\"type\":\"success\",\"msg\":\"Data has been loaded successfully.\",\"data\":{\"id\":\"2\",\"name\":\"Jhonny\",\"lastname\":\"Test\",\"email\":\"jhonny.test@test.com\",\"username\":\"test\",\"pwd\":\"\",\"photo\":\"\",\"active\":\"1\",\"removed\":\"1\",\"createdAt\":\"2021-07-06 11:05:04\",\"token\":\"\"}}";
        $flag = $this->compare($cur, $exp);
        $this->assertEquals(true , $flag, 'The expected user is not the same.');
    }
    /**
     * It verify the correct response when the user id is not a numeric valule.
     * @throws \GuzzleHttp\Exception\GuzzleException It is the tools to made request to the api.
     */
    public function test_UserTest_loadUser_undefined()
    {

        $this->title('test_UserTest_loadUser_undefined');
        $endPoint = '/api/user/undefined';
        $url = BaseTest::$HOST.$endPoint;
        $this->log( 'Execute GET to '.$url );
        // Load the REST client
        $client = new GuzzleHttp\Client(['verify' => false]);
        //It execute a GET request.
        $res = $client->request('GET',$url );
        // cconvert the answer to a JSON array.
        $cur = $res->getBody();
        $this->log("Data loaded:");
        $this->log( $cur );

        $exp = "{\"type\":\"fail\",\"msg\":\"The ID specified do not have a numeric value api\/user\/undefined\"}";
        $flag = $this->compare($cur, $exp);
        $this->assertEquals(true , $flag, 'The expected user is not the same.');
    }
    /**
     * It verify the correct respónse when the user id is not specifiect
     * @throws \GuzzleHttp\Exception\GuzzleException It is the tools to made request to the api.
     */
    public function test_UserTest_loadUser_empty_value_v1()
    {

        $this->title('test_UserTest_loadUser_empty_value_v1');
        $endPoint = '/api/user/';
        $url = BaseTest::$HOST.$endPoint;
        $this->log( 'Execute GET to '.$url );
        // Load the REST client
        $client = new GuzzleHttp\Client(['verify' => false]);
        //It execute a GET request.
        $res = $client->request('GET',$url );
        // cconvert the answer to a JSON array.
        $cur = $res->getBody();
        $this->log("Data loaded:");
        $this->log( $cur );

        $exp = "{\"type\":\"fail\",\"msg\":\"The ID specified do not have a numeric value api\/user\"}";
        $flag = $this->compare($cur, $exp);
        $this->assertEquals(true , $flag, 'The expected user is not the same.');
    }
    /**
     * It verify the correct respónse when the user id is not specifiect
     * @throws \GuzzleHttp\Exception\GuzzleException It is the tools to made request to the api.
     */
    public function test_UserTest_loadUser_empty_value_v2()
    {

        $this->title('test_UserTest_loadUser_empty_value_v2');
        $endPoint = '/api/user';
        $url = BaseTest::$HOST.$endPoint;
        $this->log( 'Execute GET to '.$url );
        // Load the REST client
        $client = new GuzzleHttp\Client(['verify' => false]);
        //It execute a GET request.
        $res = $client->request('GET',$url );
        // cconvert the answer to a JSON array.
        $cur = $res->getBody();
        $this->log("Data loaded:");
        $this->log( $cur );

        $exp = "{\"type\":\"fail\",\"msg\":\"The ID specified do not have a numeric value api\/user\"}";
        $flag = $this->compare($cur, $exp);
        $this->assertEquals(true , $flag, 'The expected user is not the same.');
    }

    /**
     * It test case verify that a user exist, using the isExists() method.
     * a user is loaded from the database
     */
    public function test_User_exist()
    {
        $this->title('test_User_exist');
        $user = new \Ablb\User\User();
        $user->setLog( $this );
        $endPoint = '/api/user/2';
        $flag = $user->addIdFromRequest( $endPoint );

        $this->log( $user->toJSONnicelly() );

        $this->assertEquals( $flag, true, 'It is not possible get the ID from the EngPoint.');

    }
//    /**
//     * It test verify if an user can be loaded from the database using an id, it
//     * test consume
//     * @throws \GuzzleHttp\Exception\GuzzleException It is the
//     */
//    public function test_UserTest_loadUser_nonnumericID()
//    {
//
//        $this->title('test_UserTest_loadUser_nonnumericID');
//        $endPoint = '/api/user/abc';
//        $url = UserTest::$HOST.$endPoint;
//        $this->log( 'Execute GET to '.$url );
//        // Load the REST client
//        $client = new GuzzleHttp\Client(['verify' => false]);
//        //It execute a GET request.
//        $res = $client->request('GET',$url );
//        // cconvert the answer to a JSON array.
//        $body = $res->getBody();
//        $data = json_decode( $body, true );
//        $this->log( $body );
//        $this->assertEquals(true , true, 'The expected user is not the same.');
//    }

//    /**
//     * It test verify if an user can be loaded from the database using an id, it
//     * test consume
//     * @throws \GuzzleHttp\Exception\GuzzleException It is the
//     */
//    public function test_UserTest_addUser()
//    {
//
//        $this->title('test_UserTest_loadeUser');
//        $endPoint = '/api/user/add';
//        $url = UserTest::$HOST.$endPoint;
//        $this->log( 'Execute POST to '.$url );
//        // Load the REST client
//        $client = new GuzzleHttp\Client(['verify' => false]);
//
//        $user = Ablb\User\User::create();
//        $user->setName("Jhonny");
//        $user->setLastname("Test");
//        $user->setUsername('test');
//        $user->setPwd('control');
//        $user->setEmail('jhonny.test@test.com');
//
//        $this->log("Adding the following user:");
//        $this->log($user->toJSONnicelly() );
//
//        //It execute a POST request.
//        $res = $client->request('POST', $url, ['treepath' => $user->toArray()]);
//
//        // cconvert the answer to a JSON array.
//        $body = $res->getBody();
//        $data = json_decode( $body, true );
//        $this->log( $body );
//        $this->assertEquals(true , true, 'The expected user is not the same.');
//    }
}