<?php
/**
 * Created by PhpStorm.
 * User: PC-1
 * Date: 05.02.2016
 * Time: 18:27
 */

namespace App\Queue\Handler;


use App\Queue\QueueElement;

interface QueueHandlerInterface
{
	public static function getInstance();

	/**
	 * @param QueueElement $element
	 * @return QueueElement
	 */
	public function enqueue(QueueElement $element);

	/**
	 * @param $queue
	 * @return QueueElement|bool
	 */
	public function dequeue($queue);
}