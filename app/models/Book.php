<?php
namespace App\Models;

use App\Core\Database;

class Book {
    protected $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Retrieve all books with optional limit and offset
    public function getAllBooks($limit = null, $offset = null) {
        return $this->getAll('books', $limit, $offset);
    }

    // Retrieve a book by its ID
    public function getBookById($id) {
        return $this->getById('books', $id);
    }

    // Create a new book record
    public function createBook($data) {
        return $this->insert('books', $data);
    }

    // Update an existing book record
    public function updateBook($data, $id) {
        return $this->update('books', $data, $id);
    }

    // Delete a book record
    public function deleteBook($id) {
        return $this->delete('books', $id);
    }

    // Search for books based on keyword
    public function searchBooks($keyword, $limit = null, $offset = null) {
        return $this->search('books', $keyword, $limit, $offset);
    }

    // Count total number of books
    public function getBooksCount() {
        return $this->getCount('books');
    }

    // Count total number of books matching search keyword
    public function getSearchBooksCount($keyword) {
        return $this->getSearchCount('books', $keyword);
    }

    // Filter books by category with optional limit and offset
    public function filterBooksByCategory($category, $limit = null, $offset = null) {
        return $this->filterByCategory('books', $category, $limit, $offset);
    }
        

    // Fetch all unique book categories
    public function fetchAllCategories() {
        return $this->getAllCategories('books');
    }

    // Fetch all unique book authors
    public function fetchAllAuthors() {
        return $this->getAllAuthors('books');
    }

    // Count total number of books in a specific category
    public function getCategoryBooksCount($category) {
        return $this->fetchCategoryBooksCount('books', $category);
    }

    // General method to retrieve all records from a table with optional limit and offset
    protected function getAll($table, $limit = null, $offset = null) {
        $sql = "SELECT * FROM $table";
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        } else {
            $stmt = $this->db->prepare($sql);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // General search method for records in a table based on a keyword
    protected function search($table, $keyword, $limit = null, $offset = null) {
        $sql = "SELECT * FROM $table WHERE book_title LIKE :keyword OR book_description LIKE :keyword OR book_author LIKE :keyword";
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        } else {
            $stmt = $this->db->prepare($sql);
        }
        $keyword = '%' . $keyword . '%';
        $stmt->bindParam(':keyword', $keyword, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // General method to count records in a table
    protected function getCount($table) {
        $stmt = $this->db->query("SELECT COUNT(*) as count FROM $table");
        return $stmt->fetch()['count'];
    }

    // Count records matching a search keyword
    protected function getSearchCount($table, $keyword) {
        $sql = "SELECT COUNT(*) as count FROM $table WHERE book_title LIKE :keyword OR book_description LIKE :keyword OR book_author LIKE :keyword";
        $stmt = $this->db->prepare($sql);
        $keyword = '%' . $keyword . '%';
        $stmt->bindParam(':keyword', $keyword, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch()['count'];
    }

    // Retrieve a single record by its ID
    protected function getById($table, $id) {
        $stmt = $this->db->prepare("SELECT * FROM $table WHERE book_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Insert a record into a table
    protected function insert($table, $data) {
        $columns = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Update a record in a table
    protected function update($table, $data, $id) {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');
        $data['id'] = $id;
        $sql = "UPDATE $table SET $fields WHERE book_id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Delete a record from a table
    protected function delete($table, $id) {
        $stmt = $this->db->prepare("DELETE FROM $table WHERE book_id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Filter records by author
    public function filterBooksByAuthor($author, $limit, $offset) {
        $query = "SELECT * FROM books WHERE book_author = :author LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':author', $author, \PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getFilteredBooksCount($value, $column) {
        $query = "SELECT COUNT(*) FROM books WHERE $column = :value";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':value', $value, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    // Filter records by category
    protected function filterByCategory($table, $category, $limit = null, $offset = null) {
        $sql = "SELECT * FROM $table WHERE book_genre = :category";
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        } else {
            $stmt = $this->db->prepare($sql);
        }
        $stmt->bindParam(':category', $category, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Fetch all unique categories
    protected function getAllCategories($table) {
        $stmt = $this->db->query("SELECT DISTINCT book_genre FROM $table");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Fetch all unique authors
    protected function getAllAuthors($table) {
        $stmt = $this->db->query("SELECT DISTINCT book_author FROM $table");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Count total number of books in a specific category
    protected function fetchCategoryBooksCount($table, $category) {
        $sql = "SELECT COUNT(*) as count FROM $table WHERE book_genre = :category";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':category', $category, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch()['count'];
    }
    protected function fetchAuthorBooksCount($table, $author) {
        $sql = "SELECT COUNT(*) as count FROM $table WHERE book_genre = :author";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':category', $author, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch()['count'];
    }
    public function filterBooksByPrice($minPrice, $maxPrice, $limit = null, $offset = null) {
        $sql = "SELECT * FROM books WHERE book_price BETWEEN :minPrice AND :maxPrice";
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        } else {
            $stmt = $this->db->prepare($sql);
        }
        $stmt->bindParam(':minPrice', $minPrice, \PDO::PARAM_INT);
        $stmt->bindParam(':maxPrice', $maxPrice, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Count total number of books in a specific price range
    public function getPriceRangeBooksCount($minPrice, $maxPrice) {
        $sql = "SELECT COUNT(*) as count FROM books WHERE book_price BETWEEN :minPrice AND :maxPrice";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':minPrice', $minPrice, \PDO::PARAM_INT);
        $stmt->bindParam(':maxPrice', $maxPrice, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['count'];
    }
    public function getRandomBooks($limit = 5) {
        $sql = "SELECT * FROM books ORDER BY RAND() LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
      // Add a new rating
      public function addRating($bookId, $userId, $rating) {
        $sql = "INSERT INTO ratings (book_id, user_id, rating) VALUES (:book_id, :user_id, :rating)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':book_id', $bookId, \PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Get average rating for a book
    public function getAverageRating($bookId) {
        $sql = "SELECT AVG(rating) as average_rating FROM ratings WHERE book_id = :book_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':book_id', $bookId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['average_rating'];
    }

    // Get all ratings for a book
    public function getRatings($bookId) {
        $sql = "SELECT * FROM ratings WHERE book_id = :book_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':book_id', $bookId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
