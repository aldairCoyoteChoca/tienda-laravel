$(document).ready(function(){

    //funcion para agregar al carrito.
    $('.add').click(function(e){
        e.preventDefault();
        const form = $(this).parents('form')
        const url = form.attr('action')

        $.post(url, form.serialize(), function(response){
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
            $('#total').html(response.total)
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
})