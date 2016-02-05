<?php
/**
 * Created by PhpStorm.
 * User: PC-1
 * Date: 04.02.2016
 * Time: 17:06
 */

namespace App\Queue;


abstract class Queue
{


	public static $queueName;

	/**
	 * @return QueueElement
	 */
	public function getElement()
	{
		return QueueElement::getByQueue(static::$queueName);
	}

	public function putElement(QueueElement $element){
		$element
			->setStatus(QueueElement::STATUS_NEW)
			->setQueueName(static::$queueName);
		$element->save();
		return $element;
	}
}