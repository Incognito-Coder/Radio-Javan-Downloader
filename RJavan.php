<?php

namespace RadioJavan;

error_reporting(0);

/**
 * @author Incognito Coder
 * @copyright 2020-2021 ICDev
 * @version 1.8
 */
class Downloader
{
    private $Array = [];
    const MP3 = 'mp3s/mp3_host';
    const PODCAST = 'podcasts/podcast_host';
    const VIDEO = 'videos/video_host';

    /**
     * @param string $type pass media type here[video, music, podcast]
     * @param mixed $url given media link from radio javan.
     */
    function Download($type, $url)
    {
        if ($type == "music") {
            $split = explode('mp3/', $this->Recognize($url));
            $parsed = $split[1];
            $file = "https://www.radiojavan.com/" . self::MP3 . "?id=$parsed";
        } elseif ($type == "podcast") {
            $split = explode('podcast/', $this->Recognize($url));
            $parsed = $split[1];
            $file = "https://www.radiojavan.com/" . self::PODCAST . "?id=$parsed";
        } elseif ($type == "video") {
            $split = explode('video/', $this->Recognize($url));
            $parsed = $split[1];
            $file = "https://www.radiojavan.com/" . self::VIDEO . "?id=$parsed";
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $file,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_COOKIEFILE => 'cookies.txt',
            CURLOPT_COOKIEJAR => 'cookies.txt',
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36',
                'Accept: */*',
                'Pragma: no-cache'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $reslut = json_decode($response);
        if ($type == "music") {
            return json_encode(['status' => true, 'type' => $this->MediaType(), 'result' => $reslut->host . "/media/mp3/mp3-256/$parsed.mp3", 'title' => $parsed, 'photo' => $this->CoverArt($url)], 128) . PHP_EOL;
        } elseif ($type == "podcast") {
            return json_encode(['status' => true, 'type' => $this->MediaType(), 'result' => $reslut->host . "/media/podcast/mp3-192/$parsed.mp3", 'title' => $parsed, 'photo' => $this->CoverArt($url)], 128) . PHP_EOL;
        } elseif ($type == "video") {
            return json_encode(['status' => true, 'type' => $this->MediaType(), 'result' => $reslut->host . "/media/music_video/hd/$parsed.mp4", 'title' => $parsed, 'photo' => $this->CoverArt($url)], 128) . PHP_EOL;
        } else {
            return json_encode(['status' => false, 'result' => 'incorrect data or another error occured.'], 128) . PHP_EOL;
        }
    }

    function Recognize($url)
    {
        $this->Array = get_defined_vars();
        if (strpos($url, 'rjplay.co')) {
            $headers = get_headers($url, 1);
            $query = parse_url($headers['Location'], PHP_URL_PATH);
            return $query;
        } elseif (strpos($url, 'rj.app')) {
            $headers = get_headers($url, 1);
            $query = parse_url($headers['Location'], PHP_URL_PATH);
            return $query;
        } elseif (strpos($url, 'rjvan.me')) {
            $headers = get_headers($url, 1);
            $query = parse_url($headers['location'], PHP_URL_PATH);
            return $query;
        } elseif (strpos($url, 'radiojavan.com')) {
            $query = parse_url($url, PHP_URL_PATH);
            return $query;
        }
    }

    function MediaType()
    {
        $file = $this->Recognize($this->Array['url']);
        if (strpos($file, 'mp3s') !== false) {
            return 'music';
        } elseif (strpos($file, 'podcasts') !== false) {
            return 'podcast';
        } elseif (strpos($file, 'videos') !== false) {
            return 'video';
        }
    }
    function CoverArt($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_COOKIEFILE => 'cookies.txt',
            CURLOPT_COOKIEJAR => 'cookies.txt',
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36',
                'Accept: */*',
                'Pragma: no-cache'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        preg_match("~<img.*src\s*=\s*[\"']([^\"']+)[\"'][^>]*>~i", $response, $m);
        return $m[1];
    }
}
