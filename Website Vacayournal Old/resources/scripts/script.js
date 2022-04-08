function sendMessage( send_to_user ) {
    let message = document.getElementById("message").value;


    if (message.length === 0) {
        alert("message to short");
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {


            if (this.readyState == 4 && this.status == 200) {
                call(send_to_user);
            }

        };

        xmlhttp.open("GET", "chat_send.php?message=" + message + "&user=" + send_to_user, true);
        xmlhttp.send();
    }
}

function call( last_action_user ) {
    var container = document.getElementById("s_dashboard");
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.response;
            var message_container = document.getElementById("message_container");
            message_container.scrollTop = message_container.scrollHeight;
        }

    };

    xmlhttp.open("GET", "chat_callback.php?cUser=" + last_action_user , true);
    xmlhttp.send();
}

function CallUserSection( user, section ) {
    var container = document.getElementById("profile_sections_action_wrapper");
    var xmlhttp = new XMLHttpRequest();

    document.querySelectorAll('.h_reset_active').forEach(function(elem) {
        elem.classList.remove('active');
    });

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.response;
            var active = document.getElementById("action_section_" + section);
            active.classList.toggle('active');

        }

    };

    xmlhttp.open("GET", "user_callback.php?cUser=" + user + "&cSection=" + section , true);
    xmlhttp.send();
}

function CallAdd( action ) {
    var container = document.getElementById("action_add_section");
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.response;

            if ( action == "Trips" ) {
                SelectPrecision();
            }
        }

    };

    xmlhttp.open("GET", "add_callback.php?aAction=" + action, true);
    xmlhttp.send();
}

function previewImages(that) {
    var preview = document.getElementById('action_image_preview_wrapper');

    if (that.files) {
        [].forEach.call(that.files, readAndPreview);
    }

    function readAndPreview(file) {
        if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
            return alert(file.name + " is not an image");
        }

        var reader = new FileReader();
        reader.addEventListener("load", function() {
            var old_base = this.result;
            var container = document.createElement('div');
            container.setAttribute('class', 's_image_preview col-sm-3');
            getOrientation(file, function(orientation) {
                resetOrientation(old_base, orientation, function(resetBase64Image) {
                    container.setAttribute('style', "background-image: url('" + resetBase64Image + "');");

                });
            });

            preview.appendChild(container);
        });

        reader.readAsDataURL(file);

    }
}

function SelectPrecision () {
    var value = document.getElementById('action_select_precision').value;
    var container = document.getElementById('action_option_container');

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.response;
        }

    };

    xmlhttp.open("GET", "precision_callback.php?cOption=" + value, true);
    xmlhttp.send();
}

function SelectVerifyBy (  ) {
    var value = document.getElementById('new_verify_by').value;
    var email = document.getElementById('verify_by_email');
    var mobile = document.getElementById('verify_by_phone');
    var email_input = document.getElementById('new_email');
    var phone_input = document.getElementById('new_phone');

    if ( value === "verify_by_email" ) {
        email.style.display = "flex";
        mobile.style.display = "none";
        phone_input.required = false;
        email_input.required = true;
    } else if ( value === "verify_by_phone" ) {
        email.style.display = "none";
        mobile.style.display = "flex";
        phone_input.required = true;
        email_input.required = false;
        window.intlTelInput(phone_input, {
            autoPlaceholder: "aggressive",
            preferredCountries: ["at"],
            separateDialCode: true,
            formatOnDisplay: true
        });
    }
}

function getPhoneNumber() {
    var form = document.getElementById("action_registration");

    if ( document.getElementById("post_phone_number") ) {
        form.removeChild(document.getElementById("post_phone_number"))
    }
    var phone_input = document.getElementById('new_phone');
    var phone_pre = document.getElementsByClassName("iti__selected-dial-code")[0];
    var input = document.createElement("input");
    var full_number = phone_pre.innerHTML + phone_input.value;
    input.id = "post_phone_number";
    input.type = "hidden";
    input.name = "new_full_data";
    input.value = full_number;
    form.appendChild(input);
}

function getOrientation(file, callback) {
    var reader = new FileReader();

    reader.onload = function(event) {
        var view = new DataView(event.target.result);

        if (view.getUint16(0, false) != 0xFFD8) return callback(-2);

        var length = view.byteLength,
            offset = 2;

        while (offset < length) {
            var marker = view.getUint16(offset, false);
            offset += 2;

            if (marker == 0xFFE1) {
                if (view.getUint32(offset += 2, false) != 0x45786966) {
                    return callback(-1);
                }
                var little = view.getUint16(offset += 6, false) == 0x4949;
                offset += view.getUint32(offset + 4, little);
                var tags = view.getUint16(offset, little);
                offset += 2;

                for (var i = 0; i < tags; i++)
                    if (view.getUint16(offset + (i * 12), little) == 0x0112)
                        return callback(view.getUint16(offset + (i * 12) + 8, little));
            }
            else if ((marker & 0xFF00) != 0xFF00) break;
            else offset += view.getUint16(offset, false);
        }
        return callback(-1);
    };

    reader.readAsArrayBuffer(file.slice(0, 64 * 1024));
}

