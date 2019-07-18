<?php
namespace App\Services;

use LastFmApi\Api\AuthApi;
use LastFmApi\Api\ArtistApi;
use LastFmApi\Api\TrackApi;
use LastFmApi\Api\TagApi;

class LastfmService
{
    private $apiKey;
    private $artistApi;
    private $trackApi;
    private $tagApi;

    public function __construct()
    {
        $this->apiKey = '6d838ada4677a7fe0c999e88516e45f8'; //required
        $auth = new AuthApi('setsession', array('apiKey' => $this->apiKey));
        $this->artistApi = new ArtistApi($auth);
        $this->trackApi = new TrackApi($auth);
    }
    public function getBio($artist)
    {
        $artistInfo = $this->artistApi->getInfo(array("artist" => $artist));

        return $artistInfo['bio'];
    }

    public function getTrackInfo($track,$artist)
    {
        $trackInfo = $this->trackApi->getInfo(array("artist" => $artist, "track" => $track, "autocorrect" => '1'));

        return $trackInfo;
    }

    public function getSimilar($tag)
    {
        $similarTrack = $this->tagApi->getSimilar(array("tag" => $tag));

        return $trackInfo;
    }
    //
    // $artistInfo = $this->artistApi->getInfo(array("artist" => "Get Scared"));
    // $trackInfo = $this->trackApi->getInfo(array("artist" => "AC/DC", "track" => "Highway to Hell"));
}
