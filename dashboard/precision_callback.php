<?php
include("../essentials/session.php");
include("../essentials/essentials.php");
$option = "";
if (isset($_REQUEST['cOption'])) {
    $option = $_REQUEST['cOption'];
} else {
    echo "ERROR";
}

if ( $option == 1 ) {
    echo <<<EOF
        <div class="row center-sm">
            <div class="col-sm-2">Von:</div>
            <div class="col-sm-2">
                <select name="new_from_day">
EOF;
                MakeDayOption( "1" );
    echo <<<EOF
                </select>
            </div>
            <div class="col-sm-3">
                <select name="new_from_month">
EOF;
                MakeMonthOption( "1" );
    echo <<<EOF
                </select>
            </div>
            <div class="col-sm-3">
                <select name="new_from_year">
EOF;
                MakeYearOption( "2017" );
    echo <<<EOF
                </select>
            </div>
        </div>
        <div class="row center-sm">
            <div class="col-sm-2">
                Bis:
            </div>
            <div class="col-sm-2">
                <select name="new_to_day">
EOF;
                MakeDayOption( "1" );
    echo <<<EOF
                </select>
            </div>
            <div class="col-sm-3">
                <select name="new_to_month">
EOF;
                MakeMonthOption( "1" );
    echo <<<EOF
                </select>
            </div>
            <div class="col-sm-3">
                <select  name="new_to_year">
EOF;
                MakeYearOption( "2017" );
    echo <<<EOF
                </select>
            </div>
        </div>
EOF;
} elseif ( $option == 2 ) {
    echo <<<EOF
        <div class="row center-sm">
            <div class="col-sm-2">Von:</div>
            <div class="col-sm-3">
                <select name="new_from_month">
EOF;
    MakeMonthOption( "1" );
    echo <<<EOF
                </select>
            </div>
            <div class="col-sm-3">
                <select name="new_from_year">
EOF;
    MakeYearOption( "2017" );
    echo <<<EOF
                </select>
            </div>
        </div>
        <div class="row center-sm">
            <div class="col-sm-2">
                Bis:
            </div>
            <div class="col-sm-3">
                <select name="new_to_month">
EOF;
    MakeMonthOption( "1" );
    echo <<<EOF
                </select>
            </div>
            <div class="col-sm-3">
                <select name="new_to_year">
EOF;
    MakeYearOption( "2017" );
    echo <<<EOF
                </select>
            </div>
        </div>
EOF;
} elseif ( $option == 3 ) {
    echo <<<EOF
    <div class="row center-sm">
        <div class="col-sm-2">Saison:</div>
        <div class="col-sm-6">
            <select  name="new_season">
EOF;
            MakeSeasonOption("0");

    echo <<<EOF
            </select>
        </div>
    </div>

EOF;
} elseif ( $option == 4 ) {
    echo <<<EOF
        <div class="row center-sm">
            <div class="col-sm-2">Von:</div>
            <div class="col-sm-3">
                <select name="new_from_year">
EOF;
    MakeYearOption( "2017" );
    echo <<<EOF
                </select>
            </div>
        </div>
        <div class="row center-sm">
            <div class="col-sm-2">
                Bis:
            </div>
            <div class="col-sm-3">
                <select name="new_to_year">
EOF;
    MakeYearOption( "2018" );
    echo <<<EOF
                </select>
            </div>
        </div>
EOF;
} else {
    echo "ERROR";
}