<?php
/**
   * @backupGlobals disabled
   * @backupStaticAttributes disabled
   */

   require_once "src/Stylist.php";

   $server = 'mysql:host=localhost:8889;dbname=hair_saloon_test';
   $username = 'root';
   $password = 'root';
   $DB = new PDO($server, $username, $password);


    class StylistTest extends PHPUnit_Framework_TestCase
    {
          protected function tearDown()
          {
          Stylist::deleteAll();
          }

          function test_save()
          {
            $test_stylist = new Stylist("Barb", "Sanders", 3);
            $executed = $test_stylist->save();
            $this->assertTrue($executed, "Task not saved");
          }
          function test_getAll(){
            $test_stylist = new Stylist("Barb", "Sanders", 3);
            $test_stylist->save();
            $test_stylist2 = new Stylist("Sandy", "Barbers", 2);
            $test_stylist2->save();
            $result = Stylist::getAll();
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
          }
          function test_deleteAll()
          {
            $test_stylist = new Stylist("Barb", "Sanders", 3);
            $test_stylist->save();
            $test_stylist2 = new Stylist("Sandy", "Barbers", 2);
            $test_stylist2->save();
            Stylist::deleteAll();
            $result = Stylist::getAll();
            $this->assertEquals([], $result);
          }
          function test_getId()
          {
            $test_stylist = new Stylist("Barb", "Sanders", 3);
            $test_stylist->save();
            $result = $test_stylist->getId();
            var_dump($result);
            $this->assertTrue(is_numeric($result));
          }
    }

?>
