<?php

require_once("../Conekta.php");
require_once("../../../../../vendor/autoload.php");

class Payment{

    private $ApiKey="key_eYvWV7gSDkNYXsmr";
    private $ApiVersion="2.0.0";

    private $UserDB = "root";
    private $PassDB="";
    private $ServerDB = "localhost";
    private $DataBaseDB="tienda-laravel";


    public function __construct($token,$name,$email,$telephone,$card,$description,$total){
        $this->token=$token;
        $this->name=$name;
        $this->email=$email;
        $this->telephone=$telephone;
        $this->card=$card; 
        $this->description=$description;
        $this->total=$total;

        $this->arrayPaymentMethod = array(
          "type" => "default"
        );
    }

    public function Pay(){

        \Conekta\Conekta::setApiKey($this->ApiKey);
        \Conekta\Conekta::setApiVersion($this->ApiVersion);

        if(!$this->CreateCustomer())
            return false;
         
        if(!$this->CreateOrder())
            return false;

        $this->SaveOrder();

        return true;

    }

    public function SaveOrder(){

        try {
            $link = new PDO("mysql:host=".$this->ServerDB."; dbname=".$this->DataBaseDB, $this->UserDB, $this->PassDB);

            $statement = $link->prepare("INSERT INTO orders (name,email,telephone,card,description,total,created_at,order_id,token)
            VALUES (:name, :email, :telephone, :card, :description,:total, now(), :order_id, :token)");
    
        $statement->execute([
            'name' => $this->name,
            'email'=> $this->email,
            'telephone'=> $this->telephone,
            'card'=> substr($this->card,strlen($this->card) -4),
            'description' => $this->description,
            'total' => $this->total, 
            'order_id'=>$this->order->id,
            'token'=>$this->token 
        ]);

        $this->order_number = $link->lastInsertId(); 

        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }       
      }

    public function CreateOrder(){
        try{
          $this->order = \Conekta\Order::create(
            array(
              "amount"=>$this->total,
              "line_items" => array(
                array(
                  "name" => $this->description,
                  "unit_price" => $this->total*100, //se multiplica por 100 conekta
                  "quantity" => 1
                )//first line_item
              ), //line_items
              "currency" => "MXN",
              "customer_info" => array(
                "customer_id" => $this->customer->id 
              ), //customer_info  
              "charges" => array(
                  array(
                      "payment_method" => $this->arrayPaymentMethod
                ) //first charge
              ) //,charges
            //   "metadata" => array(
            //     "E-mail" => $this->email1,
            //     "Tel" => $this->telephone1,
            //   )//metadata  
            )//order
          );
        } catch (\Conekta\ProcessingError $error){
          $this->error=$error->getMessage();
          return false;
        } catch (\Conekta\ParameterValidationError $error){
          $this->error=$error->getMessage();
          return false;
        } catch (\Conekta\Handler $error){
          $this->error=$error->getMessage();
          return false;
        }
  
        return true;
      }
      
    public function CreateCustomer(){
        try {
          $this->customer = \Conekta\Customer::create(
            array(
              "name" => $this->name,
              "email" => $this->email,
              "phone" => $this->telephone,
              "payment_sources" => array(
                array(
                    "type" => "card",
                    "token_id" => $this->token
                )
              )//payment_sources
            )//customerValidate
          );
        } catch (\Conekta\ProccessingError $error){
          $this->error=$error->getMesage();
          return false;
        } catch (\Conekta\ParameterValidationError $error){
          $this->error=$error->getMessage();
          return false;
        } catch (\Conekta\Handler $error){
          $this->error=$error->getMessage();
          return false;
        }

        return true;
    }
}

?>