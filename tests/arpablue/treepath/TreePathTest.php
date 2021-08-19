<?php

include_once ('tests/arpablue/libtest/BaseTest.php');

class TreePathTest extends \BaseTest
{
    /**
     * It verify that a string that not need formated, return the same string.
     */
    public function test_TreePath_format_string_not_need()
    {
        $this->title('test_TreePath_format_string_not_need');
        $target = 'This is a string';
        $exp = 'This is a string';

        $cur = \Ablb\TreePath\TreePath::format( $target );
        $this->assertEquals($exp, $cur, 'The formated expected is not as expected.');
    }
    /**
     * It verify that a string that need formated, return the same string.
     */
    public function test_TreePath_format_string()
    {
        $this->title('test_TreePath_format_string');
        $target = '          This is a \ string    ';
        $exp = 'This is a / string';

        $cur = \Ablb\TreePath\TreePath::format( $target );
        $this->assertEquals($exp, $cur, 'The formated expected is not as expected.');
    }
    /**
     * It verify that for empty string the format method() should return a null value.
     */
    public function test_TreePath_format_empty_string()
    {
        $this->title('test_TreePath_format_empty_string');
        $target = '';
        $exp = null;

        $cur = \Ablb\TreePath\TreePath::format( $target );
        $this->assertEquals($exp, $cur, 'The expected result should be null.');
    }
    /**
     * It verify that for null string the format method() should return a null value.
     */
    public function test_TreePath_format_null_string()
    {
        $this->title('test_TreePath_format_null_string');
        $target = null;
        $exp = null;

        $cur = \Ablb\TreePath\TreePath::format( $target );
        $this->assertEquals($exp, $cur, 'The expected result should be null.');
    }
    public function test_TreePath_toJSON()
    {
        $this->title('test_TreePath_toJSON');

        $tree = new Ablb\TreePath\TreePath();
        $tree->set('name','Jason');
        $tree->set('lastname','Todd');
        $tree->set('age','23');
        $tree->set('sex','m');

        $exp = "{\"name\":\"Jason\",\"lastname\":\"Todd\",\"age\":\"23\",\"sex\":\"m\"}";

        $cur = $tree->toJSON();
        $this->log( $tree->toJSON() );

        $flag = $this->compare( $cur, $exp);
        $this->assertEquals( true, $flag, 'The JSON string are not equals.');
    }
    public function xtest_TreePath_toJSONnicelly()
    {
        $this->title('test_TreePath_toJSONnicelly');
        $tree = new Ablb\TreePath\TreePath();
        $tree->set('name','Jason');
        $tree->set('lastname','Todd');
        $tree->set('age','23');
        $tree->set('sex','m');

        $exp = "{
    \"name\":\"Jason\",
    \"lastname\":\"Todd\",
    \"age\":\"23\",
    \"sex\":\"m\"
}";
        $cur = $tree->toJSONnicelly();
        $this->log( $tree->toJSONnicelly() );

        $flag = $this->compare( $cur, $exp);
        $this->assertEquals( true, $flag, 'The JSON string are not equals.');
    }
}