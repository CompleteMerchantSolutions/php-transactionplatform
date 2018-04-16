<?php require_once("../config.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Transaction Platform Portal Example</title>
    <style>
        .main {
            display: block;
            height: 900px;
            width: 400px;
            text-align: center;

            margin: 10px;
            padding: 15px;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
            display: none;
            min-height: 620px;
        }

        #loader {
            display: block;
        }

        .iframe-container {
            border: 2px solid black;
        }
    </style>
</head>
<body>
<div class="main">

    <span>Your Website</span>

    <br/><br/>

    <div id="errors-container" style="display:  none, margin-top: 10px; margin-bottom: 10px; "></div>

    <div id="forms-container">
        <div class="iframe-container">
            <span>Our Iframe</span>
            <iframe id="iframe1"></iframe>
        </div>

        <br/><br/>

        <div id="loader">Loading Form...</div>

        <form id="myForm">
            <button id="submitme">Submit Form</button>
        </form>
    </div>

</div>

<script>

    const myForm = window.document.getElementById('myForm');

    const saveCardUrl = '<?php echo $apiurl."pay/v3/saveCard"; ?>'
    const iframeDomain = saveCardUrl.match(/^http(s?):\/\/.*?(?=\/)/)[0];

    window.addEventListener('message', function messageListener(event) {
        if (event.origin === iframeDomain) {
            console.log('received message', event.data);
            if (event.data.event === 'loaded') {
                window.document.getElementById('iframe1').style.display = 'block';
                window.document.getElementById('loader').style.display = 'none';
            }
            if (event.data.event === 'cardSaved') {
                console.log('card saved', event.data.data);
                var jsonStr = JSON.stringify(event.data.data, null, 1);
                window.document.getElementById('forms-container').innerHTML = '<code>' + jsonStr + '</code>';
            }
        }
    });

    function setup() {
        fetch('http://localhost/php-transactionplatform/PaymentServicePlugin/token_request.php').then(function (response) {
            return response.text();
        }).then(function (response) {
            const iframe = `${saveCardUrl}?token=${response}`;
            window.document.getElementById('iframe1').src = iframe;
            return window.document.getElementById('iframe1');
        }).then((iframe) => {
            myForm.addEventListener('submit', function processPayment(event) {
                event.preventDefault();
                iframe.contentWindow.postMessage('posted', saveCardUrl);
                return false;
            });
        }).catch((err) => {
            console.log('error---------->', err);
            var errStr = JSON.stringify(err, null, 1);
            window.document.getElementById('errors-container').innerHTML = '<code>' + errStr + '</code>';
            window.document.getElementById('errors-container').style.display = 'block';
        });
    }

    setup()
</script>
</body>
</html>
