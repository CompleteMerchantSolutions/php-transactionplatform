# PHP Code integration to Transaction Platform API Endpoints
(Guide to authentication and running transactions)

## Dependencies
* PHP 5.* up

## Getting Started
1. Clone this repository
	> git clone [https://github.com/CompleteMerchantSolutions/php-transactionplatform.git](https://github.com/CompleteMerchantSolutions/php-transactionplatform.git)

2. Go to your location of the source directory
	> cd php-transactionplatform

3. Go to location of the source directory and compy example.config.php and save it as config.php.
	> cp example.config.php config.php

4. Update the following variables in config.php
	* **$apiurl** (The Transaction Platform Api https://api.transactionplatform.com/)
	* **$username** (Your [dashboard.transactionplatform.com](https://dashboard.transactionplatform.com/) username)
	* **$password** (Your [dashboard.transactionplatform.com](https://dashboard.transactionplatform.com/) password)

	If you have questions about any of these variables please contact us via the [Transaction Platform Support Slack Channel](https://transactionplatform.slack.com).

5. Then launch in your browser:
	> php-transactionflatform/get_jwt.php

	* This script will give you authorization tokens. One of these is idToken or the JWT which will be used in the next step to create a one time use token. And another one is refreshToken which will be use in refreshing JWT.
	* Note in our example this script will automatically save these two tokens (idToken and refreshToken) in the config.php file which will be used in the next steps.

6. Also note that idToken or the JWT expires after an hour and with that we provided a way how we can handle the expiration with the use of refreshToken. Just launch in your browser:
	> php-transactionflatform/refresh_jwt.php

	* Note that in our example this script will automatically replace the idToken and refreshToken in the config.php file.



