<?php

include_once './Classes/XML.php';
include_once './Classes/Comprobante.php';
include_once './Classes/Emisor.php';

class CFDI
{
    protected $comprobante;
    protected $xml;

    function __construct()
    {
        $this->comprobante = new Comprobante();
        $this->emisor = new Emisor();
    }

    //?No se especifica el funcionamiento mas a detalle en el ejercicio
    //? Asi que se decide cambiar el metodo a public
    public function getNode()
    {
        $this->xml = '<?xml version="1.0" encoding="UTF-8"?> <cfdi:Comprobante  xmlns:cfdi="http://www.sat.gob.mx/cfd/3"  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" ' . $this->comprobante->getAtributes() . ' >';
        $this->xml .= $this->emisor->getNode(); 
        $this->xml .= '</cfdi:Comprobante>';
        return $this->xml;
    }
    //? Se agrega función para poder accesar al metodo de la clase XML que permite mandar los atributos
    //?Como se especifica si se requiere que se haga una función especifica el atributo se agrega como key
    public function setAtributos( $attrib, $valor, $key ){
        $key == (string) 'Comprobante' ? $this->comprobante->setAtribute( $attrib, $valor ) : $this->emisor->setAtribute( $attrib, $valor );
    }
}