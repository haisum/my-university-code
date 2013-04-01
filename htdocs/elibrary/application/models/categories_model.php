<?php
class Categories_model extends Model{
    function Categories_model(){
        parent::Model();
        $this->load->database();
    }

    function getCategories()
    {
        $QueryResult = $this->db->query("SELECT * FROM DEPARTMENTS order by department_name;");
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

    function getCategoriesByDepartment($id)
    {
        $QueryResult = $this->db->query("
            SELECT category_id, category_name
            from categories, departments
            where category_department_id = department_id AND category_department_id=" . htmlspecialchars($id , ENT_QUOTES) ." ORDER BY Category_Name;"
            );
        return $QueryResult;
    }
}
?>