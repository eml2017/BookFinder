/*
    Final Project ~ CPSC 314-01 (Web Development)
	Elizabeth Larson
    Last Modified: 12/06/2020
    Sources:
        Dynamic variable names: https://www.geeksforgeeks.org/how-to-use-dynamic-variable-names-in-javascript/
        Using Modals (More Info Pop-Up): https://www.w3schools.com/howto/howto_css_modals.asp
        Keeping track of what book is being "removed": https://stackoverflow.com/questions/9789283/how-to-get-javascript-variable-value-in-php

    Logic for:
        - Displaying all books in the Reading List.
        - Displaying the "more info" modal on each book.
        - Allowing for removal from the Reading List.
*/

window.addEventListener("DOMContentLoaded", domLoaded);

function domLoaded() {
    /* ----------------- Book Information ----------------- */
    // Store the books from the database in the booksInfo array
    var readingListBooksInfo = [];
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
        readingListBooksInfo.push(newBook);
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
    
        if (readingListBooksInfo[i].isInReadingList == true) {
            var bookButtoni = document.createElement('button');
            bookButtoni.classList.add('book-button');
            var booki = document.createElement('div');

            var bookiCover = document.createElement('img');
            bookiCover.classList.add('book-cover');
            bookiCover.src = readingListBooksInfo[i].coverURL;
            booki.append(bookiCover);

            var bookiTitle = document.createElement('p');
            bookiTitle.classList.add('book-text');
            bookiTitle.innerText = readingListBooksInfo[i].title;
            booki.append(bookiTitle);

            var bookiAuthor = document.createElement('p');
            bookiAuthor.classList.add('book-subtext');
            bookiAuthor.innerText = readingListBooksInfo[i].author;
            book.append(bookiAuthor);

            var bookiTopic = document.createElement('p');
            bookiTopic.classList.add('book-subtext');
            bookiTopic.innerText = readingListBooksInfo[i].topic;
            booki.append(bookiTopic);

            var removeButtoni = document.createElement('button');
            removeButtoni.classList.add('remove-from-reading-list-button');
            removeButtoni.innerText = '-';
            booki.append(removeButtoni);

            bookButtoni.append(booki);
            books.append(bookButtoni);

            removeButtoni.addEventListener('click', function() {
                var id = readingListBooksInfo[i].id;
                window.location.href='reading-list.php?id=' + id;
            });

            bookButtoni.addEventListener('dblclick', function() {
                modal.style.display = 'block';
                modalTitle.innerText = readingListBooksInfo[i].title;
                modalAuthor.innerText = readingListBooksInfo[i].author;
                modalTopic.innerText = readingListBooksInfo[i].topic;
                modalSummary.innerText = readingListBooksInfo[i].summary;
                modalCover.src = readingListBooksInfo[i].coverURL;
            });
    */

    for(i = 0; i < readingListBooksInfo.length; i++) {
        if (readingListBooksInfo[i].isInReadingList == true) {
            // Add a new button and div for a new book
            eval("var bookButton" + i + " = document.createElement('button');");
            eval("bookButton" + i + ".classList.add('book-button');");
            eval("var book" + i + " = document.createElement('div');");

            // Add its cover
            eval("var book" + i + "Cover = document.createElement('img');");
            eval("book" + i + "Cover.classList.add('book-cover');");
            eval("book" + i + "Cover.src = readingListBooksInfo[" + i + "].coverURL;");
            eval("book" + i + ".append(book" + i + "Cover);");

            // Add its title
            eval("var book" + i + "Title = document.createElement('p');");
            eval("book" + i + "Title.classList.add('book-text');");
            eval("book" + i + "Title.innerText = readingListBooksInfo[" + i + "].title;");
            eval("book" + i + ".append(book" + i + "Title);");

            // Add its author
            eval("var book" + i + "Author = document.createElement('p');");
            eval("book" + i + "Author.classList.add('book-subtext');");
            eval("book" + i + "Author.innerText = readingListBooksInfo[" + i + "].author;");
            eval("book" + i + ".append(book" + i + "Author);");

            // Add its topic
            eval("var book" + i + "Topic = document.createElement('p');");
            eval("book" + i + "Topic.classList.add('book-subtext');");
            eval("book" + i + "Topic.innerText = readingListBooksInfo[" + i + "].topic;");
            eval("book" + i + ".append(book" + i + "Topic);");

            // Add a red - button if book is already on the Reading List
            eval("var removeButton" + i + " = document.createElement('button'); removeButton" + i + ".classList.add('remove-from-reading-list-button'); removeButton" + i + ".innerText = '-'; book" + i + ".append(removeButton" + i + ");");

            // Add the div to a button so it's clickable
            eval("bookButton" + i + ".append(book" + i + ");");
            eval("books.append(bookButton" + i + ");");

            // Red - button logic
            eval("removeButton" + i + ".addEventListener('click', function() { var id = readingListBooksInfo[" + i + "].id; window.location.href='reading-list.php?id=' + id; });");

            // Double clicking on a book opens up a window with more information
            eval("bookButton" + i + ".addEventListener('dblclick', function() { modal.style.display = 'block'; modalTitle.innerText = readingListBooksInfo[" + i + "].title; modalAuthor.innerText = readingListBooksInfo[" + i + "].author; modalTopic.innerText = readingListBooksInfo[" + i + "].topic; modalSummary.innerText = readingListBooksInfo[" + i + "].summary; modalCover.src = readingListBooksInfo[" + i + "].coverURL; });");
        }
    }
}