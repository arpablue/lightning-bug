<?php



class ArrayToolTest extends \BaseTest
{
    /**
     * It verify the arrays set on format treepath array.
     */
    public function test_ArrayTool_toJSONnicelly()
    {
        $this->title('test_ArrayTool_toJSONnicelly');
        $vec = array();

        $vec['name'] = 'Jhonny';
        $vec['lastname'] = 'Prove';
        $vec['age'] = 12;
        $vec['sex'] = true;

        $exp = "{\r\n";
        $exp = $exp . "    \"name\":\"Jhonny\",\r\n";
        $exp = $exp . "    \"lastname\":\"Prove\",\r\n";
        $exp = $exp . "    \"age\":12,\r\n";
        $exp = $exp . "    \"sex\":1\r\n";
        $exp = $exp . "}";
        $cur = \ArpaBlue\AbTools\ArrayTool::toJSONnicelly( $vec );
        $this->log( $cur );
        $this->assertEquals($exp, $cur, 'The resulst are not equals' );
    }
    /**
     * It verify that an array can be set on JSON format and a margin can be set.
     */
    public function test_ArrayTool_toJSONnicelly_with_margin()
    {
        $this->title('test_ArrayTool_toJSONnicelly');
        $vec = array();

        $vec['name'] = 'Jhonny';
        $vec['lastname'] = 'Prove';
        $vec['age'] = 12;
        $vec['sex'] = true;

        $exp = "{\r\n";
        $exp = $exp . "        \"name\":\"Jhonny\",\r\n";
        $exp = $exp . "        \"lastname\":\"Prove\",\r\n";
        $exp = $exp . "        \"age\":12,\r\n";
        $exp = $exp . "        \"sex\":1\r\n";
        $exp = $exp . "    }";
        $cur = \ArpaBlue\AbTools\ArrayTool::toJSONnicelly( $vec, "    " );
        $this->log( $cur );
        $this->assertEquals($exp, $cur, 'The results are not equals' );
    }
    /**
     * It verify that an array can be set on JSON format.
     */
    public function test_ArrayTool_toJSON()
    {
        $this->title('test_ArrayTool_toJSONnicelly');
        $vec = array();

        $vec['name'] = 'Jhonny';
        $vec['lastname'] = 'Prove';
        $vec['age'] = 12;
        $vec['sex'] = true;

        $exp = "{";
        $exp = $exp . "\"name\":\"Jhonny\",";
        $exp = $exp . "\"lastname\":\"Prove\",";
        $exp = $exp . "\"age\":12,";
        $exp = $exp . "\"sex\":1";
        $exp = $exp . "}";
        $cur = \ArpaBlue\AbTools\ArrayTool::toJSON( $vec );
        $this->log( $cur );
        $this->assertEquals($exp, $cur, 'The results are not equals' );
    }

}