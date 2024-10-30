<?php
// Database credentials
$host = 'localhost';
$dbname = 'library';
$user = 'root';
$pass = 'password';

try {
    // Connect to the database using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!<br>";

    // Function to create a new book
    function createBook($pdo, $title, $author, $published_year, $genre) {
        $query = "INSERT INTO books (title, author, published_year, genre) VALUES (:title, :author, :published_year, :genre)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['title' => $title, 'author' => $author, 'published_year' => $published_year, 'genre' => $genre]);
        echo "New book added successfully!<br>";
    }

    // Function to read all books
    function readBooks($pdo) {
        $query = "SELECT * FROM books";
        $stmt = $pdo->query($query);
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "Books in the library:<br>";
        foreach ($books as $book) {
            echo "ID: {$book['id']}, Title: {$book['title']}, Author: {$book['author']}, Published Year: {$book['published_year']}, Genre: {$book['genre']}<br>";
        }
    }

    // Function to update a book's details
    function updateBook($pdo, $id, $title, $author, $published_year, $genre) {
        $query = "UPDATE books SET title = :title, author = :author, published_year = :published_year, genre = :genre WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['title' => $title, 'author' => $author, 'published_year' => $published_year, 'genre' => $genre, 'id' => $id]);
        echo "Book details updated successfully!<br>";
    }

    // Function to delete a book
    function deleteBook($pdo, $id) {
        $query = "DELETE FROM books WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        echo "Book deleted successfully!<br>";
    }

    // Example CRUD operations
    createBook($pdo, 'The Great Gatsby', 'F. Scott Fitzgerald', 1925, 'Fiction');
    readBooks($pdo);
    updateBook($pdo, 1, 'To Kill a Mockingbird', 'Harper Lee', 1960, 'Fiction');
    deleteBook($pdo, 2);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close the database connection
$pdo = null;
?>