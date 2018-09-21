<html>
    <head><title>Thank you for your purchase</title></head>
    <body>{{$conversion_val}}
    <script type="text/javascript">
    adroll_adv_id = "JEZ4A6GE4ZHHBE6MY7T3LJ";
    adroll_pix_id = "DNH3NBVHQFC2XC6BGZWUTK";
    (function () {
        var _onload = function(){
            if (document.readyState && !/loaded|complete/.test(document.readyState)){setTimeout(_onload, 10);return}
            if (!window._adroll_loaded){_adroll_loaded=true;setTimeout(_onload, 50);return}
            var scr = document.createElement("script");
            var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
            scr.setAttribute("async", "true");
            scr.type = "text/javascript";
            scr.src = host + "/j/roundtrip.js";
            ((document.getElementsByTagName("head") || [null])[0] ||
                document.getElementsByTagName("script")[0].parentNode).appendChild(scr);
        };
        if (window.addEventListener) {window.addEventListener("load", _onload, false);}
        else {window.attachEvent("onload", _onload)}
    }());
  </script>

  <script type="text/javascript">
    adroll_conversion_value = {{$conversion_val}};
    adroll_currency = "{{$curr}}";
  </script>

       
      </body>
      </html>