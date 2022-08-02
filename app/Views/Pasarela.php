<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasarela</title>    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>
<body>
    <!-- SDK de paypal. Remplazar "test" con el client ID de la aplicacion sandbox de prueba -->
    <!-- <script src="https://www.paypal.com/sdk/js?client-id=test&currency=MXN"></script> -->
    <script src="https://www.paypal.com/sdk/js?client-id=AbwiWVYj1M9Du_1g30QLLF8qY6hWkNMdRS7M3fcrZPqCvzdkUgMjyla_swf5kvzKWwVnkE91mH7meRxC&currency=MXN"></script>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-3">
                <h1 class="text-center">Pasarelas de pago</h1>
                <!-- Set up a container element for the button -->
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


    <script>
        paypal.Buttons({
            style: {
                //color: 'blue',
                shape: 'pill', //forma de pildora del boton
                label: 'pay', //texto pagar con
            },
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '77.44' // Can also reference a variable or function
                        }
                    }]
                });
            },

            //Si se realiza el pago
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(detalles) {
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result', detalles, JSON.stringify(detalles, null, 2));

                    const transaction = detalles.purchase_units[0].payments.captures[0];

                    //alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                    alert("Pago realizado con éxito"); 

                    // When ready to go live, remove the alert and show a success message within this page. For example:

                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                    //location.href = BASE_URL + "Mattes/Arrendatario/Index";
                });
            },

            //Cuando el usuario cancela la funcionalidad del pago, no es la cancelacion del pago realizado
            onCancel: function(data){
                alert("Pago cancelado");
                console.log(data); //orderID
            },
        }).render('#paypal-button-container');

    </script>
</body>
</html>