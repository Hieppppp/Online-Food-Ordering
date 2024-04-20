$(document).ready(function () {
    $('.add-to-cart').on('click', function (e) {
        e.preventDefault();
        var productId = $(this).data('product-id');
        var token = "{{ csrf_token() }}";
        $.ajax({
            type: 'POST',
            url: '/add-to-cart/' + productId,
            data: {
                _token: token
            },
            success: function (response) {
                // Hiển thị thông báo thành công
                showAlert(response.message, 'success');
                // Cập nhật số lượng sản phẩm trong biểu tượng giỏ hàng
                updateCartQuantity(response.cart_count);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // Hiển thị lỗi nếu có
            }
        });
    });
});

function showAlert(message, type) {
    var alertClass = 'alert-success'; // Mặc định là alert-success
    if (type === 'error') {
        alertClass = 'alert-danger';
    }
    var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
        '<strong>' + message + '</strong>' +
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
        '</div>';
    $('.alert-container').html(alertHtml); // Chèn thông báo vào phần tử có class alert-container
    
}

function updateCartQuantity(quantity) {
    $('.cart-quantity').text(quantity); // Cập nhật số lượng sản phẩm trong biểu tượng giỏ hàng
}
