<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../../resources/config/config.php");
include("../../essentials/essentials.php");
include("../../essentials/dashboard_header.php");
include('../../essentials/html_header.php');

echo "<body style='overflow: hidden'>";

$size_header = "cookies_header";
ShowHeader( $size_header, $database );



?>
<main id="action_index_container" class="s_index_container s_dataprotection m_container_to_page_bottom" style="top: 150px; background-color: white; color: #1c1e21;">
    <div class="container">
        <div class="row center-xs">
            <div class="col-xs-2 start-xs">

                <div onclick="location.href='#questions_online'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Stelle online eine Frage
                    </div>
                </div>

                <div onclick="location.href='#questions_online'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Melde widerrechtliches Verhalten
                    </div>
                </div>

                <div onclick="location.href='#questions_online'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Gib eine Fehlermeldung auf
                    </div>
                </div>

                <div onclick="location.href='#questions_mail'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Schreibe Uns eine E-Mail
                    </div>
                </div>

                <div onclick="location.href='#questions_chat'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                       Schreibe Uns im Chat
                    </div>
                </div>

            </div>

            <span class="span_placeholder" id="questions_start"></span>

            <div class="col-xs-5 start-xs s_questions_text">
                <h1>Keine Antwort gefunden? Schreibe unserem Support!</h1>
                <p>
                    Deine Frage wird öffentlich gepostet und kann von jedem Benutzer beantwortet werden. Gib bitte die E-Mail-Adresse oder Telefonnummer an, mit der du dein Konto bestätigt hast. Du bekommst die Benachrichtungen auf deinem Dashboard.
                </p>
                
                
                <span class="span_placeholder" id="questions_online"></span>

                <h2>Stelle online eine Frage</h2>
                <p>
                    Deine Frage wird öffentlich gepostet und kann von jedem Benutzer beantwortet werden. Gib bitte die E-Mail-Adresse oder Telefonnummer an, mit der du dein Konto bestätigt hast. Du bekommst die Benachrichtungen auf deinem Dashboard.
                </p>
                <div class="row center-xs h_login_get_style">
                    <form class="h_padding_vertical center-xs" enctype="multipart/form-data" method="post">
                        <div class="row center-xs">
                            <label title="Wähle das Land in dem du wohnst aus." for="new_country">
                                <i class="fas fa-globe-europe"></i>
                            </label>
                            <select class="select-css" title="Wähle das Land in dem du wohnst aus." name="new_country" id="new_country">
                                <?php MakeCountryOption( "AT", $database ); ?>
                            </select>
                        </div>
                        <div class="row center-xs">
                            <label for="new_slogan">
                                <i class="far fa-envelope-open"></i>
                            </label>
                            <input title="Gib hier ein Motto, einen Slogan oder eine Kurzbeschreibung an. Dieser Text erscheint in deinem Profil." type="text" id="new_slogan" name="new_slogan" placeholder="E-Mail-Adresse oder Handynummer" required>
                        </div>
                        <div class="row center-xs">
                            <label for="new_slogan">
                                <i class="fas fa-quote-right"></i>
                            </label>
                            <textarea rows="5" title="Gib hier ein Motto, einen Slogan oder eine Kurzbeschreibung an. Dieser Text erscheint in deinem Profil." id="new_slogan" name="new_slogan" placeholder="Fehler, Vorschläge, unglöste Probleme" required></textarea>
                        </div>
                        
                        <div class="row center-xs">
                            <div class="col-sm-12">
                                <button class="b_large_action_button b_small_action_button h_margin_vertical" type="submit" title="Eingaben merken und weiter zu den geografischen Angaben.">Stelle deine Frage&nbsp;&nbsp;<i class="fas fa-forward"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <span class="span_placeholder" id="questions_report"></span>

                <button  type="button" class="b_back_to_start" onclick="location.href='#questions_start'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>


                <h2>Melde widerrechtliches Verhalten</h2>
                <p>
                    Deine Frage wird öffentlich gepostet und kann von jedem Benutzer beantwortet werden. Gib bitte die E-Mail-Adresse oder Telefonnummer an, mit der du dein Konto bestätigt hast. Du bekommst die Benachrichtungen auf deinem Dashboard.
                </p>
                <div class="row center-xs h_login_get_style">
                    <form class="h_padding_vertical center-xs" enctype="multipart/form-data" method="post">
                        <div class="row center-xs">
                            <label title="Wähle das Land in dem du wohnst aus." for="new_country">
                                <i class="fas fa-globe-europe"></i>
                            </label>
                            <select class="select-css" title="Wähle das Land in dem du wohnst aus." name="new_country" id="new_country">
                                <?php MakeCountryOption( "AT", $database ); ?>
                            </select>
                        </div>
                        <div class="row center-xs">
                            <label for="new_slogan">
                                <i class="far fa-envelope-open"></i>
                            </label>
                            <input title="Gib hier ein Motto, einen Slogan oder eine Kurzbeschreibung an. Dieser Text erscheint in deinem Profil." type="text" id="new_slogan" name="new_slogan" placeholder="E-Mail-Adresse oder Handynummer" required>
                        </div>
                        <div class="row center-xs">
                            <label for="new_slogan">
                                <i class="fas fa-quote-right"></i>
                            </label>
                            <textarea rows="5" title="Gib hier ein Motto, einen Slogan oder eine Kurzbeschreibung an. Dieser Text erscheint in deinem Profil." id="new_slogan" name="new_slogan" placeholder="Fehler, Vorschläge, unglöste Probleme" required></textarea>
                        </div>

                        <div class="row center-xs">
                            <div class="col-sm-12">
                                <button class="b_large_action_button b_small_action_button h_margin_vertical" type="submit" title="Eingaben merken und weiter zu den geografischen Angaben.">Stelle deine Frage&nbsp;&nbsp;<i class="fas fa-forward"></i></button>
                            </div>
                        </div>
                    </form>
                </div>


                <span class="span_placeholder" id="questions_error"></span>

                <button  type="button" class="b_back_to_start" onclick="location.href='#questions_start'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>


                <h2>Gib eine Fehlermeldung auf</h2>
                <p>
                    Deine Frage wird öffentlich gepostet und kann von jedem Benutzer beantwortet werden. Gib bitte die E-Mail-Adresse oder Telefonnummer an, mit der du dein Konto bestätigt hast. Du bekommst die Benachrichtungen auf deinem Dashboard.
                </p>
                <div class="row center-xs h_login_get_style">
                    <form class="h_padding_vertical center-xs" enctype="multipart/form-data" method="post">
                        <div class="row center-xs">
                            <label title="Wähle das Land in dem du wohnst aus." for="new_country">
                                <i class="fas fa-globe-europe"></i>
                            </label>
                            <select class="select-css" title="Wähle das Land in dem du wohnst aus." name="new_country" id="new_country">
                                <?php MakeCountryOption( "AT", $database ); ?>
                            </select>
                        </div>
                        <div class="row center-xs">
                            <label for="new_slogan">
                                <i class="far fa-envelope-open"></i>
                            </label>
                            <input title="Gib hier ein Motto, einen Slogan oder eine Kurzbeschreibung an. Dieser Text erscheint in deinem Profil." type="text" id="new_slogan" name="new_slogan" placeholder="E-Mail-Adresse oder Handynummer" required>
                        </div>
                        <div class="row center-xs">
                            <label for="new_slogan">
                                <i class="fas fa-quote-right"></i>
                            </label>
                            <textarea rows="5" title="Gib hier ein Motto, einen Slogan oder eine Kurzbeschreibung an. Dieser Text erscheint in deinem Profil." id="new_slogan" name="new_slogan" placeholder="Fehler, Vorschläge, unglöste Probleme" required></textarea>
                        </div>

                        <div class="row center-xs">
                            <div class="col-sm-12">
                                <button class="b_large_action_button b_small_action_button h_margin_vertical" type="submit" title="Eingaben merken und weiter zu den geografischen Angaben.">Stelle deine Frage&nbsp;&nbsp;<i class="fas fa-forward"></i></button>
                            </div>
                        </div>
                    </form>
                </div>


                <span class="span_placeholder" id="questions_mail"></span>

                <button  type="button" class="b_back_to_start" onclick="location.href='#questions_start'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>
                
                <h2>Schreibe Uns eine E-Mail</h2>
                <p>
                    Deine Frage wird öffentlich gepostet und kann von jedem Benutzer beantwortet werden. Gib bitte die E-Mail-Adresse oder Telefonnummer an, mit der du dein Konto bestätigt hast. Du bekommst die Benachrichtungen auf deinem Dashboard.
                </p>
                <div class="row">
                    <div class="col-xs-10">
                        <div class="business_card">
                            <div class="row">
                                <div class="col-xs-8" style="border-right: 1px solid #efefef">
                                    <h4 class="f_big_text">Support</h4>
                                    <a href="mailto:support@vacayournal.com" class="f_small_text">support@vacayournal.com</a>
                                    <div class="f_small_about_text"><p>Wende dich an den Support wenn du Fragen zur Funktionsweise von Vacayournal. Gerne nehmen wir auch Fehlermeldungen entgegen oder helfen dir bei konkreten Problemen.</p></div>
                                </div>
                            </div>
                            <div class="business_card_picture" style="background-image: url('../../resources/images/support.jpg')">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-10">
                        <div class="business_card">
                            <div class="row">
                                <div class="col-xs-8" style="border-right: 1px solid #efefef">
                                    <h4 class="f_big_text">Sicherheit</h4>
                                    <a href="mailto:security@vacayournal.com" class="f_small_text">security@vacayournal.com</a>
                                    <div class="f_small_about_text"><p>Wende dich an die Sicherheits-Abteilung, wenn du Fragen bezüglich Datenspeicherung, Verschlüsselung oder Sicherheit hast.</p></div>
                                </div>
                            </div>
                            <div class="business_card_picture" style="background-image: url('../../resources/images/security.jpg')">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-10">
                        <div class="business_card">
                            <div class="row">
                                <div class="col-xs-8" style="border-right: 1px solid #efefef">
                                    <h4 class="f_big_text">Kaufmännische Tätigkeiten</h4>
                                    <a href="mailto:office@vacayournal.com" class="f_small_text">office@vacayournal.com</a>
                                    <div class="f_small_about_text"><p>Möchtest du unser Partner werden oder dich auf einen ausgeschriebenen Job bewerben, sind wir deine Ansprechpartner.</p></div>
                                </div>
                            </div>
                            <div class="business_card_picture" style="background-image: url('../../resources/images/office.jpg')">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-10">
                        <div class="business_card">
                            <div class="row">
                                <div class="col-xs-8" style="border-right: 1px solid #efefef">
                                    <h4 class="f_big_text">Entwickler</h4>
                                    <a href="mailto:developer@vacayournal.com" class="f_small_text">developer@vacayournal.com</a>
                                    <div class="f_small_about_text"><p>Falls dir ein Fehler aufgefallen ist, kannst du diesen direkt unseren Software-Entwicklern mitteilen.</p></div>
                                </div>
                            </div>
                            <div class="business_card_picture" style="background-image: url('../../resources/images/developer.jpeg')">
                            </div>
                        </div>
                    </div>
                </div>
                
                <span class="span_placeholder" id="questions_chat"></span>

                <button  type="button" class="b_back_to_start" onclick="location.href='#questions_start'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>
                
                <h2>Schreibe Uns im Chat</h2>
                <p>
                    Deine Frage wird öffentlich gepostet und kann von jedem Benutzer beantwortet werden. Gib bitte die E-Mail-Adresse oder Telefonnummer an, mit der du dein Konto bestätigt hast. Du bekommst die Benachrichtungen auf deinem Dashboard.
                </p>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer</p>
            
                <span class="span_placeholder" id="cookies_heading"></span>

                <button  type="button" class="b_back_to_start" onclick="location.href='#questions_start'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>
            </div>
        </div>
    </div>
    
    
    
    <div style="margin-bottom: 60px;"></div>

    <?php PrintFooter(); ?>

</main>

<script>

    if ( document.getElementById('help_questions') ) {
        document.getElementById('help_questions').classList.add('help_nav_active');   
    }


</script>

