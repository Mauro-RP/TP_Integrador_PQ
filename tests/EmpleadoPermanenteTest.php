<?php
require_once 'EmpleadoTest.php';
class EmpleadoPermanenteTest extends EmpleadoTest
{
	public function crearEmpleadoPermanente($nombre, $apellido, $dni, $salario, $fechaIngreso)
	{
		$ep = new \App\EmpleadoPermanente($nombre,$apellido,$dni,$salario,$fechaIngreso);
		return $ep;
	}	

	public function testGetFechaDeIngreso()
	{
		$fechaIngreso = new DateTime('2013-03-01 00:00:00');
		$ep = $this->crearEmpleadoPermanente("Nicolas","Prieto",36000111,60000, $fechaIngreso);
		$this->assertEquals($fechaIngreso,$ep->getFechaIngreso());
	}

	public function testSinFechaDeIngresoYSinAntiguedad()
	{
		//Probando que si no se setea la fecha de ingreso, se autoasigna la fecha actual y el calculo de antiguedad resulta cero
		$ep = $this->crearEmpleadoPermanente("Nicolas","Prieto",36000111,60000, null);
		$this->assertEquals(new DateTime (),$ep->getFechaIngreso());
		$this->assertEquals(0,$ep->calcularAntiguedad());
	}

	public function testFechaDeIngresoFutura()
	{
		$fechaIngreso = new DateTime();
		$fechaIngreso->add(new DateInterval('P1Y')); 
		$this->expectException(\Exception::class);
		$ep = $this->crearEmpleadoPermanente("Nicolas","Prieto",36000111,60000, $fechaIngreso);
	}

	public function testCalcularAntiguedad()
	{
		$fechaIngreso = new DateTime('2013-03-01 00:00:00');
		$ep = $this->crearEmpleadoPermanente("Nicolas","Prieto",36000111,60000, $fechaIngreso);
		$this->assertEquals(8, $ep->calcularAntiguedad());
	}

	public function testcalcularComision()
	{
		$fechaIngreso = new DateTime('2013-03-01 00:00:00');
		$ep = $this->crearEmpleadoPermanente("Nicolas","Prieto",36000111,60000,$fechaIngreso);
		$this->assertEquals("8%",$ep->calcularComision());
	}

	public function testcalcularIngresoTotal()
	{
		$fechaIngreso = new DateTime('2013-03-01 00:00:00');
		$ep = $this->crearEmpleadoPermanente("Nicolas","Prieto",36000111,60000,$fechaIngreso);
		$this->assertEquals(60000 + (60000 * (8 / 100)),$ep->calcularIngresoTotal());
	}

}

?>