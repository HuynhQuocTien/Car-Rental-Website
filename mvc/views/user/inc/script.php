  <!-- <script src="../public/js/jquery.min.js"></script>
  <script src="../public/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../public/js/popper.min.js"></script>
  <script src="../public/js/bootstrap.min.js"></script>
  <script src="../public/js/jquery.easing.1.3.js"></script>
  <script src="../public/js/jquery.waypoints.min.js"></script>
  <script src="../public/js/jquery.stellar.min.js"></script>
  <script src="../public/js/owl.carousel.min.js"></script>
  <script src="../public/js/jquery.magnific-popup.min.js"></script>
  <script src="../public/js/aos.js"></script>
  <script src="../public/js/jquery.animateNumber.min.js"></script>
  <script src="../public/js/bootstrap-datepicker.js"></script>
  <script src="../public/js/jquery.timepicker.min.js"></script>
  <script src="../public/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="../public/js/google-map.js"></script>
  <script src="../public/js/main.js"></script>
  <script src="../public/js/chat.js"></script> -->

  <script src="../public/js/dashmix.app.min.js"></script>

  <!-- jQuery (required for BS Datepicker plugin) -->
  <script src="../public/js/lib/jquery.min.js"></script>

  <!-- Page JS Plugins -->
  <script src="../public/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="../public/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
  <script src="../public/js/plugins/slick-carousel/slick.min.js"></script>

  <!-- Page JS Helpers (BS Datepicker plugin) -->
  <script>
Dashmix.helpersOnLoad(['jq-datepicker', 'jq-rangeslider', 'jq-slick']);
  </script>
  <!-- Script to handle form switching -->
  <script>
document.getElementById('btnLogin').addEventListener('click', () => {
    document.getElementById('registerForm').classList.add('d-none');
    document.getElementById('forgotPasswordForm').classList.add('d-none');
    document.getElementById('forgotPasswordForm').classList.add('d-none');
    document.getElementById('resetPasswordForm').classList.add('d-none');
    document.getElementById('loginForm').classList.remove('d-none');
});
document.getElementById('showRegister').addEventListener('click', () => {
    document.getElementById('loginForm').classList.add('d-none');
    document.getElementById('registerForm').classList.remove('d-none');
});

document.getElementById('showForgotPassword').addEventListener('click', () => {
    document.getElementById('loginForm').classList.add('d-none');
    document.getElementById('forgotPasswordForm').classList.remove('d-none');
});
document.getElementById('sendOTP').addEventListener('click', () => {
    document.getElementById('forgotPasswordForm').classList.add('d-none');
    document.getElementById('otpForm').classList.remove('d-none');
});
document.getElementById('comfirmOTP').addEventListener('click', () => {
    document.getElementById('otpForm').classList.add('d-none');
    document.getElementById('resetPasswordForm').classList.remove('d-none');
});
document.getElementById('backToLogin').addEventListener('click', () => {
    document.getElementById('registerForm').classList.add('d-none');
    document.getElementById('loginForm').classList.remove('d-none');
});

document.getElementById('backToLoginFromForgot').addEventListener('click', () => {
    document.getElementById('forgotPasswordForm').classList.add('d-none');
    document.getElementById('loginForm').classList.remove('d-none');
});
  </script>
  <?php 
    if($data['Page'] == "home"){
        echo "<script>
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    autoclose: true
});

$('.carousel').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: true
});
</script>";
    }
  ?>

