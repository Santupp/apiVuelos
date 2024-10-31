<?php
require_once __DIR__ . '/../models/vuelo.model.php';
require_once __DIR__ . '/../views/vuelo.view.php';

class vuelosController
{
    private $model;
    private $view;
    public function __construct()
    {
        $this -> model = new vueloModel();
        $this -> view = new apiView(); //
    }
    public function getCiudades($req) //Todos los metodos del controller necesitan un $req
    {
        $ciudades = $this->model->getCiudades();
        return $this-> view -> response($ciudades, 200);

    }
    public function getVuelosById($req){
        $flight_id = $req -> params ->id;
        if (!$flight_id){
            return $this->view ->response("No se especifico el id", 404);
        }
        $vuelos_id = $this->model ->flightDetailById($flight_id);
        return $this->view->response($vuelos_id, 200);
    }
    public function insertarVuelo() {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->nombre) && isset($data->origen) && isset($data->destino)) {
            $this->model->insertVuelo($data->nombre, $data->origen, $data->destino);
            return $this->view->response("Vuelo insertado con éxito", 201);
        } else {
            return $this->view->response("Datos incompletos", 400);
        }
    }

}