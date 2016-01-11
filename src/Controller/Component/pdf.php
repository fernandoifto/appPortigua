<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 class PdfComponent extends Object {

     function Init($html){

            require('pdf/dompdfp.php');

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper('letter', 'landscape');
            $dompdf->render();
            $dompdf->stream("report.pdf");

     }


 }
?>
