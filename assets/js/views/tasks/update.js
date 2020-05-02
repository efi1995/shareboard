$(function(){
  alert('eee');
  console.log('efefef');
  //dropdown Details
  $(document).ready(function(){
    $("#details-button").click(function(){
      $("#details").toggle();
    });
  });

  //dropdown Description
  $(document).ready(function(){
    $("#description-button").click(function(){
      $("#description").toggle();
    });
  });

  //dropdown Comments
  $(document).ready(function(){
    $("#comments-button").click(function(){
      $("#comments").toggle();
    });
  });

  //dropdown People
  $(document).ready(function(){
    $("#people-button").click(function(){
      $("#people").toggle();
    });
  });

  //dropdown Dates
  $(document).ready(function(){
    $("#dates-button").click(function(){
      $("#dates").toggle();
    });
  });

  //calendar
  $( function(){
      $( "#datepicker" ).datepicker();
  });

  //countdown
  $("#getting-started")
    .countdown("<?php echo $task['task_deadline']; ?>", function(event) {
      $(this).text(
        event.strftime('%D days %H:%M:%S')
      );
  });

  //click button
  $(".change").change(function() {
    $("#btn-edit").click(); 
  });

  var availableTags = <?php echo json_encode($assigne_to); ?>;

  console.log(availableTags);
  $( "#tags" ).autocomplete({
    source: availableTags
  });
});