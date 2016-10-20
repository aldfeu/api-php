<?php

namespace Dacast\Elements;

use Dacast\Rest;

class Playlist
{
    /**
     * @var Rest
     */
    private $rest;

    public function __construct(Rest $rest)
    {
        $this->rest = $rest;
    }

    public function all()
    {
        $playlist = $this->rest->get('playlist');
        return $playlist;
    }

    public function get($data)
    {
        $playlist = $this->rest->get('playlist/'.$data['id']);
        return $playlist;
    }

    public function create($data)
    {
        if(!array_key_exists('flash', $data)){
            $data['flash'] = 0;
        };

        $playlist = $this->rest->post('playlist/'.$data['id'], $data);
        return $playlist;
    }

    public function modify($data)
    {
        $playlist = $this->rest->put('playlist/'.$data['id'],$data);
        return $playlist;
    }

    public function delete($data)
    {
        $playlist = $this->rest->delete('playlist/'.$data['id'],$data);
        return $playlist;
    }

    public function uploadSplashscreen($data)
    {
        $vod = $this->rest->upload('playlist/'.$data['id'].'/splash', $data);
        return $vod;
    }

    public function uploadThumbnail($data)
    {
        $vod = $this->rest->upload('playlist/'.$data['id'].'/thumbnail', $data);
        return $vod;
    }
}
