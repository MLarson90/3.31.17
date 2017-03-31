<?php
    class Stylist
    {
      private $first;
      private $last;
      private $years;
      private $id;

      function __construct($first, $last, $years, $id = null)
      {
        $this->first = $first;
        $this->last = $last;
        $this->years = $years;
        $this->id = $id;
      }
        function getFirst(){
          return $this->first;
        }
        function getLast(){
          return $this->last;
        }
        function getYears(){
          return $this->years;
        }
        function getId(){
          return $this->id;
        }
        function save()
        {
          $executed = $GLOBALS['DB']->exec("INSERT INTO stylist (first, last, years) VALUES ('{$this->getFirst()}', '{$this->getLast()}', {$this->getYears()});");
          if($executed) {
            return true;
          }else {
            return false;
          }
        }
         static function getAll()
        {
          $returned_stylist = $GLOBALS['DB']->query("SELECT * FROM stylist;");
          $stylists=array();
          foreach($returned_stylist as $stylist){
            $first = $stylist['first'];
            $last = $stylist['last'];
            $years = $stylist['years'];
            $new_stylist= new Stylist($first,$last,$years);
            array_push($stylists, $new_stylist);
          }
          return $stylists;
        }
        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM stylist;");
            if($executed){
              return true;
            }else{
              return false;
            }
        }
    }
?>
