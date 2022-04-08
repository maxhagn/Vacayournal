<?php


function ShowHeader ( $active, $database ) {

    $sUserId = "";
    if ( isset( $_SESSION['id'] ) ) {
        $sUserId =  $_SESSION['id'];
    }

    $cSearchText = "";
    if ( isset($_SESSION['search_text']) ) {
        $cSearchText = $_SESSION['search_text'];
    }

    $sUserName = GetUserName( $sUserId, $database );
    $sUserFirstName = GetUserFirstName( $sUserId, $database );
    $sUserPath = GetProfilePicture( $sUserId, $database );

    if ( !isset( $_COOKIE["cookies_agreement"] ) ) {
        echo <<<EOF
        <header id="action_cookie_header" class="s_cookie_header">
            <div class="row center-xs">
                <div class="col-xs-8">
                
                <p>Wir verwenden Cookies, um Inhalte zu personalisieren, Werbeanzeigen maßzuschneidern und zu messen sowie die Sicherheit unserer Nutzer zu erhöhen. Wenn du auf unsere Website klickst oder hier navigierst, stimmst du der Erfassung von Informationen durch Cookies auf und außerhalb von Facebook zu. Weitere Informationen zu unseren Cookies und dazu, wie du die Kontrolle darüber behältst, findest du hier: <a style="color: darkgray;" href='../policies/index.php#cookies_heading'">Cookie-Richtlinie</a>.</p>
                
                <i onclick="AcceptCookies();" class="far fa-check-square b_cookies_accept"></i>
                
                </div>
            </div>
        </header>
EOF;
    }


    if ( $active == "index_large" ) {
        echo <<<EOF
        <header id="action_classic_header" class="h_header_index top-xs top-sm top-md middle-lg center-xs center-sm center-md center-lg">
            <div class="row h_row_container middle-xs middle-sm middle-md middle-lg center-xs center-sm center-md center-lg">
                <div class="col-xs-5">
                    <h1 onclick="location.href='/website/';" class="h_cursor_pointer">Vacayournal</h1>
                </div>        
                <div class="col-xs-7">
                    <form action="/website/auth/authenticate.php" method="post">
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
                                <button type="submit"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Starten</button>
                            </div>
                        </div>
                    </form>
                </div>    
            </div>
        </header>

EOF;

    } elseif ( $active == "cookies_header" ) {

        echo <<<EOF
        <header id="action_classic_header" class="h_header_index h_header_help middle-xs center-xs">
             <div class="row middle-xs" style="height: 150px;">
                 <div class="col-xs-12">
                    <div class="row middle-xs center-xs" style="height: 100px">
                        <div class="col-xs-3">
                         <div class="row">
                            <h1 onclick="location.href='/website/';" title="Vacayournal" class="b_logo_small">V</h1>
                            <h1 onclick="location.href='/website/help/';" title="Hilfe und Support" class="b_help_title">Hilfe und Support</h1>
                            </div>
                        </div>           
                        <div class="col-xs-3">
                            <i class="fas fa-search f_label_search"></i>
                            <input class="search_bar_help" type="search" id="help_search" placeholder="Suchen" name="help_search">
                        </div>    
                        <div class="col-xs-3">
                            <div class="row middle-xs center-xs">
                                <div class="col-xs-3">
                                    <button type="button" class="b_header_link" onclick="location.href='/website/?sSpecial=l'">Anmelden</button>
                                </div>
                                <div class="col-xs-3">
                                    <button type="button" class="b_header_link" onclick="location.href='/website/?sSpecial=r'">Registrieren</button>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="row bottom-xs center-xs">
                        <div class="col-xs-10">
                            <div class="row middle-xs center-xs">
                                <button type="button" id="help_start" class="b_help_nav" onclick="location.href='../help'">Startseite</button>
                             
                                <div class="dropdown">
                                    <button type="button" id="help_setup" class="b_help_nav" onclick="location.href='../help/setup'">Konto einrichten</button>
                                    <div class="dropdown-content">
                                      <a href="#">Mit den Nutzungsbedinungen vertraut machen</a>
                                      <a href="#">Ein Konto erstellen</a>
                                      <a href="#">Die erste Anmeldung</a>
                                      <a href="#">Konto vervollständigen</a>
                                      <a href="#">Mehr Sicherheit für dein Konto</a>
                                    </div>
                                </div>
                                
                                <div class="dropdown">
                                    <button type="button" id="help_upload" class="b_help_nav" onclick="location.href='../help/upload'">Hochladen von Beiträgen</button>
                                    <div class="dropdown-content">
                                      <a href="#">Einen Beitrag verfassen</a>
                                      <a href="#">Ein Foto hochladen</a>
                                      <a href="#">Mehrere Fotos hochladen</a>
                                      <a href="#">Ein Video hochladen</a>
                                      <a href="#">Mehrere Videos hochladen</a>
                                      <a href="#">Eine Reise erstellen</a>
                                      <a href="#">Ein Ereignis erstellen</a>
                                    </div>
                                </div>
                                
                                <div class="dropdown">
                                    <button type="button" id="help_friends" class="b_help_nav" onclick="location.href='../help/friends'">Kontake knüpfen</button>
                                    <div class="dropdown-content">
                                      <a href="#">Einen Beitrag verfassen</a>
                                      <a href="#">Ein Foto hochladen</a>
                                      <a href="#">Mehrere Fotos hochladen</a>
                                      <a href="#">Ein Video hochladen</a>
                                      <a href="#">Mehrere Videos hochladen</a>
                                      <a href="#">Eine Reise erstellen</a>
                                      <a href="#">Ein Ereignis erstellen</a>
                                    </div>
                                </div>
                                
                                <div class="dropdown">
                                    <button type="button" id="help_maintain" class="b_help_nav" onclick="location.href='../help/maintain'">Konto verwalten</button>
                                    <div class="dropdown-content">
                                      <a href="#">Einen Beitrag verfassen</a>
                                      <a href="#">Ein Foto hochladen</a>
                                      <a href="#">Mehrere Fotos hochladen</a>
                                      <a href="#">Ein Video hochladen</a>
                                      <a href="#">Mehrere Videos hochladen</a>
                                      <a href="#">Eine Reise erstellen</a>
                                      <a href="#">Ein Ereignis erstellen</a>
                                    </div>
                                </div>
                                
                                <div class="dropdown">
                                    <button type="button" id="help_safety" class="b_help_nav" onclick="location.href='../help/safety'">Privatsphäre und Sicherheit</button>
                                    <div class="dropdown-content">
                                      <a href="#">Einen Beitrag verfassen</a>
                                      <a href="#">Ein Foto hochladen</a>
                                      <a href="#">Mehrere Fotos hochladen</a>
                                      <a href="#">Ein Video hochladen</a>
                                      <a href="#">Mehrere Videos hochladen</a>
                                      <a href="#">Eine Reise erstellen</a>
                                      <a href="#">Ein Ereignis erstellen</a>
                                    </div>
                                </div>
                                
                                <button type="button" id="help_questions" class="b_help_nav" onclick="location.href='../help/questions'">Stelle uns eine Frage</button>
                                
                                <button type="button" id="help_information" class="h_margin_left_large b_help_nav" onclick="location.href='../help/information'">Informationen</button>
                                <button type="button" id="help_about" class="b_help_nav"  onclick="location.href='../help/about'">Über Uns</button>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </header>

EOF;

    } elseif ( $active == "index_small" ) {

        echo <<<EOF

        <header class="h_header_index top-xs top-sm top-md middle-lg center-xs center-sm center-md center-lg">
            <div class="row h_row_container middle-xs middle-sm middle-md middle-lg center-xs">
                <div class="col-xs-12">
                    <h1 onclick="location.href='/website/';" class="h_cursor_pointer">Vacayournal</h1>
                </div>        
            </div>
        </header>

EOF;

    } else {

        $SEEN = 0;
        $count_messages = 0;
        if ($count_new_messages = $database->prepare('SELECT COUNT(*) FROM messages WHERE receiver_id=? AND seen=?')) {
            $count_new_messages->bind_param('si', $sUserId, $SEEN);
            $count_new_messages->execute();
            $count_new_messages->bind_result($count_messages);
            $count_new_messages->fetch();
            $count_new_messages->close();
        }

        echo <<<EOF
    <header class="h_header middle-xs center-xs">
       <div class="col-xs-3">
           <div class="row middle-xs">
               <div class="col-xs-1 h_hover_able" title="Startseite">
                    <div onclick="location.href='/website/dashboard';" class="row middle-xs center-xs" style="margin-top: 7.5px;">
                        <h1 class="b_logo_small">V</h1>
                    </div>
               </div>
                
               <div class="col-xs-11 row center-xs middle-xs">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row middle-xs" style="position: relative;">
                        <input class="d_searchbar" id="d_searchbar" type="text"  value="${cSearchText}" onkeyup="CallbackSearch( );" placeholder="Suche">
                        <div class="s_search_preview_container" id="action_search_preview_container" style="display: none;"></div>
                    </div>
               </div> 
           </div>
       </div>
       
       <div class="col-xs-4">
           <div class="row middle-xs">
               <div class="col-xs-6 center-xs middle-xs" style="min-width: fit-content;max-width: fit-content; padding: 0;" onclick="location.href='/website/dashboard/user/?cUserId=${sUserId}'">
                    <button type="button" id="help_setup" style="white-space: nowrap; min-width: fit-content; height: 46px;" class="b_dash_nav middle-xs" onclick="location.href='../help/setup'">
                        <div class="row middle-xs" style="min-width: fit-content">
                            <div class="col-xs-3">
                                <div class="h_round_image h_no_margin middle-xs" style="background-image: url($sUserPath);"></div>
                            </div>     
                        </div>
                    </button>
                </div>
                
                
                <div class="h_seperator"></div>
                
                <div class="col-xs-2 row center-xs middle-xs hide-xs-md" style="padding: 0; max-width: fit-content;">
                    <div class="col middle-xs">
                        <div class="dropdown">
                            <button type="button" id="help_setup" style="height:46px;" class="b_dash_nav" onclick="location.href='../help/setup'">Entdecken</button>
                            <div class="dropdown-content">
                              <a href="#">Reisen</a>
                              <a href="#">Ereignisse</a>
                              <a href="#">Länder</a>
                              <a href="#">Medien</a>
                              <a href="#">Online</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="h_seperator"></div>
        
               <div class="col-xs-2 row center-xs middle-xs hide-xs-md" style="padding: 0; max-width: fit-content;">
                    <div class="col middle-xs">
                        <div class="dropdown">
                            <button type="button" id="help_setup" style="height:46px; max-width: fit-content;" class="b_dash_nav" onclick="location.href='../help/setup'">Erstellen</button>
                            <div class="dropdown-content">
                              <a href="#">Fotografie</a>
                              <a href="#">Videografie</a>
                              <a href="#">Beitrag</a>
                              <a href="#">Reise</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="h_seperator"></div>
                
               <div class="col-xs-3 row center-xs middle-xs">
                    <div class="col-xs-4 row middle-xs center-xs" style="position: relative;">
                        <button title="Benachrichtigungen" onclick="ToggleNotification( );">
                            <i class="fas fa-bell"></i>
                        </button>
                        <div class="s_notification_preview_container" id="action_notification_preview_container" style="display: none;"></div>
                        
                    </div>
                   
                    <div class="col-xs-4 row middle-xs center-xs">
                        <button title="Nachrichten" onclick='location.href="/website/chat"'>
                            <i class="fas fa-comments"></i>
                            
EOF;
        if ( $count_messages > 0 ) {
            echo "<span class='i_got_new'>${count_messages}</span>";
        }
        echo <<<EOF
                        
                        </button>
                    </div>
                    <div class="col-xs-4 row middle-xs center-xs" style="position: relative;">
                        <div class="dropdown">
                            <button title="Benachrichtigungen" style="height:46px;" onclick="ToggleNotification( );"><i class="fas fa-angle-double-right"></i></button>
                            <div class="dropdown-content">
                              <a href="#">Gruppe verwalten</a>
                              <a href="/website/help/">Hilfe</a>
                              <hr style="margin: 0">
                              <a href="/website/dashboard/settings/">Feed-Einstellungnen</a>
                              <a href="/website/dashboard/settings/">Einstellungnen</a>
                              <a onclick='if (confirm("Willst du dich wirklich von Vacayournal abmelden?")) { location.href="/website/auth/logout.php" }' href="#">Abmelden</a>
                            </div>
                        </div>
                    </div>
                </div> 
           </div>
       </div>
      
        
       
    </header>
EOF;

    }


}
?>