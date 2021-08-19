<?php
include_once ('tests/arpablue/libtest/BaseTest.php');
use PHPUnit\Framework\TestCase;
use ArpaBlue\MapRouter\MapRouter;

/**
 * Class MapRouteTestIt is the test for the MapRouter, It test the public method.
 */
class MapRouteTest extends BaseTest
{
    /**
     * It initialize the map object, tobe used tin the tests.
     */
    protected function initMap(){
        $map = new MapRouter();
        $map->addAny('/api/*','/api/index.php');
        $map->addPOST('/user/add/*','/public/users/add.php');
        $map->addPUT('/user/modif/*','/public/users/modif.php');
        $map->addDELETE('/user/del/*','/public/users/del.php');
        $map->addGET('/user/info/*','/public/users/info.php');
        $map->addGET('/user/usrs','/public/users/list.php');

        $map->addPOST('/prj/add','/public/prj/add.php');
        $map->addPUT('/prj/modif/*','/public/prj/modif.php');
        $map->addDELETE('/prj/del/*','/public/prj/del.php');
        $map->addGET('/prj/info/*','/public/prj/info.php');
        $map->addGET('/prj/usrs','/public/prj/list.php');

        return $map;
    }
    /**
     * It verify an url can be set on correct format when the simple url.
     */
    public function test_MapRouter_formatPath_put_on_format_url_with_simple_url()
    {
        $this->write();
        $this->write('------test_MapRouter_formatPath_put_on_format_url_with_simple_url');

        $target = 'api';
        $exp = 'api';

        $cur = MapRouter::formatPath( $target );

        $flag = $this->compare( $cur, $exp );
        $this->assertEquals(true, $flag,"The expected results are not equals.");
    }
    /**
     * It verify an url can be set on correct format when the url has white spaces
     */
    public function test_MapRouter_formatPath_put_on_format_url_with_spaces()
    {
        $this->write();
        $this->write('------test_MapRouter_formatPath_put_on_format_url_with_spaces');

        $target = '     /api/*     ';
        $exp = 'api/*';

        $cur = MapRouter::formatPath( $target );

        $flag = $this->compare( $cur, $exp );
        $this->assertEquals(true, $flag,"The expected results are not equals.");
    }
    /**
     * It verify an url can be set on correct format when the url has white slashes.
     */
    public function test_MapRouter_formatPath_put_on_format_url_with_slashes()
    {
        $this->write();
        $this->write('------test_MapRouter_formatPath_put_on_format_url_with_slashes');

        $target = '////api/*///';
        $exp = 'api/*';

        $cur = MapRouter::formatPath( $target );

        $flag = $this->compare( $cur, $exp );
        $this->assertEquals(true, $flag,"The expected results are not equals.");
    }
    /**
     * It verify an url can be set on correct format when the url has white slashes.
     */
    public function test_MapRouter_formatPath_put_on_format_url_without_slashes()
    {
        $this->write();
        $this->write('------test_MapRouter_formatPath_put_on_format_url_without_slashes');

        $target = 'api/*///';
        $exp = 'api/*';

        $cur = MapRouter::formatPath( $target );

        $flag = $this->compare( $cur, $exp );
        $this->assertEquals(true, $flag,"The expected results are not equals.");
    }
    /**
     * It verify the creation of the map it is correct, no matter the method, all
     * urls with * should be called his respective response file.
     */
    public function test_MapRoute_Any_Corresponding()
    {
        $this->write();
        $this->write('------test_MapRoute_Any_Corresponding');

        $map = $this->initMap();

        $exp = 'api/index.php';

        $urls =  array();
        $urls[] = '/api/';
        $urls[] = '/api';
        $urls[] = 'api/';
        $urls[] = 'api';
        $urls[] = '/api/users/add';
        $urls[] = '/api/prj/del/2';
        $urls[] = '/api/tp/modif/4';
        $urls[] = '/api/ts/upl/6';
        $urls[] = '/api/prj_rol';

        $flag = true;
        foreach( $urls as $url )
        {
            $current = $map->get($url, 'GET');
            $flag = $flag & $this->compare( $current,$exp);
        }
        $this->assertEquals(true, $flag,'For some urls the response file is not correct.');
        if( !$flag )
        {
            $this->fail('For some urls the response file is not correct.');
        }
    }
    /**
     * Tt test case verify the call to the GET references are called correctly.
     */
    public function btest_MapRoute_Get_Corresponding()
    {
        $this->write();
        $this->write('------btest_MapRoute_Get_Corresponding');

        $exp = 'public/users/info.php';

        $map = $this->initMap();

        $method = 'GET';

        $flag = true;

        $urls =  array();
        $urls[] = '/user/info/3';
        $urls[] = '/user/info/5';
        $urls[] = '/user/info/6';
        $urls[] = '/user/info/37';
        $urls[] = '/user/info/388';
        $urls[] = '/user/info/';
        $urls[] = '/user/info';
        $urls[] = 'user/info/';
        $urls[] = 'user/info';

        foreach( $urls as $url )
        {
            $current = $map->get($url, $method );
            $flag = $flag & $this->compare( $current,$exp);
        }
        $this->assertEquals(true, $flag,'For some urls the response file is not correct.');

    }
    /**
     * It build a map with references to http methods
     * @return MapRouter
     */
    protected function getMethodMap()
    {
        $map = new \ArpaBlue\MapRouter\MapRouter();

        $uri1 = '/api/users/*';
        $exp1 = '/api/user/list.php';

        $uri2 = '/api/user/*';
        $exp2 = '/api/user/info.php';

        $uri3 = '/api/user/*';
        $exp3 = '/api/user/add.php';

        $uri4 = '/api/user/*';
        $exp4 = '/api/user/update.php';

        $uri5 = '/api/user/*';
        $exp5 = '/api/user/remove.php';

        $map->addGET( $uri1, $exp1);
        $map->addGET($uri2, $exp2);
        $map->addPOST($uri3, $exp3);
        $map->addPUT($uri4, $exp4);
        $map->addDELETE($uri5, $exp5);

        $map->setLog( $this );
        $this->log( $map->toJSONnicelly());
        return $map;
    }
    /**
     * It verify the uri response to the correct file using the corresponding method.
     */
    public function test_MapRoute_method_redirection()
    {
        $this->title("test_MapRoute_method_redirection");

        $flag = true;

        $map = $this->getMethodMap();

        $uri = array();
        $exp = array();
        $method = array();

        $method[] = 'GET';
        $uri[] = '/api/user/1';
        $exp[] = 'api/user/info.php';

        $method[] = 'GET';
        $uri[] = '/api/users';
        $exp[] = 'api/user/list.php';

        $method[] = 'POST';
        $uri[] = '/api/user';
        $exp[] = 'api/user/add.php';

        $method[] = 'PUT';
        $uri[] = '/api/user/32';
        $exp[] = 'api/user/update.php';

        $method[] = 'DELETE';
        $uri[] = '/api/user/554';
        $exp[] = 'api/user/remove.php';

        $size = count( $uri );
        $cur = 'non';
        $flag = true;
        for( $i = 0; $i < $size; $i++)
        {
            $cur = $map->get( $uri[$i], $method[$i] );
            if( $cur == null ){
                $this->log('The reference for the uri ['.$uri[$i].']');
                $flag = false;
            }else{
                if( !$this->compare($cur, $exp[$i]) )
                {
                    $flag = false;
                }

            }
        }
        if( $flag )
        {
            $this->log('PASS: All expected file references are correct.');
        }else{
            $this->log('FAI: The expedted result are not the same');
        }
        $this->assertEquals(true, $flag, 'The response of the map is not correct.');
    }
    /**
     * It verify the uri response to the correct file using the corresponding method.
     */
    public function test_MapRoute_method_redirection2()
    {
        $this->title("test_MapRoute_method_redirection2");

        $flag = true;

        $map = $this->getMethodMap();

        $uri = array();
        $exp = array();
        $method = array();

        $method[] = 'GET';
        $uri[] = 'api/user/1';
        $exp[] = 'api/user/info.php';

        $method[] = 'GET';
        $uri[] = 'api/users';
        $exp[] = 'api/user/list.php';

        $method[] = 'POST';
        $uri[] = 'api/user';
        $exp[] = 'api/user/add.php';

        $method[] = 'PUT';
        $uri[] = 'api/user/32';
        $exp[] = 'api/user/update.php';

        $method[] = 'DELETE';
        $uri[] = 'api/user/554';
        $exp[] = 'api/user/remove.php';

        $size = count( $uri );
        $cur = 'non';
        $flag = true;
        for( $i = 0; $i < $size; $i++)
        {
            $cur = $map->get( $uri[$i], $method[$i] );
            if( $cur == null ){
                $this->log('The reference for the uri ['.$uri[$i].']');
                $flag = false;
            }else{
                if( !$this->compare($cur, $exp[$i]) )
                {
                    $flag = false;
                }

            }
        }
        if( $flag )
        {
            $this->log('PASS: All expected file references are correct.');
        }else{
            $this->log('FAI: The expedted result are not the same');
        }
        $this->assertEquals(true, $flag, 'The response of the map is not correct.');
    }
    /**
     * It verify the uri response to the correct file using the corresponding method.
     */
    public function test_MapRoute_method_redirection3()
    {
        $this->title("test_MapRoute_method_redirection3");

        $flag = true;

        $map = $this->getMethodMap();

        $uri = array();
        $exp = array();
        $method = array();

        $method[] = 'GET';
        $uri[] = '/api/user/aaaa/bbbb/111111';
        $exp[] = 'api/user/info.php';

        $method[] = 'GET';
        $uri[] = '/api/users/aaaa/bbbbbb/22222';
        $exp[] = 'api/user/list.php';

        $method[] = 'POST';
        $uri[] = '/api/user/aaaa/bbbb/3333';
        $exp[] = 'api/user/add.php';

        $method[] = 'PUT';
        $uri[] = '/api/user/dddd/eeee/44444';
        $exp[] = 'api/user/update.php';

        $method[] = 'DELETE';
        $uri[] = '/api/user/aaaaaa/bbb/555555';
        $exp[] = 'api/user/remove.php';

        $size = count( $uri );
        $cur = 'non';
        $flag = true;
        for( $i = 0; $i < $size; $i++)
        {
            $this->info('SEARCHING REFERENCE FOR ENDPOINT: ['.$uri[$i].']');
            $cur = $map->get( $uri[$i], $method[$i] );
            if( $cur == null ){
                $flag = false;
            }else{
                if( !$this->compare($cur, $exp[$i]) )
                {
                    $flag = false;
                }

            }
        }
        if( $flag )
        {
            $this->log('PASS: All expected file references are correct.');
        }else{
            $this->log('FAIL: The expected result are not the same');
        }
        $this->assertEquals(true, $flag, 'The response of the map is not correct.');
    }

}