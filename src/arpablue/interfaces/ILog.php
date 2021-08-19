<?php


namespace ArpaBlue\interfaces;


use ArpaBlue\abtools\Logger;

interface ILog
{

    /**
     * It raise a message in the log file with an ERROR tag at the beginning of the message.
     * @param $msg string It is the message to be written as ERROR.
     */
    public function error( $msg );
    /**
     * It raise a message in the log file with an ERROR tag at the beginning of the message.
     * @param $msg string It is the message to be written as ERROR.
     */
    public function warning( $msg );
    /**
     * It raise a message in the log file with an ERROR tag at the beginning of the message.
     * @param $msg string It is the message to be written as ERROR.
     */
    public function info( $msg );
    /**
     * It raise a message in the log file without a tag.
     * @param $msg string It is the message to be written.
     */
    public function log( $msg );

}