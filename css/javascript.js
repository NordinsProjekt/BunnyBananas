/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function dropDown(menu) {
    if (menu == "color"){
        document.getElementById("dropDownColor").classList.toggle("show");
        document.getElementById("dropDownCategory").classList.remove("show");
        document.getElementById("dropDownColorArrow").classList.toggle("dropdown-rotateArrow");
        document.getElementById("dropDownCategoryArrow").classList.remove("dropdown-rotateArrow");
    } else if (menu == "category"){
        document.getElementById("dropDownCategoryArrow").classList.toggle("dropdown-rotateArrow");
        document.getElementById("dropDownColorArrow").classList.remove("dropdown-rotateArrow");
        document.getElementById("dropDownCategory").classList.toggle("show");
        document.getElementById("dropDownColor").classList.remove("show");
    }
    
  }

