/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
// function dropdownMenu() {
//     document.getElementById("myDropdown").classList.toggle("show");
// }
//
// // Close the dropdown if the user clicks outside of it
// window.onclick = function(e) {
//   if (!e.target.matches('.dropbtn')) {
//     var myDropdown = document.getElementById("myDropdown");
//       if (myDropdown.classList.contains('show')) {
//         myDropdown.classList.remove('show');
//       }
//   }
// }
//
// function setWidth() {
//   width = $(usernamebox).outerWidth();
//   $("#myDropdown").width(width);
// }

function setClipboard(value) {
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = value;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
}
