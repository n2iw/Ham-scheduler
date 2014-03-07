
$(document).ready(function(){
    $( ".others_slot form" ).submit(function( event ) {
        return confirm("You are going to cancel other user's reservation!\nAre you sure you want to do it?");
  });
    $( ".my_slot form" ).submit(function( event ) {
        return confirm("Cancel this reservation?");
  });
    $( ".empty_slot form" ).submit(function( event ) {
        return confirm("Reserve this time slot?");
  });
});
