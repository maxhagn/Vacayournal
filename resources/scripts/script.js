function sendMessage( send_to_user ) {
    var message = document.getElementById("message").value;


    if (message.length === 0) {
        alert("message to short");
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {


            if (this.readyState == 4 && this.status == 200) {
                call(send_to_user);
            }

        };

        xmlhttp.open("GET", "/chat/chat_send.php?message=" + message + "&user=" + send_to_user, true);
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

    xmlhttp.open("GET", "/chat/chat_callback.php?cUser=" + last_action_user , true);
    xmlhttp.send();
}

function CallUserSection( user_id, section ) {
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

    xmlhttp.open("GET", "/dashboard/user/user_callback.php?cUserId=" + user_id + "&cSection=" + section , true);
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

    xmlhttp.open("GET", "/dashboard/add_callback.php?aAction=" + action, true);
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

    xmlhttp.open("GET", "/dashboard/precision_callback.php?cOption=" + value, true);
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

function getPhoneNumberForm() {
    var form = document.getElementById("action_profile_form");

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

function CallFollow( userid, action ) {
    var xmlhttp = new XMLHttpRequest();


    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.reload();
        }

    };

    xmlhttp.open("GET", "/dashboard/follow_callback.php?cFollow=" + userid + "&cAction=" + action  , true);
    xmlhttp.send();
}

function CallFollowAndReload( userid, action ) {
    var xmlhttp = new XMLHttpRequest();


    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            PreviewTopUser();
        }

    };

    xmlhttp.open("GET", "/dashboard/follow_callback.php?cFollow=" + userid + "&cAction=" + action  , true);
    xmlhttp.send();
}

function ToggleNotification ( ) {
    var container = document.getElementById('action_notification_preview_container');

    if ( container.style.display === "none" ) {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                container.innerHTML = this.response;
            }

        };

        container.style.display = "block";


        xmlhttp.open("GET", "/dashboard/notification_callback.php", true);
        xmlhttp.send();
    } else {
        container.style.display = "none";
    }
}


function CallbackSearch ( ) {
    var container = document.getElementById('action_search_preview_container');
    var text = document.getElementById('d_searchbar').value;

    container.style.display = "block";

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.response;
        }

    };

    xmlhttp.open("GET", "/dashboard/search_callback.php?cSearchText=" + text, true);
    xmlhttp.send();
}

function DisplaySearchResults( text, style ) {
    var container = document.getElementById('action_search_results_wrapper');

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.response;
        }

    };

    xmlhttp.open("GET", "/dashboard/search_callback.php?cSearchText=" + text + "&cStyle=" + style, true);
    xmlhttp.send();

}

function ToggleModal ( image ) {
    var modal = document.getElementById('action_modal_wrapper');


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

    xmlhttp.open("GET", "/dashboard/user/image_callback.php?cImage=" + image , true);
    xmlhttp.send();
}

function ToggleUserModal ( user, id, type ) {
    var modal = document.getElementById('action_user_modal_wrapper');


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

    xmlhttp.open("GET", "/dashboard/user_modal_callback.php?cUser=" + user + "&cId=" + id + "&cType=" + type , true);
    xmlhttp.send();
}

function WriteComment( elem, type, reload ) {
    var select = "action_comment_textarea_" + type + "_" + elem;
    var textarea = document.getElementById(select);
    var value = textarea.value;



    if ( value !== "" ) {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                CallElementInformation( elem, type, reload );
            }

        };


        xmlhttp.open("GET", "/dashboard/comment_callback.php?cComment=" + value + "&cElem=" + elem + "&cType=" + type, true);
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

    xmlhttp.open("GET", "/dashboard/like_callback.php?cElem=" + elem + "&cType=" + type + "&cStatus=" + status, true);
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

    xmlhttp.open("GET", "/dashboard/element_information_callback.php?cElem=" + elem + "&cType=" + type + "&cReload=" + reload, true);
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
    var login, register, information, header;

    login = "FALSE";
    register = "TRUE";
    information = "TRUE";
    header = "index_large";


    if ( specialpage === "l" ) {
        login = "TRUE";
        register = "FALSE";
        information = "FALSE";
        header = "index_small";
    } else if ( specialpage === "r" ) {
        login = "FALSE";
        register = "TRUE";
        information = "FALSE";
        header = "index_large";

    } else {

        if ( width < 1200 ) {
            login = "TRUE";
            register = "TRUE";
            information = "TRUE";
            header = "index_small";
        } else {
            login = "FALSE";
            register = "TRUE";
            information = "TRUE";
            header = "index_large";
        }

    }



    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.body.innerHTML = this.response;

            CheckCookies();
        }
    };

    xmlhttp.open("GET", "/index_callback.php?sLogin=" + login + "&sRegister=" + register + "&sInformation=" + information + "&sHeader=" + header , true);
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
    fileSelector.setAttribute('name', 'new_profile_image');
    fileSelector.style.display = "none";
    fileSelector.setAttribute('onchange', 'previewImages(this);');
    fileSelector.click();
    container.appendChild(fileSelector);
    document.getElementById("action_image_preview_wrapper").innerHTML = "";
}

