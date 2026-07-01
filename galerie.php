<?php
$page_title = "Galerie - Kfz-Meisterwerkstatt";
include('header.php');
?>

<div class="galerie-seite">
    <h1>Unsere Arbeiten & Projekte</h1>
    <p class="galerie-einleitung">Hier siehst du eine Auswahl unserer bisherigen Fahrzeugprojekte – von Inspektionen bis hin zu komplexen Reparaturen.</p>

    <!-- Platzhalter für zukünftige Bilder -->
    <div class="galerie-grid">
        <?php for ($i = 1; $i <= 6; $i++): ?>
        <div class="galerie-item">
            <div class="galerie-placeholder">
                <span>🖼️</span>
                <p>Projekt #<?= $i ?></p>
                <small>Hier später dein Bild</small>
            </div>
            <div class="galerie-info">
                <h3>Fahrzeugprojekt <?= $i ?></h3>
                <p>Kurze Beschreibung – z.B. "Komplettservice BMW 3er"</p>
            </div>
        </div>
        <?php endfor; ?>
    </div>

    <div class="galerie-hinweis">
        💡 <strong>Tipp:</strong> Ersetze die Platzhalter später durch echte Bilder – lege sie einfach in einen <code>/images/</code>-Ordner und passe das HTML an.
    </div>
</div>

<?php include('footer.php'); ?>
