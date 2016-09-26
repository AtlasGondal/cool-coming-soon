<?php
    $cool_coming_soon_data      = get_option('cool_coming_soon_data');
    $cool_coming_soon_display   = get_option('cool_coming_soon_display');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Atlas Gondal">
    <title><?=$cool_coming_soon_data->page_title?></title>
    <style>
        @import 'https://fonts.googleapis.com/css?family=Tillana';
        @import 'https://fonts.googleapis.com/css?family=Bilbo';

        .container{text-align:center;font-size:16px;color:#fff;max-width:50%;margin-left:auto;margin-right:auto;background:url("<?=($cool_coming_soon_display->display_background == 'Yes' ? (!empty($cool_coming_soon_data->background_url) ? $cool_coming_soon_data->background_url : ($cool_coming_soon_data->bg_options == 'bg' ? plugins_url( 'assets/img/bg.jpg', __FILE__ ) : ($cool_coming_soon_data->bg_options == 'bg2' ? plugins_url( 'assets/img/bg2.jpg', __FILE__ ) : ($cool_coming_soon_data->bg_options == 'bg3' ? plugins_url( 'assets/img/bg3.jpg', __FILE__ ) : ($cool_coming_soon_data->bg_options == 'bg4' ? plugins_url( 'assets/img/bg4.jpg', __FILE__ ) : ($cool_coming_soon_data->bg_options == 'bg5' ? plugins_url( 'assets/img/bg5.jpg', __FILE__ ) : ($cool_coming_soon_data->bg_options == 'bg6' ? plugins_url( 'assets/img/bg6.jpg', __FILE__ ) : plugins_url( 'assets/img/bg.jpg', __FILE__ )) )))))) : '')?>") no-repeat;-webkit-background-size:cover;font-family:Bilbo,cursive}.main-section{margin:5% auto;background:rgba(0,0,0,.6);transition:all 1s;padding:10px 15px;border-radius:15px;border:2px solid #fff}.logo{max-width:250px;max-height:250px}.title{font-size:7em;font-weight:100;margin:0}.description{font-family:Tillana,cursive;font-size:2em;font-weight:100;padding-top:1%}.date{font-size:3em}@media screen and (max-width:320px){.logo{width:150px}.title{font-size:3em}.description{font-size:1em}}@media screen and (max-width:480px){.container{max-width:80%}.logo{max-width:250px;max-height:250px}.title{font-size:4em}.description{font-size:1.4em}.date{font-size:2em}}

    </style>
</head>
<body class="container">
    <?php
        $date_arr = explode("-", $cool_coming_soon_data->date);
    ?>
<div class="main-section">
    <img src="<?=($cool_coming_soon_display->display_logo == "Yes" ? $cool_coming_soon_data->logo_url : '')?>" class="logo" draggable="false">
    <h1 class="title"><?=($cool_coming_soon_display->display_title == "Yes" ? $cool_coming_soon_data->heading : '')?></h1>
    <div class="description">
        <?=($cool_coming_soon_display->display_logo == 'No' && $cool_coming_soon_display->display_title == 'No' && $cool_coming_soon_display->display_description == 'No' && $cool_coming_soon_display->display_date == 'No') ? '<h1>Are you alright?<br/>What are you trying to test?<br/>You have disabled everything.<br/>Please go back<br/>AND<br/>Enable at least one item.</h1>' : ''?>
        <?=($cool_coming_soon_display->display_description == "Yes" ? $cool_coming_soon_data->description : '')?>
        <span class="date"><br/><?=($cool_coming_soon_display->display_date == "Yes" ? $date_arr[2]." ".$date_arr[1]." ".$date_arr[0] : '')?></span>
    </div>
</div>
</body>
</html>