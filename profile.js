function updateProfile() {
  $.ajax({
    type: 'POST',
    url: 'profile_AJAX.php',
    success: function (data) {
      var userData = JSON.parse(data);

      $('#username').text(userData.username);
      $('#fullname').text('Full Name: ' + userData.full_name);
      $('#email').text('Email: ' + userData.email);
      $('#address').text('Address: ' + userData.address);
      $('#phone').text('Phone: ' + userData.phone_number);
      $('#img_user').attr('src', userData.img_user);
    },
    error: function (xhr, status, error) {
      console.error('Error updating profile:', status, error);
    }
  });
}

// Attach a click event to the "Update Profile" button
$(document).ready(function () {
  $('#updateProfileBtn').click(function () {
    updateProfile();
  });
});