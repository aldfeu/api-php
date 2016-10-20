<?php

namespace Dacast\Elements;

use Dacast\Rest;

class Package
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
        $package = $this->rest->get('package');
        return $package;
    }

    public function get($data)
    {
        $package = $this->rest->get('package/'.$data['id']);
        return $package;
    }

    public function create($data)
    {
        if(!array_key_exists('flash', $data)){
            $data['flash'] = 0;
        };

        $package = $this->rest->post('package/'.$data['id'], $data);
        return $package;
    }

    public function modify($data)
    {
        $package = $this->rest->put('package/'.$data['id'],$data);
        return $package;
    }

    public function delete($data)
    {
        $package = $this->rest->delete('package/'.$data['id'],$data);
        return $package;
    }

    public function uploadSplashscreen($data)
    {
        $vod = $this->rest->upload('package/'.$data['id'].'/splash', $data);
        return $vod;
    }

    public function uploadThumbnail($data)
    {
        $vod = $this->rest->upload('package/'.$data['id'].'/thumbnail', $data);
        return $vod;
    }
}
