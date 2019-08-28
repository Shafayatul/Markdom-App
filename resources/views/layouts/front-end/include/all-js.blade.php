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
<script type="text/javascript">
  $(document).ready(function(){
    $('.hamburger').on('click',function(){
      $('.main-ul').show(500);
      $(this).hide(500);
      $('.hamburger-close').show(500);
    });
    $('.hamburger-close').on('click',function(){
      $('.main-ul').hide(500);
      $(this).hide(500);
      $('.hamburger').show(500);
    });
    $('.main-li-dropdown').on('click',function(){
      $('.sub-ul').toggle(500);
    });
    if (window.width > 767) {
      $('.main-li-dropdown').hover(function(){
          $('.sub-ul').show(500);
        }, function(){
          $('.sub-ul').hide(500);
      });
    }

  });
</script>
