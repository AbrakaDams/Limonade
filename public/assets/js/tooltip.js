// $(document).ready(function() {

// }, function() {
//         // Hover out code
//         $(this).attr('title', $(this).data('tipText'));
//         $('.tooltip').remove();
// }).mousemove(function(e) {
//         var mousex = e.pageX + 20; //Get X coordinates
//         var mousey = e.pageY + 10; //Get Y coordinates
//         $('.tooltip')
//         .css({ top: mousey, left: mousex })
// });
// });

/*moment().format('MMMM Do YYYY, h:mm:ss a'); 
moment().format('dddd');                    
moment().format("MMM Do YY");               
moment().format('YYYY [escaped] YYYY');     

moment().format("dddd, MMMM Do YYYY, h:mm:ss a");

$(function() {
    $('#datetimepickerstart').datetimepicker();
    $('#datetimepickerend').datetimepicker({
        useCurrent: false //Important! See issue #1075
    });
    $("#datetimepickerstart").on("dp.change", function (e) {
        $('#datetimepickerend').data("DateTimePicker").minDate(e.date);
    });

    $("#datetimepickerend").on("dp.change", function (e) {
        $('#datetimepickerstart').data("DateTimePicker").maxDate(e.date);
    });
});
*/

$(function(){

    $('#datetimepickerstart').datetimepicker({ // Date et heure de début
      locale: 'fr',  // Format au format français
      format: 'L LT',  // Format   L = 30/06/2016 Date     LT = 12:01  Heure
    });
    $('#datetimepickerend').datetimepicker({  // Date et heure de fin
        locale: 'fr',
        format: 'L LT',
        useCurrent: false //Important! See issue #1075
    });
    $('#datetimepickerstart').on('dp.change', function (e) {
        $('#datetimepickerend').data('DateTimePicker').minDate(e.date);
    });

    $('#datetimepickerend').on('dp.change', function (e) {
        $('#datetimepickerstart').data('DateTimePicker').maxDate(e.date);
    });
  });