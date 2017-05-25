$(function() { 
  var theTable_studyarea = $('table.studyarea')

  theTable_studyarea.find("tbody > tr").find("td:eq(1)").mousedown(function(){
    $(this).prev().find(":checkbox").click()
  });

  $("#studyarea_filter").keyup(function() {
    $.uiTableFilter( theTable_studyarea, this.value );
  })

  $('#filter-form').submit(function(){
    theTable_studyarea.find("tbody > tr:visible > td:eq(1)").mousedown();
    return false;
  }).focus(); //Give focus to input field
  
  
  
  
  var theTable_location = $('table.locations')

  theTable_location.find("tbody > tr").find("td:eq(1)").mousedown(function(){
    $(this).prev().find(":checkbox").click()
  });

  $("#location_filter").keyup(function() {
    $.uiTableFilter( theTable_location, this.value );
  })

  $('#filter-form').submit(function(){
    theTable_location.find("tbody > tr:visible > td:eq(1)").mousedown();
    return false;
  }).focus(); //Give focus to input field
  
  
  
});  
