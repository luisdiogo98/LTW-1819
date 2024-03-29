<?php
    include_once('../includes/incl_session.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    include_once('../templates/tpl_profile.php');
    include_once('../templates/tpl_stories.php');
    include_once('../database/db_stories.php');
    include_once('../database/db_account.php');
    include_once('../database/db_channels.php');

    $username = htmlentities($_GET['user']);

    $userdata = getUserData($username);

    if(!empty($userdata)) //if user exists
    {        
        $subbed_channels = getSubbedChannels($username);
        draw_header($username);
        draw_navBar($username);
        printProfile($userdata);
    }
    else //if user does not exist
    {
        draw_header(null);
        draw_navBar(null);
        printProfileError($username);
    }

    draw_footer();
?>