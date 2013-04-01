<?php
class Results_model extends Model{
    function Results_model(){
        parent::Model();
        $this->load->database();
    }
    function getCategoryBooks($CategoryId)
    {
        $QueryResult = $this->db->query("
        SELECT book_id, book_title, book_author, book_isbn, publisher_name, category_name, user_name, type_name, book_downloads, book_size, book_path, book_date_inserted
        FROM books, publishers, categories, book_types, users
        WHERE book_publisher_id = publisher_id
        AND book_category_id = category_id
        AND book_uploader_id = user_id
        AND book_type_id = type_id
        AND book_isapproved = 1
        AND BOOK_CATEGORY_ID = " . htmlspecialchars($CategoryId, ENT_QUOTES) . ";"
            );
        return $QueryResult;
    }

    function getPublisherBooks($PublisherId)
    {
        $QueryResult = $this->db->query("
        SELECT book_id, book_title, book_author, book_isbn, publisher_name, category_name, user_name, type_name, book_downloads, book_size, book_path, book_date_inserted
        FROM books, publishers, categories, book_types, users
        WHERE book_publisher_id = publisher_id
        AND book_category_id = category_id
        AND book_uploader_id = user_id
        AND book_type_id = type_id
        AND book_isapproved = 1
        AND BOOK_PUBLISHER_ID = " . htmlspecialchars($PublisherId, ENT_QUOTES) . ";"
            );
        return $QueryResult;
    }

    function getSearchBooks($SearchQuery)
    {
        $QueryResult = $this->db->query("
        SELECT book_id, book_title, book_author, book_isbn, publisher_name, category_name, user_name, type_name, book_downloads, book_size, book_path, book_date_inserted
        FROM books, publishers, categories, book_types, users
        WHERE book_publisher_id = publisher_id
        AND book_category_id = category_id
        AND book_uploader_id = user_id
        AND book_type_id = type_id
        AND book_isapproved = 1
        AND (book_title like ('%" . htmlspecialchars($SearchQuery, ENT_QUOTES) . "%')
        OR publisher_name like ('%" . htmlspecialchars($SearchQuery, ENT_QUOTES) . "%')
        OR book_author like ('%" . htmlspecialchars($SearchQuery, ENT_QUOTES) . "%')
        );"    );
        return $QueryResult;
    }
}
?>