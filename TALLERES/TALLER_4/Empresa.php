<?php
require_once 'Empleado.php';
require_once 'Gerente.php';
require_once 'Desarrollador.php';
require_once 'Evaluable.php';

class Empresa {
    private $empleados = [];

    public function agregarEmpleado(Empleado $empleado) {
        $this->empleados[] = $empleado;
    }

    public function listarEmpleados() {
        foreach ($this->empleados as $emp) {
            echo "ID: {$emp->getIdEmpleado()}, Nombre: {$emp->getNombre()}, Salario: {$emp->getSalarioBase()}\n";
        }
    }

    public function calcularNomina() {
        $total = 0;
        foreach ($this->empleados as $emp) {
            if ($emp instanceof Gerente) {
                $total += $emp->getSalarioTotal();
            } else {
                $total += $emp->getSalarioBase();
            }
        }
        return $total;
    }

    public function evaluarEmpleados() {
        foreach ($this->empleados as $emp) {
            if ($emp instanceof Evaluable) {
                $resultado = $emp->evaluarDesempenio();
                echo "{$emp->getNombre()} tiene evaluación: $resultado\n";
            }
        }
    }
}
?>
