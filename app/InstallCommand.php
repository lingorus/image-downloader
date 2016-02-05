<?php

namespace App;
use App\Db\Db;

/**
 * Class ScheduleCommand
 */
class InstallCommand implements Command
{
    public function run($args)
    {
        $db = Db::getConnect();
        $db->exec( 'CREATE TABLE IF NOT EXISTS queue (
                      id INT NOT NULL AUTO_INCREMENT,
                      file_url VARCHAR (255),
                      status INT,
                      queue_name VARCHAR (255),
                      PRIMARY KEY (id), KEY idx_queue_status (queue_name, status)
                    )
                    ENGINE=MyISAM;
                    '
        );
    }
}
