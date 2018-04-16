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
	> http://localhost/php-transactionflatform/get_jwt.php

	* This script will output the authorization tokens. One of these is idToken or the JWT which will be used in the next step to create a one time use token. And another one is refreshToken which will be use in refreshing JWT.
	* Note in our example this script will automatically save values to $JWT and $refreshToken variables in the config.php file which will be used in the next steps.

6. Also note that idToken or the JWT expires after an hour and with that we provided a way how we can handle the expiration with the use of refreshToken. Just launch in your browser:
	> http://localhost/php-transactionflatform/refresh_jwt.php

	* Note that in our example this script will automatically replace the $JWT and $refreshToken in the config.php file.

## Use the JWT to Get a One Time Use Token
1. Since our config.php file is now completely setup then open:
	> PaymentServicePlugin\token_request.php

2. Check or review the following data required to get a one time use token: 
	* data.amount (number)
	* merchantId (string)
	* gateway.name (string)(comma separated)
	* or refer here [https://docs.transactionplatformstg.com/#653fe486-9ed4-9630-ad14-3b4f0c7b5a0f](https://docs.transactionplatformstg.com/#653fe486-9ed4-9630-ad14-3b4f0c7b5a0f) for more details

3. Then launch in your browser this file:
	> http://localhost/php-transactionplatform/PaymentServicePlugin/token_request.php

4. This file will print out your one time use token. This token can be used for retrieving the saveCard and makePayment iframes.

### Iframe Forms: Run Transaction
1. Follow the steps in the [Getting Started](#getting-started) section.

2. To load the example iframe for running a transaction visit:  
 	> [http://localhost/php-transactionplatform/PaymentServicePlugin/run_transaction.php](http://localhost/php-transactionplatform/PaymentServicePlugin/run_transaction.php)

3. The iframe is now embedded in this website and can be used to process a transaction.

### Iframe Forms: Save Card
1. Follow the steps in the [Getting Started](#getting-started) section.

2. To load the example iframe for saving a card visit:  
 	> [http://localhost/php-transactionplatform/PaymentServicePlugin/save_card.php](http://localhost/php-transactionplatform/PaymentServicePlugin/save_card.php)

3. The iframe is now embedded in this website and can be used to save a card and customer information.

### API: Run Transaction
1. Follow the steps in the [Getting Started](#getting-started) section.

2. Since our config.php file is now completely setup then open:
	> PaymentServiceAPI\run_transaction.php

3. Check or review the following data required in the data query parameters: 
	* merchantId (string)
	* amount (number) 
	* gateway (string)
	* card_expr_month (month's two digits number example for February: 02)
	* card_expr_year  (year's two digits number example for 2021: 21)
	* paymethod (string - the tokenex card token)
	* or refer here [https://docs.transactionplatformstg.com/#3c540f64-76db-7f54-adf1-5abadf43bfc8](https://docs.transactionplatformstg.com/#3c540f64-76db-7f54-adf1-5abadf43bfc8) for complete details

4. Then launch in your browser:
	> http://localhost/php-transactionplatform/PaymentServiceAPI/run_transaction.php

### API: Refund/Void
1. Follow the steps in the [Getting Started](#getting-started) section.

2. Since our config.php file is now completely setup then open:
	> PaymentServiceAPI\void_transaction.php or 
	> PaymentServiceAPI\refund_transaction.php

3. Update the transaction reference number provided in the url: 
	* or refer here [https://docs.transactionplatformstg.com/#0526a0af-b129-811d-1994-7c104bbad43e](https://https://docs.transactionplatformstg.com/#0526a0af-b129-811d-1994-7c104bbad43e) for complete details

4. Then launch in your browser:
	> http://localhost/php-transactionplatform/PaymentServiceAPI/void_transaction.php or
	> http://localhost/php-transactionplatform/PaymentServiceAPI/refun_transaction.php

### API: Auth Only
1. Follow the steps in the [Getting Started](#getting-started) section.

2. Since our config.php file is now completely setup then open:
	> PaymentServiceAPI\authonly.php

3. Check or review the following data required in the data query parameters: 
	* merchantId (string)
	* amount (number) 
	* gateway (string)
	* card_expr_month (month's two digits number example for February: 02)
	* card_expr_year  (year's two digits number example for 2021: 21)
	* paymethod (string - the tokenex card token)
	* or refer here [https://docs.transactionplatformstg.com/#e240bd5a-aa67-665d-79df-cca5840ffbe3](https://docs.transactionplatformstg.com/#e240bd5a-aa67-665d-79df-cca5840ffbe3) for complete details

4. Then launch in your browser:
	> http://localhost/php-transactionplatform/PaymentServiceAPI/authonly.php

### API: Capture
1. Follow the steps in the [Getting Started](#getting-started) section.

2. Since our config.php file is now completely setup then open:
	> PaymentServiceAPI\capture_transaction.php

3. Update the transaction reference number provided in the url: 
	* merchantId (string)
	* amount (number) 
	* gateway (string)
	* transactionReferenceNumber (string)
	* or refer here [https://docs.transactionplatformstg.com/#4ed41eeb-4e9a-2553-b658-9fea126dd865](https://docs.transactionplatformstg.com/#4ed41eeb-4e9a-2553-b658-9fea126dd865) for complete details

4. Then launch in your browser:
	> http://localhost/php-transactionplatform/PaymentServiceAPI/capture_transaction.php