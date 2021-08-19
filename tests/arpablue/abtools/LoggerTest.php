<?php
include_once ('tests/arpablue/libtest/BaseTest.php');

use PHPUnit\Framework\TestCase;
use ArpaBlue\AbTools\Logger;
/**
 * Class MapRouteTestIt is the test for the MapRouter, It test the public method.
 */
class LoggerTest extends BaseTest
{

    /**
     * It write a message in the log file, this message not have tag.
     */
    public function test_LoggerTest_add_a_message_in_the_log_file(){
        $this->write("\n-------------------test_LoggerTest_add_a_message_in_the_log_file\n");
        $target = new Logger('./logs/test.log',Logger::$LOG_ALL);

        $target->log('This is the log file');
        $target->log('This is the second line of the log file.');
        $this->assertEquals( true, true,"It is not possible create the log file.");

    }
    /**
     * It write an INFO in the log file, this message not have tag.
     */
    public function test_LoggerTest_add_an_INFO_in_the_log_file(){
        $this->write("\n-------------------test_LoggerTest_add_an_INFO_in_the_log_file\n");
        $target = new Logger('./logs/test.log',Logger::$LOG_ALL);
        $target->info('This is the log file');
        $target->info('This is the second line of the log file.');

        $this->assertEquals( true, true,"It is not possible create the log file.");

    }
    /**
     * It write an INFO in the log file, this message not have tag.
     */
    public function test_LoggerTest_add_a_WARNING_in_the_log_file(){
        $this->write("\n-------------------test_LoggerTest_add_a_WARNING_in_the_log_file\n");
        $target = new Logger('./logs/test.log',Logger::$LOG_ALL);
        $target->warning('This is the log file');
        $target->warning('This is the second line of the log file.');

        $this->assertEquals( true, true,"It is not possible create the log file.");

    }
    /**
     * It write an INFO in the log file, this message not have tag.
     */
    public function test_LoggerTest_add_a_ERROR_in_the_log_file(){
        $this->write("\n-------------------test_LoggerTest_add_a_ERROR_in_the_log_file\n");
        $target = new Logger('./logs/test.log',Logger::$LOG_ALL);
        $target->error('This is the log file');
        $target->error('This is the second line of the log file.');

        $this->assertEquals( true, true,"It is not possible create the log file.");

    }



}