<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../resources/config/config.php");
include("../essentials/essentials.php");
include("../essentials/dashboard_header.php");
include('../essentials/html_header.php');

echo "<body style='overflow: hidden'>";

$size_header = "cookies_header";
ShowHeader( $size_header, $database );

?>

    <main id="action_index_container" class="s_index_container" style="top: 150px;background-color: #FFF;">
        <div class="row center-xs">
            <div class="col-xs-12 start-xs">
                <div class="s_important_section">
                    <div class="row center-xs middle-xs">
                        <div class="col-xs-3 start-xs middle-xs">
                            <p class="speech-bubble-left">Wie erstelle ich ein Konto?</p>
                            <br><br>
                            <p class="speech-bubble-left">Ich habe mein Passwort vergessen.</p>
                        </div>
                        <div class="col-xs-6 start-xs">
                            <h2>Häufig gestellte Fragen</h2>
                            <div class="row">
                                <p class="speech-bubble-left">Wie lade ich Bilder und Videos gleichzeitig hoch?</p>
                                <p class="speech-bubble-left">Wie erstelle ich eine Reise?</p>
                            </div>
                            <div class="row">
                                <p class="speech-bubble-left">Wie werden meine Daten geschützt?</p>
                                <p class="speech-bubble-left">Wie kann ich die Sichtbarkeit meiner Bilder einstellen?</p>
                            </div>
                            <div class="row">
                                <p class="speech-bubble-left">Wie kann ich meine Profilbilder bearbeiten?</p>
                                <p class="speech-bubble-left">Wie bekomme ich Hilfe auf mein konkreten Problem?</p>
                                <p class="speech-bubble-left">Wie sieht es mit Datenschutz aus?</p>
                            </div>
                        </div>
                        <div class="col-xs-3 start-xs">
                            <p class="speech-bubble-left">Wie lösche ich die erstellen Cookies?</p>
                            <p class="speech-bubble-left">Wie kann meine E-Mail-Adresse ändern?</p>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
        
        <div class="row center-xs">
            <div class="col-xs-6 start-xs">
            <h2>Beliebte Themen</h2>
                <div class="row h_no_padding">
                    <div class="col-xs-3 h_no_padding">
                        <button class="b_large_preview" type="button">
                            <div class="row">
                                <div class="col-xs-12 center-xs"><i class="fas fa-key b_large_symbol"></i></div>
                                
                            </div>
                            <div class="row">
                                <div class="col-xs-12"><span class="f_big_text">Registration und Passwort</span></div>
                            </div>
                            
                            <div class="row">
                                <div class="col-xs-12"><p class="f_small_text">Wie meldest du dich an oder änderst dein Passwort?</p></div>
                            </div>
                        </button>
                    </div>
                    <div class="col-xs-3 h_no_padding">
                        <button class="b_large_preview" type="button">
                            <div class="row">
                                <div class="col-xs-12 center-xs"><i class="fas fa-search-location b_large_symbol"></i></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12"><span class="f_big_text">Registration und Passwort</span></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12"><p class="f_small_text">Wie meldest du dich an oder änderst dein Passwort?</p></div>
                            </div>
                        </button>
                    </div>
                    <div class="col-xs-3 h_no_padding">
                        <button class="b_large_preview" type="button">
                            <div class="row">
                                <div class="col-xs-12 center-xs"><i class="fas fa-camera b_large_symbol"></i></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12"><span class="f_big_text">Registration und Passwort</span></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12"><p class="f_small_text">Wie meldest du dich an oder änderst dein Passwort?</p></div>
                            </div>
                        </button>>
                    </div>
                    <div class="col-xs-3 h_no_padding">
                        <button  style="border-right: 1px solid #dddfe2;" class="b_large_preview" type="button">
                            <div class="row">
                                <div class="col-xs-12 center-xs"><i class="fas fa-mobile b_large_symbol"></i></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12"><span class="f_big_text">Registration und Passwort</span></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12"><p class="f_small_text">Wie meldest du dich an oder änderst dein Passwort?</p></div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>   
        
        <div class="row center-xs" style="margin-bottom: 150px">
            <div class="col-xs-6 start-xs">
                <h2 style="margin-bottom: 120px">Nicht das Richtige gefunden?</h2>
                
                <div class="row">
                    <div class="col-xs-4">
                        <div class="row">
                            <i class="fas fa-mail-bulk b_extra_large"></i>
                        </div>
                        <div class="row">
                            <div class="col-xs-12"><span class="f_big_text">Registration und Passwort</span></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8"><p class="f_small_text">Schreibe unserem Support Team</p></div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="row">
                            <i class="fas fa-question b_extra_large"></i>
                        </div>
                        <div class="row">
                            <div class="col-xs-12"><span class="f_big_text">Registration und Passwort</span></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8"><p class="f_small_text">Schreibe unserem Support Team</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php PrintFooter(); ?>

</main>

<script>

    if ( document.getElementById('help_start') ) {
        document.getElementById('help_start').classList.add('help_nav_active');   
    }


</script>

