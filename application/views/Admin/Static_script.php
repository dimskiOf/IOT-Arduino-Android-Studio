<script>
  $(function() {
      var url = window.location.pathname,
        urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");

      $('.nav-link').each(function() {
        if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
          $(this).addClass('active');
          var dropdown = $(this).data('menu');

          if (dropdown) {
            $('#' + dropdown).addClass('menu-open');
            $('#' + dropdown).find('#menu' + dropdown).addClass('active');
          }

          var dropdown2 = $(this).data('submenu');

          if (dropdown2) {
            $('#' + dropdown2).addClass('menu-open');
            $('#' + dropdown2).find('#submenu' + dropdown2).addClass('active');
          }


        }
      });


    });

</script>