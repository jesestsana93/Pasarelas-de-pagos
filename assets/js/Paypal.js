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
