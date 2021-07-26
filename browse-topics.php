<!--
    Final Project ~ CPSC 314-01 (Web Development)
	Elizabeth Larson
    Last Modified: 12/06/2020
    Sources:
        Passing array from PHP to Javascript file: https://stackoverflow.com/questions/27918653/pass-php-arrays-to-external-javascript-file
 
	Logic for reading topics from the database, as well as creating HTML elements to be used in other files.
-->

<?php
    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "BookFinder";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if there are any books in the database already, and if not, tell the user
    $sql = "SELECT * FROM Book";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Don't add anything because the database is already populated
    } else { // Otherwise, the table has nothing in it
        echo "There are no books in the database. Go to the home-page.php to try again.";
    }

    // Make an array of the topics in the table
    $sql = "SELECT DISTINCT topic FROM Book";
    $result = $conn->query($sql);
    $arrayOfTopics = [];
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($arrayOfTopics, $row["topic"]);
    }
    } else {
        echo "0 results";
    }

    // Close the connection
    $conn->close();
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Finder - Browse Topics</title>
        <link href="styles/browse-topics-styles.css" rel="stylesheet">
        <script type="text/javascript">var topicsInfoPHP =<?php echo json_encode($arrayOfTopics); ?>;</script>
        <script type="text/javascript" src="scripts/browse-topics-script.js"></script>
    </head>

    <body>
        <body>
            <!-- Header -->
            <div id="header">
                <!--Navigation buttons on the left-->
                <div id="header-left">
                    <button id="browse-all-books-button" class="header-button">Browse All Books</button>
                    <button id="browse-all-topics-button" class="header-button">Browse All Topics</button>
                    <button id="reading-list-button" class="header-button">Reading List</button>
                </div>
                <!--Search functionality on the right-->
                <div id="header-right">
                    <span id="header-text">Search By Title or Author</span>
                    <input type="text" id="header-search-bar" placeholder="Search here...">
                    <button id="search-button" class="header-button">Search!</button>
                </div>
            </div>
    
            <!-- Main Page -->
            <div id="main">
                <!--Title text-->
                <div id="title-text">Topics</div>
                <div id="title-subtext">Click on a topic button below to browse books about it.</div>

                <!--Topics (will be populated later)-->
                <div id="topics"></div>
            </div>
        </body>
    </body>
</html>