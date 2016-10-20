<?php

namespace Dacast\Elements;

use Dacast\Rest;

class Live
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
        $channel = $this->rest->get('channel');
        return $channel;
    }
    
    public function get($data)
    {
        $channel = $this->rest->get('channel/'.$data['id']);
        return $channel;
    }

    public function create($data)
    {
        if(!array_key_exists('flash', $data)){
            $data['flash'] = 0;
        };

        $channel = $this->rest->post('channel', $data);
        return $channel;
    }

    public function modify($data)
    {
        $channel = $this->rest->put('channel/'.$data['id'],$data);
        return $channel;
    }

    public function delete($data)
    {
        $channel = $this->rest->delete('channel/'.$data['id'],$data);
        return $channel;
    }

    public function uploadSplashscreen($data)
    {
        $vod = $this->rest->upload('channel/'.$data['id'].'/splash', $data);
        return $vod;
    }

    public function uploadThumbnail($data)
    {
        $vod = $this->rest->upload('channel/'.$data['id'].'/thumbnail', $data);
        return $vod;
    }
}
