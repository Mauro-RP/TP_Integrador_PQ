<?php 
class EmpleadoTest extends \PHPUnit\Framework\TestCase 
{
	public function crear($nombre, $apellido, $dni, $salario=0, $sector="No especificado")
	{
		$e = new \App\Empleado($nombre,$apellido,$dni,$salario,$sector);
		return $e;
	}

	public function testNombreApellidoDelEmpleado()
	{
		$e = $this->crear("Nicolas","Prieto",36000111,60000,'e');
		$this->assertEquals("Nicolas Prieto",$e->getNombreApellido());
	}

	public function testNoSePuedeCrearConNombreVacio()
	{
		$this->expectException(\Exception::class);
		$a = $this->crear("","Prieto",36000111,60000,'e');
	}

	public function testNoSePuedeCrearConApellidoVacio()
	{
		$this->expectException(\Exception::class);
		$b = $this->crear("Nicolas","",36000111,60000,'p');
	}

	public function testDNIDelEmpleado()
	{
		$e = $this->crear("Nicolas","Prieto",36111222,60000,'e');
		$this->assertEquals(36111222,$e->getDNI());
	}

	public function testNoSePuedeConstruirConDNIconteniendoLetras()
	{
		$this->expectException(\Exception::class);
		$e = $this->crear("Nicolas","Prieto",'361a12b2',60000,'p');
	}

	public function testNoSePuedeConstruirConDNIvacio()
	{
		$this->expectException(\Exception::class);
		$e = $this->crear("Nicolas","Prieto","",60000,'p');
	}

	public function testSalarioDelEmpleado()
	{
		$e = $this->crear("Nicolas","Prieto",36444555,60000);
		$this->assertEquals(60000,$e->getSalario());
	}

	public function testNoSePuedeConstruirConSalarioVacio()
	{
		$this->expectException(\Exception::class);
		$e = $this->crear("Nicolas","Prieto",36555666,"",'p');
	}

	public function testGetYSetSectorDelEmpleado()
	{
		$e = $this->crear("Nicolas","Prieto",36207505,60000); //'p' de Permanente
		$e -> setSector('e');
		$this->assertEquals('e',$e->getSector());
	}

	public function test__toString()
	{
		$e = $this->crear("Nicolas","Prieto",36207505,60000);
		$this->assertEquals("Nicolas Prieto 36207505 60000",$e->__toString());
	}

	public function testSiNoSeEspecificaElSector()
	{
		$d = $this->crear("Nicolas","Prieto",36207505,60000); //'p' de Permanente
		$this->assertEquals("No especificado",$d->getSector());
	}

}

?>