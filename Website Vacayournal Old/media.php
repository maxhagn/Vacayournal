<?php
include('session.php');
include('html_header.php');
include('dashboard_header.php');

ShowHeader( "media", $database );

echo <<<EOF
    <main class="s_dashboard">
        <div class="container">
            <div class="row">
            <h1>MEDIA</h1>
            
EOF;


echo <<<EOF
            </div>
        </div>
    </main>
EOF;

?>