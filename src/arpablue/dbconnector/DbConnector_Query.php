<?php


namespace ArpaBlue\dbconnector;

/**
 * Class DbConnector_Query
 * It class conatains the method to process the query and request of the database.
 * @package ArpaBlue\dbconnector
 */
abstract class DbConnector_Query extends DbConnector_DTO
{
    /**
     * @param $sql String It is the query to be executed.
     * @return array It is hte result of the query.
     */
    public abstract function executeQuery( $sql );

    /**
     * It execute a sql that not return the a result, the sql only modify data in the database, like update, insert, etc.
     * @param $sql String It is the sql sentence to be executed.
     * @return boolean It is true, the query has been executed without problem.
     */
    public abstract function executeNonQuery( $sql );
}