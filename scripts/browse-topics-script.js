/*
    Final Project ~ CPSC 314-01 (Web Development)
	Elizabeth Larson
    Last Modified: 12/06/2020
    Sources:
        Dynamic variable names: https://www.geeksforgeeks.org/how-to-use-dynamic-variable-names-in-javascript/

	Logic for:
        - Displaying topics using clickable buttons.
*/

window.addEventListener("DOMContentLoaded", domLoaded);

function domLoaded() {
    /* ----------------- Topics Information ----------------- */
    // Store the books from the database in the booksInfo array
    var topicsInfo = [];
    for (var i = 0; i < topicsInfoPHP.length; i++) {
        topicsInfo.push(topicsInfoPHP[i]);
    }

    /* ----------------- Header Event Listener ----------------- */
    // Buttons
    const browseAllBooksButton = document.getElementById('browse-all-books-button');
    browseAllBooksButton.addEventListener('click', function() {
        location.href = "home-page.php"
    });
    const browseAllTopicsButton = document.getElementById('browse-all-topics-button');
    browseAllTopicsButton.addEventListener('click', function() {
        location.href = "browse-topics.php";
    });
    const readingListButton = document.getElementById('reading-list-button');
    readingListButton.addEventListener('click', function() {
        location.href = "reading-list.php";
    });
    const searchButton = document.getElementById('search-button');
    const searchBar = document.getElementById('header-search-bar');
    searchButton.addEventListener('click', function() {
        localStorage.setItem('searchCriteria', searchBar.value);
        location.href = "browse-books.php";
    });
 
    /* ----------------- Display Books ----------------- */
    /* Pretty print of for loop:

        var topicButtoni = document.createElement('button');
        topicButtoni.classList.add('topic-button');
        topicButtoni.innerText = topicsInfo[i];
        topics.append(topicButtoni);"

        topicButtoni.addEventListener('click', function() {
            searchCriteria.setItem('topic', topicButtoni.innerText);
            location.href = 'browse-books.html';
        });
    */
    for(i = 0; i < topicsInfo.length; i++) {
        // Add a new button for each topic
        eval("var topicButton" + i + " = document.createElement('button');");
        eval("topicButton" + i + ".classList.add('topic-button');");
        eval("topicButton" + i + ".innerText = topicsInfo[" + i + "];");
        eval("topics.append(topicButton" + i + ");");
        
        // Open the browse book page with the topic button's name attached at the end (for narrowing down search results)
        eval("topicButton" + i + ".addEventListener('click', function() { localStorage.setItem('searchCriteria', topicButton" + i + ".innerText); location.href = 'browse-books.php'; setSearchCriteria('topicButton" + i + ".innerText'); });");
    }
}