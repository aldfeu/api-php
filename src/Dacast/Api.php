<?php
namespace Dacast;

use Dacast\Elements\Live;
use Dacast\Elements\Package;
use Dacast\Elements\Playlist;
use Dacast\Elements\Vod;
use Dacast\Rest;

class Api
{
    /**
     * @var Live
     */
    public $live;

    public $vod;

    public $package;

    public $playlist;

    public function __construct($apiKey)
    {
        $rest = new Rest($apiKey);
        $this->live = new Live($rest);
        $this->package = new Package($rest);
        $this->playlist = new Playlist($rest);
        $this->vod = new Vod($rest);

    }
}
