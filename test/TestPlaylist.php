<?php

require 'vendor/autoload.php';

class TestPlaylist extends \PHPUnit_Framework_TestCase
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

    public function testGetAllPlaylist()
    {
        $this->rest->expects($this->once())->method('get')->will($this->returnValue(true));

        $playlist = new \Dacast\Elements\Playlist($this->rest);

        $playlist = $playlist->all();
        $this->assertEquals(true, $playlist);
    }

    public function testGetPlaylist()
    {   
        $this->rest->expects($this->once())->method('get')->will($this->returnValue([
            'id'    => 423025
        ]));

        $playlist = new \Dacast\Elements\Playlist($this->rest);

        $playlist = $playlist->get(['id' => 423025]);
        $this->assertEquals(423025, $playlist['id']);
    }

    public function testCreatePlaylist()
    {
        $this->rest->expects($this->once())->method('post')->will($this->returnValue([
            'id'    => 423025,
            'title' => 'new playlist'
        ]));

        $playlist = new \Dacast\Elements\Playlist($this->rest);

        $playlist = $playlist->create([
            'id' => 423025,
            'title' => 'new playlist',
            'description' => 'new playlist description'
        ]);


        $this->assertEquals(423025, $playlist['id']);

        return $playlist;
    }

    /**
     * @depends testCreatePlaylist
     */
    public function testModifyPlaylist($playlist)
    {
        $this->rest->expects($this->once())->method('put')->will($this->returnValue([
            'id'    => $playlist['id'],
            'title' => 'title modified'
        ]));

        $play = new \Dacast\Elements\Playlist($this->rest);

        $play = $play->modify([
            'id' => $playlist['id'],
            'title' => 'title modified'
        ]);

        $this->assertEquals('title modified', $play['title']);
    }

    /**
     * @depends testCreatePlaylist
     */
    public function testDeleteChannel($play)
    {
        $this->rest->expects($this->once())->method('delete')->will($this->returnValue(true));

        $playlist = new \Dacast\Elements\Playlist($this->rest);

        $playlist = $playlist->delete([
            'id' => $play['id']
        ]);

        $this->assertEquals(true, $playlist);
    }


}