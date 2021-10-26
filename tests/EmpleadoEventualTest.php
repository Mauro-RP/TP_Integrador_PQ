<?php 
require_once 'EmpleadoTest.php';
class EmpleadoEventualTest extends EmpleadoTest
{
	private $ventas = array(100,200,300,400,500);

	public function crearEE($nombre, $apellido, $dni, $salario, $montos)
	{
		$ee = new \App\EmpleadoEventual($nombre,$apellido,$dni,$salario,$montos);
		return $ee;
	}

	public function testCalcularComision()
	{
		$empE = $this->crearEE("Fulano","Cualquiera",36111222,70000,$this->ventas);
		$com = (1500 / count($this->ventas)) * 0.05;
		$this->assertEquals($com, $empE -> calcularComision());
	}

	public function testCalcularIngresoTotal()
	{
		$empE = $this->crearEE("Fulano","Cualquiera",36111222,70000,$this->ventas);
		$this->assertEquals(70000 + $empE -> calcularComision(), $empE -> calcularIngresoTotal());	
	}

	public function testProbarMontoDeVentaNegativoYCero()
	{
		$this->expectException(\Exception::class);
		$vent = array(100,200,300,-400,500);
		$empE = $this->crearEE("Fulano","Cualquiera",36111222,70000,$vent);
	}

	public function testProbarMontoDeVentaCero()
	{
		$this->expectException(\Exception::class);
		$vents = array(100,200,300,0,500);
		$empEv = $this->crearEE("Fulano","Cualquiera",36111222,70000,$vents);
	}

}

?>