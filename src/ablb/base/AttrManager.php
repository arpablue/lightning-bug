<?php


namespace Ablb\base;

use Ablb\User\User;
use ArpaBlue\AbTools\ArrayTool;

/**
 * Class AttrManager
 * It class contain the methods to manage the
 * @package Ablb\base
 */
class AttrManager extends AttrManager_DAO
{
    ////////////////////////////////////////////constructors destructor /////////////////////////////////////
    /**
     * MapRouter destructor.
     */
    public function __destruct(){
        parent::__destruct();
    }
    /**
     * MapRouter constructor.
     */
    public function __construct(){
        parent::__construct();
        $this->mAttrs = array();
    }
    ///////////////////////////////////// Methods //////////////////////////////////////
    /**
     * It evaluate is value is null or a empty string.
     * @param $value string It is the value to be evaluate.
     * @return bool It is false then the value is null or empty.
     */
    protected static function validValue( $value )
    {
        if( $value == null )
        {
            return false;
        }
        $value = $value.'';
        if( strlen( $value ) < 1)
        {
            return false;
        }
        return true;
    }
    /**
     * It return the value of a attribute, but if the attribute not exist then return null,
     * to verify than an attribute exists, use the exists() method
     * @param $attr
     * @return mixed|null
     */
    public function getAttribute( $attr )
    {
        if( $this->exists( $attr ) )
        {
            return $this->mAttrs[$attr];
        }
        return false;
    }

    /**
     * It specify a value for an attribute, if the attribute not exists then iks add to the list of attribute
     * @param $attr
     * @param $value
     */
    public function setAttribute( $attr , $value )
    {
        if( $this->mAttrs == null )
        {
            $this->mAttrs = array();
        }
        $this->mAttrs[$attr] = $value;
    }
    /**
     * It set an array as attributes of the object.
     * @param $attrs array It is the new group of attributes for the current object.
     */
    public function setAttributes( $attrs )
    {
        if( $attrs == null ){
            $this->warning('It is not possible assign NULL values to the attributes of the user.');
            return false;
        }

        $this->mAttrs = $attrs;
        return true;
    }

    /**
     * It return the current group of attributes of the current object
     * @return array It is the attributes and its values.
     */
    public function getAttributes()
    {
        return $this->mAttrs;
    }
    /**
     * It verify if an attribute exists in the current attributes of the objects
     * @param $attr string It is the attribute name
     * @return bool It is true the attribute exists.
     */
    public function exists( $attr )
    {
        if( $this->mAttrs == null )
        {
            return false;
        }
        foreach( $this->mAttrs as $k => $v )
        {
            if( strcmp( $k, $attr ) == 0){
                return true;
            }
        }
        return false;
    }
    /**
     * It compare the current object attributes with the target, if the target contains all
     * attributes of the current object and the values of this objects are equals then return
     * true, in other case return false. If the target object to compare has additional attributes
     * then these attributes are contemplate in the comparison process.
     * @param $target AttrManager It is the object to be compare.
     * @return bool It is true if the attributes of the current objects exists in the target
     * and it has the same values.
     */
    public function compare( $target )
    {
        $v2 = null;
        $flag = true;
        foreach( $this->mAttrs as $k => $v1)
        {
            $v2= $target->getAttribute( $k ).'';
            $v1 = $v1.'';
            if( strcmp( $v1, $v2 ) != 0 )
            {
                $flag = false;
            }
        }
        return $flag;
    }

    /**
     * It return the a copy of the current object, the same values, but a different object.
     * @return User It is the a copy of the current object.
     */
    public function clone()
    {
        $user = new User();
        if( $this->mAttrs == null )
        {
            return $user;
        }
        foreach( $this->mAttrs as $k => $v )
        {
            $user->setAttribute( $k, $v );
        }
        return $user;
    }
    /**
     * It show the data of the object isn a JSON format to show in structure to be displayed and reviewed
     * by a person without problems.
     * @return string
     */
    public function toJSONnicelly( $margin = '    ', $allowNull = false )
    {
        $res = ArrayTool::toJSONnicelly($this->mAttrs, $margin, $allowNull);
        return $res;
    }
    /**
     * It return a treepath of the current attributes of the object. If the some problems
     * happen to try to build the treepath then return null.
     * @return null|string It is the JSON of the current object.
     */
    public function toJSON()
    {
        $res = json_encode($this->mAttrs);
        if( $res === false ){
            $this->warning('It is not possible return a JSON object.');
            return null;
        }
        return $res;
    }

    /**
     * It load the attributes from a treepath format
     * @param string $json It contain the jason format.
     * @return bool It is true the parse has been did without problems.
     */
    public function parseJSON( $json )
    {
        if( $json == null )
        {
            $this->warning('It  is not possible parse a JSON with null value.');
            $this->mAttrs = array();
            return false;
        }
        $this->mAttrs = json_decode($json);
        return true;
    }

    /**
     * It return an array with the name of the current attributes as keys and the respective values
     * of this attributes.
     * @return array It is the array of the attributes of the current object.
     */
    public function toArray()
    {
        return $this->mAttrs;
    }

    /**
     * It return the current time stamp in a string format.
     * @return mixed It is the current time stamp
     */
    public static function getTimeStamp()
    {
        $res = new Datetime('now');
        return $res->format('U');

    }

    /**
     * It verify the data if a value is valid, this method evaluate if the values has been assigned, is different to NULL and
     * the value is not empty.
     * @param $value mixed It is the value to be evaluated.
     * @return bool It is return the value of the variable is valid.
     */
    protected static function validData( $value )
    {
        if( !isset( $value ) )
        {

            return false;
        }
        if( $value == null )
        {
            return false;
        }
        $kind = gettype( $value );
        if( strcmp('string', $kind ) == 0 )
        {
            if( strlen( $kind ) < 1 )
            {
                return false;
            }
        }
        return false;
    }
//    /**
//     * It verify if a data exist in the database and table assigned.
//     * @return bool If is true then the current data exists.
//     *
//     */
//    public function isExists()
//    {
//        $id = $this->getAttribute('id');
//        if( !AttrManager::validData( $id ) )
//        {
//            return false;
//        }
//        $sql = ' SELECT COUNT(*) FROM '.$this->mTable.' WHERE id='.$id;
//        $res = $this->getDbConnector()->executeQuery("sql");
//        if( $res == null )
//        {
//            return false;
//        }
//        if( count( $res ) < 1)
//        {
//            return false;
//        }
//        return true;
//
//    }
    /**
     * @param $uri string It extract the iud from the last value of a URI.
     * @return bool It is the id has been identified.
     */
    public function addIdFromRequest( $endPoint )
    {
        if( $endPoint == null )
        {
            $this->warning('It is not possible load a the ID from a NULL endpoint.');
            return false;
        }
        if( strlen($endPoint) < 1 )
        {
            $this->warning('It is not possible load a the ID from an empty endpoint.');
            return false;
        }
        $v = explode('/', $endPoint );
        $e = $v[count($v) - 1];
        if( $e == null )
        {
            $this->warning('It is not possible load a the ID from a NULL endpoint without an ID.');
            return false;
        }
        if( !is_numeric( $e ) )
        {
            $this->warning('The ID specified do not have a numeric value '.$endPoint);
            return false;
        }
        $this->success('The user has been found.');
        $this->setId( $e );

        return true;
    }

}