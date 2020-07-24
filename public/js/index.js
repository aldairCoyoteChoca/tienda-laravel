$(document).ready(function(){
    //funcion para agregar al carrito.
    $('.add').click(function(e){
        e.preventDefault();
        const form = $(this).parents('form')
        const url = form.attr('action')

        $.post(url, form.serialize(), function(response){
            $('#cart_details').html(response.total_productos)
            Swal.fire({
                toast: true,
                position: 'bottom-right',
                text: response.message,
                icon: 'success',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
        }).fail(function(){
            Swal.fire({
                toast: true,
                position: 'bottom-right',
                text: 'Algo ha salido mal',
                icon: 'error',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
        })
    })
})
