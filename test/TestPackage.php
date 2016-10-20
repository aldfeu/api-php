<?php

require 'vendor/autoload.php';

class TestPackage extends \PHPUnit_Framework_TestCase
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

    public function testGetAllPackage()
    {
        $this->rest->expects($this->once())->method('get')->will($this->returnValue(true));

        $package = new \Dacast\Elements\Package($this->rest);

        $package = $package->all();
        $this->assertEquals(true, $package);
    }

    public function testGetPackage()
    {   
        $this->rest->expects($this->once())->method('get')->will($this->returnValue([
            'id'    => 423025
        ]));

        $package = new \Dacast\Elements\Package($this->rest);

        $package = $package->get(['id' => 423025]);
        $this->assertEquals(423025, $package['id']);
    }

    public function testCreatePackage()
    {
        $this->rest->expects($this->once())->method('post')->will($this->returnValue([
            'id'    => 423025,
            'title' => 'new package'
        ]));

        $package = new \Dacast\Elements\Package($this->rest);

        $package = $package->create([
            'id' => 423025,
            'title' => 'new channel',
            'description' => 'new package description'
        ]);


        $this->assertEquals(423025, $package['id']);

        return $package;
    }

    /**
     * @depends testCreatePackage
     */
    public function testModifyPackage($pack)
    {
        $this->rest->expects($this->once())->method('put')->will($this->returnValue([
            'id'    => $pack['id'],
            'title' => 'title modified'
        ]));

        $package = new \Dacast\Elements\Package($this->rest);

        $package = $package->modify([
            'id' => $pack['id'],
            'title' => 'title modified'
        ]);

        $this->assertEquals('title modified', $package['title']);
    }

    /**
     * @depends testCreatePackage
     */
    public function testDeletePackage($pack)
    {
        $this->rest->expects($this->once())->method('delete')->will($this->returnValue(true));

        $package = new \Dacast\Elements\Package($this->rest);

        $package = $package->delete([
            'id' => $pack['id']
        ]);

        $this->assertEquals(true, $package);
    }


}