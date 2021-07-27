(function ($) {
  'use strict';
  // Get the modal
  let modal = document.getElementById("myModal");

// Get the button that opens the modal
  let btn = document.getElementById("myBtn");

// Get the button that close the modal
  let cancel = document.getElementById("abort");
  console.log(cancel);

// Get the <span> element that closes the modal
  let span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
  btn.onclick = function () {
    modal.style.display = "block";
  };

// When the user clicks on <span> (x), close the modal
  span.onclick = function () {
    modal.style.display = "none";
  };
  cancel.onclick = function () {
    modal.style.display = "none";
  };
// When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  };
  $(document).ready(function () {
    $('#rem_multiple').appendTo('.modal-content');
    $('#abort').appendTo('.modal-content');
  });
})(jQuery);
