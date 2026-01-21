<?php
// app/controllers/HomeController.php

require_once '../app/models/Alquiler.php'; 

class HomeController extends Controller {
    
    public function index() {
        // 1. Instanciar modelo
        $alquilerModel = new Alquiler($this->db);
        
        // 2. Obtener la agenda pública (RF-PUB-02)
        $agenda = $alquilerModel->obtenerAgendaPublica();

        // 3. Cargar la vista enviando los datos
        $this->view('home/index', [
            'agenda' => $agenda
        ]);
    }
}