function show_setting(){
  var x = $("#target").css('display');

  if(x == 'none'){
      $("#target").show(1000);
  }else{
    $("#target").hide(1000);
  }
}