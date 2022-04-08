<?php
include("../essentials/session.php");

$action = "";
if (isset($_REQUEST['aAction'])) {
    $action = $_REQUEST['aAction'];
} else {
    echo "ERROR";
}

if ( $action == "Images" ) {

    echo <<<EOF
        <section class="col-sm-offset-4 col-sm-4 s_write_post">
            <div class="row">
                <div class="col-sm-12 s_write_post_heading">
                    <h3>Fotografien hinzufügen</h3>
                </div>
            </div>
    
            <form action="post.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                        <textarea class="h_underline" name="new_post" rows="5" placeholder="Bitte beschreibe dein Foto, ${_SESSION['name']} !"></textarea>
                    </div>
                </div>
    
                <div class="row h_padding_vertical">
                    <div class="col-sm-12 center-sm">
                            Bilder: 
                            <input type="file" onchange="previewImages(this);" name="fileToUpload" id="fileToUpload" multiple>
                    </div>
                </div>
                <div class="row h_margin_vertical h_padding_horizontal around-sm" id="action_image_preview_wrapper">
                </div>
                
                <div class="row h_margin_vertical">
                    <div class="col-sm-12 end-sm">
                        <button type="submit">
                            <i class="far fa-share-square"></i>
                            Veröffentlichen
                        </button>
                    </div>
                </div>
            </form>
        </section>
EOF;

} elseif ( $action == "Videos" ) {

    echo <<<EOF
        <section class="col-sm-offset-4 col-sm-4 s_write_post">
            <div class="row">
                <div class="col-sm-12 s_write_post_heading">
                    <h3>Videografie hinzufügen</h3>
                </div>
            </div>
    
            <form action="upload_video.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                        <textarea class="h_underline" name="new_post" rows="5" placeholder="Bitte beschreibe dein Video, ${_SESSION['name']} !"></textarea>
                    </div>
                </div>
    
                <div class="row h_padding_vertical">
                    <div class="col-sm-12 center-sm">
                            Video: 
                            <input type="file" name="videoToUpload" id="videoToUpload" accept="video/mp4">
                    </div>
                </div>
                <div class="row h_margin_vertical h_padding_horizontal around-sm" id="action_image_preview_wrapper">
                </div>
                
                <div class="row h_margin_vertical">
                    <div class="col-sm-12 end-sm">
                        <button type="submit">
                            <i class="far fa-share-square"></i>
                            Veröffentlichen
                        </button>
                    </div>
                </div>
            </form>
        </section>
EOF;

} elseif ( $action == "Posts" ) {

    echo <<<EOF
        <section class="col-sm-offset-4 col-sm-4">
EOF;

    DisplayWritePost();

    echo <<<EOF
        </section>
EOF;

} elseif ( $action == "Trips" ) {

    echo <<<EOF
        <section class="col-sm-offset-4 col-sm-4 s_write_post">
            <div class="row">
                <div class="col-sm-12 s_write_post_heading">
                    <h3>Reise erstellen</h3>
                </div>
            </div>
    
            <form action="upload_video.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12 h_margin_vertical">
                        <span class="f_add_heading">Titel</span>
                        <textarea class="h_underline" name="new_title" rows="2" placeholder="Gib deiner Reise einen aussagekräftigen Titel, ${_SESSION['name']} !"></textarea>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <span class="f_add_heading">Beschreibung</span>
                        <textarea class="h_underline" name="new_description" rows="5" placeholder="Hier kannst du deine Reise kürzer oder länger beschreiben, Anektoten, Sprichwörter oder sonnstiges einfügen - natürlich kannst du trotzdem weitere Posts hinzufügen."></textarea>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <span class="f_add_heading">Zeitangaben</span>
                        <div class="row h_margin_vertical">
                            <div class="col-sm-12">
                                <select name="new_precision" onChange="SelectPrecision();" id="action_select_precision">
EOF;
                                MakeTimePrecisionOption( "Exakt" );
    echo <<<EOF
                                </select>
                            </div>
                        </div>
                        <div id="action_option_container">
                        
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <span class="f_add_heading">Ortsangaben</span>
                        <div class="row h_margin_vertical">
                            <div class="col-sm-6">
                                <select name="new_country">
EOF;
                                MakeCountryOption( 0, $database );
    echo <<<EOF
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <textarea style="padding-top: 2px;" class="h_underline" name="new_place" rows="2" placeholder="Füge optional einen Ort oder eine Region hinzu!"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <span class="f_add_heading">Kategorieangaben</span>
                        <div class="row h_margin_vertical">
                            <div class="col-sm-12">
                                <select name="new_group_type">
EOF;
                                MakeGroupTypeOption( 0 );
    echo <<<EOF
                                </select>
                            </div>
                        </div>
                        <div class="row h_margin_vertical">
                            <div class="col-sm-12">
                                <select name="new_trip_type">
EOF;
                                MakeTripTypeOption( 0 );
    echo <<<EOF
                                </select>
                            </div>
                        </div>
                        <div class="row h_margin_vertical">
                            <div class="col-sm-12">
                                <select name="new_transport_type">
EOF;
                                MakeTransportOption( 0 );
    echo <<<EOF
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="row h_padding_vertical">
                    <div class="col-sm-12">
                    <span class="f_add_heading">Medien</span>
                        <input type="file" onchange="previewImages(this);" name="files[]" id="fileToUpload" multiple>
                    </div>
                </div>
                <div class="row h_margin_vertical h_padding_horizontal around-sm" id="action_image_preview_wrapper">
                </div>
                
                <div class="row h_margin_vertical">
                    <div class="col-sm-12 end-sm">
                        <button type="submit">
                            <i class="far fa-share-square"></i>
                            Veröffentlichen
                        </button>
                    </div>
                </div>
            </form>
        </section>
EOF;

} else {
    echo "ERROR";
}







?>