function TriggerUploadProfileImage() {
    var container = document.getElementById("action_file_input_container");
    var fileSelector = document.createElement('input');
    fileSelector.setAttribute('type', 'file');
    fileSelector.setAttribute('id', 'new_profile_image');
    fileSelector.setAttribute('name', 'new_profile_image');
    fileSelector.style.display = "none";
    fileSelector.setAttribute('onchange', 'uploadProfileImage(this);');
    fileSelector.click();
    console.log("after click");
    container.appendChild(fileSelector);
}

var newwidth = 0;
var newheight = 0;
var newx = 0;
var newy = 0;
var cache_img = "";
function uploadProfileImage(that) {
    var xmlhttp = new XMLHttpRequest();
    file = that.files[0];
    var data = new FormData();
    data.append("new_profile_image", file);

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.body.removeChild(document.getElementById("action_loader_container"));
            var modal = document.createElement('div');
            var content = document.createElement('div');
            var img = document.createElement('img');
            var closeButton = document.createElement('span');
            var footer = document.createElement('div');
            footer.innerHTML = "<button type='button' onclick='OpenPrivacySettings();' class='b_crop_image_modal_button b_crop_image_privacy'><i class=\"fas fa-globe-europe\"></i></button><button type='button' onclick='CloseProfileImageUpload();' class='b_crop_image_modal_button'>Abbrechen</button><button type='button' onclick='SaveProfileImage();' class='b_crop_image_modal_button'>Speichern</button>";
            footer.setAttribute("class", "b_crop_image_modal_footer");
            img.style.height = "";
            img.style.width = "";
            closeButton.setAttribute("class", "b_crop_image_modal_close");
            closeButton.setAttribute("onclick", "CloseProfileImageUpload();");
            content.appendChild(closeButton);
            closeButton.innerHTML = "&times;";
            img.setAttribute("class", "i_crop_image_modal_preview");
            img.setAttribute("id", "image");
            img.src = "../" + this.responseText;
            cache_img = this.responseText;
            content.appendChild(img);
            content.appendChild(footer);
            content.setAttribute("class", "s_crop_image_modal_content");
            modal.setAttribute("class", "s_crop_image_modal");
            modal.setAttribute("id", "action_modal_wrapper");
            modal.appendChild(content);
            modal.style.display = "block";
            document.body.appendChild(modal);

            var minCroppedWidth = 400;
            var minCroppedHeight = 400;
            var maxCroppedWidth = 600;
            var maxCroppedHeight = 600;
            const image = document.getElementById('image');
            const cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,

                data: {
                    width: (minCroppedWidth + maxCroppedWidth) / 2,
                    height: (minCroppedHeight + maxCroppedHeight) / 2,
                },

                crop(event) {
                    var width = event.detail.width;
                    var height = event.detail.height;
                    if (
                        width < minCroppedWidth
                        || height < minCroppedHeight
                        || width > maxCroppedWidth
                        || height > maxCroppedHeight
                    ) {
                        cropper.setData({
                            width: Math.max(minCroppedWidth, Math.min(maxCroppedWidth, width)),
                            height: Math.max(minCroppedHeight, Math.min(maxCroppedHeight, height)),
                        });
                    }
                    newwidth  = event.detail.width;
                    newheight = event.detail.height;
                    newx      = event.detail.x;
                    newy      = event.detail.y;
                },
            });
        } else if (this.readyState == 1) {
            var loader = document.createElement('div');
            loader.setAttribute("class", "s_loader_container");
            loader.setAttribute("id", "action_loader_container");
            loader.innerHTML = "<div class=\"lds-facebook\"><div></div><div></div><div></div></div>";
            document.body.appendChild(loader);
        }
    };

    xmlhttp.open("POST", "/essentials/image_upload_callback_silent.php", true);
    xmlhttp.send(data);
}

