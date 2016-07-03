$('#add-list-input').on('focusout, keyup', function() {
    var addListInput = $.trim($(this).val());
    if(addListInput.length > 50) {
        markErrorInput(this);
    }
    else {
        markSuccessInput(this);
    }
});

$('.add-card-form input[name=card_title]').focusout(function() {
    var cardTitle = $.trim($(this).val());
    console.log(cardTitle);
    if(addListInput.length > 50) {
        markErrorInput(this);
        console.log(cardTitle);
    }
    else {
        markErrorInput(this);
    }
});

// make particular input border red in case of failure
function markErrorInput(input) {
    $(input).css('border-color', 'red');
}
// make particular input border green in case of success
function markSuccessInput(input) {
    $(input).css('border-color', '#f0f0f0');
}
