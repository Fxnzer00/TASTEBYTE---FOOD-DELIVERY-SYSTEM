






function displayCartModal() {
  console.log('Displaying Cart Modal'); // Debugging statement
  $('#cartModal').show();
}

$(document).ready(function() {
  // Display the cart modal when the "Cart" link is clicked
  $('a.cart-win').click(function(event) {
    event.preventDefault();
    displayCartModal();
  });

  // Close the cart modal when the "Close" button is clicked
  $('.close').click(function() {
    $('#cartModal').hide();
  });

  // Close the cart modal when the user clicks outside of it
  $(window).click(function(event) {
    if (event.target == $('#cartModal')[0]) {
      $('#cartModal').hide();
    }
  });
});



