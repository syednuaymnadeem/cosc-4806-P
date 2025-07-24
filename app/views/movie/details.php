<?php if (isset($movie['error'])): ?>
    <p style="color: red;"><strong>Error:</strong> <?= htmlspecialchars($movie['error']) ?></p>
<?php else: ?>

<?php endif; ?>
<h2><?= htmlspecialchars($movie['Title']) ?> (<?= htmlspecialchars($movie['Year']) ?>)</h2>

<?php if ($movie['Poster'] && $movie['Poster'] !== "N/A"): ?>
    <img src="<?= htmlspecialchars($movie['Poster']) ?>" alt="Poster" style="max-width:200px;">
<?php endif; ?>

<p><strong>Genre:</strong> <?= htmlspecialchars($movie['Genre']) ?></p>
<p><strong>Director:</strong> <?= htmlspecialchars($movie['Director']) ?></p>
<p><strong>Actors:</strong> <?= htmlspecialchars($movie['Actors']) ?></p>
<p><strong>Plot:</strong> <?= htmlspecialchars($movie['Plot']) ?></p>
<p><strong>IMDB Rating:</strong> <?= htmlspecialchars($movie['imdbRating']) ?></p>

<?php if ($avgRating): ?>
    <p><strong>Average User Rating:</strong> <?= $avgRating ?>/5</p>
<?php else: ?>
    <p><strong>Average User Rating:</strong> Not rated yet</p>
<?php endif; ?>

<?php if ($ratingSubmitted): ?>
    <p style="color: green;"><strong>Thank you for rating!</strong></p>
<?php endif; ?>

<h3>Rate this movie:</h3>
<form method="post">
    <select name="rating" required>
        <option value="">--Select Rating--</option>
        <option value="1">1 - Poor</option>
        <option value="2">2 - Fair</option>
        <option value="3">3 - Good</option>
        <option value="4">4 - Very Good</option>
        <option value="5">5 - Excellent</option>
    </select>
    <button type="submit">Submit Rating</button>
</form>