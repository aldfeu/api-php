<?php

require 'vendor/autoload.php';

class TestChannel extends \PHPUnit_Framework_TestCase
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

    public function testGetAllChannel()
    {
        $this->rest->expects($this->once())->method('get')->will($this->returnValue(true));

        $live = new \Dacast\Elements\Live($this->rest);

        $channel = $live->all();
        $this->assertEquals(true, $channel);
    }

    public function testGetChannel()
    {   
        $this->rest->expects($this->once())->method('get')->will($this->returnValue([
            'id'    => 423025
        ]));
        
        $live = new \Dacast\Elements\Live($this->rest);
        
        $channel = $live->get(['id' => 423025]);
        $this->assertEquals(423025, $channel['id']);
    }

    public function testCreateChannel()
    {
        $this->rest->expects($this->once())->method('post')->will($this->returnValue([
            'id'    => 423025,
            'title' => 'new channel'
        ]));

        $live = new \Dacast\Elements\Live($this->rest);

        $channel = $live->create([
            'id' => 423025,
            'title' => 'new channel',
            'description' => 'new channel description'
        ]);

        $this->assertEquals(423025, $channel['id']);

        return $channel;
    }

    /**
     * @depends testCreateChannel
     */
    public function testModifyChannel($channel)
    {
        $this->rest->expects($this->once())->method('put')->will($this->returnValue([
            'id'    => $channel['id'],
            'title' => 'title modified'
        ]));

        $live = new \Dacast\Elements\Live($this->rest);

        $channel = $live->modify([
            'id' => $channel['id'],
            'title' => 'title modified'
        ]);

        $this->assertEquals('title modified', $channel['title']);
    }

    /**
     * @depends testCreateChannel
     */
    public function testDeleteChannel($channel)
    {
        $this->rest->expects($this->once())->method('delete')->will($this->returnValue(true));

        $live = new \Dacast\Elements\Live($this->rest);

        $channel = $live->delete([
            'id' => $channel['id']
        ]);

        $this->assertEquals(true, $channel);
    }


}