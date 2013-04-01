<?php
class Books_model extends Model{
    function Books_model(){
        parent::Model();
        $this->load->database();
    }
    function getBook($Id)
    {
        $QueryResult = $this->db->query("
        SELECT book_id, book_title, book_author, book_isbn, publisher_name, category_name, user_name, type_name, book_downloads, book_size, book_path, book_date_inserted
        FROM books, publishers, categories, book_types, users
        WHERE book_publisher_id = publisher_id
        AND book_category_id = category_id
        AND book_uploader_id = user_id
        AND book_type_id = type_id
        AND book_isapproved = 1
        AND BOOK_ID = " . htmlspecialchars($Id, ENT_QUOTES) . ";"
            );
        return $QueryResult;
    }
    function updateBook($id, $downloads){
        $downloads = $downloads+1;
        $QueryResult = $this->db->query("
        UPDATE BOOKS
        SET book_downloads = " . $downloads . "
        WHERE BOOK_ID = " . htmlspecialchars($id, ENT_QUOTES) . ";");
    }
}
?>