<?php
//Incluimos la clase del LDAP para las validaciones contra el LDAP
require_once('adLDAP.php');
$ldapIniciado        = false;
$adldap              = '';
$authUser            = false;

//Incluimos la clase para el SOAP
include_once 'soap_nav.php';
function iniciaWS()
{
	global $ldapIniciado, $adldap, $authUser;
	if (!$ldapIniciado) {
		$adldap = new adLDAP();
		//Usuario y password del DOMINIO con acceso a NAV
		$username = "USUARIO DEL DOMINIO";
		$password = "PASSWORD DEL USUARIO DEL DOMINIO";
		$authUser = $adldap->authenticate($username, $password);
	}
	if ($authUser) {
		stream_wrapper_unregister('http');
		stream_wrapper_register('http', 'NTLMStream') or die("Error al registrar el protocolo");
	}
	return ($authUser);
}
function ValidaUsuario($dominio, $usuario, $password)
{
	$GLOBALS['USERPWD'] = $dominio . '.local\\' . $usuario . ':' . $password;
}
function iniciaWSlocal()
{
	global $ldapIniciado, $adldap, $authUser;
	stream_wrapper_unregister('http');
	stream_wrapper_register('http', 'NTLMStream') or die("Error al registrar el protocolo");
	return true;
}
class consultaWS extends NTLMSoapClient
{
	function __construct($empresa, $codeunit, $baseURL)
	{
		//URL WEB SERVICE NAV						
		parent::__construct($baseURL . '/' . $empresa . '/Codeunit/' . $codeunit, array("exceptions" => 0));
	}
	function ejecucionErronea($result)
	{
		if (isset($result->faultcode)) {
			var_export($result);
			die("Funcion: " . $this->__last_request_headers[4] . "</br>Error Navision:" . $result->detail->string . "</br>");
		}
	}
}
class consultaPageWS extends NTLMSoapClient
{
	function __construct($empresa, $codeunit, $baseURL)
	{
		//URL WEB SERVICE NAV		
		parent::__construct($baseURL . '/' . $empresa . '/Page/' . $codeunit, array("exceptions" => 0));
		//parent::NTLMSoapClient($link, array("exceptions" => 0));
	}
	function ejecucionErronea($result)
	{
		if (isset($result->faultcode)) {
			var_export($result);
			die("Funcion: " . $this->__last_request_headers[4] . "</br>Error Navision:" . $result->detail->string . "</br>");
		}
	}
}
function finalizaWS()
{
	stream_wrapper_restore('http');
}
