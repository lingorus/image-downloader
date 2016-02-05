<?php

namespace App;
use App\Config\Config;
use App\Queue\DownloadQueue;
use App\Queue\QueueElement;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class ScheduleCommand
 */
class ScheduleCommand implements Command 
{
    public function run($args)
    {
        $file = $args[0];

        /**
         * @param $handle
         * @return \Generator
         */
        function getStr($handle)
        {
            while (($buffer = fgets($handle)) !== false) {
                yield $buffer;
            }
            fclose($handle);
        }

        $handle = self::getFileHandler($file , "r");
        $generator = getStr($handle);
        foreach ($generator as $url) {
            $newQueueElement = new QueueElement();
            $newQueueElement->setFileUrl(trim($url));
            (new DownloadQueue())->putElement($newQueueElement);
        }
    }

    public function getFileHandler($file, $mode)
    {
        $handle = fopen($file, $mode);
        if (!$handle){
            throw new Exception("Can't open file " .  $file);
        }
        return $handle;
    }


}
