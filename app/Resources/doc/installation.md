# Composer Installation
Get composer:
```
curl -s http://getcomposer.org/installer | php
```
Run the following command for the 1.x-dev branch:
```
php composer.phar create-project bruery/bassoon:1.x-dev
```
The installation process used Incenteev's ParameterHandler to handle parameters.yml configuration.

You might experience some timeout issues with composer, as the create-project start different scripts, you can increase the default composer value with the COMPOSER_PROCESS_TIMEOUT env variable:
```
COMPOSER_PROCESS_TIMEOUT=600 php composer.phar create-project bruery/bassoon:1.x-dev
```
Fixtures are automatically loaded on the composer create-project step. If you'd like to reset your sandbox to the default fixtures (or you had an issue while installing and want to fill in the fixtures manually), you may run:
```
php bin/load_data.php
```
This will completely reset your database.

# Run

Configure your server vhost and point your document root to the INSTALLATION_DIRECTORY/web. Then open the defined URL on your browser.