$('#newsfeed-show-btn').click(function() {
    // console.log('toggled');
    // $('#event-newsfeed').toggleClass('event-newsfeed-visible');

    $('.event-newsfeed').show('slide', {direction: "right"});
});

$('#newsfeed-hide-btn').click(function() {
    // console.log('toggled');
    // $('#event-newsfeed').toggleClass('event-newsfeed-visible');

    $('.event-newsfeed').hide('slide', {direction: "right"});
});


$(document).ready(function() {
    $( "#event-lists" ).resizable({
        animate: true
    });
})
