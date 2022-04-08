<?php


function ShowHeader ( $active, $database ) {
    $sName = "";
    if ($stmt = $database->prepare('SELECT name FROM users WHERE id=?')) {
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        $stmt->bind_result($sName);
        $stmt->fetch();
        $stmt->close();
    }

    $iPath = GetProfilePicture( $sName, $database );

    if ( $active == "index_large" ) {

        echo <<<EOF

        <header class="h_header_index top-xs top-sm top-md middle-lg center-xs center-sm center-md center-lg">
            <div class="row h_row_container middle-xs middle-sm middle-md middle-lg center-xs center-sm center-md center-lg">
                <div class="col-xs-5">
                    <h1 onclick="location.href='index.php';" class="h_cursor_pointer">Vacayournal</h1>
                </div>        
                <div class="col-xs-7">
                    <form action="authenticate.php" method="post">
                        <div class="row center-xs">
                            <div class="col-xs-5 m_form_input_fixed middle-xs">
                                <div class="row h_padding_horizontal">
                                    <label for="username" class="h_white_label h_margin_bottom">E-Mail-Adresse oder Handynummer	</label>
                                </div>
                                <div class="row h_padding_horizontal">
                                    <input type="text" id="username" name="username">
                                </div>
                            </div>
                            <div class="col-xs-5 m_form_input_fixed middle-xs">
                                <div class="row h_padding_horizontal">
                                    <label for="password" class="h_white_label h_margin_bottom">Passwort</label>
                                </div>
                                <div class="row h_padding_horizontal">
                                    <input type="password" id="password" name="password">
                                </div>
                            </div>
                            <div class="col-xs-2 m_form_button_fixed">
                                <button type="submit"><i class="fas fa-paper-plane"></i>  Starten</button>
                            </div>
                        </div>
                    </form>
                </div>    
            </div>
        </header>

EOF;

    } elseif ( $active == "index_small" ) {

        echo <<<EOF

        <header class="h_header_index top-xs top-sm top-md middle-lg center-xs center-sm center-md center-lg">
            <div class="row h_row_container middle-xs middle-sm middle-md middle-lg center-xs">
                <div class="col-xs-12">
                    <h1 onclick="location.href='index.php';" class="h_cursor_pointer">Vacayournal</h1>
                </div>        
            </div>
        </header>

EOF;

    } else {

        $SEEN = 0;
        $count_messages = 0;
        if ($count_new_messages = $database->prepare('SELECT COUNT(*) FROM messages WHERE receiver=? AND seen=?')) {
            $count_new_messages->bind_param('si', $sName, $SEEN);
            $count_new_messages->execute();
            $count_new_messages->bind_result($count_messages);
            $count_new_messages->fetch();
            $count_new_messages->close();
        }

        echo <<<EOF
    <header class="h_header middle-xs start-xs">
        <div class="col-xs-2 col-sm-1 col-md-1 col-lg-3 row center-xs middle-xs">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                <div class="h_round_image" style="background-image: url($iPath);">
    
                </div>
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-9 start-sm h_display_none">
                <button onclick="location.href = 'user.php?tUsername=${sName}'" type="submit">
                    $sName
                </button>
            </div>
        </div>
        
        <div class="col-xs-4 col-offset-small col-sm-3 col-md-3 col-lg-3 row center-xs middle-xs hide-xs-md">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <button onclick='location.href="dashboard.php"'>
                    Überblick
                </button>
            </div>
        
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <button onclick='location.href="media.php"'>
                    Medien
                </button>
            </div>
            
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <button onclick='location.href="events.php"'>
                    Ereignisse
                </button>
            </div>
        </div>
        
        <div class="col-xs-3 col-sm-offset-1 col-sm-2 col-md-2 col-lg-1 row center-xs middle-xs hide-lg">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 row middle-xs center-xs">
                <button onclick='location.href="dashboard.php"'>
                    <i class="fas fa-stream"></i>
                </button>
            </div>
        
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 row middle-xs center-xs">
                <button onclick='location.href="media.php"'>
                    <i class="fas fa-photo-video"></i>
                </button>
            </div>
            
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 row middle-xs center-xs">
                <button onclick='location.href="events.php"'>
                    <i class="far fa-calendar-times"></i>
                </button>
            </div>
        </div>
        
        <div class="col-xs-4 col-sm-offset-1 col-sm-3 col-md-3 col-lg-2 row center-xs middle-xs">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row middle-xs">
                <form>
                    <input class="d_searchbar" type="search" placeholder="Suche">
                </form>
            </div>
        </div>
        
        <div class="col-xs-3 col-sm-offset-1 col-sm-2 col-md-2 col-lg-1 row center-xs middle-xs">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 row middle-xs center-xs" style="position: relative;">
                <button title="Benachrichtigungen" onclick="ToggleNotification( );">
                    <i class="fas fa-bell"></i>
                </button>
                <div class="s_notification_preview_container" id="action_notification_preview_container" style="display: none;"></div>
                
            </div>
           
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 row middle-xs center-xs">
                <button title="Nachrichten" onclick='location.href="chat.php"'>
                    <i class="fas fa-comments"></i>
                    
EOF;
        if ( $count_messages > 0 ) {
            echo "<span class='i_got_new'>${count_messages}</span>";
        }
        echo <<<EOF
                    
                </button>
            </div>
            
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 row middle-xs center-xs" title="Einstellungen">
                <button onclick='if (confirm("Willst du dich wirklich von meiner Webapp abmelden?")) { location.href="logout.php" }'>
                   <i class="fas fa-angle-double-right"></i>
                 </button>
            </div>
        </div>
    </header>
EOF;

    }


}
?>