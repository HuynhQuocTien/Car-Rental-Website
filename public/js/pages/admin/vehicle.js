function calculateDiscountedPrices() {
    let dailyPrice = parseFloat($('#dailyPrice').val()) || 0;
    let weeklyDiscount = parseFloat($('#weeklyDiscount').val()) || 0;
    let monthlyDiscount = parseFloat($('#monthlyDiscount').val()) || 0;

    let weeklyPrice = dailyPrice * 7 * (1 - weeklyDiscount / 100);
    let monthlyPrice = dailyPrice * 30 * (1 - monthlyDiscount / 100);

    if (!isNaN(weeklyPrice)) {
        $('#weeklyPrice').val(weeklyPrice.toFixed(2));
    }
    if (!isNaN(monthlyPrice)) {
        $('#monthlyPrice').val(monthlyPrice.toFixed(2));
    }
}

// Gọi hàm khi người dùng nhập dữ liệu
$(document).ready(function () {
    $('#dailyPrice, #weeklyDiscount, #monthlyDiscount').on('input', calculateDiscountedPrices);
});
