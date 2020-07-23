$(document).ready(function(){

    $('#mes').change(function (e) {
        var fecha = $('#mes').val().split('-');
        $('#anioConecta').val(fecha[0].substring(2,fecha[0].length));
        $('#mesConecta').val(fecha[1]);
    });

      // Evento para detectar el key prees de la tarjeta
      $("#cardChange").keypress(function(e) {
        const contador = $("#card").val().length;
        if(contador < 16){
            var code = e.which;
            var character = String.fromCharCode(code);
            if (code >= 32 && code <= 127) {
                if(isNaN(character)){
                    return false;
                }else{
                    $("#card").val($("#card").val() + character);
                }
            }   
        };
        $("#cardChange").trigger("keyup");
    });

    // Evento para detectar el key uo de la tarjeta
    $("#cardChange").keyup(function(e) {
        var code = e.which;
        const contador = $("#card").val().length;
        if (code == 8) {
            var length = $("#cardChange").val().length;
            $("#card").val($("#card").val().substring(0, length));
        } else if(contador <= 13){
            var current_val = $('#cardChange').val().length;
            $("#cardChange").val(createstars(current_val - 1) + $("#cardChange").val().substring(current_val - 1));
        }
    });

    // Evento para eveitar seleccionar tarjeta
    $("#cardChange").select(function() {
        this.selectionStart = this.selectionEnd;
    });

    //funcion para agregar al carrito.
    $('.add').click(function(e){
        e.preventDefault();
        const form = $(this).parents('form')
        const url = form.attr('action')

        $.post(url, form.serialize(), function(response){
            $('#cart_details').html(response.total_productos)
            Swal.fire({
                toast: true,
                position: 'top-right',
                text: response.message,
                icon: 'success',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
        }).fail(function(){
            Swal.fire({
                toast: true,
                position: 'top-right',
                text: 'Algo ha salido mal',
                icon: 'error',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
        })
    })

    //function para eliminar del carrito
    $('.delete').click(function(e){
        e.preventDefault();
        const row = $(this).parents('tr')
        const form = $(this).parents('form')
        const url = form.attr('action')
        
        $.post(url, form.serialize(), function(response){
            row.fadeOut()
            $('#total_productos').html(response.total_productos)
            $('#total').html(response.total)
            $('#total_car').html(response.total)
            $('#gran_total').html(response.total)
            $('#cart_details').html(response.total_productos)
            Swal.fire({
                toast: true,
                position: 'top-right',
                text: response.message,
                icon: 'success',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
        }).fail(function(){
            Swal.fire({
                toast: true,
                position: 'top-right',
                text: 'Algo ha salido mal',
                icon: 'error',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
        })
    })

    //function para actualizar el carrito
    $('.update').change(function(e){
        e.preventDefault();
        const form = $(this).parents('form')
        const url = form.attr('action')
        
        $.post(url, form.serialize(), function(response){
            $('#total_productos').html(response.total_productos)
            $('#subtotal').html(response.subtotal)
            $('#total').val(response.total)
            $('#total_car').html(response.total)
            $('#gran_total').html(response.total)
            $('#cart_details').html(response.total_productos)
            Swal.fire({
                toast: true,
                position: 'top-right',
                text: response.message,
                icon: 'success',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
        }).fail(function(){
            Swal.fire({
                toast: true,
                position: 'top-right',
                text: 'Algo ha salido mal',
                icon: 'error',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
        })
    })
    //jQuery para que genere el token después de dar click en submit
    $("#card-form").submit(function(e) {
        e.preventDefault();
        var $form = $(this);
        if($form[0].checkValidity()){
            $('#modal1').modal('hide');
            $('#modalLoader').modal('show');
            Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
        }
        return false;
    });

    /**
     * realiza el pago con la peticion hacia conekta
     * @param token Token generado por conekta
     */
    function conektaSuccessResponseHandler(token){
        $("#conektaTokenId").val(token.id);
        JsPay();
    }

    /**
     * Manejador de errores para petición conekta
     * @param response respues del conekta respeto a petición
     */
    function conektaErrorResponseHandler(response){
        var $form=$("#card-form");
        Swal.fire({
            toast: true,
            position: 'top-right',
            text: response.message_to_purchaser,
            icon: 'error',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        })
    }
    //conekta
    Conekta.setPublicKey('key_KJysdbf6PotS2ut2');
})

/**
 * Cambia el valor de input para que la primera letra sea mayúscula
 * @param {String} id Identificador de imput 
 */
function firstMayus(id){
    var str=$('#'+id).val();
    str= str.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, "");
    var words = str.split(' ');
    if(words.length>0){
        var valueComplete = "";
        words.forEach(e => {
            var cad = e;
            var tam = e.length;
            var aux = "";
            if(tam > 1){ 
                aux = cad[0].toUpperCase() + "" + cad.substring(1,tam).toLowerCase();
            }
            valueComplete += " " + aux;
        });
        $('#'+id).val(valueComplete.trim());
    }
}

/**
 * Convierte todo el valor del input a minúsculas
 * @param {String} id Identificador de input 
 */
function allMinus(id){
    var str=$('#'+id).val();
    if (str!= undefined  && str.length>0){
        $('#'+id).val(str.toLowerCase().trim());
    }
}

function createstars(n) {
    return new Array(n+1).join("•")
}

/**
 * Funcion para validación de formularios
 */
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }); 
    }, false);
})();

function JsPay(){
    let params=$("#card-form").serialize();
    let url="../vendor/conekta/lib/payConekta/Pay.php";
    $.post(url,params,function(data){
        if(data == "1"){
            $("#enviar").submit();
            $("#modalLoader").modal('hide');
            jsClean();
        }else{
            Swal.fire({
                toast: true,
                position: 'top-right',
                text: 'Algo ha salido mal',
                icon: 'error',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
        }
    });
}

function jsClean(){
    $("#card-form").removeClass('was-validated');
    $(".form-control").prop("value","");
    $("#conektaTokenId").prop("value","");
}