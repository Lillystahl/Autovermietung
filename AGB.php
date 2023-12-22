<?php
    require_once('db_connect.php');
    require_once('config_session.inc.php');
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentEase AGB</title>
    <link rel="icon" href="Images/ImageRE-small.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="infoStyle.css">
    <link rel="stylesheet" href="homeStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<header>
    <?php
    if(isset($_SESSION["user_id"])){
        echo '<div class="header">
                    <div class="header-left">
                        <a href="home.php" class="logo"><img src="Images/ImageRE.png" alt="Company Logo" /></a>
                        <h1><a href="Produktübersicht.php" id="header1">Unsere Fahrzeuge</a></h1>
                        <h1><a href="Top-deals.php" id="header2">Top-Deals</a></h1>
                        <h1><a href="Geschaeftskunden.php" id="header3">Geschäftskunden</a></h1>
                    </div>
                    <div class="header-right">
                        <div class="dropdown">
                            <span class="user-section">
                                Willkommen,&nbsp;<span class="user-name">' . $_SESSION["user_username"] . '</span>&nbsp;&nbsp;
                                <i class="fa-regular fa-user"></i>&nbsp;
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                            <ul class="dropdown-menu" id="dropdownMenu">
                                <li><a href="MyBookings.php">Meine Buchungen</a></li>
                                <li><a href="MyProfilePage.php">Mein Profil</a></li>
                                <li><a href="logout.inc.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>';
    }else{
        echo'<div class="header">
        <div class="header-left">
            <a href="home.php" class="logo"><img src="Images/ImageRE.png" alt="Company Logo" /></a>
            <h1>
                <a href="Produktübersicht.php" id="header1">Unsere Fahrzeuge</a>
            </h1>
            <h1><a href="Top-deals.php" id="header2">Top-Deals</a></h1>
            <h1>
                <a href="Geschaeftskunden.php" id="header3">Geschäftskunden</a>
            </h1>
        </div>
        <div class="header-right">
            <div class="search-container">
                <input type="text" placeholder="Search..." name="search" />
            </div>
            <div class="button-container">
            <a href="Registrierung.php" class="Login-button">LogIn / SignUp</a>
            </div>
        </div>
        </div>';
    }
    ?>
    </header>

    <div class="aTextContainer">
        <div class="TextContainer">
        <h1>Allgemeine Geschäftsbedingungen (AGB)</h1>

        <h2>1. Führungsberechtigung</h2>
        <p>Das Fahrzeug darf außer vom Mieter nur von den im Mietvertrag angegebenen Fahrern oder den beim Mieter angestellten Berufsfahrern in dessen Auftrag geführt werden. Dabei ist immer das jeweilige festgesetzte Mindestalter zu beachten, sowie eine Zusatzfahrergebühr je Fahrer zu entrichten. Voraussetzung ist immer der Besitz einer gültigen Fahrerlaubnis. Die Fahrer sind Erfüllungsgehilfen des Mieters. Der Mieter ist verantwortlich für die Überprüfung der für die Fahrzeugklasse benötigte Fahrerlaubnis, sowie über die Einhaltung der AGB durch die im Mietvertrag genannten Fahrer.</p>

        <h2>2. Nutzung und Nutzungsbeschränkungen</h2>
        <p>Dem Mieter ist untersagt, das Fahrzeug zu verwenden:</p>
        <ol>
            <li>zur Teilnahme an motor-sportlichen Veranstaltungen und Fahrzeugtests,</li>
            <li>zur Beförderung von leicht entzündlichen, giftigen oder sonst gefährlichen Stoffen,</li>
            <li>zur Begehung von Zoll- und sonstigen Straftaten,</li>
            <li>zur Weitervermietung,</li>
            <li>für sonstige Nutzungen, die über den vertraglichen Gebrauch hinausgehen.</li>
        </ol>
        <p>Bei der Benutzung des Fahrzeuges ist die Bedienungsanleitung für das Fahrzeug und etwaiges Zubehör zu beachten. Dazu gehört insbesondere die ständige Überprüfung des Motoröls, des Kühlwassers und des Reifendrucks. Fahrten außerhalb des Bundesgebietes Deutschland sind nur mit schriftlicher Genehmigung der Vermieterin zulässig. Solange das Fahrzeug nicht benutzt wird, sind das Lenkradschloss, das Schiebedach, die Türen und der Kofferraum verschlossen zu halten. Bei Cabriolets ist das Abstellen mit geöffnetem Verdeck nicht zulässig.</p>

        <h2>3. Versicherungsschutz</h2>
        <p>Das Fahrzeug ist entsprechend den jeweils geltenden allgemeinen Bedingungen der Kraftfahrtversicherung (AKB) bis 50 Millionen Euro Höhe für Drittschäden (Personenschäden bis 8 Millionen Euro) haftpflichtversichert.</p>
        <p>Weiter besteht eine Teilkaskoversicherung zur Abdeckung von Schäden an dem gemieteten Fahrzeug, die durch Diebstahl, Brand- oder Glasbruch entstehen, mit einer Selbstbeteiligung, die im Schadenfall vom Mieter zu tragen ist. Die Höhe der Selbstbeteiligung ist der gültigen Preisliste zu entnehmen. Reifenschäden, soweit kein Materialfehler vorliegt und / oder technische Defekte, die durch Unachtsamkeit des Mieters oder des Fahrers verursacht werden, sind durch keine Versicherung abgedeckt. Für diese Schäden haftet der Mieter.</p>

        <h2>4. Wartung und Reparatur</h2>
        <p>Bei längeren Mietzeiten hat der Mieter nach Rücksprache mit der Vermieterin fällige Wartungsarbeiten in einer Fachwerkstatt vornehmen zu lassen und die anfallenden Kosten vorzulegen. Reparaturen, die notwendig werden, um Betriebs- und Verkehrssicherheit des Fahrzeugs zu gewährleisten, dürfen vom Mieter bis zum Preis von 100,00 Euro ohne weiteres, größere Reparaturen nur mit schriftlicher Einwilligung der Vermieterin, in Auftrag gegeben werden. Die Reparaturkosten werden dem Mieter von der Vermieterin gegen Vorlage eines prüffähigen Originalbeleges erstattet, soweit der Mieter nicht für den Schaden haftet.</p>

        <h2>5. Mietzeit, Kündigung, Rückgabe des Fahrzeugs</h2>
        <p>Die Mietzeit beginnt mit dem Zeitpunkt der Anmietung, bei Anlieferung auf Verlangen des Mieters gilt der Zeitpunkt, zu dem das Fahrzeug die Vermietstation verlässt. Der Miettag dauert 24 Stunden, angebrochene Miettage gelten als ganze Miettage. Das Mietverhältnis endet zu dem im Mietvertrag vereinbarten Zeitpunkt. Eine frühere Rückgabe des Fahrzeuges entbindet den Mieter nicht von seiner Verpflichtung, den vereinbarten Mietzins zu zahlen.</p>
        <p>Das Recht des Mieters zur fristlosen Kündigung aus wichtigem Grund bleibt unberührt. Der Mieter ist verpflichtet, das Fahrzeug zum vereinbarten Zeitpunkt bei der Vermietstation, bei der er das Fahrzeug angemietet hat, innerhalb der Geschäftszeit zurückzugeben. Wird das Fahrzeug außerhalb der Geschäftszeiten zurückgebracht, gilt das Fahrzeug in dem Zustand und in dem Zeitpunkt als zurückgegeben, in dem es die Vermieterin während der Geschäftszeit vorfindet. Wird das Fahrzeug auf Verlangen des Mieters bei diesem abgeholt, gilt der Zeitpunkt, in dem das Fahrzeug die Vermietstation erreicht, als Zeitpunkt der Rückgabe.</p>

        <h2>6. Kraftstoff und Mautgebühren</h2>
        <p>Das Fahrzeug wird dem Mieter mit einem vollen Tank übergeben. Der Mieter ist verpflichtet, das Fahrzeug mit aufgefülltem Tank zurückzugeben. Der Mieter hat die Kosten für den verbrauchten Kraftstoff zu tragen. Verstößt der Mieter gegen diese Verpflichtung, ist die Vermieterin berechtigt, das Fahrzeug auf Kosten des Mieters vollzutanken und zusätzlich dafür eine Servicegebühr laut Aushang in den Geschäftsräumen zu verlangen. Ebenso trägt der Mieter alle anfallenden Straßenbenutzungsgebühren und sonstige Abgaben, die im Zusammenhang mit der Benutzung des Fahrzeuges durch den Mieter anfallen.</p>

        <h2>7. Verhalten bei Unfällen</h2>
        <p>Der Mieter hat nach einem Unfall, Brand, Diebstahl, Wild- oder sonstigen Schäden sofort die Polizei zu verständigen. Das gilt auch bei selbstverschuldeten Unfällen ohne Mitwirkung Dritter. Gegnerische Ansprüche dürfen nicht anerkannt werden. Der Mieter hat der Vermieterin selbst bei geringfügigen Schäden unverzüglich einen ausführlichen schriftlichen Bericht unter Vorlage einer Skizze zu erstatten. Der Unfallbericht muss insbesondere Namen und Anschrift der beteiligten Personen und etwaiger Zeugen sowie die amtlichen Kennzeichen der beteiligten Fahrzeuge enthalten.</p>

        <h2>8. Haftung der Vermieterin</h2>
        <p>Die Vermieterin und ihre Mitarbeiter haften nur für grobes Verschulden, also für Vorsatz und grobe Fahrlässigkeit. Eine Haftung für Folgeschäden, die durch den Ausfall eines Fahrzeuges entstehen, ist in jedem Fall ausgeschlossen. Der Haftungsausschluss gilt nicht für Schäden aus der Verletzung des Lebens, der Körpers oder der Gesundheit, in diesen Fällen haftet die Vermieterin auch für fahrlässige Pflichtverletzungen.</p>

        <h2>9. Haftung des Mieters</h2>
        <p>Der Mieter haftet für alle Schäden, die durch Verletzung von Vertragspflichten entstehen. Das gilt insbesondere für Schäden:</p>
        <ol>
            <li>die durch das Ladegut entstehen,</li>
            <li>die auf Beschädigung, Verunreinigung oder Zerstörung von Schäden durch die Ladung im Zusammenhang mit der Benutzung des Fahrzeugs entstehen,</li>
            <li>die an allen LKW- Auf- und Anbauten durch Nichtbeachtung der Durchfahrtshöhe oder des gemieteten LKWs entstehen,</li>
            <li>die durch grob fahrlässige oder vorsätzliche Vernachlässigung der Pflicht zum Schutz des Fahrzeuges gegen Diebstahl und unbefugte Ingebrauchnahme entstehen,</li>
            <li>die durch Nichtbeachtung des zulässigen Gesamtgewichts entstehen,</li>
            <li>die das Fahrzeug während der Mietzeit erleidet, insbesondere durch Unfall, äußere Einwirkungen sonstiger Art oder Einwirkung unbekannter Dritter, es sei denn, ein bekannter Dritter tritt in die Haftung verbindlich ein.</li>
        </ol>
        <p>Die Haftung des Mieters erstreckt sich auf den Fahrzeugschaden bis zur Höhe des Wiederbeschaffungswertes des Fahrzeuges vor Schadenseintritt, einer eventuellen Wertminderung, der Gutachterkosten, der Abschlepp- und Bergekosten, der Rückholkosten bis Vermietstation und den Mietausfall.</p>

        <h2>10. Haftungsreduzierung</h2>
        <p>Der Mieter kann für sich und seine Fahrer die Haftung nach den Grundsätzen einer Vollkaskoversicherung für Schäden durch äußere Einwirkungen durch Zahlung eines besonderen Entgeltes reduzieren. Die Haftungsreduzierung muss bereits bei Abschluss des Mietvertrages vereinbart sein und durch Unterschrift der Vermieterin bestätigt sein. Der Mieter und seine Fahrer verlieren ihre Rechte aus einer vereinbarten Haftungsreduzierung, wenn sie ihren Verpflichtungen nicht nachkommen, insbesondere wenn</p>
        <ol>
            <li>die Schadenverursachung vorsätzlich oder grob fahrlässig herbeigeführt wurde,</li>
            <li>Alkohol-, Drogen-, Medikamenten- oder sonstiger Weise bedingte Fahruntüchtigkeit vorlag,</li>
            <li>die Polizei nicht unverzüglich bei Schadenseintritt hinzugezogen wurde,</li>
            <li>ein Unfallschaden oder Diebstahlschaden verspätet gemeldet wurde,</li>
            <li>das Fahrzeug von anderen als in diesem Vertrag genannten Personen, insbesondere solchen ohne gültige Fahrererlaubnis, geführt wurde.</li>
        </ol>

        <h2>11. Langzeitmiete</h2>
        <p>Mietzahlungen für Langzeitmieten (30 Tage und länger) sind grundsätzlich im voraus zu bezahlen.</p>

        <h2>12. Datenschutzklausel</h2>
        <p>Mieter und Fahrer sind damit einverstanden, dass ihre persönlichen Daten von der Vermieterin gespeichert werden und aus zwingenden Gründen weitergegeben werden können.</p>

        <h2>13. Rechts- und Gerichtsstand und Erfüllungsortvereinbarung</h2>
        <p>Für diesen Vertrag gilt ausschließlich das Recht der Bundesrepublik Deutschland. Gerichtsstand und Erfüllungsort für Kaufleute im Sinne des Handelsrechtes ist Flensburg.</p>

        <h2>14. Bonitätsprüfungen</h2>
        <p>Unser Unternehmen prüft regelmäßig bei Vertragsabschlüssen und in bestimmten Fällen, in denen ein berechtigtes Interesse vorliegt, auch bei Bestandskunden, Ihre Bonität. Dazu arbeiten wir mit der Goodfellas GmbH, von der wir die dazu benötigten Daten erhalten. Zu diesem Zweck übermitteln wir Ihren Namen und Ihre Kontaktdaten an die Goodfellas GmbH. Die Informationen gem. Art. 14 der EU-Datenschutz-Grundverordnung zu der bei der Goodfellas GmbH stattfindenden Datenverarbeitung finden Sie hier: https://www.GoodfellasGmbh.de/eu-dsgvo/informationen-nach-eu-dsgvo-fuer-verbraucher/.</p>
        </div>
    </div>

    <div class="footer-container">
        <div class="footer">
        <div class="footer-heading footer-1">
            <h2>About Us</h2>
            <a href="#">Blog</a>
            <a href="#">Kunden</a>
            <a href="Datenschutz.php">Datenschutz</a>
            <a href="AGB.php">AGB</a>
            <a href="Impressum.php">Impressum</a>
        </div>

        <div class="footer-heading footer-2">
            <h2>Contact Us</h2>
            <a href="#">Jobs</a>
            <a href="#">Contact</a>
            <a href="#">Sponsorships</a>
            <a href="#">Support</a>
        </div>

        <div class="footer-heading footer-3">
            <h2>Social Media</h2>
            <div class="sm">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>

        <div class="footer-heading footer-4">
            <div class="footer-email-form">
            <h2>Join our Newsletter</h2>
            <form>
                <div class="input-container">
                <input
                    type="email"
                    placeholder="Enter your E-Mail address"
                    id="footer-email"
                />
                <input type="submit" value="Sign Up" id="footer-email-button" />
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="footer-small">
        <div class="sub-holder">
            <div class="sub-container">
                <div class="app-container">
                    <span>Get the App</span>
                        <div class="app-icons">
                            <i class="fa-brands fa-app-store-ios"></i>
                            <i class="fa-brands fa-google-play"></i>
                        </div>
                    </div>
                    <div class="Copyright-container">
                        <span>ReantEase 2023 All rights reserved</span>
                    </div>
                    <div class="Payment-container">
                        <span>Payment Options</span>
                        <div class="payment-icons">
                            <i class="fa-brands fa-google-pay"></i>
                            <i class="fa-brands fa-apple-pay"></i>
                            <i class="fa-brands fa-paypal"></i>
                            <i class="fa-brands fa-cc-mastercard"></i>
                            <i class="fa-brands fa-cc-amex"></i>
                            <i class="fa-brands fa-cc-visa"></i>
                        </div>
                    </div>
                </div>
            <script src="home.js"></script>
        </div>
    </div>
</body>
</html>