<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <button id="pay-button">Pay!</button>

    <form id="submit_form" method="post" action="/your_post_payment_endpoint">
        <input type="hidden" name="payment_token" id="payment_token">
    </form>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    document.getElementById('payment_token').value = result;
                    $('#submit_form').submit();
                },
                onPending: function(result) {
                    console.log('Pending: ', result);
                },
                onError: function(result) {
                    console.log('Error: ', result);
                }
            });
        });
    </script>
</body>

</html>