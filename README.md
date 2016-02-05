# Image downloader
##Installing application
1. Clone git repository `git clone https://github.com/lingorus/image-downloader.git`
2. Install all project's dependencies `php composer.phar install`
3. Create database(DbHandler by default)
	* Run installation command `./bot install` to create required tables
4. Fill in the configuration file `config/config.yml` according to your server settings
5. Make the script executable `chmod +x bot`
6. Test your application `./bot schedule`
