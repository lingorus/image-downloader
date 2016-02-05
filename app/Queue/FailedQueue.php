<?php
/**
 * Created by PhpStorm.
 * User: PC-1
 * Date: 04.02.2016
 * Time: 17:06
 */

namespace App\Queue;


class FailedQueue extends Queue
{
	public static $queueName = 'failed';

}