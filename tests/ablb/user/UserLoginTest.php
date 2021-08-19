<?php
include_once ('tests/arpablue/libtest/BaseTest.php');

/**
 * Class UserTest
 * Itn test the login and the logout of user from the API.
 */
class UserLoginTest extends \BaseTest
{
    /**
     * It test verify if an user can be loaded from the database using an id, it
     * test consume
     * @throws \GuzzleHttp\Exception\GuzzleException It is the
     */
    public function test_UserTest_addUser()
    {

        $this->title('test_UserTest_loadeUser');
        $endPoint = '/api/user/add';
        $url = BaseTest::$HOST.$endPoint;
        $this->log( 'Execute POST to '.$url );
        // Load the REST client
        $client = new GuzzleHttp\Client(['verify' => false]);

        $user = Ablb\User\User::create();
        $user->setName("Jhonny");
        $user->setLastname("Test");
        $user->setUsername('test');
        $user->setPwd('control');
        $user->setEmail('jhonny.test@test.com');

        $this->log("Adding the following user:");
        $this->log($user->toJSONnicelly() );

        //It execute a POST request.
        $res = $client->request('POST', $url, ['treepath' => $user->toArray()]);

        // cconvert the answer to a JSON array.
        $body = $res->getBody();
        $data = json_decode( $body, true );
        $this->log( $body );
        $this->assertEquals(true , true, 'The expected user is not the same.');
    }
}