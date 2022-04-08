<?php


function DisplayRegisterMail ($username, $email, $code, $user_id) {
$msg = "";


$msg = <<<EOF

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:v="urn:schemas-microsoft-com:vml">
<head>
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml><![endif]-->
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <meta content="width=device-width" name="viewport"/>
    <!--[if !mso]><!-->
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <!--<![endif]-->
    <title></title>
    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
    <!--<![endif]-->
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }

        table,
        td,
        tr {
            vertical-align: top;
            border-collapse: collapse;
        }

        * {
            line-height: inherit;
        }

        a[x-apple-data-detectors=true] {
            color: inherit !important;
            text-decoration: none !important;
        }
    </style>
    <style id="media-query" type="text/css">
        @media (max-width: 670px) {

            .block-grid,
            .col {
                min-width: 320px !important;
                max-width: 100% !important;
                display: block !important;
            }

            .block-grid {
                width: 100% !important;
            }

            .col {
                width: 100% !important;
            }

            .col > div {
                margin: 0 auto;
            }

            img.fullwidth,
            img.fullwidthOnMobile {
                max-width: 100% !important;
            }

            .no-stack .col {
                min-width: 0 !important;
                display: table-cell !important;
            }

            .no-stack.two-up .col {
                width: 50% !important;
            }

            .no-stack .col.num4 {
                width: 33% !important;
            }

            .no-stack .col.num8 {
                width: 66% !important;
            }

            .no-stack .col.num4 {
                width: 33% !important;
            }

            .no-stack .col.num3 {
                width: 25% !important;
            }

            .no-stack .col.num6 {
                width: 50% !important;
            }

            .no-stack .col.num9 {
                width: 75% !important;
            }

            .video-block {
                max-width: none !important;
            }

            .mobile_hide {
                min-height: 0px;
                max-height: 0px;
                max-width: 0px;
                display: none;
                overflow: hidden;
                font-size: 0px;
            }

            .desktop_hide {
                display: block !important;
                max-height: none !important;
            }
        }
    </style>
