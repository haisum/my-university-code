<?php
class Publishers_model extends Model{
    function Publishers_model(){
        parent::Model();
        $this->load->database();
    }

    function getPublishers()
    {
        $QueryResult = $this->db->query("SELECT * FROM publishers order by publisher_name;");
        return $QueryResult;
    }

    function getCategoryBooks($CategoryId)
    {
        $QueryResult = $this->db->query("
        SELECT BOOK_title, BOOK_Author, Book_ISBN, publisher_name, category_name, user_name, book_isapproved, type_name, book_downloads, book_size, book_path, book_date_inserted
        FROM books, publishers, categories, book_types, users
        WHERE book_publisher_id = publisher_id
        AND book_category_id = category_id
        AND book_uploader_id = user_id
        AND book_type_id = type_id
        AND BOOK_CATEGORY_ID = " + htmlspecialchars($CategoryId, ENT_QUOTES) + ";"
            );
        return $QueryResult;
    }
}
?>