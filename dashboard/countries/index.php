<?php
include('../../essentials/session.php');
include('../../essentials/html_header.php');
include('../../essentials/dashboard_header.php');

ShowHeader( "dash", $database );

echo <<<EOF
<main class="s_dashboard">
    <div class="container">
        <div class="row center-xs">
            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6" style="text-align: left">
            
            
            
            
            </div>
            
            <div class="col-xs-2 h_padding_horizontal s_dash_sidenav s_search_menu start-xs">
                <h4>Beitragsart: </h4>
                <div class="row">
                    <div class="col-xs-12">
                        <select class="select-css select-css-small" title="Wähle das Land in dem du wohnst aus." name="new_country" id="new_country">
EOF;
MakeCountryOption( "AT", $database );

echo <<<EOF
                        </select>
                    </div>
                </div>
                
                <h4>Länder: </h4>
                <div class="row">
                    <div class="col-xs-12">
                        <select class="select-css select-css-small" title="Wähle das Land in dem du wohnst aus." name="new_country" id="new_country">
EOF;
MakeCountryOption( "AT", $database );

echo <<<EOF
                        </select>
                    </div>
                </div>
                
                <h4>Beiträge von: </h4>
                <div class="row">
                    <div class="col-xs-12">
                        <input checked="checked" type="radio" id="cAllUser" name="cArticleType" value="allpersons">
                        <label for="cAllUser"> Beliebige Person</label> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input type="radio" id="cYourFriends" name="cArticleType" value="friends">
                        <label for="cYourFriends"> Deine Freunde </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input type="radio" id="cPublic" name="cArticleType" value="public">
                        <label for="cPublic"> Öffentlich</label> 
                    </div>
                </div>
                
                <h4>Datum des Beitrags: </h4>
                <div class="row">
                    <div class="col-xs-12">
                        <input checked="checked" type="radio" id="cAllDates" name="cArticleDate" value="alldates">
                        <label for="cAllDates"> Beliebiges Datum</label> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input type="radio" id="cThisWeek" name="cArticleDate" value="thisweek">
                        <label for="cThisWeek"> Diese Woche </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input type="radio" id="cLastWeek" name="cArticleDate" value="lastweek">
                        <label for="cLastWeek"> Letzte Woche </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input type="radio" id="cThisMonth" name="cArticleDate" value="thismonth">
                        <label for="cThisMonth"> Dieser Monat</label> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input type="radio" id="cLastMonth" name="cArticleDate" value="lastmonth">
                        <label for="cLastMonth"> Letzter Monat</label> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input type="radio" id="cThisYear" name="cArticleDate" value="thisyear">
                        <label for="cThisYear"> Dieses Jahr</label> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input type="radio" id="cLastYear" name="cArticleDate" value="lastyear">
                        <label for="cLastYear"> Letztes Jahr</label> 
                    </div>
                </div>
                            
EOF;

PrintDashboardFooter();

echo <<<EOF
            </div>

            
            
            
            
        </div>
    </div>
</main>


EOF;
