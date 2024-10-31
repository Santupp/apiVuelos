<?php

class vueloModel
{
   private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=airUnicen;charset=utf8', 'root', '');
    }
    public function getCiudades()
    {
        $query = $this ->db->prepare('SELECT nombre FROM ciudad');
        $query ->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function flightDetailById($flight_id){
        $query = $this -> db->prepare('SELECT id_vuelo FROM vuelo WHERE id_vuelo = ?');
        $query -> execute([$flight_id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    public function insertVuelo($nombre, $origen, $destino) {
        $query = $this->db->prepare("INSERT INTO vuelos (nombre, origen, destino) VALUES (?, ?, ?)");
        $query->execute([$nombre, $origen, $destino]);
    }
}