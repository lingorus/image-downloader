# Image downloader
##Installing application
1. Clone git repository `git clone https://github.com/lingorus/image-downloader.git` `cd image-downloader`.
2. Install all project's dependencies `php composer.phar install`.
3. Create database(DbHandler by default) and fill in the configuration file `config/config.yml` according to your server settings
	* Run installation command `./bot install` to create required tables.
4. Test your application `./bot schedule test.txt` with test file or use your own file.

##Description
This application works according to the description that you can find in the root of application: `technical_description.pdf`.

##Configuration

1. It is possible to change the storage for the queue.
To do this, you must write a handler class implementing QueueHandlerInterface and specify it in the configuration file.
`queue_handler: App\Queue\Handler\DbQueueHandler`
2. It is possible to change the directory for downloaded images.
`images_dir: images`
