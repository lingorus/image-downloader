<?php
/**
 * Created by PhpStorm.
 * User: PC-1
 * Date: 05.02.2016
 * Time: 18:27
 */

namespace App\Queue\Handler;


use App\Db\Db;
use App\Queue\QueueElement;

class DbQueueHandler implements QueueHandlerInterface
{
	public static function getInstance(){
		return new self;
	}

	/**
	 * @param QueueElement $element
	 * @return QueueElement
	 */
	public function enqueue(QueueElement $element){
		$queueName = $element->getQueueName();
		$fileUrl = $element->getFileUrl();
		$sth = Db::getConnect()->prepare("insert into queue set  queue_name=:queue_name, file_url=:file_url");
		$sth->bindParam(':queue_name', $queueName);
		$sth->bindParam(':file_url', $fileUrl);
		$sth->execute();
		return $element;
	}


	/**
	 * @param $queue
	 * @return QueueElement|bool
	 */
	public function dequeue($queue){
		$dbConnect = Db::getConnect();
		$dbConnect->beginTransaction();
		try {
			$query = Db::getConnect()->prepare("
				select *
				from queue
				where queue_name = :queue_name
				ORDER  BY id
				limit 1 FOR UPDATE
	 		");
			$query->bindParam(':queue_name', $queue);
			$query->execute();
			$elementArray = $query->fetchAll();
			$element = false;
			if (!empty($elementArray)) {
				$element = new QueueElement();
				$element->setQueueName($elementArray[0]['queue_name']);
				$element->setFileUrl($elementArray[0]['file_url']);
				$element->setStatus($elementArray[0]['status']);;
				$queryDelete = Db::getConnect()->prepare("
					delete from queue where id = :id
	 			");
				$queryDelete->bindParam(':id', $elementArray[0]['id']);
				$queryDelete->execute();
			}
			$dbConnect->commit();
		} catch(\Exception $e){
			$dbConnect->rollBack();
			$element = false;
		}
		return $element;
	}
}