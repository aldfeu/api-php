<?php

namespace Dacast\Elements;

use Dacast\Rest;

class Vod
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
        $vod = $this->rest->get('vod');
        return $vod;
    }

    public function get($data)
    {
        $vod = $this->rest->get('vod/'.$data['id']);
        return $vod;
    }

    public function create($data)
    {
        if(!array_key_exists('flash', $data)){
            $data['flash'] = 0;
        };

        $vod = $this->rest->post('vod/'.$data['id'], $data);
        return $vod;
    }

    public function modify($data)
    {
        $vod = $this->rest->put('vod/'.$data['id'],$data);
        return $vod;
    }

    public function delete($data)
    {
        $vod = $this->rest->delete('vod/'.$data['id'],$data);
        return $vod;
    }

    public function transcodingList($data)
    {
        $vod = $this->rest->get('vod/'.$data['id'].'/transcoding');
        return $vod;
    }
    public function encodeVod($data)
    {
        $vod = $this->rest->post('vod/'.$data['id'].'/transcoding', $data);
        return $vod;
    }

    public function uploadVod($data, $callbackProgress, $callbackSuccess)
    {
        $vod = $this->rest->upload('vod', $data, $callbackProgress, $callbackSuccess);
        return $vod;
    }

    public function uploadSplashscreen($data)
    {
        $vod = $this->rest->upload('vod/'.$data['id'].'/splash', $data);
        return $vod;
    }

    public function uploadThumbnail($data)
    {
        $vod = $this->rest->upload('vod/'.$data['id'].'/thumbnail', $data);
        return $vod;
    }
}