function SaveProfileImage() {
    var xmlhttp = new XMLHttpRequest();
    var formData = new FormData();
    formData.append("newwidth", newwidth);
    formData.append("newheight", newheight);
    formData.append("newx", newx);
    formData.append("newy", newy);
    formData.append("cache_image", cache_img);

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         location.reload();
        }
    };

    xmlhttp.open("POST", "/essentials/image_upload_callback.php", true);
    xmlhttp.send(formData);
}


function CloseProfileImageUpload() {
    document.body.removeChild(document.getElementById('action_modal_wrapper'));
}

function CallProfileForm ( status, userid ) {
    var container = document.getElementById( "action_profile_form" );

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.response;


            if ( status == 1 ) {
                if(document.getElementById("new_phone")) {
                    var phone_input = document.getElementById('new_phone');
                    window.intlTelInput(phone_input, {
                        autoPlaceholder: "aggressive",
                        preferredCountries: ["at"],
                        separateDialCode: true,
                        formatOnDisplay: true
                    });
                }
                container.setAttribute("action", "profile_form_save.php?cStatus=1&cUserId=" + userid);
            }
            else if ( status == 2 ) { container.setAttribute("action", "profile_form_save.php?cStatus=2&cUserId=" + userid); }
            else if ( status == 3 ) { container.setAttribute("action", "profile_form_save.php?cStatus=3&cUserId=" + userid); }
            else if ( status == 4 ) { container.setAttribute("action", "profile_form_save.php?cStatus=4&cUserId=" + userid);}
            else if ( status == 5 ) {
                container.setAttribute("action", "profile_form_save.php?cStatus=5&cUserId=" + userid);
                PreviewTopUser();
            }
        }
    };

    xmlhttp.open("GET", "/compvare/profile_form_callback.php?cPage=" + status + "&cUserId=" + userid, true);
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

    xmlhttp.open("GET", "/compvare/search_callback.php?cSearch=" + search + "&cCountry=" + country, true);
    xmlhttp.send();
}

function PreviewTopUser () {
    var container = document.getElementById("action_present_top_user");

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.response;
        }

    };

    xmlhttp.open("GET", "/compvare/profile_form_user_callback.php", true);
    xmlhttp.send();
}

function CallbackSettings ( page ) {
    var container = document.getElementById("action_settings_container");
    var title_name = "";
    var xmlhttp = new XMLHttpRequest();

    if ( page == 1 ) {
        title_name = "Vacayournal | Allgemeine Einstellungen";
    } else if ( page == 2 ) {
        title_name = "Vacayournal | Öffentliche Informationen Einstellungen";
    } else if ( page == 3 ) {
        title_name = "Vacayournal | Standort Einstellungen";
    } else if ( page == 4 ) {
        title_name = "Vacayournal | Sicherheit und Login Einstellungen";
    } else if ( page == 5 ) {
        title_name = "Vacayournal | Privatsphäre Einstellungen";
    } else if ( page == 6 ) {
        title_name = "Vacayournal | Deine Daten Einstellungen";
    } else if ( page == 7 ) {
        title_name = "Vacayournal | News-Feed Einstellungen";
    }

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.document.title = title_name;
            container.innerHTML = this.response;
        }

    };

    xmlhttp.open("GET", "/dashboard/settings/settings_callback.php?cPage=" + page, true);
    xmlhttp.send();
}

var action_settings_wrapper;
var saved_elem;

function CallbackEdit ( identifier, index ) {
    if ( action_settings_wrapper != null ) {
        CancelEdit();
    }
    action_settings_wrapper = document.getElementById(identifier + "_wrapper");
    saved_elem = document.getElementById(identifier);

    var add = document.createElement('div');
    add.setAttribute('id', 'action_active_edit');
    add.setAttribute('class', 's_active_edit')
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            add.innerHTML = this.response;
            saved_elem.parentNode.removeChild(saved_elem);
            action_settings_wrapper.appendChild(add);
        }
    };

    xmlhttp.open("GET", "/dashboard/settings/edit_callback.php?cIndex=" + index, true);
    xmlhttp.send();
}

function CancelEdit() {
    action_settings_wrapper.removeChild(document.getElementById("action_active_edit"));
    action_settings_wrapper.appendChild(saved_elem);
    action_settings_wrapper = null;
    saved_elem = null;
}

function SaveSettings( form, event, index ) {
    event.preventDefault();

    var xmlhttp = new XMLHttpRequest();
    var formData = new FormData(form);
    formData.append('cIndex', index);

    for (var pair of formData.entries()) {
        console.log(pair[0]+ ', ' + pair[1]);
    }

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            action_settings_wrapper = null;
            saved_elem = null;
            if ( index <= 5 ) { CallbackSettings('1'); }
            if ( index >= 20 && index <= 21 ) { CallbackSettings('2'); }
        }
    };

    xmlhttp.open("POST", "/dashboard/settings/settings_save_callback.php", true);
    xmlhttp.send(formData);

}

