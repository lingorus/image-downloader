<?php

namespace App;

use App\Config\Config;
use App\Queue\DoneQueue;
use App\Queue\DownloadQueue;
use App\Queue\FailedQueue;
use Symfony\Component\Config\Definition\Exception\Exception;


/**
 * Class DownloadCommand
 * @package App
 */
class DownloadCommand implements Command 
{
    private static $queueName = 'download';

    public function run($args)
    {
        while($element = (new DownloadQueue())->getElement()){
            if ($this->download(trim($element->getFileUrl()))){
                $element->sendToQueue(DoneQueue::$queueName);
            } else {
                $element->sendToQueue(FailedQueue::$queueName);
            }
        }
    }

    private function download($url){
        $emageDir = Config::getConfig()->getParam('images_dir');
        $path_parts = pathinfo($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        $result = curl_exec($ch);
        if ($result){
            $extension = self::getExtensionByMimeType(curl_getinfo($ch, CURLINFO_CONTENT_TYPE));
            $saveFile = fopen($emageDir .'/'. $path_parts['filename'] . '(' . uniqid() . ')' . '.' . $extension , 'w');
            fwrite($saveFile, $result);
            fclose($saveFile);
        }
        curl_close($ch);
        return $result ? true : false;
    }

    private static function getExtensionByMimeType($mimeType)
    {
        $map = array(
            'image/gif'         => 'gif',
            'image/jpeg'        => 'jpg',
            'image/png'         => 'png',
        );
        return $map[strtolower($mimeType)];
    }


}
