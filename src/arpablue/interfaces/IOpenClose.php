<?php


namespace ArpaBlue\interfaces;
/**
 * Interface IOpenClose
 * It set the open() and close() methods to the child.
 * @package ArpaBlue\interfaces
 *
 */

interface IOpenClose
{
    /**
     * It open the channel for a connection.
     * @return boolean It is true the channel has been opened without problems.
     */
    public function open();
    /**
     * It close the connection.
     * @return boolean It is true the connection has been closed without problems.
     */
    public function close();
    /**
     * It return the current state of the object.
     * @return boolean It is true the connection is open.
     */
    public function isOpen();
}