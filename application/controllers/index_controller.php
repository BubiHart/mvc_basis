<?php


  class index_controller_class extends controller_class
  {
    function action_index()
    {
      $this->view->generate_page_view('index_view.php', 'basic_template.php');
    }

  }


?>
