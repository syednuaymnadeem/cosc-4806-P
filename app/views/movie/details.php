<?php if (isset($movie['error'])): ?>
    <p style="color: red;"><strong>Error:</strong> <?= htmlspecialchars($movie['error']) ?></p>
<?php else: ?>

<?php endif; ?>
<h2><?= htmlspecialchars($movie['Title']) ?> (<?= htmlspecialchars($movie['Year']) ?>)</h2>

<?php if ($movie['Poster'] && $movie['Poster'] !== "N/A"): ?>
    <img src="<?= htmlspecialchars($movie['Poster']) ?>" alt="Poster" style="max-width:200px;">
<?php endif; ?>
