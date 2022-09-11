<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conekta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
</head>
<body>
    <div class="container mt-5">
            <div class="card pt-4 pb-5">
                    <h1 class="text-center">Pago con Conekta</h1>
                    <div class="card-body">
                        <form id="card-form">
                            <input type="hidden" name="conektaTokenId" id="conektaTokenId" value="">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">
                                            Nombre como aparece en la tarjeta
                                        </label>
                                        <input type="text" data-conekta="card[name]" class="form-control" name="name" id="name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">
                                            Número de tarjeta
                                        </label>
                                        <input type="text" maxlength="16" data-conekta="card[number]" class="form-control" name="card" id="card">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">
                                            Fecha de expiración (MM/AA)
                                        </label>
                                        <div>
                                            <input type="text" maxlength="2" data-conekta="card[exp_month]" class="form-control" style="width:49%;display:inline-block;">
                                            <input type="text" maxlength="2" data-conekta="card[exp_year]" class="form-control" style="width:49%;display:inline-block;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">
                                            CVC
                                        </label>
                                        <input type="text" maxlength="4" data-conekta="card[cvc]" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">
                                            Correo electrónico
                                        </label>
                                        <input type="email" class="form-control" name="email" id="email" maxlength="200">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">
                                            Concepto
                                        </label>
                                        <input type="text" class="form-control" name="description" id="description" maxlength="100">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">
                                            Monto
                                        </label>
                                        <input type="number" class="form-control" name="total" id="total">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center mt-5">
                                        <button class="btn btn-success btn-lg">
                                            PAGAR
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">
                                        Concepto
                                    </label>
                                    <input type="text" class="form-control" value="Camisa">
                                </div>
                                <div class="col-md-4">
                                    <label for="">
                                        Cantidad
                                    </label>
                                    <input type="number" class="form-control" value="1">
                                </div>
                                <div class="col-md-4">
                                    <label for="">
                                        Total
                                    </label>
                                    <input type="number" class="form-control" value="450.56">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center mt-5">
                                  
                                </div>
                            </div>
                        </div>
                  
                </div>
            </div>
        </div>   
    </div>
    <script>
        Conekta.setPublicKey('key_JbchsDsxFzS77qotVaQ2wjQ');

        var conektaSuccessResponseHandler = function(token) {

            $('#conektaTokenId').val(token.id);

            jsPay();
            //console.log(token.id);

        }

        var conektaErrorResponseHandler = function(response) {
            var form = $('#card-form');

            alert(response.message_to_purchaser);
        }

        $(document).ready(function(){
            $('#card-form').submit(function(e){
                e.preventDefault();

                var form = $('#card-form');

                Conekta.Token.create(form, conektaSuccessResponseHandler, conektaErrorResponseHandler);

            });
        });

        function jsPay(){
            let params = $('#card-form').serialize();
            let url = 'pay.php';

            $.ajax({
                type: 'POST',
                url: url,
                data: params,
                success: function(data)
                {
                    if(data == 1){
                        alert('Tu pago se realizó con éxito');
                        jsClean();
                    }else{
                        alert(data);
                    }
                }
            });
        }

        function jsClean(){
            $('.form-control').prop('value','');
            $('#conektaTokenId').prop('value','');
        }
    </script>
</body>
</html>