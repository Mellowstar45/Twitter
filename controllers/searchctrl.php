<?php

  include '../model/conndb.php';
  include '../model/search.php';

  $searchInput = $_POST["input"];

  class Searchctrl extends Search
  {
    public $searchInput;
    public $atUsernames;
    public $hashtags;

    public function __construct($searchInput, $arobase, $hashtag)
    {
      $this->searchInput      = $searchInput;
      $this->atUsernames       = $arobase;
      $this->hashtags          = $hashtag;

    }

    public function checkSearch()
    {
      $this->searchByInput($this->searchInput);
      $this->searchByAtusername($this->atUsernames);
      $this->searchByHashtag($this->hashtags);
    }
  }

  $allAroba = [];
  if (str_contains($searchInput, "@")) {
    $test = strstr($searchInput, "@");
    $test = trim($test);
    $arr = explode(" ", $test);
    foreach($arr as $value){
      if(str_starts_with($value, "@")){
        if($value != "@"){
          array_push($allAroba, $value);
        }
      }
    }
  }

  $allHash = [];
  if (str_contains($searchInput, "#")) {
    $test = strstr($searchInput, "#");
    $test = trim($test);
    $arr = explode(" ", $test);
    foreach($arr as $value){
      if(str_starts_with($value, "#")){
        if($value != "#"){
          array_push($allHash, $value);
        }
      }
    }
  }

  $call = new Searchctrl($searchInput, $allAroba, $allHash);
  $call->checkSearch();
