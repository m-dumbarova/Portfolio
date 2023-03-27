<?php
//Creating an XSLTProcessor

        //Loading an XSL document
        $xsl = new DOMDocument();
        $xsl->load("simple.xslt");
       // $xsl->loadXML($xslt_var);
        
        //Loading an XML document
        $xml = new DOMDocument();
        $xml->load("library.xml");
       // $xsl->loadXML($xml_var);

        //Creating an XSLTProcessor
        $proc = new XSLTProcessor();

        //Importing the XSL document
        $proc->importStyleSheet($xsl);

        //Transforming the style to XML
        print($proc->transformToXML($xml));

?>