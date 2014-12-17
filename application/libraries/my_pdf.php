<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_PDF {

    public function My_PDF() {
        require_once('html2pdf_v4.03/html2pdf.class.php');
    }

}

?>