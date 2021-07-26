<!--
    Final Project ~ CPSC 314-01 (Web Development)
	Elizabeth Larson
    Last Modified: 12/06/2020
    Sources:
        Using Modals (More Info Pop-Up): https://www.w3schools.com/howto/howto_css_modals.asp
        Passing array from PHP to Javascript file: https://stackoverflow.com/questions/27918653/pass-php-arrays-to-external-javascript-file
        Updating based on JavaScript book id: https://stackoverflow.com/questions/9789283/how-to-get-javascript-variable-value-in-php

	Logic for reading from and updating the database, as well as creating HTML elements to be used in other files.
-->

<!-- Reading -->
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

    // Make an array of the books in the table
    $sql = "SELECT * FROM Book";
    $result = $conn->query($sql);
    $arrayOfBooks = [];
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($arrayOfBooks, [$row["id"], $row["title"], $row["author"], $row["topic"], $row["summary"], $row["cover_url"], $row["is_in_reading_list"]]);
    }
    } else {
        echo "0 results";
    }

    // Close the connection
    $conn->close();
?>

<!-- Updating -->
<?php
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $id = $_GET["id"];

        // Database credentials
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "BookFinder";

        // Create connection
        $connUpdate = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sqlUpdate = "UPDATE Book SET is_in_reading_list=FALSE WHERE id=" . $id;

        if ($connUpdate->query($sqlUpdate) === TRUE) { // Record updated successfully
            echo "Reading List successfully updated! Click on the Reading Button button to refresh the page.";
        } else {
            echo "Error updating the Reading List.";
        }
            
        // Close the connection
        $connUpdate->close();
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Finder - Reading List</title>
        <link href="styles/reading-list-styles.css" rel="stylesheet">
        <script type="text/javascript">var booksInfoPHP =<?php echo json_encode($arrayOfBooks); ?>;</script>
        <script type="text/javascript" src="scripts/reading-list-script.js"></script>
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
                <div id="title-text">Reading List</div>
                <div id="title-subtext">Double click on a book to see its overview.</div>

                <!--Books (will be populated later)-->
                <div id="books"></div>
                <div id="more-info-modal">
                    <div id="mofe-info-modal-content">
                        <span id="close-button">&times;</span>
                        <img id="more-info-cover" class="book-cover">
                        <p id="more-info-title" class="more-info-text"></p>
                        <p id="more-info-author" class="more-info-text"></p>
                        <p id="more-info-topic" class="more-info-text"></p>
                        <p id="more-info-summary" class="more-info-text"></p>
                    </div>
                </div>
            </div>
        </body>
    </body>
</html>