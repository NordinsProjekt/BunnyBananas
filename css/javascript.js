/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function dropDown(menu) {
    if (menu == "color"){
        document.getElementById("dropDownColor").classList.toggle("show");
        document.getElementById("dropDownCategory").classList.remove("show");
    } else if (menu == "category"){
        document.getElementById("dropDownCategory").classList.toggle("show");
        document.getElementById("dropDownColor").classList.remove("show");
    }
    
  }

