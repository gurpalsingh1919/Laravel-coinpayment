<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> <?php echo $__env->yieldContent('title'); ?>  </title>
 <link rel="shortcut icon" href="<?php echo e(url('/')); ?>/assets/images/favicon2.ico">
         <!-- For Facebook Sharing -->
       <!--  <meta property="og:url"           content="https://kwatt.4new.io/" /> -->
        <meta property="og:url"           content="https://kwatt.4new.io" />
        <meta property="og:image:secure_url"           content="https://kwatt.4new.io" />
        <meta property="og:image"         content="https://kwatt.4new.io/back/images/trashtotreasure.jpg" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="4New" />
        <meta property="og:description"   content="Help Save The Planet With KWATT Tokenized Electricity.  4NEW is the World's first company to use waste to create energy to power Crypto-Mining.  Patent Pending process! Graphic should be the Help Save The Planet banner" />
                 
       <meta property="og:image:width" content="200" />
        <meta property="og:image:height" content="200" />

     

    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
    WebFont.load({
        google: { "families": ["Nunito:300,400,600,700,800,900"] },
        active: function() {
            sessionStorage.fonts = true;
        }
    });
    </script>


    <?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>

<body>

    <?php echo $__env->make('layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>

</body>

<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</html>
<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="858df13b-8ea9-4fd7-941f-62c52324c273";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
<script type="text/javascript">
    
function trackmyorder(conversion_val,curr)
{
    console.log(conversion_val);
    console.log(curr);
    adroll_conversion_value = conversion_val;
    adroll_currency = adroll_currency;
}
  
</script>
</script>
