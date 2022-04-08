<?php
include('session.php');
include('html_header.php');
include('dashboard_header.php');

ShowHeader( "events", $database );

echo <<<EOF
<main class="s_dashboard">
    <div class="container">
        <div class="row">
            <h1>EVENTS</h1>

EOF;


            echo <<<EOF
        </div>
    </div>
</main>
EOF;

?>