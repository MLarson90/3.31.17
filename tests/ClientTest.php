<?php
/**
   * @backupGlobals disabled
   * @backupStaticAttributes disabled
   */

   require_once "src/Client.php";

   $server = 'mysql:host=localhost:8889;dbname=hair_saloon_test';
   $username = 'root';
   $password = 'root';
   $DB = new PDO($server, $username, $password);


    class ClientTest extends PHPUnit_Framework_TestCase
    {
          protected function tearDown()
          {
          Client::deleteAll();
          }

          function test_save()
          {
            $test_client = new Client("Cindy", "Johnson", 3);
            $executed = $test_client->save();
            $this->assertTrue($executed, "Task not saved");
          }
          function test_getAll(){
            $test_client = new Client("Cindy", "Johnson", 3);
            $test_client->save();
            $test_client2 = new Client("Claire", "Durpenfurf", 2);
            $test_client2->save();
            $result = Client::getAll();
            $this->assertEquals([$test_client, $test_client2], $result);
          }
          function test_deleteAll()
          {
            $test_client = new Client("Cindy", "Johnson", 3);
            $test_client->save();
            $test_client2 = new Client("Claire", "Durpenfurf", 2);
            $test_client2->save();
            Client::deleteAll();
            $result = Client::getAll();
            $this->assertEquals([], $result);
          }
          function test_getId()
          {
            $test_client = new Client("Cindy", "Johnson", 3);
            $test_client->save();
            $result = $test_client->getId();
            $this->assertTrue(is_numeric($result));
          }
          function test_find()
          {
            $test_client = new Client("Cindy", "Johnson", 3);
            $test_client->save();
            $test_client2 = new Client("Claire", "Durpenfurf", 2);
            $test_client2->save();
            $id = $test_client->getStylistId();
            $result= Client::findStylist($id);
            $this->assertEquals([$test_client], $result);
          }
          function test_find_by_id()
          {
            $test_client = new Client("Cindy", "Johnson", 3);
            $test_client->save();
            $test_client2 = new Client("Claire", "Durpenfurf", 2);
            $test_client2->save();
            $id= $test_client->getId();
            $result= Client::find($id);
            $this->assertEquals($test_client, $result);
          }
          function test_update()
          {
            $test_client = new Client("Cindy", "Johnson", 3);
            $test_client->save();
            $new_name = "Dametri";
            $test_client->update($new_name);
            $result = $test_client->getFirst();
            $this->assertEquals("Dametri", $result);
          }
          function test_deleteClient()
          {
            $test_client = new Client("Barb", "Sanders", 3);
            $test_client->save();
            $test_client2 = new Client("Sandy", "Barbers", 2);
            $test_client2->save();
            $test_client->deleteClient();
            $this->assertEquals([$test_client2], Client::getAll());
          }
    }
 ?>
