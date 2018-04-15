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
	* **$merchantID** (The merchant id assigned to you from CMS)
	* **$username** (Your [dashboard.transactionplatform.com](https://dashboard.transactionplatform.com/) username)
	* **$password** (Your [dashboard.transactionplatform.com](https://dashboard.transactionplatform.com/) password)

	If you have questions about any of these variables please contact us via the [Transaction Platform Support Slack Channel](https://transactionplatform.slack.com).

5. Then launch in your browser:
	> php-transactionflatform/get_jwt.php

	* This script will output the authorization tokens. One of these is idToken or the JWT which will be used in the next step to create a one time use token. And another one is refreshToken which will be use in refreshing JWT.
	* Note in our example this script will automatically save values to $JWT and $refreshToken variables in the config.php file which will be used in the next steps.

6. Also note that idToken or the JWT expires after an hour and with that we provided a way how we can handle the expiration with the use of refreshToken. Just launch in your browser:
	> php-transactionflatform/refresh_jwt.php

	* Note that in our example this script will automatically replace the $JWT and $refreshToken in the config.php file.

## Use the JWT to Get a One Time Use Token
1. Since our config.php file is now completely setup:
	> open PaymentServicePlugin\token_request.php

2. Check the following data required to get a one time use token: (Refer here [https://docs.transactionplatformstg.com/#653fe486-9ed4-9630-ad14-3b4f0c7b5a0f](https://docs.transactionplatformstg.com/#653fe486-9ed4-9630-ad14-3b4f0c7b5a0f))
	> data.amount (number)
	> merchantId (string)
	> gateway.name (string)(comma separated)

3. Then launch in your browser this file:
	> open php-transactionflatform/PaymentServicePlugin/token_request.php

4. This file will print out your one time use token. This token can be used for retrieving the saveCard and makePayment iframes.
