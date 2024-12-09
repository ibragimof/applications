function getDatepickerConfig(element) {
    return {
        format: $(element).data('date-format') || 'dd/mm/yyyy',
        language: $(element).data('language') || 'en',
        autoclose: true,
        todayHighlight: true,
        clearBtn: true,
        orientation: 'bottom auto'
    };
}

// Khởi tạo datepicker
$('.datepicker').each(function() {
    $(this).datepicker(getDatepickerConfig(this));
});
