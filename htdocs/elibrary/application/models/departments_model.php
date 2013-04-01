<?php
class Departments_model extends Model{
    function Categories_model(){
        parent::Model();
    }
    function getDepartments(){
        $QueryResults = $this->db->get('departments');
        return  $QueryResults;
    }
    function getByDepartmentId($DepartmentId){
        $QueryResult = $this->db->query("
        SELECT BOOK_title, BOOK_Author, Book_ISBN, publisher_name, category_name, user_name, book_isapproved, type_name, book_downloads, book_size, book_path, book_date_inserted
        FROM books, publishers, categories, book_types, users
        WHERE book_publisher_id = publisher_id
        AND book_category_id = category_id
        AND book_uploader_id = user_id
        AND book_type_id = type_id
        AND BOOK_DEPARTMENT_ID = " + htmlspecialchars($DepartmentId, ENT_QUOTES) + ";"
            );
        return $QueryResult;
    }
}
?>