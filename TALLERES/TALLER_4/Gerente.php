<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';

class Gerente extends Empleado implements Evaluable {
    private $departamento;
    private $bono = 0;

    public function __construct($nombre, $idEmpleado, $salarioBase, $departamento) {
        parent::__construct($nombre, $idEmpleado, $salarioBase);
        $this->departamento = $departamento;
    }

    public function getDepartamento() {
        return $this->departamento;
    }

    public function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    public function asignarBono($monto) {
        $this->bono = $monto;
    }

    public function getSalarioTotal() {
        return $this->getSalarioBase() + $this->bono;
    }

    public function evaluarDesempenio() {
        
        $evaluacion = rand(1, 5); 
        if ($evaluacion >= 4) {
            $this->asignarBono(500); 
        }
        return $evaluacion;
    }
}
?>
