<?php
class Results extends Controller
{
	function Results()
	{
		parent::Controller();
                $this->load->database();
	}
        function search(){
            if(isset ($_REQUEST['query']))
                $searchTxt = htmlspecialchars($_REQUEST['query'], ENT_QUOTES);
            else
                 $searchTxt = "";
                $html = <<< html
                <div class="booksTitle"><span>Search results for $searchTxt</span></div>
                <div class="content centerContent ">
                    <table width ="100%" border="0" id="quicksearch" class="display">
                        <thead>
                           <tr>
                            <th ><a href="javascript:;" style="text-decoration:none;color:#000;">Book Title</a></th>
                            <th ><a href="javascript:;" style="text-decoration:none;color:#000;">Type</a></th>
                            <th ><a href="javascript:;" style="text-decoration:none;color:#000;">Publisher</a></th>
                            <th ><a href="javascript:;" style="text-decoration:none;color:#000;">Downloads</a></th>
                            <th  ><a href="javascript:;" style="text-decoration:none;color:#000;">Size kbs</a></th>
                           </tr>
                        </thead>
                        <tbody>

html;
                $this->load->model('results_model');
               $query = $this->results_model->getSearchBooks($searchTxt);

              foreach ($query->result() as $row){
                    $url = $this->config->item('base_url') . "/index.php/books/book/" . $row->book_id;
                    $size = $this->_getSize($row->book_size);
                    $type = strtoupper($row->type_name);
                    $html .= <<< html
                    <tr>
                    <td><a href="$url" class="bookURL">$row->book_title</a></td>
                    <td >$type</td>
                    <td >$row->publisher_name</td>
                    <td >$row->book_downloads</td>
                    <td >$size</td>
                    </tr>
html;
                }
                if($query->num_rows() == 0)
                {
                  $html .= "<tr><td colspan='5'>No results found for $searchTxt </td></tr>";
                }
                $html .= "</tbody></table>";
                $data['message'] = $html;
                $this->load->view('message_view', $data);
        }
        function category(){
            if(isset ($_REQUEST['category_id']) && isset ($_REQUEST['category_name'])){
                $id = htmlspecialchars($_REQUEST['category_id'], ENT_QUOTES);
                $category = htmlspecialchars($_REQUEST['category_name'], ENT_QUOTES);
            }
            else
            {
               $category = "";
               $id = "";
            }
                $html = <<< html
                <div class="booksTitle"><span>Books Categorized Under $category</span></div>
                <div class="content centerContent">
                    <table width ="100%" border="0" id="quicksearch" class="display">
                        <thead>
                           <tr>
                            <th ><a href="javascript:;" style="text-decoration:none;color:#000;">Book Title</a></th>
                            <th ><a href="javascript:;" style="text-decoration:none;color:#000;">Type</a></th>
                            <th ><a href="javascript:;" style="text-decoration:none;color:#000;">Publisher</a></th>
                            <th ><a href="javascript:;" style="text-decoration:none;color:#000;">Downloads</a></th>
                            <th  ><a href="javascript:;" style="text-decoration:none;color:#000;">Size kbs</a></th>
                           </tr>
                        </thead>
                        <tbody>

html;
                $this->load->model('results_model');
                $query = $this->results_model->getCategoryBooks($id);
                foreach ($query->result() as $row){
                    $url = $this->config->item('base_url') . "/index.php/books/book/" . $row->book_id;
                    $size = $this->_getSize($row->book_size);
                    $type = strtoupper($row->type_name);
                    $html .= <<< html
                    <tr>
                    <td><a href="$url" class="bookURL">$row->book_title</td>
                    <td>$type</td>
                    <td>$row->publisher_name</td>
                    <td>$row->book_downloads</td>
                    <td>$size</td>
                    </tr>
html;
                }

                if($query->num_rows() == 0)
                {
                  $html .= "<tr><td colspan='5'>No books found categorized under $category</td></tr>";
                }
                $html .= "</tbody></table>";
                $data['message'] = $html;
                $this->load->view('message_view', $data);
        }
        function publisher(){
           if(isset ($_REQUEST['publisher_id']) && isset ($_REQUEST['publisher_name'])){
                $id = htmlspecialchars($_REQUEST['publisher_id'], ENT_QUOTES);
                $publisher = htmlspecialchars($_REQUEST['publisher_name'], ENT_QUOTES);
            }
            else
            {
               $publisher = "";
               $id = "";
            }
                $html = <<< html
                <div class="booksTitle"><span>Books Published by $publisher</span></div>
                <div class="content centerContent">
                    <table width ="100%" border="0" id="quicksearch" class="display">
                        <thead>
                           <tr>
                            <th ><a href="javascript:;" style="text-decoration:none;color:#000;">Book Title</a></th>
                            <th ><a href="javascript:;" style="text-decoration:none;color:#000;">Type</a></th>
                            <th ><a href="javascript:;" style="text-decoration:none;color:#000;">Publisher</a></th>
                            <th ><a href="javascript:;" style="text-decoration:none;color:#000;">Downloads</a></th>
                            <th  ><a href="javascript:;" style="text-decoration:none;color:#000;">Size kbs</a></th>
                           </tr>
                        </thead>
                        <tbody>

html;
                $this->load->model('results_model');
                $query = $this->results_model->getPublisherBooks($id);
                foreach ($query->result() as $row){
                    $url = $this->config->item('base_url') . "/index.php/books/book/" . $row->book_id;
                    $type = strtoupper($row->type_name);
                    $size = $this->_getSize($row->book_size);
                    $html .= <<< html
                    <tr>
                    <td><a href="$url" class="bookURL">$row->book_title</td>
                    <td >$type</td>
                    <td >$row->publisher_name</td>
                    <td >$row->book_downloads</td>
                    <td >$size</td>
                    </tr>
html;
                }

                if($query->num_rows() == 0)
                {
                  $html .= "<tr><td colspan='5'>No books found published by $publisher</td></tr>";
                }
                $html .= "</tbody></table>";
                $data['message'] = $html;
                $this->load->view('message_view', $data);
        }


        function _getSize($size){
                return str_replace(',' , '' , number_format(($size/1024), 2));
        }
}
?>