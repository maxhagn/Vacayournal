<?php
include("../resources/config/config.php");
include('../essentials/html_header.php');
include("../essentials/essentials.php");
include("../essentials/dashboard_header.php");
echo "<body>";

ShowHeader("index_large", $database);
?>


<main id="action_index_container" class="s_index_container s_dataprotection m_container_to_page_bottom" style="background-color: white; color: #1c1e21;">
    <div class="container">
        <div class="row center-xs">
            <div class="col-xs-2 start-xs">

                <div onclick="location.href='#saved_data'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Welche Daten speichern wir?
                    </div>
                </div>

                <div onclick="location.href='#cookies_heading'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Wie verwenden wir Cookies?
                    </div>
                </div>

                <div onclick="location.href='#personal_data'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Welche personenbezogenen Daten speichern wir?
                    </div>
                </div>

                <div onclick="location.href='#your_rights'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Welche Rechte hast du laut DSGVO?
                    </div>
                </div>

                <div onclick="location.href='#evaluate_user_data'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                       Wie werten wir die Daten aus?
                    </div>
                </div>

                <div onclick="location.href='#https'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Wie verschlüsseln wir unsere Daten?
                    </div>
                </div>

                <div onclick="location.href='#google_fonts'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Wie gebrauchen wir Google Fonts?
                    </div>
                </div>

                <div onclick="location.href='#google_maps'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Wie gebrauchen wir Google Maps?
                    </div>
                </div>

                <div onclick="location.href='#google_recaptcha'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Wie gebrauchen wir Google reCAPTCHA?
                    </div>
                </div>

                <div onclick="location.href='#google_analytics'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Wie gebrauchen wir Google Analytics?
                    </div>
                </div>

                <div onclick="location.href='#newsletter'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Wie reagiere ich auf Newsletter?
                    </div>
                </div>

                <div onclick="location.href='#imprint'" class="row s_dataprotection_button">
                    <div class="col-xs-12 start-xs">
                        Wie kontaktierst du Vacayournal bei Fragen?
                    </div>
                </div>

            </div>

            <span class="span_placeholder" id="dataprotection_heading"></span>

            <div class="col-xs-5 start-xs s_dataprotection_text">
                <h1>Datenschutzerklärung</h1>
                <h2>Datenschutz</h2>

                <p>Wir haben diese Datenschutzerklärung (Fassung 12.08.2019-211099727) verfasst, um Ihnen gemäß der
                    Vorgaben der Datenschutz-Grundverordnung (EU) 2016/679 und dem <a
                            href="https://www.ris.bka.gv.at/GeltendeFassung.wxe?Abfrage=Bundesnormen&amp;Gesetzesnummer=10001597&amp;tid=211099727"
                            target="_blank" rel="noopener nofollow">Datenschutzgesetz
                        (DSG)</a> zu erklären, welche Informationen wir sammeln, wie wir Daten verwenden und welche
                    Entscheidungsmöglichkeiten Sie als Besucher dieser Webseite haben.</p>
                <p>Leider liegt es in der Natur der Sache, dass diese Erklärungen sehr technisch klingen. Wir haben uns
                    bei
                    der
                    Erstellung jedoch bemüht die wichtigsten Dinge so einfach und klar wie möglich zu beschreiben.</p>
                <h2 id="saved_data">Automatische Datenspeicherung</h2>
                <p>Wenn Sie heutzutage Webseiten besuchen, werden
                    gewisse Informationen automatisch erstellt und gespeichert, so auch auf dieser Webseite.</p>
                <p>Wenn Sie unsere Webseite so wie jetzt gerade besuchen, speichert unser Webserver (Computer auf dem
                    diese
                    Webseite
                    gespeichert ist) automatisch Daten wie</p>
                <ul>
                    <li>die Adresse (URL) der aufgerufenen Webseite</li>
                    <li>Browser und Browserversion</li>
                    <li>das verwendete Betriebssystem</li>
                    <li>die Adresse (URL) der zuvor besuchten Seite (Referrer URL)</li>
                    <li>den Hostname und die IP-Adresse des Geräts von welchem aus zugegriffen wird</li>
                    <li>Datum und Uhrzeit</li>
                </ul>
                <p>in Dateien (Webserver-Logfiles).</p>
                <p>In der Regel werden Webserver-Logfiles zwei Wochen gespeichert und danach automatisch gelöscht. Wir
                    geben
                    diese Daten
                    nicht weiter, können jedoch nicht ausschließen, dass diese Daten beim Vorliegen von rechtswidrigem
                    Verhalten
                    eingesehen werden.</p>

                <span class="span_placeholder" id="cookies_heading"></span>

                <button  type="button" class="b_back_to_start" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

                <h2>Cookies</h2>
                <p>Unsere Website verwendet HTTP-Cookies um nutzerspezifische Daten zu
                    speichern.<br/>
                    Im Folgenden erklären wir, was Cookies sind und warum Sie genutzt werden, damit Sie die folgende
                    Datenschutzerklärung besser verstehen.</p>
                <h3>Was genau sind Cookies?</h3>
                <p>Immer wenn Sie durch das Internet surfen, verwenden Sie einen Browser. Bekannte Browser sind
                    beispielsweise
                    Chrome,
                    Safari, Firefox, Internet Explorer und Microsoft Edge. Die meisten Webseiten speichern kleine
                    Text-Dateien
                    in Ihrem
                    Browser. Diese Dateien nennt man Cookies.</p>
                <p>Eines ist nicht von der Hand zu weisen: Cookies sind echt nützliche Helferlein. Fast alle Webseiten
                    verwenden Cookies. Genauer gesprochen sind es HTTP-Cookies, da es auch noch anderer Cookies für
                    andere
                    Anwendungsbereiche gibt. HTTP-Cookies sind kleine Dateien, die von unserer Website auf Ihrem
                    Computer
                    gespeichert
                    werden. Diese Cookie-Dateien werden automatisch im Cookie-Ordner, quasi dem &#8222;Hirn&#8220; Ihres
                    Browsers,
                    untergebracht. Ein Cookie besteht aus einem Namen und einem Wert. Bei der Definition eines Cookies
                    müssen
                    zusätzlich
                    ein oder mehrere Attribute angegeben werden.</p>
                <p>Cookies speichern gewisse Nutzerdaten von Ihnen, wie beispielsweise Sprache oder persönliche
                    Seiteneinstellungen.
                    Wenn Sie unsere Seite wieder aufrufen, übermittelt Ihr Browser die „userbezogenen“ Informationen an
                    unsere
                    Seite
                    zurück. Dank der Cookies weiß unsere Website, wer Sie sind und bietet Ihnen Ihre gewohnte
                    Standardeinstellung. In
                    einigen Browsern hat jedes Cookie eine eigene Datei, in anderen wie beispielsweise Firefox sind
                    alle Cookies in
                    einer einzigen Datei gespeichert.</p>
                <p>Es gibt sowohl Erstanbieter Cookies als auch Drittanbieter-Cookies. Erstanbieter-Cookies werden
                    direkt
                    von
                    unserer
                    Seite erstellt, Drittanbieter-Cookies werden von Partner-Webseiten (z.B. Google Analytics)
                    erstellt. Jedes
                    Cookie
                    ist individuell zu bewerten, da jedes Cookie andere Daten speichert. Auch die Ablaufzeit eines
                    Cookies
                    variiert von
                    ein paar Minuten bis hin zu ein paar Jahren. Cookies sind keine Software-Programme und enthalten
                    keine
                    Viren,
                    Trojaner oder andere „Schädlinge“. Cookies können auch nicht auf Informationen Ihres PCs
                    zugreifen.</p>
                <p>So können zum Beispiel Cookie-Daten aussehen:</p>
                <ul>
                    <li>Name: _ga</li>
                    <li>Ablaufzeit: 2 Jahre</li>
                    <li>Verwendung: Unterscheidung der Webseitenbesucher</li>
                    <li>Beispielhafter Wert: GA1.2.1326744211.152211099727</li>
                </ul>
                <p>Ein Browser sollte folgende Mindestgrößen unterstützen:</p>
                <ul>
                    <li>Ein Cookie soll mindestens 4096 Bytes enthalten können</li>
                    <li>Pro Domain sollen mindestens 50 Cookies gespeichert werden können</li>
                    <li>Insgesamt sollen mindestens 3000 Cookies gespeichert werden können</li>
                </ul>
                <h3>Welche Arten von Cookies gibt es?</h3>
                <p>Die Frage welche Cookies wir im Speziellen verwenden, hängt von den verwendeten Diensten ab und wird
                    in
                    der
                    folgenden
                    Abschnitten der Datenschutzerklärung geklärt. An dieser Stelle möchten wir kurz auf die
                    verschiedenen
                    Arten
                    von
                    HTTP-Cookies eingehen.</p>
                <p>Man kann 4 Arten von Cookies unterscheiden:</p>
                <p><strong>Unbedingt notwendige Cookies<br/>
                    </strong>Diese Cookies sind nötig, um grundlegende Funktionen der Website sicherzustellen. Zum
                    Beispiel
                    braucht es
                    diese Cookies, wenn ein User ein Produkt in den Warenkorb legt, dann auf anderen Seiten weitersurft
                    und
                    später erst
                    zur Kasse geht. Durch diese Cookies wird der Warenkorb nicht gelöscht, selbst wenn der User sein
                    Browserfenster
                    schließt.</p>
                <p><strong>Funktionelle Cookies<br/>
                    </strong>Diese Cookies sammeln Infos über das Userverhalten und ob der User etwaige Fehlermeldungen
                    bekommt.
                    Zudem
                    werden mithilfe dieser Cookies auch die Ladezeit und das Verhalten der Website bei verschiedenen
                    Browsern
                    gemessen.
                </p>
                <p><strong>Zielorientierte Cookies<br/>
                    </strong>Diese Cookies sorgen für eine bessere Nutzerfreundlichkeit. Beispielsweise werden
                    eingegebene
                    Standorte,
                    Schriftgrößen oder Formulardaten gespeichert.</p>
                <p><strong>Werbe-Cookies<br/>
                    </strong>Diese Cookies werden auch Targeting-Cookies genannt. Sie dienen dazu dem User individuell
                    angepasste
                    Werbung zu liefern. Das kann sehr praktisch, aber auch sehr nervig sein.</p>
                <p>Üblicherweise werden Sie beim erstmaligen Besuch einer Webseite gefragt, welche dieser Cookiearten
                    Sie
                    zulassen
                    möchten. Und natürlich wird diese Entscheidung auch in einem Cookie gespeichert.</p>
                <h3>Wie kann ich Cookies löschen?</h3>
                <p>Wie und ob Sie Cookies verwenden wollen, entscheiden Sie selbst. Unabhängig von welchem Service oder
                    welcher
                    Website
                    die Cookies stammen, haben Sie immer die Möglichkeit Cookies zu löschen, nur teilweise zuzulassen
                    oder
                    zu
                    deaktivieren. Zum Beispiel können Sie Cookies von Drittanbietern blockieren, aber alle anderen
                    Cookies
                    zulassen.</p>
                <p>Wenn Sie feststellen möchten, welche Cookies in Ihrem Browser gespeichert wurden, wenn Sie
                    Cookie-Einstellungen
                    ändern oder löschen wollen, können Sie dies in Ihren Browser-Einstellungen finden:</p>
                <p><a href="https://support.google.com/chrome/answer/95647?tid=211099727"
                      rel="nofollow">Chrome: Cookies in Chrome löschen, aktivieren und verwalten</a></p>
                <p><a href="https://support.apple.com/de-at/guide/safari/sfri11471/mac?tid=211099727"
                      rel="nofollow">Safari: Verwalten von Cookies und Websitedaten mit Safari</a></p>
                <p><a
                            href="https://support.mozilla.org/de/kb/cookies-und-website-daten-in-firefox-loschen?tid=211099727"
                            rel="nofollow">Firefox: Cookies löschen, um Daten zu entfernen, die Websites auf Ihrem
                        Computer
                        abgelegt haben</a></p>
                <p><a
                            href="https://support.microsoft.com/de-at/help/17442/windows-internet-explorer-delete-manage-cookies?tid=211099727"
                            rel="nofollow">Internet Explorer: Löschen und Verwalten von Cookies</a></p>
                <p><a
                            href="https://support.microsoft.com/de-at/help/4027947/windows-delete-cookies?tid=211099727"
                            rel="nofollow">Microsoft Edge: Löschen und Verwalten von Cookies</a></p>
                <p>Falls Sie grundsätzlich keine Cookies haben wollen, können Sie Ihren Browser so einrichten, dass er
                    Sie
                    immer
                    informiert, wenn ein Cookie gesetzt werden soll. So können Sie bei jedem einzelnen Cookie
                    entscheiden,
                    ob
                    Sie das
                    Cookie erlauben oder nicht. Die Vorgangsweise ist je nach Browser verschieden. Am besten ist es Sie
                    suchen
                    die
                    Anleitung in Google mit dem Suchbegriff “Cookies löschen Chrome” oder &#8222;Cookies deaktivieren
                    Chrome&#8220;
                    im
                    Falle eines Chrome Browsers oder tauschen das Wort &#8222;Chrome&#8220; gegen den Namen Ihres
                    Browsers,
                    z.B.
                    Edge,
                    Firefox, Safari aus.</p>
                <h3>Wie sieht es mit meinem Datenschutz aus?</h3>
                <p>Seit 2009 gibt es die sogenannten „Cookie-Richtlinien“. Darin ist festgehalten, dass das Speichern
                    von
                    Cookies eine
                    Einwilligung des Website-Besuchers (also von Ihnen) verlangt. Innerhalb der EU-Länder gibt es
                    allerdings
                    noch sehr
                    unterschiedliche Reaktionen auf diese Richtlinien. In Österreich erfolgte aber die Umsetzung dieser
                    Richtlinie in §
                    96 Abs. 3 des Telekommunikationsgesetzes (TKG).</p>
                <p>Wenn Sie mehr über Cookies wissen möchten und vor technischen Dokumentationen nicht zurückscheuen,
                    empfehlen
                    wir <a
                            href="https://tools.ietf.org/html/rfc6265" target="_blank"
                            rel="nofollow noopener">https://tools.ietf.org/html/rfc6265</a>, dem Request for Comments
                    der Internet Engineering Task Force (IETF) namens &#8222;HTTP State Management Mechanism&#8220;.</p>

                <span class="span_placeholder" id="personal_data"></span>

                <button type="button" class="b_back_to_start" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

                <h2>Speicherung persönlicher Daten</h2>
                <p>Persönliche Daten, die Sie uns auf dieser Website
                    elektronisch übermitteln, wie zum Beispiel Name, E-Mail-Adresse, Adresse oder andere persönlichen
                    Angaben im
                    Rahmen
                    der Übermittlung eines Formulars oder Kommentaren im Blog, werden von uns gemeinsam mit dem
                    Zeitpunkt
                    und
                    der
                    IP-Adresse nur zum jeweils angegebenen Zweck verwendet, sicher verwahrt und nicht an Dritte
                    weitergegeben.</p>
                <p>Wir nutzen Ihre persönlichen Daten somit nur für die Kommunikation mit jenen Besuchern, die Kontakt
                    ausdrücklich
                    wünschen und für die Abwicklung der auf dieser Webseite angebotenen Dienstleistungen und Produkte.
                    Wir
                    geben
                    Ihre
                    persönlichen Daten ohne Zustimmung nicht weiter, können jedoch nicht ausschließen, dass diese Daten
                    beim
                    Vorliegen
                    von rechtswidrigem Verhalten eingesehen werden.</p>
                <p>Wenn Sie uns persönliche Daten per E-Mail schicken &#8211; somit abseits dieser Webseite &#8211;
                    können
                    wir
                    keine
                    sichere Übertragung und den Schutz Ihrer Daten garantieren. Wir empfehlen Ihnen, vertrauliche Daten
                    niemals
                    unverschlüsselt per E-Mail zu übermitteln.</p>

                <span class="span_placeholder" id="your_rights"></span>

                <button type="button" class="b_back_to_start" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

                <h2>Rechte laut Datenschutzgrundverordnung</h2>
                <p>Ihnen stehen laut den Bestimmungen der
                    DSGVO und des österreichischen <a
                            href="https://www.ris.bka.gv.at/GeltendeFassung.wxe?Abfrage=Bundesnormen&amp;Gesetzesnummer=10001597&amp;tid=211099727"
                            target="_blank" rel="noopener nofollow">Datenschutzgesetzes
                        (DSG)</a> grundsätzlich die folgende Rechte zu:</p>
                <ul>
                    <li>Recht auf Berichtigung (Artikel 16 DSGVO)</li>
                    <li>Recht auf Löschung („Recht auf Vergessenwerden“) (Artikel 17 DSGVO)</li>
                    <li>Recht auf Einschränkung der Verarbeitung (Artikel 18 DSGVO)</li>
                    <li>Recht auf Benachrichtigung &#8211; Mitteilungspflicht im Zusammenhang mit der
                        Berichtigung oder Löschung personenbezogener Daten oder der Einschränkung der Verarbeitung
                        (Artikel
                        19
                        DSGVO)
                    </li>
                    <li>Recht auf Datenübertragbarkeit (Artikel 20 DSGVO)</li>
                    <li>Widerspruchsrecht (Artikel 21 DSGVO)</li>
                    <li>Recht, nicht einer ausschließlich auf einer automatisierten Verarbeitung —
                        einschließlich Profiling — beruhenden Entscheidung unterworfen zu werden (Artikel 22 DSGVO)
                    </li>
                </ul>
                <p>Wenn Sie glauben, dass die Verarbeitung Ihrer Daten gegen das Datenschutzrecht verstößt oder Ihre
                    datenschutzrechtlichen Ansprüche sonst in einer Weise verletzt worden sind, können Sie sich bei der
                    Aufsichtsbehörde
                    beschweren, welche in Österreich die Datenschutzbehörde ist, deren Webseite Sie unter <a
                            href="https://www.dsb.gv.at/?tid=211099727"

                            rel="nofollow">https://www.dsb.gv.at/</a>
                    finden.</p>

                <span class="span_placeholder" id="evaluate_user_data"></span>

                <button type="button" class="b_back_to_start" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

                <h2>Auswertung des Besucherverhaltens</h2>
                <p>In der folgenden Datenschutzerklärung
                    informieren wir Sie darüber, ob und wie wir Daten Ihres Besuchs dieser Website auswerten. Die
                    Auswertung
                    der
                    gesammelten Daten erfolgt in der Regel anonym und wir können von Ihrem Verhalten auf dieser Website
                    nicht
                    auf Ihre
                    Person schließen.</p>
                <p>Mehr über Möglichkeiten dieser Auswertung der Besuchsdaten zu widersprechen erfahren Sie in der
                    folgenden
                    Datenschutzerklärung.</p>


                <span class="span_placeholder" id="https"></span>

                <button type="button" class="b_back_to_start" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

                <h2>TLS-Verschlüsselung mit https</h2>
                <p>Wir verwenden https um Daten abhörsicher im Internet
                    zu übertragen (Datenschutz durch Technikgestaltung <a
                            href="https://eur-lex.europa.eu/legal-content/DE/TXT/HTML/?uri=CELEX:32016R0679&amp;from=DE&#038;tid=211099727"
                            target="_blank" rel="noopener nofollow">Artikel
                        25 Absatz 1 DSGVO</a>). Durch den Einsatz von TLS (Transport Layer Security), einem
                    Verschlüsselungsprotokoll
                    zur sicheren Datenübertragung im Internet können wir den Schutz vertraulicher Daten sicherstellen.
                    Sie
                    erkennen die
                    Benutzung dieser Absicherung der Datenübertragung am kleinen Schlosssymbol links oben im Browser und
                    der
                    Verwendung
                    des Schemas https (anstatt http) als Teil unserer Internetadresse.</p>


                <span class="span_placeholder" id="google_fonts"></span>

                <button type="button" class="b_back_to_start" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

                <h2>Google Fonts Lokal Datenschutzerklärung</h2>
                <p>Wir verwenden Google Fonts der Firma
                    Google Inc. (1600 Amphitheatre Parkway Mountain View, CA 94043, USA) auf unserer Webseite. Wir haben
                    die
                    Google-Schriftarten lokal, d.h. auf unserem Webserver &#8211; nicht auf den Servern von Google
                    &#8211;
                    eingebunden.
                    Dadurch gibt es keine Verbindung zu Server von Google und somit auch keine Datenübertragung bzw.
                    Speicherung.</p>
                <h3>Was sind Google Fonts?</h3>
                <p>Google Fonts (früher Google Web Fonts) ist ein interaktives Verzeichnis mit mehr als
                    800 Schriftarten,
                    die
                    die <a
                            href="https://de.wikipedia.org/wiki/Google_LLC?tid=211099727"
                            rel="nofollow">Google LLC</a> zur freien Verwendung bereitstellt. Mit Google Fonts könnte
                    man
                    die
                    Schriften
                    nutzen, ohne sie auf den eigenen Server hochzuladen. Doch um diesbezüglich jede
                    Informationsübertragung
                    zum
                    Google-Server zu unterbinden, haben wir die Schriftarten auf unseren Server heruntergeladen. Auf
                    diese
                    Weise
                    handeln
                    wir datenschutzkonform und senden keine Daten an Google Fonts weiter.</p>
                <p>Anders als andere Web-Schriften erlaubt uns Google uneingeschränkten Zugriff auf alle Schriftarten.
                    Wir
                    können also
                    unlimitiert auf ein Meer an Schriftarten zugreifen und so das Optimum für unsere Webseite rausholen.
                    Mehr zu
                    Google
                    Fonts und weiteren Fragen finden Sie auf <a
                            href="https://developers.google.com/fonts/faq?tid=211099727"
                            rel="nofollow">https://developers.google.com/fonts/faq?tid=211099727</a>.
                </p>

                <span class="span_placeholder" id="google_maps"></span>

                <button type="button" class="b_back_to_start" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

                <h2>Google Maps Datenschutzerklärung</h2>
                <p>Wir verwenden Google Maps der Firma Google Inc.
                    (1600 Amphitheatre Parkway Mountain View, CA 94043, USA) auf unserer Webseite.</p>
                <p>Durch die Nutzung der Funktionen dieser Karte werden Daten an Google übertragen. Welche Daten von
                    Google
                    erfasst
                    werden und wofür diese Daten verwendet werden, können Sie auf <a
                            href="https://www.google.com/intl/de/policies/privacy/"
                            rel="nofollow">https://www.google.com/intl/de/policies/privacy/</a>
                    nachlesen.</p>

                <span class="span_placeholder" id="google_recaptcha"></span>

                <button type="button" class="b_back_to_start" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

                <h2>Google reCAPTCHA Datenschutzerklärung</h2>
                <p>Unser oberstes Ziel ist es, dass unsere
                    Webseite für Sie und für uns bestmöglich geschützt und sicher ist. Um das zu gewährleisten,
                    verwenden
                    wir
                    Google
                    reCAPTCHA der Firma Google Inc. (1600 Amphitheatre Parkway Mountain View, CA 94043, USA). Mit
                    reCAPTCHA
                    können wir
                    feststellen, ob Sie auch wirklich ein Mensch aus Fleisch und Blut sind und kein Roboter oder eine
                    andere
                    Spam-Software. Unter Spam verstehen wir jede, auf elektronischen Weg, unerwünschte Information, die
                    uns
                    ungefragter
                    Weise zukommt. Bei den klassischen CAPTCHAS mussten Sie zur Überprüfung meist Text- oder Bildrätsel
                    lösen.
                    Mit
                    reCAPTCHA von Google müssen wir Sie meist nicht mit solchen Rätseln belästigen. Hier reicht es in
                    den
                    meisten
                    Fällen, wenn Sie einfach ein Häkchen setzen und so bestätigen, dass Sie kein Bot sind. Mit der neuen
                    Invisible
                    reCAPTCHA Version müssen Sie nicht mal mehr ein Häkchen setzen. Wie das genau funktioniert und vor
                    allem
                    welche
                    Daten dafür verwendet werden, erfahren Sie im Verlauf dieser Datenschutzerklärung.</p>
                <h3>Was ist reCAPTCHA?</h3>
                <p>reCAPTCHA ist ein freier Captcha-Dienst von Google, der Webseiten vor Spam-Software und den
                    Missbrauch
                    durch
                    nicht-menschliche Besucher schützt. Am häufigsten wird dieser Dienst verwendet, wenn Sie Formulare
                    im
                    Internet
                    ausfüllen. Ein Captcha-Dienst ist ein automatischer Turing-Test, der sicherstellen soll, dass eine
                    Handlung
                    im
                    Internet von einem Menschen und nicht von einem Bot vorgenommen wird. Im klassischen Turing-Test
                    (benannt
                    nach dem
                    Informatiker Alan Turing) stellt ein Mensch die Unterscheidung zwischen Bot und Mensch fest. Bei
                    Captchas
                    übernimmt
                    das auch der Computer bzw. ein Softwareprogramm. Klassische Captchas arbeiten mit kleinen Aufgaben,
                    die
                    für
                    Menschen
                    leicht zu lösen sind, doch für Maschinen erhebliche Schwierigkeiten aufweisen. Bei reCAPTCHA müssen
                    Sie
                    aktiv keine
                    Rätsel mehr lösen. Das Tool verwendet moderne Risikotechniken, um Menschen von Bots zu
                    unterscheiden.
                    Hier
                    müssen
                    Sie nur noch das Textfeld „Ich bin kein Roboter“ ankreuzen bzw. bei Invisible reCAPTCHA ist selbst
                    das
                    nicht
                    mehr
                    nötig. Bei reCAPTCHA wird ein JavaScript-Element in den Quelltext eingebunden und dann läuft das
                    Tool im
                    Hintergrund
                    und analysiert Ihr Benutzerverhalten. Aus diesen Useraktionen berechnet die Software einen
                    sogenannten
                    Captcha-Score. Google berechnet mit diesem Score schon vor der Captcha-Eingabe wie hoch die
                    Wahrscheinlichkeit ist,
                    dass Sie ein Mensch sind. ReCAPTCHA bzw. Captchas im Allgemeinen kommen immer dann zum Einsatz, wenn
                    Bots
                    gewisse
                    Aktionen (wie z.B. Registrierungen, Umfragen usw.) manipulieren oder missbrauchen könnten.</p>
                <h3>Warum verwenden wir reCAPTCHA auf unserer Website?</h3>
                <p>Wir wollen nur Menschen aus Fleisch und Blut auf unserer Seite begrüßen. Bots oder Spam-Software
                    unterschiedlichster
                    Art dürfen getrost zuhause bleiben. Darum setzen wir alle Hebel in Bewegung, uns zu schützen und die
                    bestmögliche
                    Benutzerfreundlichkeit für Sie anzubieten. Aus diesem Grund verwenden wir Google reCAPTCHA der Firma
                    Google.
                    So
                    können wir uns ziemlich sicher sein, dass wir eine „botfreie“ Webseite bleiben. Durch die Verwendung
                    von
                    reCAPTCHA
                    werden Daten an Google übermittelt, die Google verwendet, um festzustellen, ob Sie auch wirklich ein
                    Mensch
                    sind.
                    reCAPTCHA dient also der Sicherheit unserer Webseite und in weiterer Folge damit auch Ihrer
                    Sicherheit.
                    Zum
                    Beispiel
                    könnte es ohne reCAPTCHA passieren, dass bei einer Registrierung ein Bot möglichst viele
                    E-Mail-Adressen
                    registriert, um im Anschluss Foren oder Blogs mit unerwünschten Werbeinhalten „zuzuspamen“. Mit
                    reCAPTCHA
                    können wir
                    solche Botangriffe vermeiden.</p>
                <h3>Welche Daten werden von reCAPTCHA gespeichert?</h3>
                <p>ReCAPTCHA sammelt personenbezogene Daten von Usern, um festzustellen, ob die Handlungen auf unserer
                    Webseite
                    auch
                    wirklich von Menschen stammen. Es kann also die IP-Adresse und andere Daten, die Google für den
                    reCAPTCHA-Dienst
                    benötigt, an Google versendet werden. IP-Adressen werden innerhalb der Mitgliedstaaten der EU oder
                    anderer
                    Vertragsstaaten des Abkommens über den Europäischen Wirtschaftsraum fast immer zuvor gekürzt, bevor
                    die
                    Daten auf
                    einem Server in den USA landen. Die IP-Adresse wird nicht mit anderen Daten von Google kombiniert,
                    sofern
                    Sie nicht
                    während der Verwendung von reCAPTCHA mit Ihrem Google-Konto angemeldet sind. Zuerst prüft der
                    reCAPTCHA-Algorithmus,
                    ob auf Ihrem Browser schon Google-Cookies von anderen Google-Diensten (YouTube. Gmail usw.)
                    platziert
                    sind.
                    Anschließend setzt reCAPTCHA ein zusätzliches Cookie in Ihrem Browser und erfasst einen
                    Schnappschuss
                    Ihres
                    Browserfensters.</p>
                <p>Die folgende Liste von gesammelten Browser- und Userdaten, hat nicht den Anspruch auf
                    Vollständigkeit.
                    Vielmehr sind
                    es Beispiele von Daten, die nach unserer Erkenntnis, von Google verarbeitet werden.</p>
                <ul>
                    <li>Referrer URL (die Adresse der Seite von der der Besucher kommt)</li>
                    <li>IP-Adresse (z.B. 256.123.123.1)</li>
                    <li>Infos über das Betriebssystem (die Software, die den Betrieb Ihres Computers
                        ermöglicht. Bekannte Betriebssysteme sind Windows, Mac OS X oder Linux)
                    </li>
                    <li>Cookies (kleine Textdateien, die Daten in Ihrem Browser speichern)</li>
                    <li>Maus- und Keyboardverhalten (jede Aktion, die Sie mit der Maus oder der Tastatur
                        ausführen wird gespeichert)
                    </li>
                    <li>Datum und Spracheinstellungen (welche Sprache bzw. welches Datum Sie auf Ihrem PC
                        voreingestellt haben wird gespeichert)
                    </li>
                    <li>Alle Javascript-Objekte (JavaScript ist eine Programmiersprache, die Webseiten
                        ermöglicht, sich an den User anzupassen. JavaScript-Objekte können alle möglichen Daten unter
                        einem
                        Namen
                        sammeln)
                    </li>
                    <li>Bildschirmauflösung (zeigt an aus wie vielen Pixeln die Bilddarstellung besteht)</li>
                </ul>
                <p>Unumstritten ist, dass Google diese Daten verwendet und analysiert noch bevor Sie auf das Häkchen
                    „Ich
                    bin
                    kein
                    Roboter“ klicken. Bei der Invisible reCAPTCHA-Version fällt sogar das Ankreuzen weg und der ganze
                    Erkennungsprozess
                    läuft im Hintergrund ab. Wie viel und welche Daten Google genau speichert, erfährt man von Google
                    nicht
                    im
                    Detail.</p>
                <p>Folgende Cookies werden von reCAPTCHA verwendet: Hierbei beziehen wir uns auf die reCAPTCHA
                    Demo-Version
                    von
                    Google
                    unter <a href="https://www.google.com/recaptcha/api2/demo" target="_blank"
                             rel="noopener nofollow">https://www.google.com/recaptcha/api2/demo</a>. All diese Cookies
                    benötigen zu Trackingzwecken eine eindeutige Kennung. Hier ist eine Liste an Cookies, die Google
                    reCAPTCHA
                    auf der
                    Demo-Version gesetzt hat:</p>
                <p><strong>Name:</strong> IDE<br/>
                    <strong>Ablaufzeit:</strong> nach einem Jahr<br/>
                    <strong>Verwendung:</strong> Dieses Cookie wird von der Firma DoubleClick (gehört auch
                    Google) gesetzt, um die Aktionen eines Users auf der Webseite im Umgang mit Werbeanzeigen zu
                    registrieren
                    und zu
                    melden. So kann die Werbewirksamkeit gemessen und entsprechende Optimierungsmaßnahmen getroffen
                    werden.
                    IDE
                    wird in
                    Browsern unter der Domain doubleclick.net gespeichert.<br/>
                    <strong>Beispielwert:</strong> WqTUmlnmv_qXyi_DGNPLESKnRNrpgXoy1K-pAZtAkMbHI-211099727
                <p><strong>Name:</strong> 1P_JAR<br/>
                    <strong>Ablaufzeit:</strong> nach einem Monat<br/>
                    <strong>Verwendung:</strong> Dieses Cookie sammelt Statistiken zur Website-Nutzung und
                    misst Conversions. Eine Conversion entsteht z.B., wenn ein User zu einem Käufer wird. Das Cookie
                    wird
                    auch
                    verwendet, um Usern relevante Werbeanzeigen einzublenden. Weiters kann man mit dem Cookie vermeiden,
                    dass
                    ein User
                    dieselbe Anzeige mehr als einmal zu Gesicht bekommt.<br/>
                    <strong>Beispielwert:</strong> 2019-5-14-12</p>
                <p><strong>Name:</strong> ANID<br/>
                    <strong>Ablaufzeit:</strong> nach 9 Monaten<br/>
                    <strong>Verwendung:</strong> Viele Infos konnten wir über dieses Cookie nicht in
                    Erfahrung bringen. In der Datenschutzerklärung von Google wird das Cookie im Zusammenhang mit
                    „Werbecookies“
                    wie z.
                    B. &#8222;DSID&#8220;, &#8222;FLC&#8220;, &#8222;AID&#8220;, &#8222;TAID&#8220; erwähnt. ANID wird
                    unter
                    Domain
                    google.com gespeichert.<br/>
                    <strong>Beispielwert:</strong> U7j1v3dZa2110997270xgZFmiqWppRWKOr</p>
                <p><strong>Name:</strong> CONSENT<br/>
                    <strong>Ablaufzeit:</strong> nach 19 Jahren<br/>
                    <strong>Verwendung:</strong> Das Cookie speichert den Status der Zustimmung eines Users
                    zur Nutzung unterschiedlicher Services von Google. CONSENT dient auch der Sicherheit, um User zu
                    überprüfen,
                    Betrügereien von Anmeldeinformationen zu verhindern und Userdaten vor unbefugten Angriffen zu
                    schützen.<br/>
                    <strong>Beispielwert: </strong>YES+AT.de+20150628-20-0</p>
                <p><strong>Name:</strong> NID<br/>
                    <strong>Ablaufzeit:</strong> nach 6 Monaten<br/>
                    <strong>Verwendung:</strong> NID wird von Google verwendet, um Werbeanzeigen an Ihre
                    Google-Suche anzupassen. Mit Hilfe des Cookies „erinnert“ sich Google an Ihre meist eingegebenen
                    Suchanfragen oder
                    Ihre frühere Interaktion mit Anzeigen. So bekommen Sie immer maßgeschneiderte Werbeanzeigen. Das
                    Cookie
                    enthält eine
                    einzigartige ID, die Google benutzt um persönliche Einstellungen des Users für Werbezwecke zu
                    sammeln.<br/>
                    <strong>Beispielwert:</strong> 0WmuWqy211099727zILzqV_nmt3sDXwPeM5Q</p>
                <p><strong>Name:</strong> DV<br/>
                    <strong>Ablaufzeit:</strong> nach 10 Minuten<br/>
                    <strong>Verwendung:</strong> Sobald Sie das „Ich bin kein Roboter“-Häkchen angekreuzt
                    haben, wird dieses Cookie gesetzt. Das Cookie wird von Google Analytics für personalisierte Werbung
                    verwendet. DV
                    sammelt Informationen in anonymisierter Form und wird weiters benutzt, um User-Unterscheidungen
                    treffen
                    zu
                    können.<br/>
                    <strong>Beispielwert:</strong> gEAABBCjJMXcI0dSAAAANbqc211099727
                <p>Anmerkung: Diese Aufzählung kann keinen Anspruch auf Vollständigkeit erheben, da Google
                    erfahrungsgemäß
                    die
                    Wahl
                    ihrer Cookies immer wieder auch verändert.</p>
                <h3>Wie lange und wo werden die Daten gespeichert?</h3>
                <p>Durch das Einfügen von reCAPTCHA werden Daten von Ihnen auf den Google-Server übertragen. Wo genau
                    diese
                    Daten
                    gespeichert werden, stellt Google, selbst nach wiederholtem Nachfragen, nicht klar dar. Ohne eine
                    Bestätigung von
                    Google erhalten zu haben, ist davon auszugehen, dass Daten wie Mausinteraktion, Verweildauer auf der
                    Webseite oder
                    Spracheinstellungen auf den europäischen oder amerikanischen Google-Servern gespeichert werden. Die
                    IP-Adresse, die
                    Ihr Browser an Google übermittelt, wird grundsätzlich nicht mit anderen Google-Daten aus weiteren
                    Google-Diensten
                    zusammengeführt. Wenn Sie allerdings während der Nutzung des reCAPTCHA-Plug-ins bei Ihrem
                    Google-Konto
                    angemeldet
                    sind, werden die Daten zusammengeführt.<strong> </strong>Dafür gelten die abweichenden
                    Datenschutzbestimmungen der Firma Google.</p>
                <h3>Wie kann ich meine Daten löschen bzw. die Datenspeicherung verhindern?</h3>
                <p>Wenn Sie wollen, dass über Sie und über Ihr Verhalten keine Daten an Google übermittelt werden,
                    müssen
                    Sie
                    sich,
                    bevor Sie unsere Webseite besuchen bzw. die reCAPTCHA-Software verwenden, bei Google vollkommen
                    ausloggen
                    und alle
                    Google-Cookies löschen. Grundsätzlich werden die Daten sobald Sie unsere Seite aufrufen automatisch
                    an
                    Google
                    übermittelt. Um diese Daten wieder zu löschen, müssen Sie den Google-Support auf  <a
                            href="https://support.google.com/?hl=de&amp;tid=211099727"

                            rel="nofollow">https://support.google.com/?hl=de&amp;tid=211099727</a>
                    kontaktieren.</p>
                <p>Wenn Sie also unsere Webseite verwenden, erklären Sie sich einverstanden, dass Google LLC und deren
                    Vertreter
                    automatisch Daten erheben, bearbeiten und nutzen.</p>
                <p>Etwas mehr über reCAPTCHA erfahren Sie auf der Webentwickler-Seite von Google auf <a
                            href="https://developers.google.com/recaptcha/"
                            target="_blank"
                            rel="noopener nofollow"
                    >https://developers.google.com/recaptcha/</a>.
                    Google geht hier zwar auf die technische Entwicklung der reCAPTCHA näher ein, doch genaue
                    Informationen
                    über
                    Datenspeicherung und datenschutzrelevanten Themen sucht man auch dort vergeblich. Eine gute
                    Übersicht
                    über
                    die
                    grundsätzliche Verwendung von Daten bei Google finden Sie in der hauseigenen Datenschutzerklärung
                    auf <a
                            href="https://policies.google.com/privacy?hl=de&amp;tid=211099727"
                            target="_blank" rel="noopener nofollow"
                    >https://www.google.com/intl/de/policies/privacy/</a>.</p>

                <span class="span_placeholder" id="google_analytics"></span>

                <button type="button" class="b_back_to_start" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

                <h2>Google Analytics Datenschutzerklärung</h2>
                <p>Wir verwenden auf dieser Website Google
                    Analytics der Firma Google LLC (1600 Amphitheatre Parkway Mountain View, CA 94043, USA) um
                    Besucherdaten
                    statistisch
                    auszuwerten. Dabei verwendet Google Analytics zielorientierte Cookies.</p>
                <h3>Cookies von Google Analytics</h3>
                <ul>
                    <li>_ga
                        <ul>
                            <li>Ablaufzeit: 2 Jahre</li>
                            <li>Verwendung: Unterscheidung der Webseitenbesucher</li>
                            <li>Beispielhafter Wert: GA1.2.1326744211.152211099727</li>
                        </ul>
                    </li>
                    <li>_gid
                        <ul>
                            <li>Ablaufzeit: 24 Stunden</li>
                            <li>Verwendung: Unterscheidung der Webseitenbesucher</li>
                            <li>Beispielhafter Wert: GA1.2.1687193234.152211099727</li>
                        </ul>
                    </li>
                    <li>_gat_gtag_UA_&lt;property-id&gt;
                        <ul>
                            <li>Ablaufzeit: 1 Minute</li>
                            <li>Verwendung: Wird zum Drosseln der Anforderungsrate verwendet. Wenn Google
                                Analytics über den Google Tag Manager bereitgestellt wird, erhält dieser Cookie den
                                Namen
                                _dc_gtm_ &lt;property-id&gt;.
                            </li>
                            <li>Beispielhafter Wert: 1</li>
                        </ul>
                    </li>
                </ul>
                <p>Nähere Informationen zu Nutzungsbedingungen und Datenschutz finden Sie unter <a
                            href="http://www.google.com/analytics/terms/de.html"
                            rel="nofollow">http://www.google.com/analytics/terms/de.html</a>
                    bzw. unter <a href="https://support.google.com/analytics/answer/6004245?hl=de"
                                  rel="nofollow">https://support.google.com/analytics/answer/6004245?hl=de</a>.</p>
                <h3>Pseudonymisierung</h3>
                <p>Unser Anliegen im Sinne der DSGVO ist die Verbesserung unseres Angebotes und unseres Webauftritts. Da
                    uns
                    die
                    Privatsphäre unserer Nutzer wichtig ist, werden die Nutzerdaten pseudonymisiert. Die
                    Datenverarbeitung
                    erfolgt auf
                    Basis der gesetzlichen Bestimmungen des § 96 Abs 3 TKG sowie des Art 6 EU-DSGVO Abs 1 lit a
                    (Einwilligung)
                    und/oder
                    f (berechtigtes Interesse) der DSGVO.</p>
                <h3>Deaktivierung der Datenerfassung durch Google Analytics</h3>
                <p>Mithilfe des <strong>Browser-Add-ons zur Deaktivierung</strong> von Google
                    Analytics-JavaScript (ga.js, analytics.js, dc.js) können Website-Besucher verhindern, dass Google
                    Analytics
                    ihre
                    Daten verwendet.</p>
                <p>Sie können die Erfassung der durch das Cookie erzeugten und auf Ihre Nutzung der Website bezogenen
                    Daten
                    an
                    Google
                    sowie die Verarbeitung dieser Daten durch Google verhindern, indem Sie das unter dem folgenden Link
                    verfügbare
                    Browser-Plugin herunterladen und installieren: <a
                            href="https://tools.google.com/dlpage/gaoptout?hl=de"
                            rel="nofollow">https://tools.google.com/dlpage/gaoptout?hl=de</a>
                </p>
                <p>&nbsp;</p>

                <span class="span_placeholder" id="google_analytics_extra"></span>

                <button type="button" class="b_back_to_start" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

                <h2>Google Analytics Zusatz zur Datenverarbeitung</h2>
                <p>Wir haben mit Google einen
                    Direktkundenvertrag zur Verwendung von Google Analytics abgeschlossen, indem wir den “Zusatz zur
                    Datenverarbeitung”
                    in Google Analytics akzeptiert haben.</p>
                <p>Mehr über den Zusatz zur Datenverarbeitung für Google Analytics finden Sie hier: <a
                            href="https://support.google.com/analytics/answer/3379636?hl=de&amp;utm_id=ad"
                            target="_blank"
                            rel="noopener nofollow"
                    >https://support.google.com/analytics/answer/3379636?hl=de&amp;utm_id=ad</a>
                </p>

                <span class="span_placeholder" id="google_analytics_anonym"></span>

                <button type="button" class="b_back_to_start" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

                <h2>Google Analytics IP-Anonymisierung</h2>
                <p>Wir haben auf dieser Webseite die
                    IP-Adressen-Anonymisierung von Google Analytics implementiert. Diese Funktion wurde von Google
                    entwickelt,
                    damit
                    diese Webseite die geltenden Datenschutzbestimmungen und Empfehlungen der lokalen
                    Datenschutzbehörden
                    einhalten
                    kann, wenn diese eine Speicherung der vollständigen IP-Adresse untersagen. Die Anonymisierung bzw.
                    Maskierung der IP
                    findet statt, sobald die IP-Adressen im Google Analytics-Datenerfassungsnetzwerk eintreffen und
                    bevor
                    eine
                    Speicherung oder Verarbeitung der Daten stattfindet.</p>
                <p>Mehr Informationen zur IP-Anonymisierung finden Sie auf <a
                            href="https://support.google.com/analytics/answer/2763052?hl=de"
                            target="_blank"
                            rel="noopener nofollow">https://support.google.com/analytics/answer/2763052?hl=de</a>.
                </p>
                <h2>Google Analytics Berichte zu demografischen Merkmalen und Interessen</h2>
                <p>Wir haben in
                    Google Analytics die Funktionen für Werbeberichte eingeschaltet. Die Berichte zu demografischen
                    Merkmalen
                    und
                    Interessen enthalten Angaben zu Alter, Geschlecht und Interessen. Damit können wir uns &#8211; ohne
                    diese
                    Daten
                    einzelnen Personen zuordnen zu können &#8211; ein besseres Bild von unseren Nutzern machen. Mehr
                    über
                    die
                    Werbefunktionen erfahren Sie <a
                            href="https://support.google.com/analytics/answer/3450482?hl=de_AT&amp;utm_id=ad"
                            target="_blank" rel="noopener nofollow">auf https://support.google.com/analytics/answer/3450482?hl=de_AT&amp;utm_id=ad</a>.
                </p>
                <p>Sie können die Nutzung der Aktivitäten und Informationen Ihres Google Kontos unter “Einstellungen für
                    Werbung” auf <a
                            href="https://adssettings.google.com/authenticated"
                            rel="nofollow">https://adssettings.google.com/authenticated</a> per Checkbox beenden.</p>
                <h2>Google Analytics Deaktivierungslink</h2>
                <p>Wenn Sie auf folgenden <strong
                    >Deaktivierungslink</strong> klicken, können Sie verhindern, dass Google weitere
                    Besuche auf dieser Webseite erfasst. Achtung: Das Löschen von Cookies, die Nutzung des
                    Inkognito/Privatmodus
                    ihres
                    Browsers, oder die Nutzung eines anderen Browsers führt dazu, dass wieder Daten erhoben werden.</p>
                <a href="javascript:gaoop_analytics_optout();">Google
                    Analytics deaktivieren</a> <br><br>

                <span id="newsletter" class="span_placeholder"></span>

                <button type="button" class="b_back_to_start" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

                <h2>Newsletter Datenschutzerklärung</h2>
                <p><span
                            style="font-weight: 400;">Wenn Sie sich für unseren Newsletter eintragen übermitteln Sie die oben genannten persönlichen Daten und geben uns das Recht Sie per E-Mail zu kontaktieren. Die im Rahmen der Anmeldung zum Newsletter gespeicherten Daten nutzen wir ausschließlich für unseren Newsletter und geben diese nicht weiter.</span>
                </p>
                <p><span style="font-weight: 400;">Sollten Sie sich vom Newsletter abmelden &#8211; Sie finden den Link dafür in jedem Newsletter ganz unten &#8211; dann löschen wir alle Daten die mit der Anmeldung zum Newsletter gespeichert wurden.</span>
                </p>

                <span class="span_placeholder" id="imprint"></span>

                <button type="button" class="b_back_to_start" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

                <h1>Impressum</h1>
                <div class="row">
                    <div class="col-xs-12 h_margin_vertical">
                        Informationspflicht laut §5 E-Commerce Gesetz, §14 Unternehmensgesetzbuch, §63 Gewerbeordnung und Offenlegungspflicht laut §25 Mediengesetz.
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 h_margin_bottom">
                        Maximilian Hagn
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        Kennergasse 10, Stiege 7 Tür 11,
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        1100 Wien,
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        Österreich
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 h_margin_top_large">
                        Tel.: <a href="tel:+43 676 9579022">+43 676 9579022</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        E-Mail:  <a href="mailto:office@vacayournal.com">office@vacayournal.com</a>
                    </div>
                </div>
                <h2>U-Streitschlichtung</h2>
                <p>Gemäß Verordnung über Online-Streitbeilegung in Verbraucherangelegenheiten (ODR-Verordnung) möchten wir Sie über die Online-Streitbeilegungsplattform (OS-Plattform) informieren.
                Verbraucher haben die Möglichkeit, Beschwerden an die Online Streitbeilegungsplattform der Europäischen Kommission unter http://ec.europa.eu/odr?tid=221099710 zu richten. Die dafür notwendigen Kontaktdaten finden Sie oberhalb in unserem Impressum.

                Wir möchten Sie jedoch darauf hinweisen, dass wir nicht bereit oder verpflichtet sind, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.</p>

                <h2>Haftung für Inhalte dieser Webseite</h2>
                <p>Wir entwickeln die Inhalte dieser Webseite ständig weiter und bemühen uns korrekte und aktuelle Informationen bereitzustellen. Leider können wir keine Haftung für die Korrektheit aller Inhalte auf dieser Webseite übernehmen, speziell für jene die seitens Dritter bereitgestellt wurden.

                    Sollten Ihnen problematische oder rechtswidrige Inhalte auffallen, bitten wir Sie uns umgehend zu kontaktieren, Sie finden die Kontaktdaten im Impressum.</p>

                <h2>Haftung für Links auf dieser Webseite</h2>
                <p>Unsere Webseite enthält Links zu anderen Webseiten für deren Inhalt wir nicht verantwortlich sind. Haftung für verlinkte Websites besteht laut § 17 ECG für uns nicht, da wir keine Kenntnis rechtswidriger Tätigkeiten hatten und haben, uns solche Rechtswidrigkeiten auch bisher nicht aufgefallen sind und wir Links sofort entfernen würden, wenn uns Rechtswidrigkeiten bekannt werden.

                Wenn Ihnen rechtswidrige Links auf unserer Website auffallen, bitten wir Sie uns zu kontaktieren, Sie finden die Kontaktdaten im Impressum.</p>

                <h2>Urheberrechtshinweis</h2>
                <p>Alle Inhalte dieser Webseite (Bilder, Fotos, Texte, Videos) unterliegen dem Urheberrecht. Falls notwendig, werden wir die unerlaubte Nutzung von Teilen der Inhalte unserer Seite rechtlich verfolgen.</p>

                <h2>Bildernachweis</h2>
                <p>Die Bilder, Fotos und Grafiken auf dieser Webseite sind urheberrechtlich geschützt.

                Die Bilderrechte liegen bei den folgenden Fotografen und Unternehmen:

                Fotograf Mustermann</p>

                <button type="button" class="b_back_to_start h_margin_bottom_large" onclick="location.href='#dataprotection_heading'">
                    <i class="fas fa-chevron-up fa_round_icon"></i>
                    Zurück zum Seitenanfang
                </button>

            </div>
        </div>
    </div>
</main>


<script>

    CheckCookies();

</script>

