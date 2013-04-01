<?php
class Sides_model extends Model{
    function Sides_model(){
        parent::Model();
        $this->load->database();
    }

    function getFeatured(){
        $query = $this->db->query("SELECT book_id, book_title FROM featured_books , books WHERE featured_book_id = book_id order by book_date_inserted DESC LIMIT 10;");
        return  $query;
    }

    function getPopular(){
        $query = $this->db->query("SELECT book_id, book_title FROM books order by book_downloads DESC, book_title ASC LIMIT 10;");
        return  $query;
    }
    function getNewest(){
        $query = $this->db->query("SELECT book_title, book_id from books order by book_date_inserted DESC LIMIT 10;");
        return  $query;
    }
}
?>