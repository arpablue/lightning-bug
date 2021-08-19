<?php


namespace ArpaBlue\interfaces;

/**
 * Interface IJson
 * @package ArpaBlue\interfaces
 */
interface IJson
{
    /**
     * It return a string with all data of the current object is a JSON format.
     * @return string It is the data in JSON format.
     */
    function toJSON();
    /**
     * It return a string with all data of the current object is a JSON format, but to be displayed to be
     * comfortable to the view.
     * @return string It is the data in JSON format.
     */
    function toJSONnicelly();
}