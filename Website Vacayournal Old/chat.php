<?php
include('session.php');
include('html_header.php');
include('dashboard_header.php');

ShowHeader( "chat", $database );

if( isset($_REQUEST['cUser']) ) {
    $last_action_user['sender'] = $_REQUEST['cUser'];
} else {
    $last_action_user['sender'] = "";
}

echo <<<EOF
<script>
    window.onload = function(){call('${last_action_user['sender']}');};
</script>
<main class="s_dashboard" id="s_dashboard">

</main>
EOF;
?>


