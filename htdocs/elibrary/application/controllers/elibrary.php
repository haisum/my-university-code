<?php
class Elibrary extends Controller
{
        var $base_url = "";
	function ELibrary()
	{
		parent::Controller();
                $this->load->database();
	}
	
	function index()
	{
		$this->base_url = $this->config->item('base_url');
		$data['base_url'] = $this->base_url;
                $data['categories'] = $this->_getCategories();
                $data['publishers'] = $this->_getPublishers();
                $data['newest'] = $this->_getNewest();
                $data['featured'] = $this->_getFeatured();
                $data['popular'] = $this->_getPopular();
                //$this->output->cache(2*24*60);
		$this->load->view('elibrary_view', $data);
	}
        function _getCategories()
        {
            $count = 0;
                $html = "<table cellspacing ='0' width='100%'>";
                $department = "";
		$this->load->model('categories_model');
                $Results = $this->categories_model->getCategories();
                $total = $Results->num_rows();
                foreach($Results->result() as $row){
                    if($department != $row->department_name)
                            {
                                $department = $row->department_name;
                                $html .= "                              <tr>
                                  <td class='mainCatName' colspan='4'  width='25%'>
                                      <span>".$department."<span>
                                        </td>
                                        </tr>";
                                $result = $this->categories_model->getCategoriesByDepartment($row->department_id);
                                foreach ($result->result() as $subRow){
                                    $id = htmlspecialchars($subRow->category_id, ENT_QUOTES);
                                    $name = htmlspecialchars($subRow->category_name, ENT_QUOTES);
                                    ++$count;
                                    if($count % 4 == 1 && $count !=1)
                                            $html.="</tr>";
                                    if($count % 4 ==1){
                                        $html .= <<< html
                                                <tr><td class='subCatName' width='25%'><a href='javascript:category("{$id}", "{$name}");'>$name</a></td>
html;
                                    }
                                    else if($count % 4 != 1){

                                        $html .= <<< html
                                                <td class='subCatName' width='25%'><a href='javascript:category("{$id}", "{$name}");'>$name</a></td>
html;
                                    }
                                    if($count == $result->num_rows() && $result->num_rows()%4 ==0){
                                        $html .= "</tr>";
                                    }
                                    else if($count == $result->num_rows() && $result->num_rows()%4 !=0){
                                        for($i=0;$i<(4-($result->num_rows()%4));$i++)
                                            $html .= "<td class='subCatName'  width='25%'></td>";
                                        $html .= "</tr>";
                                    }
                                }
                                $count = 0;
                            }
                }

                $html.="</table>";
                return  $html;
        }
        function _getPublishers()
        {
            $count = 0;
                $html = "<table cellspacing ='0' width='100%'>";
		$this->load->model('publishers_model');
                $result = $this->publishers_model->getPublishers();
                                foreach ($result->result() as $subRow){
                                    $id = htmlspecialchars($subRow->publisher_id, ENT_QUOTES);
                                    $name = htmlspecialchars($subRow->publisher_name, ENT_QUOTES);
                                    ++$count;
                                    if($count % 4 == 1 && $count !=1)
                                            $html.="</tr>";
                                    if($count % 4 ==1){
                                        $html .= <<< html
                                                <tr><td class='subCatName' width='25%'><a href='javascript:publisher("{$id}", "{$name}");'>$name</a></td>
html;
                                    }
                                    else if($count % 4 != 1){

                                        $html .= <<< html
                                                <td class='subCatName' width='25%'><a href='javascript:publisher("{$id}", "{$name}");'>$name</a></td>
html;
                                    }
                                    if($count == $result->num_rows() && $result->num_rows()%4 ==0){
                                        $html .= "</tr>";
                                    }
                                    else if($count == $result->num_rows() && $result->num_rows()%4 !=0){
                                        for($i=0;$i<(4-($result->num_rows()%4));$i++)
                                            $html .= "<td class='subCatName'  width='25%'></td>";
                                        $html .= "</tr>";
                                    }
                                }
                            
                

                $html.="</table>";
                return  $html;
        }
        function _getNewest(){
              $this->load->model('sides_model');
              $QueryResult = $this->sides_model->getNewest();
              $html = "";
              foreach($QueryResult->result() as $row)
              {
                $html.= "<li  class='linkAd'><a href='". $this->base_url . "/index.php/books/book/" . $row->book_id ."'>" . $row->book_title . "</a></li>";
              }
              return  $html;
        }
        function _getFeatured(){
              $this->load->model('sides_model');
              $QueryResult = $this->sides_model->getFeatured();
              $html = "";
              foreach($QueryResult->result() as $row)
              {
                $html.= "<li  class='linkAd'><a href='". $this->base_url . "/index.php/books/book/" . $row->book_id ."'>" . $row->book_title . "</a></li>";
              }
              return  $html;
        }
        function _getPopular(){
              $this->load->model('sides_model');
              $QueryResult = $this->sides_model->getPopular();
              $html = "";
              foreach($QueryResult->result() as $row)
              {
                $html.= "<li  class='linkAd'><a href='". $this->base_url . "/index.php/books/book/" . $row->book_id ."'>" . $row->book_title . "</a></li>";
              }
              return  $html;
        }
}
?>