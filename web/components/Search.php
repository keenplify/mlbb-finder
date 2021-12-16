<form method="GET" action="<?php echo getOrigin_URL()?>/web/search.php">
  <div class="d-flex mx-2">
    <input type="search" name="keyword" placeholder="Search Gamebuddies" class="form-control" value="<?php
      if (isset($_GET['keyword'])) echo $_GET['keyword']
    ?>">
    <button class="btn btn-primary">
      <span class="oi oi-magnifying-glass"></span>
    </button>
  </div>
</form>