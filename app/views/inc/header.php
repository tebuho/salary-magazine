<!DOCTYPE html>
<html lang="en-ZA" itemscope itemtype="http://schema.org/WebPage">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112003877-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-112003877-1');
    </script>
    
    <?php require_once APPROOT .'/views/inc/functions.php'; ?>
    <?php require_once APPROOT .'/views/inc/inc_provinces.php'; ?>
    
    <!-- Browser data -->
    
    <link rel="canonical" href="<?php echo $data['page_url']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $data['page_title']; ?>&nbsp;|&nbsp;<?php echo SITENAME; ?></title>
    <meta name="theme-color" content="#ff0">
    <meta name="msapplication-navbutton-color" content="#ff0">
    <meta name="apple-mobile-web-app-status-bar-style" content="#ff0">
    
    <!-- Open Graph data -->
    <meta property="fb:pages" content="454145568313710">
    <meta property="og:locale" content="xh_za">
    <meta property="og:site_name" content="Salary Magazine">
    <meta property="og:title" content="<?php echo $data['page_title']; ?>&nbsp;|&nbsp;<?php echo SITENAME; ?>">
    <meta property="og:type" content="<?php echo $data['page_type']; ?>">
    <meta property="og:url" content="<?php echo $data['page_url']; ?>">
    <meta property="og:image" content="<?php echo $data['page_image']; ?>">
    <meta property="og:image:alt" content="<?php echo $data['page_title']; ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="675">
    <meta property="og:description" content="<?php echo $data['page_description']; ?>">
    <meta property="article:publisher" content="https://www.facebook.com/salarymagazine/">
    <meta property="article:author" content="https://www.facebook.com/salarymagazine/">
    <meta property="fb:app_id" content="356408348235135">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Playfair+Display|Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/rha5bzd.css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="<?php echo URLROOT; ?>/css/style.css?version=2.3.55" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/all.css">
    
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo URLROOT; ?>/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo URLROOT; ?>/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo URLROOT; ?>/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo URLROOT; ?>/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo URLROOT; ?>/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo URLROOT; ?>/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo URLROOT; ?>/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo URLROOT; ?>/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo URLROOT; ?>/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo URLROOT; ?>/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo URLROOT; ?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo URLROOT; ?>/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo URLROOT; ?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo URLROOT; ?>/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffff00">
    <meta name="msapplication-TileImage" content="<?php echo URLROOT; ?>/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffff00">
    
    <!-- ShareThis -->
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5cc9cf310ff462001290dd25&product=inline-share-buttons' async='async'></script>
    
    <!-- Google Adsense & CKEditor -->
    <script src="https://cdn.tiny.cloud/1/el252dxb71z0rz3ff5swsn0gxcycmd4egow400okd62fyy06/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="<?php echo URLROOT; ?>/js/ckeditor/ckeditor.js"></script>
    
   <!-- AdSense -->
   <script data-ad-client="ca-pub-1034834624649462" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
 
<?php require APPROOT .'/views/inc/navbar.php'; ?>
    