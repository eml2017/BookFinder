/*
    Final Project ~ CPSC 314-01 (Web Development)
	Elizabeth Larson
    Last Modified: 12/06/2020
    Sources:
        Dynamic variable names: https://www.geeksforgeeks.org/how-to-use-dynamic-variable-names-in-javascript/
        Using Modals (More Info Pop-Up): https://www.w3schools.com/howto/howto_css_modals.asp
        Keeping track of what book is being "added": https://stackoverflow.com/questions/9789283/how-to-get-javascript-variable-value-in-php

	Logic for:
        - Displaying all books in the narrowed-down search.
        - Displaying the "more info" modal on each book.
        - Allowing for adding to the Reading List.
*/

window.addEventListener("DOMContentLoaded", domLoaded);

function domLoaded() {
    /* ----------------- Search Criteria ----------------- */
    // Represents topic for buttons/title or author for the search bar
    var searchCriteria = "";
    var searchCriteriaText = document.getElementById("title-text");
    if (localStorage.getItem("searchCriteria")) { // If there's a search term in local storage (clicked topic button or searched title/author)        
        searchCriteria = localStorage.getItem("searchCriteria");
        searchCriteriaText.innerText = "Showing: " + searchCriteria;
    }
    else { // Otherwise, let the user know there was an issue
        searchCriteriaText.innerText = "No results matching your search" + searchCriteria;
    }

    /* ----------------- Book Information ----------------- */
    // Store the books from the database in the booksInfo array
    var booksInfo = [];
    for (var i = 0; i < booksInfoPHP.length; i++) {
        var newBook = {
            id: booksInfoPHP[i][0],
            title: booksInfoPHP[i][1],
            author: booksInfoPHP[i][2],
            topic: booksInfoPHP[i][3],
            summary: booksInfoPHP[i][4],
            coverURL: booksInfoPHP[i][5],
            isInReadingList: booksInfoPHP[i][6]
        }
        booksInfo.push(newBook);
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

    /* ----------------- More Info Modal Event Listener/Functionality ----------------- */
    const modal = document.getElementById("more-info-modal");
    const modalTitle = document.getElementById("more-info-title");
    const modalAuthor = document.getElementById("more-info-author");
    const modalTopic = document.getElementById("more-info-topic");
    const modalSummary = document.getElementById("more-info-summary");
    const modalCover = document.getElementById("more-info-cover");

    // Close the more info model when the user clicks the x button
    const closeButton = document.getElementById('close-button');
    closeButton.addEventListener('click', function() {
        modal.style.display = "none";
    });

    // Clicking outside of the more info modal closes it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
 
    /* ----------------- Display Books ----------------- */
    /* Pretty print of for loop:
    
        if (booksInfo[i].topic == searchCriteria || booksInfo[i].title == searchCriteria || booksInfo[i].author == searchCriteria) {
            var bookButtoni = document.createElement('button');
            bookButtoni.classList.add('book-button');
            var booki = document.createElement('div');

            var bookiCover = document.createElement('img');
            bookiCover.classList.add('book-cover');
            bookiCover.src = booksInfo[i].coverURL;
            booki.append(bookiCover);

            var bookiTitle = document.createElement('p');
            bookiTitle.classList.add('book-text');
            bookiTitle.innerText = booksInfo[i].title;
            booki.append(bookiTitle);

            var bookiAuthor = document.createElement('p');
            bookiAuthor.classList.add('book-subtext');
            bookiAuthor.innerText = booksInfo[i].author;
            book.append(bookiAuthor);

            var bookiTopic = document.createElement('p');
            bookiTopic.classList.add('book-subtext');
            bookiTopic.innerText = booksInfo[i].topic;
            booki.append(bookiTopic);

            if (booksInfo[i].isInReadingList == false) {
                var addButtoni = document.createElement('button');
                addButtoni.classList.add('add-to-reading-list-button');
                addButtoni.innerText = '+';
                booki.append(addButtoni);
                addButtoni.addEventListener('click', function() {
                    var id = booksInfo[i].id;
                    window.location.href='browse-books.php?id=' + id;
                });
            };

            bookButtoni.append(booki);
            books.append(bookButtoni);

            bookButtoni.addEventListener('dblclick', function() {
                modal.style.display = 'block';
                modalTitle.innerText = booksInfo[i].title;
                modalAuthor.innerText = booksInfo[i].author;
                modalTopic.innerText = booksInfo[i].topic;
                modalSummary.innerText = booksInfo[i].summary;
                modalCover.src = booksInfo[i].coverURL;
            });
        }
    */
    for(i = 0; i < booksInfo.length; i++) {
        // Topic for topic buttons and title/author for search bar
        if (booksInfo[i].topic == searchCriteria || booksInfo[i].title == searchCriteria || booksInfo[i].author == searchCriteria) {
            // Add a new button and div for a new book
            eval("var bookButton" + i + " = document.createElement('button');");
            eval("bookButton" + i + ".classList.add('book-button');");
            eval("var book" + i + " = document.createElement('div');");

            // Add its cover
            eval("var book" + i + "Cover = document.createElement('img');");
            eval("book" + i + "Cover.classList.add('book-cover');");
            eval("book" + i + "Cover.src = booksInfo[" + i + "].coverURL;");
            eval("book" + i + ".append(book" + i + "Cover);");

            // Add its title
            eval("var book" + i + "Title = document.createElement('p');");
            eval("book" + i + "Title.classList.add('book-text');");
            eval("book" + i + "Title.innerText = booksInfo[" + i + "].title;");
            eval("book" + i + ".append(book" + i + "Title);");

            // Add its author
            eval("var book" + i + "Author = document.createElement('p');");
            eval("book" + i + "Author.classList.add('book-subtext');");
            eval("book" + i + "Author.innerText = booksInfo[" + i + "].author;");
            eval("book" + i + ".append(book" + i + "Author);");

            // Add its topic
            eval("var book" + i + "Topic = document.createElement('p');");
            eval("book" + i + "Topic.classList.add('book-subtext');");
            eval("book" + i + "Topic.innerText = booksInfo[" + i + "].topic;");
            eval("book" + i + ".append(book" + i + "Topic);");

            // Add a green + button if book isn't already in the Reading List
            eval("if (booksInfo[" + i + "].isInReadingList == false) { var addButton" + i + " = document.createElement('button'); addButton" + i + ".classList.add('add-to-reading-list-button'); addButton" + i + ".innerText = '+'; book" + i + ".append(addButton" + i + "); addButton" + i + ".addEventListener('click', function() { var id = booksInfo[" + i + "].id; window.location.href='browse-books.php?id=' + id; }); };");

            // Add the div to a button so it's clickable
            eval("bookButton" + i + ".append(book" + i + ");");
            eval("books.append(bookButton" + i + ");");

            // Double clicking on a book opens up a window with more information
            eval("bookButton" + i + ".addEventListener('dblclick', function() { modal.style.display = 'block'; modalTitle.innerText = booksInfo[" + i + "].title; modalAuthor.innerText = booksInfo[" + i + "].author; modalTopic.innerText = booksInfo[" + i + "].topic; modalSummary.innerText = booksInfo[" + i + "].summary; modalCover.src = booksInfo[" + i + "].coverURL; });");
        } // Otherwise, it doesn't fit the search criteria and shouldn't be displayed
    }
}