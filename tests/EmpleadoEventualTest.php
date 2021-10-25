<?php 

require_once 'EmpleadoTest.php';
class EmpleadoEventualTest extends EmpleadoTest
{
	public function crear($saldo = 5000, $tope=2000,$n=123,$titular="Fulano")
	{
		$cc = new \App\EmpleadoEventual($n,$titular,$saldo,$tope);
		return $cc;
	}

	public function testNoSePuedeExtraerMasDelTopeDescubierto()
	{
		$c = $this->crear(2000,1000);
		$this->assertEquals("Tope de descubierto excedido",$c -> extraer(4000));
		$this->assertEquals(2000,$c->getSaldo());
	}

}

?>