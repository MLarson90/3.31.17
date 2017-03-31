

    <?php
        class Client
        {
          private $first;
          private $last;
          private $stylist_id;
          private $id;

          function __construct($first, $last, $stylist_id, $id=null)
          {
            $this->first = $first;
            $this->last = $last;
            $this->stylist_id = $stylist_id;
            $this->id = $id;
          }
            function getFirst(){
              return $this->first;
            }
            function getLast(){
              return $this->last;
            }
            function getStylistId(){
              return $this->stylist_id;
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
            function setStylistId($new_name){
              $this->stylist_id = (int) $new_name;
            }
            function save()
            {
              $executed = $GLOBALS['DB']->exec("INSERT INTO client (first, last, stylist_id) VALUES ('{$this->getFirst()}', '{$this->getLast()}', {$this->getStylistId()});");
              if($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
              }else {
                return false;
              }
            }
             static function getAll()
            {
              $returned_client = $GLOBALS['DB']->query("SELECT * FROM client;");
              $client = array();
              foreach($returned_client as $clients){
                $first = $clients['first'];
                $last = $clients['last'];
                $stylist_id = $clients['stylist_id'];
                $id = $clients['id'];
                $new_client = new Client($first,$last,$stylist_id, $id);
                array_push($client, $new_client);
              }
              return $client;
            }
            static function deleteAll()
            {
                $executed = $GLOBALS['DB']->exec("DELETE FROM client;");
                if($executed){
                  return true;
                }else{
                  return false;
                }
            }
            static function findStylist($search_stylist_id)
            {
              $new_clients = array();
              $returned_client= $GLOBALS['DB']->prepare("SELECT * FROM client WHERE stylist_id = :id");
              $returned_client->bindParam(':id', $search_stylist_id, PDO::PARAM_STR);
              $returned_client->execute();
              foreach($returned_client as $client){
                $first = $client['first'];
                $last = $client['last'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                if($stylist_id == $search_stylist_id){
                $new_client= new Client($first,$last,$stylist_id, $id);
                array_push($new_clients,$new_client);
                }
              }
              return $new_clients;
            }
            static function find($search_id)
            {
              $returned_client= $GLOBALS['DB']->prepare("SELECT * FROM client WHERE id = :id");
              $returned_client->bindParam(':id', $search_id, PDO::PARAM_STR);
              $returned_client->execute();
              foreach($returned_client as $client){
                $first = $client['first'];
                $last = $client['last'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                if($id == $search_id){
                  $newClient = new Client($first, $last, $stylist_id, $id);
                    return $newClient;
                }
              }
            }
            function update($new_name)
            {
              $executed = $GLOBALS['DB']->exec("UPDATE client SET first = '{$new_name}' WHERE id = {$this->getId()};");
              if($executed){
                $this->setFirst($new_name);
                return true;
              }else{
                return false;
              }
            }
            function updatelast($new_name)
            {
              $executed = $GLOBALS['DB']->exec("UPDATE client SET last = '{$new_name}' WHERE id = {$this->getId()};");
              if($executed){
                $this->setLast($new_name);
                return true;
              }else{
                return false;
              }
            }
            function deleteClient()
            {
              $executed= $GLOBALS['DB']->exec("DELETE FROM client Where id={$this->getId()};");
              if ($executed){
                return true;
              }else{
                return false;
              }
            }
        }
    ?>