function CheckUrlName() {
    var name = document.getElementById('action_url_name').value;
    var container = document.getElementById('action_answer_wrapper');
    var button = document.getElementById('action_url_name_submit');
    var xmlhttp = new XMLHttpRequest();


    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if ( this.responseText !== "0" ) {
                container.style.color = "green";
                button.disabled = false;
                container.innerHTML = "Verfügbar";

            } else {
                container.style.color = "red";
                button.disabled = true;
                container.innerHTML = "Nicht Verfügbar";
            }
            this.response;
        }
    };

    xmlhttp.open("POST", "/dashboard/settings/check_url_callback.php?cUrlName=" + name, true);
    xmlhttp.send();

}

function CheckEmail() {
    var email = document.getElementById('action_email').value;
    var container = document.getElementById('action_answer_wrapper');
    var button = document.getElementById('action_url_name_submit');
    var xmlhttp = new XMLHttpRequest();


    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if ( this.responseText !== "0" ) {
                container.style.color = "green";
                button.disabled = false;
                container.innerHTML = "Verfügbar";

            } else {
                container.style.color = "red";
                button.disabled = true;
                container.innerHTML = "Nicht Verfügbar";
            }
            this.response;
        }
    };

    xmlhttp.open("POST", "/dashboard/settings/check_email_callback.php?cEmail=" + email, true);
    xmlhttp.send();
}

function CheckMobile() {
    var mobile = document.getElementById('action_mobile').value;
    var container = document.getElementById('action_answer_wrapper');
    var button = document.getElementById('action_url_name_submit');
    var xmlhttp = new XMLHttpRequest();


    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if ( this.responseText !== "0" ) {
                container.style.color = "green";
                button.disabled = false;
                container.innerHTML = "Verfügbar";

            } else {
                container.style.color = "red";
                button.disabled = true;
                container.innerHTML = "Nicht Verfügbar";
            }
            this.response;
        }
    };

    xmlhttp.open("POST", "/dashboard/settings/check_mobile_callback.php?cMobile=" + mobile, true);
    xmlhttp.send();
}



function SaveCity( city, lat, long ) {
    var map_container = document.getElementById("action_city_preview");
    var container = document.getElementById("action_location_preview");
    var latitude = document.createElement("input");
    var longitude = document.createElement("input");
    latitude.setAttribute("name", "new_latitude");
    latitude.setAttribute("value", lat);
    latitude.setAttribute("tyoe", "hidden");
    longitude.setAttribute("name", "new_longitude");
    longitude.setAttribute("value", long);
    longitude.setAttribute("tyoe", "hidden");
    container.appendChild(latitude);
    container.appendChild(longitude);


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
                dragPan: !window.isMobileOrTabvar()
            });

            var marker = new tt.Marker()
                .setLngLat([long, lat])
                .addTo(map);
        }

    };

    xmlhttp.open("GET", "/compvare/city_information_callback.php?cCity=" + city, true);
    xmlhttp.send();
}

function SetRequired() {
    var verification = document.getElementById("new_verification");
    var target = "";

    if ( document.getElementById("new_email") ) {  target = document.getElementById("new_email") }
    if ( document.getElementById("new_phone") ) {  target = document.getElementById("new_phone") }

    if ( target !== "" ) {

        if ( verification.checked === true ) {
            target.required = true;
        } else {
            target.required = false;
        }

    }
}

function TickTypesOff() {
    var na = document.getElementById("typesnoanswer");
    var other = document.getElementsByClassName("action_types_toggle");

    if ( na.checked === true ) {

        for( var i = 0; i < other.length; i++ ) {
            other.item(i).checked = false;
        }

    }
}

function TickTypesOn() {
    var na = document.getElementById("typesnoanswer");
    na.checked = false;
}

function CheckCookies() {
    var element = document.getElementById("action_cookie_header");

    if(typeof(element) != 'undefined' && element != null){
        document.getElementById('action_classic_header').style.top = "80px";
        document.getElementById('action_index_container').style.top = "180px";

    }
}

function AcceptCookies() {
    //document.getElementById('action_classic_header').style.top = "0";
    document.getElementById('action_cookie_header').style.display = "none";
    document.getElementById('action_index_container').style.top = "90px";
    document.cookie = "cookies_agreement=true";
    alert("ok");


}