$('#add-list-form').on('change', function() {
    var addListInput = $.trim($(this).val());
    if(addListInput.length > 50) {
        $(this).css('border-color', 'red');
        console.log(addListInput);
    }
})
