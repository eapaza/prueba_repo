<?php	function sumar($a, $b)	{		$res = $a + $b;		return $res;	}	function sumar2($a, $b, &$res)	{		$res = $a + $b;	}	function restar($a, $b)	{		$res = $a - $b;		return $res;	}		    function multiplicar($a, $b)	{		$res = $a * $b;		return $res;	}			function dividir($a, $b, &$msg, &$res)	{		try{		   if ($b == 0)		   {			  throw new Exception('divisor 0');		   }		   $res = 0;		   $res = $a / $b;		   $msg = "La division de ".$a." y ".$b." es correcta";		   } catch (Exception $e){		$msg = "La division no puede ser entre 0";		$res = 0;}	}?>