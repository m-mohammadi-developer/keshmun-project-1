// function to change the background color of the menu button and the display value of the menu
function accordionMenu() {
    var menu = document.getElementById("toggled");
      var menuStyle = window.getComputedStyle(menu);
      var display = menuStyle.getPropertyValue('display');
    
    if (display === 'none') {
      toggle.style.backgroundColor = "gray";
      menu.style.display = "block";
    } else {
      toggle.style.backgroundColor = "transparent";
      menu.style.display = "none";
    };
  };
  
  // add event listener to menu button
  var toggle = document.getElementById("menu-toggle");
  toggle.addEventListener("click", accordionMenu, false);