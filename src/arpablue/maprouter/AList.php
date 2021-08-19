<?php


namespace ArpaBlue\MapRouter;


class AList
{
    protected $mList;
    ////////////////////////////////////////////constructors destructor /////////////////////////////////////
    /**
     * MapRouter destructor.
     */
    public function __destruct(){}
    /**
     * MapRouter constructor.
     */
    public function __construct(){}
    ///////////////////////////////////// Methods //////////////////////////////////////
    /**
     * it return the number of elements in the list
     * @return int It is the number of elements in the list.
     */
    public function size(){
        $size = 0;
        if( $this->mList == null ){
            $size = 0;
        }
        $size = count( $this->mList );
        return $size;
    }
    /**
     * it verify is a key exist or partial key in the list .
     * @param $key mixed It is the reference of the key in the list.
     * @return bool It is true if the element exists
     */
    public function exits( $key ){

        if( $key == null ){
            return false;
        }
        if( $this->mList == null ){
            return false;
        }
        $key = trim( $key );
        foreach( $this->mList as $k => $v ){
            if( strcasecmp( $key, $k ) == 0 ){
                return true;
            }
        }
        return false;
    }
    /**
     * It return the value assigned to a key.
     * @param $key mixed It is the key in the list,
     * @return mixed|null It is the value assigned to a key, if the key not exist could not exists, to verify this use
     * the exists() method.
     */
    public function get( $key ){
        if( !$this->exits( $key ) ){
            return null;
        }
        foreach( $this->mList as $k => $v ){
            if( strcasecmp( $key, $k ) == 0 ){
                return $v;
            }
        }
        return null;
    }
    /**
     * It specify a value for a key in the list, if the key not exists then is add to the list.
     * @param $key mixed It is the key of the list.
     * @param $value mixed|null It is th value assigned to the $key.
     */
    public function put( $key, $value ){
        if( $key == null ){
            return;
        }
        if( $value == null ){
            return;
        }
        $key = trim( $key );
        $value = trim( $value );
        $this->mList[ $key ] = $value;
    }
    /**
     * It return a value of index.
     * @param $index int It is the position in the list.
     * @return mixed It is the value of the index, if the index not exist then the method return null.
     */
    public function getIndex( $index ){
        $i = 0;
        foreach ( $this->mList as $value  ){
            if( $i == $index ){
                return $value;
            }
            $i++;
        }
        return null;
    }
    /**
     * it return the key corresponding position in the list.
     * @param $index int It is a position in the list.
     * @return int|string|null It return the key of index.
     */
    public function getKey( $index ){
        $i = 0;
        foreach ( $this->mList as $key => $value  ){
            if( $i == $index ){
                return $key;
            }
            $i++;
        }
        return null;
    }

    /**
     * It return the list of keys.
     * @return array It is the arrays of keys used in the currently.
     */
    public function getKeys(){
        $keys = array();
        if( $this->mList == null ){
            return $keys;
        }
        foreach ( $this->mList as $key => $value ){
            $keys[] = $key;
        }
        return $keys;
    }
    /**
     * It return the content of the URL reference in a JSON format in nicelly way.
     * @return string It is the data in JSON format.
     */
    public function toJSONnicelly($margin = "" ){
        $res = "{\n";
        if($this->mList == null ){
            return '{}';
        }
        if( $this->size() < 1 ){
            return '{}';
        }
        $flag = false;
        foreach( $this->mList as $key => $value ){
            if( $flag ){
                $res = $res . ",\n";
            }
            $res = $res .  $margin . $margin . $margin ."\"" . $key . "\":\"" . $value . "\"";
            $flag = true;
        }
        $res = $res . "\n" . $margin . $margin . "}";
        return $res;
    }
}