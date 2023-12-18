$(document).ready(function () {
    $('#stockForm').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/update-stock',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                $('#productModal').modal('hide');
                // Update the table row with the updated stock
                var productId = response.id;
                var stock = response.stock;
                $('table').find('tr[data-product-id="' + productId + '"]').find('td:last-child').text(stock);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});