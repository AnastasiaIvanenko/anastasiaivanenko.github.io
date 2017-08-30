<?php

  include_once "include/db.php";
 include_once "include/group_list_db.php";
  include_once "include/model.php";
 include_once "include/view.php";
  include_once "include/controller.php";
   
 Controller::handleAction($_GET['action']);
  ?>
