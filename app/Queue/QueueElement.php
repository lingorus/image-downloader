<?php
/**
 * Created by PhpStorm.
 * User: PC-1
 * Date: 04.02.2016
 * Time: 17:06
 */

namespace App\Queue;


use App\Config\Config;

class QueueElement
{

	const STATUS_NEW = 1;
	const STATUS_DONE = 2;

	protected $id;
	protected $queueName;
	protected $fileUrl;
	protected $status;

	public function sendToQueue($queueName)
	{
		$this->setQueueName($queueName)->save();
	}

	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	public function setQueueName($queueName)
	{
		$this->queueName = $queueName;
		return $this;
	}

	public function setStatus($status)
	{
		$this->status = $status;
		return $this;
	}

	public function setFileUrl($url)
	{
		$this->fileUrl = $url;
		return $this;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getQueueName()
	{
		return $this->queueName;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getFileUrl()
	{
		return $this->fileUrl;
	}

	public function save(){
		$config = Config::getConfig();
		$queueHandlerClass = $config->getParam('queue_handler');
		$queueHandler = $queueHandlerClass::getInstance();
		$queueHandler->enqueue($this);
		return $this;
	}

	public static function getByQueue($queue)
	{
		$config = Config::getConfig();
		$queueHandlerClass = $config->getParam('queue_handler');
		$queueHandler = $queueHandlerClass::getInstance();
		return $queueHandler->dequeue($queue);

	}


}

