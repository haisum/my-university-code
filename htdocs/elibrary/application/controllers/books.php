<?php
session_start();
class Books extends Controller
{
	function Books()
	{
		parent::Controller();
                $this->load->database();
	}
        function book($id){
               $this->load->model('books_model');
               $query = $this->books_model->getBook($id);
               $data;
              foreach ($query->result() as $row){
                  $data['book_size'] =  $this->_getSize($row->book_size);
                  $data['book_name'] =  $row->book_title;                  
                  $data['type_name'] =  $row->type_name;
                  $data['book_publisher'] =  $row->publisher_name;
                  $data['book_author'] =  $row->book_author;
                  $data['user_name'] =  $row->user_name;
                  $data['book_category'] =  $row->category_name;
                  $data['book_isbn'] =  $row->book_isbn;
                  $data['book_date_inserted'] =  $row->book_date_inserted;
                  $data['book_downloads'] =  $row->book_downloads;
                  $data['base_url'] = $this->config->item('base_url');
                  $_SESSION['ext'] = $row->type_name;
                  $_SESSION['path'] = $row->book_path;
                  $_SESSION['book_name'] = $row->book_title;
                  $_SESSION['publisher'] = $row->publisher_name;
                  $_SESSION['author'] = $row->book_author;
                  $_SESSION['size'] = $data['book_size'];
                  $_SESSION['isbn'] = $row->book_isbn;
                  $_SESSION['book_id'] = $row->book_id;
                  $_SESSION['book_downloads'] = $row->book_downloads;
              }
             
                  $this->load->view('books_view', $data);
        }


        function _getSize($size){
            if($size/1024/1024 > 1){
                return number_format(($size/1024/1024), 2) . "MB";
            }
            else {
                return number_format(($size/1024), 2) . "KB";
            }
        }
        function download(){
            if(isset ($_SESSION['path'])){
                $this->load->model('books_model');
                $this->books_model->updateBook( $_SESSION['book_id'], $_SESSION['book_downloads']);
                $this->load->helper('download');
                $data = file_get_contents($this->config->item('base_url') . "/uploads/" . $_SESSION['path']);
                $name = $_SESSION['book_name'] . "." . $_SESSION['author'] . "." . $_SESSION['publisher'] .".". $_SESSION['isbn']. "." .$_SESSION['size'] .".". $_SESSION['ext'];
                force_download($name, $data); 
            }
            else{
                header('location:' . $this->config->item('base_url'));
            }
        }
}
?>