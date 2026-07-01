<?php
$page_title = "Kontakt - Kfz-Meisterwerkstatt";
include('header.php');

$nachricht_gesendet = false;
$fehler = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefon = trim($_POST['telefon'] ?? '');
    $betreff = trim($_POST['betreff'] ?? '');
    $nachricht = trim($_POST['nachricht'] ?? '');

    if (empty($name)) $fehler[] = 'Bitte geben Sie Ihren Namen ein.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $fehler[] = 'Bitte eine gültige E-Mail-Adresse angeben.';
    if (empty($nachricht)) $fehler[] = 'Bitte schreiben Sie uns Ihre Nachricht.';

    if (empty($fehler)) {
        $eintrag = "----------------------------------------\n";
        $eintrag .= "Datum: " . date('d.m.Y H:i') . "\n";
        $eintrag .= "Name: $name\n";
        $eintrag .= "E-Mail: $email\n";
        $eintrag .= "Telefon: $telefon\n";
        $eintrag .= "Betreff: $betreff\n";
        $eintrag .= "Nachricht:\n$nachricht\n";

        // Speichern in Textdatei (einfach, serverbasiert)
        file_put_contents('kontakt_nachricht.txt', $eintrag, FILE_APPEND | LOCK_EX);

        // Optional: E-Mail versenden (auskommentiert, da serverabhängig)
        /*
        mail('ihre@email.de', 'Kontaktanfrage von ' . $name, $eintrag, 'From: ' . $email);
        */
       mail('keilany@web.de', 'Kontaktanfrage von ' . $name, $eintrag, 'From: ' . $email);
        $nachricht_gesendet = true;
    }
}
?>

<div class="kontakt-formular">
    <h1>Kontaktieren Sie uns</h1>
    <p>Wir freuen uns auf Ihre Nachricht – wir melden uns schnellstmöglich zurück.</p>

    <?php if ($nachricht_gesendet): ?>
        <div class="erfolg">✅ Vielen Dank! Ihre Nachricht wurde gesendet.</div>
    <?php else: ?>
        <?php if (!empty($fehler)): ?>
            <div class="fehler">
                <?php foreach ($fehler as $f): ?>
                    <p>❌ <?= htmlspecialchars($f) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <label>Name *<br><input type="text" name="name" required value="<?= htmlspecialchars($name ?? '') ?>"></label><br>
            <label>E-Mail *<br><input type="email" name="email" required value="<?= htmlspecialchars($email ?? '') ?>"></label><br>
            <label>Telefon<br><input type="tel" name="telefon" value="<?= htmlspecialchars($telefon ?? '') ?>"></label><br>
            <label>Betreff<br><input type="text" name="betreff" value="<?= htmlspecialchars($betreff ?? '') ?>"></label><br>
            <label>Nachricht *<br><textarea name="nachricht" rows="5" required><?= htmlspecialchars($nachricht ?? '') ?></textarea></label><br>

       <!-- Terminwunsch -->
<label>Gewünschter Termin<br>
    <input type="date" name="termin_datum" min="<?= date('Y-m-d') ?>">
</label><br>

<label>Uhrzeit (circa)<br>
    <select name="termin_uhrzeit">
        <option value="">-- Bitte wählen --</option>
        <option value="08:00">08:00 Uhr</option>
        <option value="09:00">09:00 Uhr</option>
        <option value="10:00">10:00 Uhr</option>
        <option value="11:00">11:00 Uhr</option>
        <option value="12:00">12:00 Uhr</option>
        <option value="13:00">13:00 Uhr</option>
        <option value="14:00">14:00 Uhr</option>
        <option value="15:00">15:00 Uhr</option>
        <option value="16:00">16:00 Uhr</option>
        <option value="17:00">17:00 Uhr</option>
    </select>
</label><br>

<label>Fahrzeug (Marke/Modell)<br>
    <input type="text" name="fahrzeug" placeholder="z.B. VW Golf 7">
</label><br>

<!-- Terminwunsch -->
            <button type="submit" class="btn">Absenden</button>
        </form>
    <?php endif; ?>
<br>
<hr width=100% align=center>
<!-- Anfahrt / Google Maps -->
<div class="anfahrt-box">
    <h2>📍 So finden Sie uns</h2>
    <p><strong>Region:</strong> 31167 Hildesheim / Bockenem</p>
    <p>Wir sind in der Region Hildesheim für Sie da – kommen Sie gerne vorbei!</p>

    <!-- Google Maps Iframe (PLZ-Bereich) -->
    <div class="map-container">
        <iframe 
           
 src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d156401.3464971716!2d9.8764!3d52.1506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47ab4e6c8f4f4f4f%3A0x4f4f4f4f4f4f4f4f!2s31167%20Bockenem!5e0!3m2!1sde!2sde!4v1234567890"
            width="100%" 
            height="350" 
            style="border:0; border-radius:12px;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>
</div>
<!-- Anfahrt / Google Maps -->
</div>
<?php include('footer.php'); ?>