</head>
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #FFF; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; cursor: default;">
<!--[if IE]>
<div class="ie-browser"><![endif]-->
<table bgcolor="#FFF" cellpadding="0" cellspacing="0" class="nl-container" role="presentation"
       style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFF; width: 100%;"
       valign="top" width="100%">
    <tbody>
    <tr style="vertical-align: top;" valign="top">
        <td style="word-break: break-word; vertical-align: top;" valign="top">
            <!--[if (mso)|(IE)]>
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td align="center" style="background-color:#E9EBEE"><![endif]-->
            <div style="background-color:#FFF; box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                <div class="block-grid"
                     style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
                    <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                        <!--[if (mso)|(IE)]>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="background-color:#FFF;">
                            <tr>
                                <td align="center">
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:650px">
                                        <tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                        <!--[if (mso)|(IE)]>
                        <td align="center" width="650"
                            style="background-color:transparent;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;"
                            valign="top">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:15px;">
                        <![endif]-->
                        <div class="col num12"
                             style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 650px;">
                            <div style="width:100% !important;">
                                <!--[if (!mso)&(!IE)]><!-->
                                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;">
                                    <!--<![endif]-->
                                    <!--[if mso]>
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="padding-right: 10px; padding-left: 0px; padding-top: 5px; padding-bottom: 0px; font-family: Tahoma, Verdana, sans-serif">
                                    <![endif]-->
                                    <div style="color:#445352;font-family:'Roboto', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:5px;padding-right:10px;padding-bottom:0px;padding-left:0px;">
                                        <div style="line-height: 14px; font-family: 'Roboto', Tahoma, Verdana, Segoe, sans-serif; font-size: 12px; color: #445352;">
                                            <p style="line-height: 14px; font-size: 12px; text-align: center; margin: 0;">
                                                <a title="Startseite" style="border: none; cursor: pointer; text-decoration: none;" href="https://www.vacayournal.com"><strong><span
                                                        style="font-size: 30px; line-height: 36px; color: #B8000C;">Vacayournal</span></strong></a>
                                            </p>
                                        </div>
                                    </div>
                                    <!--[if mso]></td></tr></table><![endif]-->
                                    <!--[if (!mso)&(!IE)]><!-->
                                </div>
                                <!--<![endif]-->
                            </div>
                        </div>
                        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
            </div>
            <div style="background-color:transparent;">
                <div class="block-grid"
                     style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
                    <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                        <!--[if (mso)|(IE)]>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="background-color:transparent;">
                            <tr>
                                <td align="center">
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:650px">
                                        <tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                        <!--[if (mso)|(IE)]>
                        <td align="center" width="650"
                            style="background-color:transparent;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;"
                            valign="top">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;">
                        <![endif]-->
                        <div class="col num12"
                             style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 650px;">
                            <div style="width:100% !important;">
                                <!--[if (!mso)&(!IE)]><!-->
                                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                                    <!--<![endif]-->
                                    <!--[if mso]>
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif">
                                    <![endif]-->
                                    <div style="color:#555555;font-family:'Roboto', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                        <div style="font-family: 'Roboto', Tahoma, Verdana, Segoe, sans-serif; font-size: 12px; line-height: 14px; color: #555555;">
                                            <p style="font-size: 12px; line-height: 14px; margin: 0;"><br/></p>
                                        </div>
                                    </div>
                                    <!--[if mso]></td></tr></table><![endif]-->
                                    <!--[if (!mso)&(!IE)]><!-->
                                </div>
                                <!--<![endif]-->
                            </div>
                        </div>
                        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
            </div>

            <div style="background-color:transparent;">
                <div class="block-grid"
                     style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
                    <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                        <!--[if (mso)|(IE)]>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="background-color:transparent;">
                            <tr>
                                <td align="center">
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:650px">
                                        <tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                        <!--[if (mso)|(IE)]>
                        <td align="center" width="650"
                            style="background-color:transparent;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;"
                            valign="top">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:15px;">
                        <![endif]-->
                        <div class="col num12"
                             style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 650px;">
                            <div style="width:100% !important;">
                                <!--[if (!mso)&(!IE)]><!-->
                                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;">
                                    <!--<![endif]-->
                                    <!--[if mso]>
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif">
                                    <![endif]-->
                                    <div style="color:#445352;font-family:'Roboto', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                        <div style="line-height: 14px; font-family: 'Roboto', Tahoma, Verdana, Segoe, sans-serif; font-size: 12px; color: #445352;">
                                            <p style="line-height: 50px; text-align: center; font-size: 12px; margin: 0;">
                                                <span style="font-size: 42px;">Hallo ${username}</span></p>
                                        </div>
                                    </div>
                                    <!--[if mso]></td></tr></table><![endif]-->
                                    <!--[if (!mso)&(!IE)]><!-->
                                </div>
                                <!--<![endif]-->
                            </div>
                        </div>
                        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
            </div>
            <div style="background-color:transparent;">
                <div class="block-grid"
                     style="Margin: 0 auto; min-width: 320px; max-width: 100%; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
                    <div style="border-collapse: collapse; display: table; width: 100%;background-color:transparent;">
                        <!--[if (mso)|(IE)]>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="background-color:transparent;">
                            <tr>
                                <td align="center">
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:650px">
                                        <tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                        <!--[if (mso)|(IE)]>
                        <td align="center" width="650"
                            style="background-color:transparent;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;"
                            valign="top">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;">
                        <![endif]-->
                        <div class="col num12"
                             style="min-width: 320px; max-width: 100%; display: table-cell; vertical-align: top; width: 650px;">
                            <div style="width:100% !important;">
                                <!--[if (!mso)&(!IE)]><!-->
                                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                                    <!--<![endif]-->
                                    <div align="center" class="img-container center fullwidthOnMobile fixedwidth"
                                         style="padding-right: 0px;padding-left: 0px;">
                                        <!--[if mso]>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr style="line-height:0px">
                                                <td style="padding-right: 0px;padding-left: 0px;" align="center">
                                        <![endif]--><img align="center" alt="Image" border="0"
                                                         class="center fullwidthOnMobile fixedwidth"
                                                         src="https://www.vacayournal.com/bg-min.jpg"
                                                         style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24); border-radius: 4px; height: auto; width: 100%; max-width: 100%; display: block;"
                                                         title="Image" width="650"/>
                                        <!--[if mso]></td></tr></table><![endif]-->
                                    </div>
                                    <!--[if (!mso)&(!IE)]><!-->
                                </div>
                                <!--<![endif]-->
                            </div>
                        </div>
                        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
            </div>
            <div style="background-color:transparent;">
                <div class="block-grid"
                     style="margin: 20px auto 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
                    <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                        <!--[if (mso)|(IE)]>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="background-color:transparent;">
                            <tr>
                                <td align="center">
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:650px">
                                        <tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                        <!--[if (mso)|(IE)]>
                        <td align="center" width="650"
                            style="background-color:transparent;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;"
                            valign="top">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-right: 60px; padding-left: 60px; padding-top:5px; padding-bottom:5px;">
                        <![endif]-->
                        <div class="col num12"
                             style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 650px;">
                            <div style="width:100% !important;">
                                <!--[if (!mso)&(!IE)]><!-->
                                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 60px; padding-left: 60px;">
                                    <!--<![endif]-->
                                    <!--[if mso]>
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="padding-right: 60px; padding-left: 60px; padding-top: 0px; padding-bottom: 0px; font-family: Tahoma, Verdana, sans-serif">
                                    <![endif]-->
                                    <div style="color:#445352;font-family:'Roboto', Tahoma, Verdana, Segoe, sans-serif;line-height:150%;padding-top:0px;padding-right:60px;padding-bottom:0px;padding-left:60px;">
                                        <div style="line-height: 18px; font-size: 12px; font-family: 'Roboto', Tahoma, Verdana, Segoe, sans-serif; color: #445352;">
                                            <p style="line-height: 30px; font-size: 12px; text-align: left; margin: 0;">
                                                <span style="font-size: 20px;"><strong>Bestätige deine E-Mail-Adresse</strong></span>
                                            </p>
                                        </div>
                                    </div>
                                    <!--[if mso]></td></tr></table><![endif]-->
                                    <!--[if mso]>
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="padding-right: 60px; padding-left: 60px; padding-top: 10px; padding-bottom: 5px; font-family: Arial, sans-serif">
                                    <![endif]-->
                                    <div style="color:#555555;font-family:'Open Sans', Helvetica, Arial, sans-serif;line-height:150%;padding-top:10px;padding-right:60px;padding-bottom:5px;padding-left:60px;">
                                        <div style="font-size: 12px; line-height: 18px; font-family: 'Open Sans', Helvetica, Arial, sans-serif; color: #555555;">
                                            <p style="font-size: 14px; line-height: 21px; text-align: left; margin: 0;">
                                                Du hast dich vor Kurzem für Vacaytional registriert. Bestätige bitte
                                                dein Konto, um deine Registrierung abzuschließen.</p>
                                                
                                            <p style="font-size: 12px; line-height: 21px; text-align: left; margin: 0;">
                                                Dein Sicherheitscode ist: ${code} </p>
                                        </div>
                                    </div>
                                    <!--[if mso]></td></tr></table><![endif]-->
                                    <div align="right" class="button-container"
                                         style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                        <form action="https://www.vacayournal.com/mail_verify.php">
                                            <input type="hidden" name="code" value="${code}">
                                            <input type="hidden" name="user_id" value="${user_id}">
                                            <button type="submit" style="border: none; cursor: pointer; background-color: #414141; height: 50px; border-radius: 20px; color: white; font-size: 14px; box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24); padding: 5px 20px">E-Mail-Adresse bestätigen</button>
                                        </form>
                                    </div>
                                    <!--[if mso]>
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="padding-right: 15px; padding-left: 60px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif">
                                    <![endif]-->
                                    <div style="color:#555555;font-family:'Roboto', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:10px;padding-right:15px;padding-bottom:10px;padding-left:60px;">
                                        <div style="font-family: 'Roboto', Tahoma, Verdana, Segoe, sans-serif; font-size: 12px; line-height: 14px; color: #555555;">
                                            <p style="font-size: 12px; line-height: 14px; text-align: right; margin: 0;">
                                                Bitte beachte, dass dein Profil zu deiner eigenen Sicherheit erst
                                                freigeschalten wird wenn du deine E-Mail-Adresse bestätigst.</p>
                                        </div>
                                    </div>
                                    <!--[if mso]></td></tr></table><![endif]-->
                                    <!--[if (!mso)&(!IE)]><!-->
                                </div>
                                <!--<![endif]-->
                            </div>
                        </div>
                        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
            </div>
            <div style="background-color:transparent;">
                <div class="block-grid"
                     style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
                    <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                        <!--[if (mso)|(IE)]>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="background-color:transparent;">
                            <tr>
                                <td align="center">
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:650px">
                                        <tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                        <!--[if (mso)|(IE)]>
                        <td align="center" width="650"
                            style="background-color:transparent;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;"
                            valign="top">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-right: 60px; padding-left: 60px; padding-top:5px; padding-bottom:5px;">
                        <![endif]-->
                        <div class="col num12"
                             style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 650px;">
                            <div style="width:100% !important;">
                                <!--[if (!mso)&(!IE)]><!-->
                                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 60px; padding-left: 60px;">
                                    <!--<![endif]-->
                                    <!--[if mso]>
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="padding-right: 60px; padding-left: 60px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif">
                                    <![endif]-->
                                    <div style="color:#555555;font-family:'Open Sans', Helvetica, Arial, sans-serif;line-height:120%;padding-top:10px;padding-right:60px;padding-bottom:10px;padding-left:60px;">
                                        <div style="font-family: 'Open Sans', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 14px; color: #555555;">
                                            <p style="font-size: 14px; line-height: 14px; margin: 0;"><span
                                                    style="font-size: 12px;">Mit Vacayournal kannst du deine schönsten Erinnerungen mit Freunden teilen, im Zuge dessen kannst du Reisen anlegen, Bilder, Videos und Posts hochladen und vieles mehr.</span>
                                            </p>
                                        </div>
                                    </div>
                                    <!--[if mso]></td></tr></table><![endif]-->
                                    <!--[if (!mso)&(!IE)]><!-->
                                </div>
                                <!--<![endif]-->
                            </div>
                        </div>
                        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
            </div>
            <div style="background-color:transparent;">
                <div class="block-grid"
                     style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
                    <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                        <!--[if (mso)|(IE)]>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="background-color:transparent;">
                            <tr>
                                <td align="center">
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:650px">
                                        <tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                        <!--[if (mso)|(IE)]>
                        <td align="center" width="650"
                            style="background-color:transparent;width:650px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;"
                            valign="top">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;">
                        <![endif]-->
                        <div class="col num12"
                             style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 650px;">
                            <div style="width:100% !important;">
                                <!--[if (!mso)&(!IE)]><!-->
                                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                                    <!--<![endif]-->
                                    <table border="0" cellpadding="0" cellspacing="0" class="divider"
                                           role="presentation"
                                           style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                                           valign="top" width="100%">
                                        <tbody>
                                        <tr style="vertical-align: top;" valign="top">
                                            <td class="divider_inner"
                                                style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 15px; padding-right: 15px; padding-bottom: 15px; padding-left: 15px;"
                                                valign="top">
                                                <table align="center" border="0" cellpadding="0" cellspacing="0"
                                                       class="divider_content" height="0" role="presentation"
                                                       style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 1px solid #CCCCCC; height: 0px;"
                                                       valign="top" width="100%">
                                                    <tbody>
                                                    <tr style="vertical-align: top;" valign="top">
                                                        <td height="0"
                                                            style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                                                            valign="top"><span></span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if mso]>
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif">
                                    <![endif]-->
                                    <div style="color:#000000;font-family:'Roboto', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                        <div style="line-height: 14px; font-family: 'Roboto', Tahoma, Verdana, Segoe, sans-serif; font-size: 12px; color: #000000;">
                                            <p style="font-size: 14px; line-height: 16px; text-align: center; margin: 0;">
                                                <span style="font-size: 14px; color: #000000; line-height: 16px;">
                                                    Diese Nachricht wurde auf deine Anfrage hin an ${email} gesendet.<br/>
                                                    Bitte leite diese E-Mail zum Schutz deines Kontos nicht weiter. <br/><br/> 
                                                    Mehr zu unseren Datenschutzbestimmungen findest du 
                                                    <a style="border: none; cursor: pointer; text-decoration: none; color: #999; font-size: 14px;"  line-height: 16px; href="https://www.vacayournal.com/index.php">Hier</a> <br/> 
                                                    Mehr Über uns findest du 
                                                    <a style="border: none; cursor: pointer; text-decoration: none; color: #999; font-size: 14px;"  line-height: 16px;"  href="https://www.vacayournal.com/impressum.php">Hier</a> <br/><br/>
                                                </span>
                                                <span style="color: #B8000C; font-size: 14px; line-height: 16px;"><b>Vacayournal</b></span> <br/> 
                                                <span style="font-size: 14px; color: #000000;">
                                                Kennergasse 10, Stiege 7 Tür 11, <br/> 
                                                1100 Wien, <br/> 
                                                Österreich <br/> <br/> </span></span>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <!--[if mso]></td></tr></table><![endif]-->
                                    <!--[if (!mso)&(!IE)]><!-->
                                </div>
                                <!--<![endif]-->
                            </div>
                        </div>
                        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
            </div>
            <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        </td>
    </tr>
    </tbody>
</table>
<!--[if (IE)]></div><![endif]-->
</body>
</html>








EOF;

    return $msg;
}
?>