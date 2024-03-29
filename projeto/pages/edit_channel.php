<?php
    include_once('../includes/incl_session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    include_once('../templates/tpl_channel.php');
    include_once('../database/db_channels.php');

    $username = htmlentities($_POST['user']);
    $channel_name = htmlentities($_POST['channel']);
  
    if (!isset($_SESSION['username']) || $_SESSION['username'] != $username)
        die(header('Location: ../pages/channels_list.php'));
    
    $channel = getChannel($channel_name);

    draw_header($_SESSION['username']);
    draw_navBar($_SESSION['username']);
    $subbed_channels = getSubbedChannels($_SESSION['username']);
    draw_sidebar($subbed_channels, false);

    draw_edit_channel($channel);
    draw_footer();
?>