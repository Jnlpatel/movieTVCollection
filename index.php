<?php
// Include database configuration
require_once 'config.php';

// SQL query to join the media and genres tables
$sql = "SELECT m.*, g.genre_name 
        FROM media m 
        JOIN genres g ON m.genre_id = g.genre_id 
        ORDER BY m.rating DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Media Collection</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>My Movie and TV Show Collection</h1>
        <p>A collection of my favorite movies and TV shows</p>
    </header>

    <main>
        <div class="filters">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="Movie">Movies</button>
            <button class="filter-btn" data-filter="TV Show">TV Shows</button>
        </div>

        <div class="media-container">
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    // Determine which CSS class to use based on media type
                    $mediaClass = strtolower(str_replace(' ', '-', $row["media_type"]));
                    
                    // Determine rating class for color coding
                    $ratingClass = "";
                    if ($row["rating"] >= 9) {
                        $ratingClass = "excellent";
                    } elseif ($row["rating"] >= 7.5) {
                        $ratingClass = "good";
                    } elseif ($row["rating"] >= 6) {
                        $ratingClass = "average";
                    } else {
                        $ratingClass = "poor";
                    }
                    
                    // Create card with proper classes
                    echo '<div class="media-card ' . $mediaClass . '">';
                    
                    // Add poster image if available
                    if (!empty($row["poster_url"])) {
                        echo '<div class="poster"><img src="' . htmlspecialchars($row["poster_url"]) . '" alt="' . htmlspecialchars($row["title"]) . ' poster"></div>';
                    } else {
                        echo '<div class="poster no-image"><span>No Image Available</span></div>';
                    }
                    
                    echo '<div class="details">';
                    echo '<h2>' . htmlspecialchars($row["title"]) . '</h2>';
                    echo '<p><strong>Director:</strong> ' . htmlspecialchars($row["director"]) . '</p>';
                    echo '<p><strong>Year:</strong> ' . htmlspecialchars($row["release_year"]) . '</p>';
                    echo '<p><strong>Genre:</strong> ' . htmlspecialchars($row["genre_name"]) . '</p>';
                    echo '<p><strong>Type:</strong> ' . htmlspecialchars($row["media_type"]) . '</p>';
                    echo '<p class="rating ' . $ratingClass . '"><strong>Rating:</strong> ' . htmlspecialchars($row["rating"]) . '/10</p>';
                    
                    // Add collapsible review section
                    echo '<div class="review-section">';
                    echo '<button class="review-toggle">Show Review</button>';
                    echo '<div class="review-content">';
                    echo '<p>' . htmlspecialchars($row["review"]) . '</p>';
                    echo '</div>'; // End review-content
                    echo '</div>'; // End review-section
                    
                    echo '</div>'; // End details
                    echo '</div>'; // End media-card
                }
            } else {
                echo "<p class='no-results'>No media found in your collection.</p>";
            }
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Media Collection. All rights reserved.</p>
    </footer>

    <!-- Include the JavaScript file -->
    <script src="scripts.js"></script>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>