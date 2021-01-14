// Alert when button clicked
function btnClick() {
  alert("Clicked!")
}

// Change color using JS
function btnChangeColor() {
  //var inputColor = document.getElementById("color-input").value;
  //document.getElementById("div1").style.backgroundColor = "#" + inputColor;
}

// Change color using jQuery
$("#change-color").click(function(){
  $("#div1").css("background-color", "#" + $("#color-input").val())
});

// Toggle visiblity of div3
$("#toggle-div3").click(function(){
  $("#div3").fadeToggle("fast");
});