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

            margin: 10px;
            padding: 15px;
            text-align: center;
        }

        iframe {
            width: 100%;
            height: 50%;
            border: 0;
            display: none;
            min-height: 290px;
        }

        #loader {
            display: block;
        }

        .iframe-container {
            border: 2px solid black;
            text-align: center;
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

    const iframeUrl = '<?php echo $apiurl."pay/v3/"; ?>'
    const iframeDomain = iframeUrl.match(/^http(s?):\/\/.*?(?=\/)/)[0];

    window.addEventListener('message', function messageListener(event) {
        if (event.origin === iframeDomain) {
            console.log('received message', event.data);
            if (event.data.event === 'loaded') {
                window.document.getElementById('iframe1').style.display = 'block';
                window.document.getElementById('loader').style.display = 'none';
            }
            if (event.data.event === 'cardSaved') {
                console.log('card saved', event.data.data);
            }
        }
    });

    function setup() {
        fetch('http://localhost/php-transactionplatform/PaymentServicePlugin/token_request.php').then(function (response) {
            console.log(response);
            return response.text();
        }).then(function (response) {
            const iframe = `${iframeUrl}?token=${response}`;
            window.document.getElementById('iframe1').src = iframe;
            return window.document.getElementById('iframe1');
        }).then((iframe) => {
            myForm.addEventListener('submit', function processPayment(event) {
                event.preventDefault();
                iframe.contentWindow.postMessage('posted', iframeUrl);
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
