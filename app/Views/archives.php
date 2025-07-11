<!-- Banner -->
<section class="py-5 text-white text-center" style="background: linear-gradient(90deg, #004e92, #000428);">
  <div class="container">
    <h1 class="display-4 fw-bold">Archives</h1>
    <p class="lead">Discover IJACS Publications Organized by Year & Volume</p>
  </div>
</section>

<!-- Archives Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold display-6">Browse Yearly Issues</h2>
      <p class="text-muted mb-0">Use the smart search to find a specific volume or year.</p>
    </div>

    <!-- Search Bar -->
    <div class="mb-4 text-center">
      <input type="text" id="archiveSearch"
        class="form-control w-75 w-md-50 mx-auto rounded-3 border-primary shadow-sm py-2 px-3"
        placeholder="Search volume or year...">
    </div>

    <!-- Accordion -->
    <div class="accordion shadow rounded-4 border border-1 border-primary-subtle bg-white" id="archivesAccordion">
      <?php
      // Database connection
      $conn = new mysqli("localhost", "ijacs", "BGadiBS@157", "ijacs");
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Get years and volumes
      $sql = "SELECT DISTINCT year, volume FROM archives ORDER BY year DESC";
      $result = $conn->query($sql);
      $first = true;

      while ($row = $result->fetch_assoc()) {
        $year = $row['year'];
        $volume = $row['volume'];
        $collapse_id = 'collapse' . str_replace('-', '', $year);
        $heading_id = 'heading' . str_replace('-', '', $year);

        echo "<div class='accordion-item archive-item' data-year='$year' data-volume='Volume $volume'>";
        echo "<h2 class='accordion-header' id='$heading_id'>";
        echo "<button class='accordion-button bg-white fw-bold text-primary" . ($first ? "" : " collapsed") . "' type='button' data-bs-toggle='collapse' data-bs-target='#$collapse_id' aria-expanded='" . ($first ? "true" : "false") . "' aria-controls='$collapse_id'>";
        echo "<i class='bi bi-journal-bookmark me-2'></i> $year <span class='ms-auto badge bg-secondary'>Vol $volume</span>";
        echo "</button></h2>";

        echo "<div id='$collapse_id' class='accordion-collapse collapse" . ($first ? " show" : "") . "' aria-labelledby='$heading_id' data-bs-parent='#archivesAccordion'>";
        echo "<div class='accordion-body pt-4 pb-0'>";
        echo "<div class='row row-cols-2 row-cols-sm-3 row-cols-md-4 g-3'>";

        // Fetch issues for this year+volume
        $stmt = $conn->prepare("SELECT issue, file_path FROM archives WHERE year = ? AND volume = ? ORDER BY issue ASC");
        $stmt->bind_param("si", $year, $volume);
        $stmt->execute();
        $issueResult = $stmt->get_result();

        while ($issueRow = $issueResult->fetch_assoc()) {
          $issue = $issueRow['issue'];
          $file = $issueRow['file_path'];
          echo "<div class='col text-center'>";
          echo "<a href='" . htmlspecialchars($file) . "' target='_blank' class='btn btn-light border-primary border-2 w-100 py-2 fw-semibold rounded-3 shadow-sm text-primary small'>";
          echo "<i class='bi bi-book-half me-1'></i> Issue $issue";
          echo "</a></div>";
        }

        echo "</div></div></div></div>";
        $first = false;
      }

      $conn->close();
      ?>
    </div>
  </div>
</section>

<!-- JS: Smart Search -->
<script>
  document.getElementById('archiveSearch').addEventListener('input', function () {
    const filter = this.value.toLowerCase();
    document.querySelectorAll('.archive-item').forEach(item => {
      const year = item.getAttribute('data-year').toLowerCase();
      const volume = item.getAttribute('data-volume').toLowerCase();
      item.style.display = (year.includes(filter) || volume.includes(filter)) ? '' : 'none';
    });
  });
</script>