function resetOrientation(srcBase64, srcOrientation, callback) {
    var img = new Image();

    img.onload = function() {
        var width = img.width,
            height = img.height,
            canvas = document.createElement('canvas'),
            ctx = canvas.getContext("2d");

        // set proper canvas dimensions before transform & export
        if (4 < srcOrientation && srcOrientation < 9) {
            canvas.width = height;
            canvas.height = width;
        } else {
            canvas.width = width;
            canvas.height = height;
        }

        // transform context before drawing image
        switch (srcOrientation) {
            case 2: ctx.transform(-1, 0, 0, 1, width, 0); break;
            case 3: ctx.transform(-1, 0, 0, -1, width, height ); break;
            case 4: ctx.transform(1, 0, 0, -1, 0, height ); break;
            case 5: ctx.transform(0, 1, 1, 0, 0, 0); break;
            case 6: ctx.transform(0, 1, -1, 0, height , 0); break;
            case 7: ctx.transform(0, -1, -1, 0, height , width); break;
            case 8: ctx.transform(0, -1, 1, 0, 0, width); break;
            default: break;
        }

        // draw image
        ctx.drawImage(img, 0, 0);

        // export base64
        callback(canvas.toDataURL());
    };

    img.src = srcBase64;
}

function CallFollow( user, action ) {
    var xmlhttp = new XMLHttpRequest();


    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.reload();
        }

    };

    xmlhttp.open("GET", "follow_callback.php?cFollow=" + user + "&cAction=" + action  , true);
    xmlhttp.send();
}

function ToggleNotification ( ) {
    let container = document.getElementById('action_notification_preview_container');

    if ( container.style.display === "none" ) {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                container.innerHTML = this.response;
            }

        };

        container.style.display = "block";


        xmlhttp.open("GET", "notification_callback.php", true);
        xmlhttp.send();
    } else {
        container.style.display = "none";
    }
}

function ToggleModal ( image ) {
    let modal = document.getElementById('action_modal_wrapper');


    var xmlhttp = new XMLHttpRequest();


    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            modal.innerHTML = this.response;
            modal.style.display = "block";

            var span = document.getElementsByClassName("close")[0];

            span.onclick = function() {
                modal.style.display = "none";
            };

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };
        }
    };

    xmlhttp.open("GET", "image_callback.php?cImage=" + image , true);
    xmlhttp.send();
}

function ToggleUserModal ( user, id, type ) {
    let modal = document.getElementById('action_user_modal_wrapper');


    var xmlhttp = new XMLHttpRequest();


    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            modal.innerHTML = this.response;
            modal.style.display = "block";

            var span = document.getElementsByClassName("close_user_modal")[0];

            span.onclick = function() {
                modal.style.display = "none";
            };

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };
        }
    };

    xmlhttp.open("GET", "user_modal_callback.php?cUser=" + user + "&cId=" + id + "&cType=" + type , true);
    xmlhttp.send();
}

function WriteComment( elem, type, reload ) {
    let select = "action_comment_textarea_" + type + "_" + elem;
    let textarea = document.getElementById(select);
    let value = textarea.value;



    if ( value !== "" ) {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                CallElementInformation( elem, type, reload );
            }

        };


        xmlhttp.open("GET", "comment_callback.php?cComment=" + value + "&cElem=" + elem + "&cType=" + type, true);
        xmlhttp.send();
    } else {
        textarea.value = "";
    }
}

function Like( elem, type, status, reload ) {

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            CallElementInformation( elem, type, reload );
        }

    };

    xmlhttp.open("GET", "like_callback.php?cElem=" + elem + "&cType=" + type + "&cStatus=" + status, true);
    xmlhttp.send();

}

function CallTimeline( user, start_number, end_number ) {
    var xmlhttp = new XMLHttpRequest();


    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.reload();
        }

    };

    xmlhttp.open("GET", "timeline_callback.php?cUser=" + user + "&cStart=" + start_number + "&cEnd=" + end_number, true);
    xmlhttp.send();
}

function CallElementInformation ( elem, type, reload ) {
    var query = "action_element_information_" + type + "_" + elem;
    var container = document.getElementById(query);

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.response;

            if ( reload === 1 ) {
                var commentSection = document.getElementById("action_comment_horizontal");
                commentSection.scrollTop = commentSection.scrollHeight;
            }
        }
    };

    xmlhttp.open("GET", "element_information_callback.php?cElem=" + elem + "&cType=" + type + "&cReload=" + reload, true);
    xmlhttp.send();
}

function getWidth() {
    return Math.max(
        document.documentElement.scrollWidth,
        document.documentElement.offsetWidth,
        document.documentElement.clientWidth
    );
}

