<?php
// Database credentials
$host = 'localhost';
$dbname = 'library';
$user = 'root';
$pass = 'password';

try {
    // Connect to the database using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!<br>";

    // INSERT a new book
    $insertQuery = "INSERT INTO books (title, author, published_year, genre) VALUES ('The Great Gatsby', 'F. Scott Fitzgerald', 1925, 'Fiction')";
    $pdo->exec($insertQuery);
    echo "New book added successfully!<br>";

    // SELECT all books
    $selectQuery = "SELECT * FROM books";
    $stmt = $pdo->query($selectQuery);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Books in the library:<br>";
    foreach ($books as $book) {
        echo "ID: {$book['id']}, Title: {$book['title']}, Author: {$book['author']}, Published Year: {$book['published_year']}, Genre: {$book['genre']}<br>";
    }

    // UPDATE a book's details
    $updateQuery = "UPDATE books SET title = 'To Kill a Mockingbird', author = 'Harper Lee' WHERE id = 1";
    $pdo->exec($updateQuery);
    echo "Book details updated successfully!<br>";

    // DELETE a book
    $deleteQuery = "DELETE FROM books WHERE id = 2";
    $pdo->exec($deleteQuery);
    echo "Book deleted successfully!<br>";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close the database connection
$pdo = null;
?>