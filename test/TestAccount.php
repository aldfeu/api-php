<?php

require 'vendor/autoload.php';

class TestAccount extends \PHPUnit_Framework_TestCase
{
    public $rest;
    public $live;
    public $vod;
    public $package;
    public $playlist;

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->rest = $this->getMockBuilder('\Dacast\Rest')
            ->setConstructorArgs(array('65041_5e0e9cca5dcda8e8b36a'))
            ->getMock();
    }

    public function testSells()
    {
        $this->rest->expects($this->once())->method('get')->will($this->returnValue(true));

        $account = new \Dacast\Elements\Account($this->rest);

        $account = $account->sells();
        $this->assertEquals(true, $account);
    }
}
