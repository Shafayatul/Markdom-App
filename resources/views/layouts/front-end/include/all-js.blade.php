<!-----------Firebase js---------->
<script src="https://www.gstatic.com/firebasejs/7.1.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.1.0/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.1.0/firebase-analytics.js"></script>
<!-----------End Firebase js---------->

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="{{ asset('front-end-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front-end-assets/js/bootstrap-select.js') }}"></script>
<script type="text/javascript" src="{{ asset('front-end-assets/js/jquery.leanModal.min.js') }}"></script>
<script src="{{ asset('front-end-assets/js/jquery.uls.data.js') }}"></script>
<script src="{{ asset('front-end-assets/js/jquery.uls.data.utils.js') }}"></script>
<script src="{{ asset('front-end-assets/js/jquery.uls.lcd.js') }}"></script>
<script src="{{ asset('front-end-assets/js/jquery.uls.languagefilter.js') }}"></script>
<script src="{{ asset('front-end-assets/js/jquery.uls.regionfilter.js') }}"></script>
<script src="{{ asset('front-end-assets/js/jquery.uls.core.js') }}"></script>
<script type="text/javascript" src="{{ asset('front-end-assets/js/jquery.flexisel.js')}}"></script>
<script src="{{ asset('front-end-assets/slick/slick.js')}}"></script>
<script src="{{ asset('front-end-assets/custom-js/menu.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('ul.nav li.dropdown').hover(function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
      }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
  });
});
</script>
<script src="{{ asset('front-end-assets/custom-js/firebase.js') }}"></script>
		