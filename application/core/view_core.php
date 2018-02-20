<?php

  class view_class
  {


    function generate_page_view($content_view, $basic_template)
    {
      include dirname(__FILE__, $levels = 2)."/views/".$basic_template;
      include dirname(__FILE__, $levels = 2)."/views/".$content_view;
    }

  }


?>
