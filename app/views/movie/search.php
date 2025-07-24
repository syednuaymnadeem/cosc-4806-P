<!-- app/views/movie/search.php -->

<h1>Movie Search</h1>

<form method="GET" action="">
  <input type="hidden" name="action" value="details">
  <label>
      Movie Title:
      <input type="text" name="title" required>
  </label><br><br>
  <label>
      Year (optional):
      <input type="text" name="year">
  </label><br><br>
</form>
