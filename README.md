# Image downloader
##Installing application
1. Clone git repository `git clone https://github.com/lingorus/image-downloader.git`.
2. Install all project's dependencies `php composer.phar install`.
3. Make the script executable `chmod +x bot`.
4. Create database(DbHandler by default) and fill in the configuration file `config/config.yml` according to your server settings
	* Run installation command `./bot install` to create required tables.
5. Test your application `./bot schedule test.txt` with test file or use your own file.

##Description
This application works according to the description that you can find in the root of application: `technical_description.pdf`.


