<?php
include('../../essentials/session.php');
include('../../essentials/html_header.php');
include('../../essentials/dashboard_header.php');

ShowHeader( "dash", $database );

?>

<main class="s_dashboard h_no_padding">
    <div class="container">
        <div class="row center-xs">
            <div class="col-xs-2 start-xs">

                <div onclick="CallbackSettings('1');" class="row s_settings_button">
                    <div class="col-xs-12 start-xs">
                        <i class="fas fa-cogs"></i>&nbsp;&nbsp;Allgemein
                    </div>
                </div>

                <div onclick="CallbackSettings('2');" class="row s_settings_button">
                    <div class="col-xs-12 start-xs">
                        <i class="fas fa-info-circle"></i>&nbsp;&nbsp;Öffentliche Informationen
                    </div>
                </div>

                <div onclick="CallbackSettings('3');" class="row s_settings_button">
                    <div class="col-xs-12 start-xs">
                        <i class="fas fa-globe-europe"></i>&nbsp;&nbsp;Standort
                    </div>
                </div>

                <div onclick="CallbackSettings('4');" class="row s_settings_button">
                    <div class="col-xs-12 start-xs">
                        <i class="fas fa-shield-alt"></i>&nbsp;&nbsp;Sicherheit und Login
                    </div>
                </div>

                <div onclick="CallbackSettings('5');" class="row s_settings_button">
                    <div class="col-xs-12 start-xs">
                        <i class="fas fa-key"></i>&nbsp;&nbsp;Privatsphäre
                    </div>
                </div>

                <div onclick="CallbackSettings('6');" class="row s_settings_button">
                    <div class="col-xs-12 start-xs">
                        <i class="fas fa-database"></i>&nbsp;&nbsp;Deine Daten
                    </div>
                </div>

                <div onclick="CallbackSettings('7');" class="row s_settings_button">
                    <div class="col-xs-12 start-xs">
                        <i class="fas fa-stream"></i>&nbsp;&nbsp;Feed-Einstellungen
                    </div>
                </div>

            </div>

            <div class="col-xs-5 start-xs s_settings_content" id="action_settings_container">

            </div>
        </div>
        <div class="row center-xs">
            <div class="col-xs-5 col-xs-offset-2 start-xs">
                <?php PrintDashboardFooter(); ?>

            </div>
        </div>
    </div>

    <script>
        CallbackSettings('1');
    </script>


</main>