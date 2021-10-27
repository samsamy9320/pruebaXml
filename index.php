<?php

include_once './CFDI.php';

class Main
{
    private $cfdi_xml;
    private $array_data = [
        "Comprobante" => [
            "LugarExpedicion" => "64000",
            "TipoDeComprobante" => "i",
            "Moneda" => "MXN",
            "SubTotal" => "100",
            "Total" => "116",
            "FormaPago" => "01",
            "NoCertificado" => "00000010101010101",
            "Fecha" => "2021-10-06 11:00:00"
        ],
        "Emisor" => [
            "Rfc" => "TME960709LR2",
            "Nombre" => "Tracto Camiones s.a de c.v", //!FIXME: se requiere S.A de C.V??
            "RegimenFiscal" => "612"
        ]
    ];

    /*Se remueve la propiedad protected bajo la siguiente condicion:
      The constructor may be made private or protected to prevent it from being called externally
    */
    function __construct()
    {
        $this->cfdi_xml = new CFDI();
    }

    //?No se especifica si la aplicación tendra otros alcances
    /* En base a otras aplicaciones desarrolladas y a ejemplos que se encuentran en la documentacion oficial se obtiene lo siguiente:
        The 'final' keyword is extremely useful.  Inheritance is also useful, but can be abused and becomes problematic in large applications.  If you ever come across a finalized class or method that you wish to extend, write a decorator instead.
    */
    //? En base al comentario de arriba se decide accesarla con la propiedad public
    public function createXML()
    {
        //Obtener el XML por medio de la clase XML
        foreach ($this->array_data as $key => $value) :
             foreach ($value as $attribute => $value) : //? Se decide mandar la Key para no repetir metodos y poderlo hacer mas escalable
                $this->cfdi_xml->setAtributos( $attribute,  $value, $key );
             endforeach;
        endforeach;
        //? Se manda a traer la info de los nodos
        echo strval($this->cfdi_xml->getNode()); //? En el README unicamente se especifica que se requiere un string con los datos del array 
    }

}

try {
    $main = new Main(); //?Se inicializa la clase
    $main->createXML();
} catch (\Exception $error) {
    echo $error->getMessage();
}