function LoadIndex ( specialpage ) {
    var width = getWidth();
    var login, register, information, header, footer;

    login = "FALSE";
    register = "TRUE";
    information = "TRUE";
    header = "index_large";
    footer = "large";


    if ( specialpage === "l" ) {
        login = "TRUE";
        register = "FALSE";
        information = "FALSE";
        header = "index_small";
        footer = "small";
    } else if ( specialpage === "r" ) {
        login = "FALSE";
        register = "TRUE";
        information = "FALSE";
        header = "index_small";
        footer = "small";

    } else {

        if ( width < 1200 ) {
            login = "TRUE";
            register = "TRUE";
            information = "TRUE";
            header = "index_small";
            footer = "small";
        } else {
            login = "FALSE";
            register = "TRUE";
            information = "TRUE";
            header = "index_large";
            footer = "large";
        }

    }



    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.body.innerHTML = this.response;
        }
    };

    xmlhttp.open("GET", "index_callback.php?sLogin=" + login + "&sRegister=" + register + "&sInformation=" + information + "&sHeader=" + header + "&sFooter=" + footer , true);
    xmlhttp.send();
}

function detectmob() {
    if( navigator.userAgent.match(/Android/i)
        || navigator.userAgent.match(/webOS/i)
        || navigator.userAgent.match(/iPhone/i)
        || navigator.userAgent.match(/iPad/i)
        || navigator.userAgent.match(/iPod/i)
        || navigator.userAgent.match(/BlackBerry/i)
        || navigator.userAgent.match(/Windows Phone/i)
    ){
        return true;
    }
    else {
        return false;
    }
}

function TriggerUploadModal() {
    var container = document.getElementById("action_file_input_container");

    if ( document.getElementById("new_profile_image") ) { container.removeChild( document.getElementById("new_profile_image") ) }

    var fileSelector = document.createElement('input');
    fileSelector.setAttribute('type', 'file');
    fileSelector.setAttribute('id', 'new_profile_image');
    fileSelector.style.display = "none";
    fileSelector.setAttribute('onchange', 'previewImages(this);');
    fileSelector.click();
    container.appendChild(fileSelector);
}

function CallProfileForm ( status, username ) {
    var container = document.getElementById( "action_profile_form" );

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.response;


            if      ( status == 1 ) {
                if(document.getElementById("new_phone")) {
                    var phone_input = document.getElementById('new_phone');
                    window.intlTelInput(phone_input, {
                        autoPlaceholder: "aggressive",
                        preferredCountries: ["at"],
                        separateDialCode: true,
                        formatOnDisplay: true
                    });
                }
                container.setAttribute("onSubmit", "SaveProfileInfo();CallProfileForm('2', '" + username + "');return false;")
            }
            else if ( status == 2 ) { container.setAttribute("onSubmit", "SaveProfileInfo();CallProfileForm('3', '" + username + "');return false;") }
            else if ( status == 3 ) { container.setAttribute("onSubmit", "SaveProfileInfo();CallProfileForm('4', '" + username + "');return false;") }
            else if ( status == 4 ) { container.setAttribute("onSubmit", "SaveProfileInfo();CallProfileForm('5', '" + username + "');return false;") }
            else if ( status == 5 ) { container.setAttribute("onSubmit", "SaveProfileInfo();CallProfileForm('6', '" + username + "');return false;") }
        }
    };

    xmlhttp.open("GET", "profile_form_callback.php?cPage=" + status + "&cUsername=" + username, true);
    xmlhttp.send();
}

function PreviewCities () {
    var container = document.getElementById("action_location_preview");
    var map = document.getElementById("action_city_preview");
    var country = document.getElementById("new_country").value;
    var search = document.getElementById("new_search").value;


    var xmlhttp = new XMLHttpRequest();


    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.response;
            map.style.display = "none";
            container.style.display = "block";
        }

    };

    xmlhttp.open("GET", "search_callback.php?cSearch=" + search + "&cCountry=" + country, true);
    xmlhttp.send();
}

function SaveCity( city, lat, long ) {
    var map_container = document.getElementById("action_city_preview");
    var container = document.getElementById("action_location_preview");

    var xmlhttp = new XMLHttpRequest();


    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            map_container.innerHTML = this.response;
            container.style.display = "none";
            map_container.style.display = "block"

            var map = tt.map({
                key: '4iASSdlHsZOZl0NZRde1KoC56R6gvoez',
                container: 'map',
                style: 'tomtom://wms/1/jpeg',
                center: [long, lat],
                zoom: 8,
                dragPan: !window.isMobileOrTablet()
            });

            var marker = new tt.Marker()
                .setLngLat([long, lat])
                .addTo(map);
        }

    };

    xmlhttp.open("GET", "city_information_callback.php?cCity=" + city, true);
    xmlhttp.send();
}

function SaveProfileInfo () {
    slogan = document.getElementById("new_slogan");
    nickname = document.getElementById("new_nickname");
    mail = document.getElementById("new_email");




    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert( this.response );
        }
    };

    xmlhttp.open("POST", "profile_form_save.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("sData1=Henry&sData2=Ford");
}