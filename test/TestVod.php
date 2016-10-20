<?php

require 'vendor/autoload.php';

class TestVod extends \PHPUnit_Framework_TestCase
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

    public function testGetAllVod()
    {
        $this->rest->expects($this->once())->method('get')->will($this->returnValue(true));

        $vod = new \Dacast\Elements\Vod($this->rest);

        $vod = $vod->all();
        $this->assertEquals(true, $vod);
    }

    public function testGetVod()
    {   
        $this->rest->expects($this->once())->method('get')->will($this->returnValue([
            'id'    => 423025
        ]));
        
        $vod = new \Dacast\Elements\Vod($this->rest);
        
        $vod = $vod->get(['id' => 423025]);
        $this->assertEquals(423025, $vod['id']);

        return $vod;
    }

    public function testUploadVod()
    {
        $this->rest->expects($this->once())->method('upload')->will($this->returnValue([
            'id'    => 423025
        ]));

        $vod = new \Dacast\Elements\Vod($this->rest);

        $vod = $vod->uploadVod([
            "originalFilename" => 'test',
            "file" => "./test/test.mp4"
        ],function($progress){
            var_dump('$progress');
            var_dump($progress);
        },function($result){
            var_dump('$result');
            var_dump($result);
            $this->assertEquals(423025, $result['id']);
        });

        return $vod;
    }

    /**
     * @depends testGetVod
     */
    public function testModifyChannel($file)
    {
        $this->rest->expects($this->once())->method('put')->will($this->returnValue([
            'id'    => $file['id'],
            'title' => 'title modified'
        ]));

        $vod = new \Dacast\Elements\Vod($this->rest);

        $file = $vod->modify([
            'id' => $file['id'],
            'title' => 'title modified'
        ]);

        $this->assertEquals('title modified', $file['title']);
    }

    /**
     * @depends testGetVod
     */
    public function testDeleteChannel($file)
    {
        $this->rest->expects($this->once())->method('delete')->will($this->returnValue(true));

        $vod = new \Dacast\Elements\Vod($this->rest);

        $file = $vod->delete([
            'id' => $file['id']
        ]);

        $this->assertEquals(true, $file);
    }


}