<?php
error_log("Starting index.php");

// Include the database configuration
require_once 'db_config.php';
error_log("Database configuration included");

// Fetch data from the database
try {
    error_log("Attempting to fetch data from the database");
    $stmt = $conn->prepare("SELECT * FROM stdata");
    $stmt->execute();
    $students = $stmt->fetchAll();
    error_log("Data fetched successfully");
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CompLog - Student Data</title>
  <link rel="stylesheet" href="styles2.css">
</head>
<body>
  <header>
    <div class="top-row">
      <div class="logo">
        <img src="logo1.png" alt="Logo" style="border-radius: 10px;">
      </div>
      <div>
        <img class="dpu" src="dpu.png" alt="Logo" style="border-radius: 10px;">
      </div>
    </div>

    <div class="nav-bar">
      <nav>
        <a class="home" href="index.php">Home</a>
      </nav>
    </div>
  </header>

  <main class="mcont">
    <div class="filters">
      <h3>Filters</h3>
      <label for="filterCategory">Category</label>
      <select id="filterCategory">
        <option value="all">All Categories</option>
      </select>
      
      <label for="filterCollege">College</label>
      <select id="filterCollege">
        <option value="all">All Colleges</option>
      </select>
      
      <label for="filterYear">Year</label>
      <select id="filterYear">
        <option value="all">All Years</option>
      </select>
    </div>

    <div class="competition-dashboard">
      <h2>Competition Dashboard</h2>
      <div class="category-tiles" id="categoryTiles">
        <?php if (empty($students)): ?>
          <p>No students found.</p>
        <?php else: ?>
          <ul>
            <?php foreach ($students as $student): ?>
              <li>
                <?php echo htmlspecialchars($student['name']); ?> - 
                <?php echo htmlspecialchars($student['class']); ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
    </div>

    <div class="add-competition-container">
      <button type="button" class="add-category-btn">Add Competition</button>
    </div>
  </main>

  <div id="competitionModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Add Competition</h2>
      <input type="text" id="compName" placeholder="Competition Name">
      <input type="text" id="compCategory" placeholder="Competition Category">
      <input type="text" id="compCollege" placeholder="College Name">
      <input type="number" id="compYear" placeholder="Year" min="2000" max="2099">
      <button type="button" onclick="addCompetition()">Add Competition</button>
    </div>
  </div>

  <script src="script2.js" defer></script>
</body>
</html>