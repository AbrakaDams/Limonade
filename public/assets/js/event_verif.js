$('#add-list-input').on('focusout, keyup', function() {
    var addListInput = $.trim($(this).val());
    if(addListInput.length > 50) {
        markErrorInput(this);
    }
    else {
        markSuccessInput(this);
    }
});


$('#event-lists').on('focusout', '.add-card-form input[name=card_title]', function() {
    var cardTitle = $.trim($(this).val());
    if(cardTitle.length > 50 || cardTitle.length == 0) {
        markErrorInput(this);
    }
    else {
        markSuccessInput(this);
    }
});


$('#event-lists').on('focusout', '.add-card-form input[name=card_desc]', function() {
    var cardTitle = $.trim($(this).val());
    if(cardTitle.length > 50 || cardTitle.length == 0) {
        markErrorInput(this);
    }
    else {
        markSuccessInput(this);
    }
});

$('#event-lists').on('focusout', '.add-card-form input[name=card_quantity]', function() {
    var cardNum = $.trim($(this).val());

    if(cardNum.length > 10 || cardNum < 0) {
        markErrorInput(this);
    }
    else {
        markSuccessInput(this);
    }
});

$('#event-lists').on('focusout', '.add-card-form input[name=card_price]', function() {
    var cardPrice = $.trim($(this).val());

    if(cardPrice.length > 10 || cardPrice <= 0) {
        markErrorInput(this);
    }
    else {
        markSuccessInput(this);
    }
});

// $('#event-lists').on('submit', '.add-card-form', function() {
//     // console.log('HEhe');
//     var formData = $(this).serialize();
//     // console.log(formData);
//     console.log(this);
//     console.log($('input[name=card_title]').closest().val());
//     if($('input[name=card_title]').closest().val().length == 0) {
//         markErrorInput(this);
//         console.log(this);
//     }
//
// });

// make particular input border red in case of failure
function markErrorInput(input) {
    $(input).css('border-color', 'red');
}
// make particular input border green in case of success
function markSuccessInput(input) {
    $(input).css('border-color', '#f0f0f0');
}
