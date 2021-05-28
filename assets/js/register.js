$(document).ready(function () {
  // On click signup, hide login and show registration
  $('#signup').click(function () {
    $('.login-form').slideUp('slow', function () {
      $('.register-form').slideDown('slow');
    });
  });
  // On click signup, hide registration and show login
  $('#signin').click(function () {
    $('.register-form').slideUp('slow', function () {
      $('.login-form').slideDown('slow');
    });
  });
});
