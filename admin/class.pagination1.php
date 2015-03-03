<?php
class pagination {
        var $full_sql, $per_page, $cur_page, $tot_pages, $offset;
        //define variable
        function pagination($full_sql, $per_page, $cur_page) {
                $this->full_sql = $full_sql; //full sql
                $this->per_page = $per_page; //no of entries per page
                $this->cur_page = $cur_page; //current page
                
                $sqlt = $full_sql;
                $rsdt = mysql_query($sqlt);
                $total = mysql_num_rows($rsdt); //total no of rows in mysql
                $this->tot_pages = ceil($total/$per_page); //total no of pages
        }

        function get_query() {
                $this->offset = ($this->cur_page - 1) * $this->per_page;
                return $this->full_sql." limit $this->offset,$this->per_page";
        }

        function get_links() {
                $page_link = "<ul>";

                                $self="viewusers.php"; //variable to define it's location page
                //previous link - if current page is first page: no link
                if ($this->cur_page > 1) {
                        $prev  = $this->cur_page - 1;
                        $page_link .= "<li class='prev'> <a href='$self?page=$prev'>&larr; Previous</a> </li>";
                }
                else {
                        $page_link .= "<li class='prev disabled'><a href='#'>&larr; Previous</a></li>";
                }

                //page links with number - current page number: no link
                for($i = 1; $i <= $this->tot_pages; $i++) {
                        if ($i == $this->cur_page)
                                $page_link .= "<li class='active'><a href='#'> $i</a> </li> ";
                        else
                                $page_link .= "<li> <a href=\"$self?page=$i\">$i</a></li> ";
                }

                //next link - if current page is last page: no link
                if ($this->cur_page < $this->tot_pages) {
                        $next = $this->cur_page + 1;
                        $page_link .= "<li class='next'> <a href='$self?page=$next'>Next &rarr;</a></li> ";
                }
                else {
                        $page_link .= "<li class='next disabled'><a href='#'>Next &rarr;</a></li>";
                }
                $page_link .= "</ul>";
                return $page_link;
        }
}
?>