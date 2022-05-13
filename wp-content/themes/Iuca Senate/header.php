<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article# profile: http://ogp.me/ns/profile# fb: http://ogp.me/ns/fb#">

<head>
    <meta charset="utf-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- header addons -->
    <meta property="og:image" content="http://example.com/ogp.jpg" />  
    <meta property="og:image:secure_url" content="https://secure.example.com/ogp.jpg" />  
    <meta property="og:image:type" content="image/jpeg" />  
	<meta property="og:image:width" content="400" />  
    <meta property="og:image:height" content="300" />  
    <meta property="og:image:alt" content="A shiny red apple with a bite taken out" />

    <?php if(is_paged()): ?>
    <meta name='robots' content='noindex, nofollow' />
    <?php endif; ?>
    
    <!-- header addons end -->

<?php wp_head(); ?>
   
</head>
<body>
<div class="wrap">

<?php 
    get_template_part('template-parts/header/template');
?>