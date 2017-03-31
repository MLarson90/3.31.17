<?php
    class Stylist
    {
      private $first;
      private $last;
      private $years;
      private $id;

      function __construct($first, $last, $years, $id=null)
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
        function setFirst($new_name){
          $this->first = (string) $new_name;
        }
        function setLast($new_name){
          $this->last = (string) $new_name;
        }
        function setYears($new_name){
          $this->years = (int) $new_name;
        }
        function save()
        {
          $executed = $GLOBALS['DB']->exec("INSERT INTO stylist (first, last, years) VALUES ('{$this->getFirst()}', '{$this->getLast()}', {$this->getYears()});");
          if($executed) {
            $this->id = $GLOBALS['DB']->lastInsertId();
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
            $id = $stylist['id'];
            $new_stylist= new Stylist($first,$last,$years, $id);
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
        static function find($search_last)
        {
          $returned_stylist= $GLOBALS['DB']->prepare("SELECT * FROM stylist WHERE last = :id");
          $returned_stylist->bindParam(':id', $search_last, PDO::PARAM_STR);
          $returned_stylist->execute();
          foreach($returned_stylist as $stylist){
            $first = $stylist['first'];
            $last = $stylist['last'];
            $years = $stylist['years'];
            $id = $stylist['id'];
            if($last == $search_last){
            $new_stylist= new Stylist($first,$last,$years, $id);
            }
          }
          return $new_stylist;
        }
        function update($new_name)
        {
          $executed = $GLOBALS['DB']->exec("UPDATE stylist SET first = '{$new_name}' WHERE id = {$this->getId()};");
          if($executed){
            $this->setFirst($new_name);
            return true;
          }else{
            return false;
          }
        }
        function deleteStylist()
        {
          $executed= $GLOBALS['DB']->exec("DELETE FROM stylist Where id={$this->getId()};");
          if ($executed){
            return true;
          }else{
            return false;
          }
        }
    }
?>
