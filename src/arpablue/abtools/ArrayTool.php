<?php


namespace ArpaBlue\AbTools;


class ArrayTool
{
    /**
     * It pass the content of an array to JSON format to be shown nicelly.
     * @param array $target  It is the array to be shown on JSON format.
     * @param string $margin It is the space blank used as margin of the elements.
     * @param boolean $allowBoolean It is the space blank used as margin of the elements.
     * @return string It is the JSON format of the array.
     */
    public static function toJSONnicelly($target, $margin = '    ', $allowNull = true )
    {
        if( $target == null )
        {
            return 'null';
        }
        $size = count( $target );
        if( $size < 1)
        {
            return '{}';
        }
        $res = "{";
        $flag = false;
        foreach($target as $k => $v ) {
            $field = "\"" . $k . "\":";
            if( is_array( $v ) )
            {
                $field = $field . ArrayTool::toJSONnicelly( $v,$margin.'    ', $allowNull );
            }else{
                if( $v == null ){
                    if( $allowNull )
                    {
                        $field = $field . "null";
                    }else{
                        $field = null;
                    }
                }else{
                    $field = $field . "\"".$v."\"";
                }
            }
            if( $field != null )
            {
                if( $flag ){
                    $res = $res . ",\r\n" . $margin . '    ' . $field;
                }else {
                    $res = $res . "\r\n" . $margin . '    ' . $field;
                }
                $field = true;
            }
            $flag = true;
        }
        $res = $res . "\r\n" . $margin . "}";
        return $res;
    }
    /**
     * It pass the content of an array to JSON format to be shown nicelly.
     * @param array $target  It is the array to be shown on JSON format.
     * @return string It is the JSON format of the array.
     */
    public static function toJSON($target)
    {
        if( $target == null )
        {
            return 'null';
        }
        $size = count( $target );
        if( $size < 1)
        {
            return "{}";
        }
        $res = "{";
        $first = false;
        foreach($target as $k => $v )
        {
            if( $first )
            {
                $res = $res . ",";
            }
            $first = true;
            $res = $res . "\"".$k."\":";
            $kind = gettype( $v );
            if( strcasecmp($kind, 'string') == 0)
            {
                $v = "\"".$v."\"";
            }
            $res = $res . $v;

        }
        $res = $res . "}";
        return $res;
    }
}