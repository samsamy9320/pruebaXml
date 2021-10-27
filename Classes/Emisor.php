<?php

class Emisor extends XML
{

    public $regimenFiscal;

    /*Se remueve la propiedad protected bajo la siguiente condicion:
      The constructor may be made private or protected to prevent it from being called externally
    */
    function __construct()
    {
        $this->atributos = [];
        $this->atributos['Rfc'] = ''; //? Fue necesario agregar la propiedad de Rfc para que se muestre en la impresión
        $this->atributos['Nombre'] = '';
        $this->atributos['RegimenFiscal'] = '';
        $this->rules = [];
        //!FIXME: Unicamente se indica que se agreguen los campos faltantes sin indicar si todos seran requeridos
        $this->rules['Rfc'] = 'R'; //? En base a las condiciones se debe agregar como requerido
        $this->rules['Nombre'] = 'R';
        $this->rules['RegimenFiscal'] = 'R';
    }

    public function getNode()
    {
        $xml = '<cfdi:Emisor ' . $this->getAtributes() . ' />';
        return $xml;
    }
}
