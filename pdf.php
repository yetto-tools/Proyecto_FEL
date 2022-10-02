<?php
require('PDF/fpdf/fpdf.php');
require_once "config.php";




function CrearFacturaPDF($facturaPDF, $db){
    if($facturaPDF!=0){
        $facturaPDF = $facturaPDF;
        $sql = "SELECT c.nit_cliente, c.nombre_cliente, c.direccion_cliente,c.telefono_cliente, c.logo_cliente, f.id_factura, f.nit, f.nombre, f.direccion, f.factura_uuid, date_format(f.fecha, '%d de %M de %Y') as fecha, f.descuento, f.total_factura as total , f.iva_factura as iva, d.no_linea as '#', d.codigo, d.descripcion as producto, d.cantidad, d.precio, d.monto FROM factura f LEFT JOIN factura_detalle d ON d.factura_uuid = f.factura_uuid LEFT JOIN cliente c ON c.id_cliente = f.cliente_id WHERE id_factura =?;";
        // Listar Empresas
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $facturaPDF);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $factura = $result->fetch_all(MYSQLI_ASSOC); // fetch data  
        //$stmt->close();
        // var_dump($factura);
        
    
        // Simple table
        function BasicTable($data)
        {
            $pdf = new FPDF('P', 'cm', 'Letter');
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',10);
            
    
            $pdf->Text(9.8, 2.0, "Empresa:         " .$data[0]['nombre_cliente']); 
            $pdf->Text(9.8, 2.5, "NIT:                   " .$data[0]['nit_cliente']); 
            $pdf->Text(9.8, 3.0, "Direccion:         " .$data[0]['direccion_cliente']);
            $pdf->Text(9.8, 3.5, "Telefono:         " .$data[0]['telefono_cliente']);
    
            $pdf->Text(9.8, 4.5, "Fecha:        " .$data[0]['fecha']);
            $pdf->Text(9.8, 5.2, "No. Factura:    " .$data[0]['factura_uuid'],0,0,'R'); 
            // info factura
            
            $pdf->Text(2.2,  6.5, "Nombre:     " .$data[0]['nombre']);
            $pdf->Text(15.2, 6.5, "NIT:            " .$data[0]['nit'],0,0,'R');
            $pdf->Text(2.2,  7.0, "Direccion:  " .$data[0]['direccion']);
            
    
            // titulo tabla 
            $pdf->SetY(7.5);
            $pdf->Cell(1,0.6,"#");
            $pdf->Cell(2,0.6,"Codigo");
            $pdf->Cell(6,0.6,"Descripcion");
            $pdf->Cell(3,0.6,"Cantidad",0,0,'R');
            $pdf->Cell(2,0.6,"Precio U.",0,0,'R');
            $pdf->Cell(2,0.6,"Monto",0,0,'R');
            $pdf->Ln();
            // detalle factura
            foreach($data as $row){
                $pdf->Cell(1,0.6,$row['#']);
                $pdf->Cell(2,0.6,$row['codigo']);
                $pdf->Cell(6,0.6,$row['producto']);
                $pdf->Cell(3,0.6,$row['cantidad'],0,0,'R');
                $pdf->Cell(2,0.6,$row['precio'],0,0,'R');
                $pdf->Cell(2,0.6,$row['monto'],0,0,'R');
                $pdf->Ln();
            }
            $pdf->Ln();
            // footer tabla
    
            $pdf->SetX(13);
            $pdf->Cell(2,0.6,'Total sin IVA Q.',0,0,'R');
            $pdf->Cell(2,0.6,($data[0]['total']-$data[0]['iva']),0,0,'R');
            $pdf->Ln();
    
            $pdf->SetX(13);
            $pdf->Cell(2,0.6,'Iva.',0,0,'R');
            $pdf->Cell(2,0.6,$data[0]['iva'],0,0,'R');
            $pdf->Ln();
    
            $pdf->SetX(13);
            $pdf->Cell(2,0.6,'Total:',0,0,'R');
            $pdf->Cell(2,0.6,$data[0]['total'],0,0,'R');
            
            $img = explode(',', $data[0]['logo_cliente']);
            $formato = explode("/", explode(';',$img[0])[0])[1];
        
            $rutaImagenSalida = __DIR__."/PDF/logo.".$formato;
            $imagenBinaria = base64_decode(explode(',', $data[0]['logo_cliente'])[1]);
            $bytes = file_put_contents($rutaImagenSalida, $imagenBinaria);
            $pdf->Image($rutaImagenSalida, 2.2,2,-600);
            
            //$pdf->Output;

            $pdf->Output("D", "Factura - " .$data[0]['factura_uuid'].".pdf");
            
        }
        BasicTable($factura);
        header("Location: Facturacion.php");
    }
}


function CrearCertificacionPDF($id_cliente, $fechaInicial, $fechaFinal, $db){
    if(intval($id_cliente)!=0){
        $id_cliente = intval($id_cliente);
        $sql = "SELECT F.id_factura, F.nit, F.nombre, F.direccion,F.factura_uuid,
            F.total_factura,
            C.nombre_cliente,
            C.nit_cliente,
            C.telefono_cliente,
            C.direccion_cliente,
            C.logo_cliente
            FROM factura F
            LEFT JOIN cliente C ON F.cliente_id = C.id_cliente
            WHERE F.cliente_id = ?
            AND fecha BETWEEN  ? AND ? 
            ORDER BY NIT";  
        // Listar Empresas
        $stmt = $db->prepare($sql);
        $stmt->bind_param("iss",$id_cliente,$fechaInicial,$fechaFinal);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        //$titulos = $result->fetch_assoc();
        $certificacion = $result->fetch_all(MYSQLI_ASSOC); // fetch data  
        
    
        // Simple table
        function BasicTable($data)
        {
            $pdf = new FPDF('P', 'cm', 'Letter');
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',9);    

            $pdf->Text(9.8, 2.0, "Empresa:         " .$data[0]['nombre_cliente']); 
            $pdf->Text(9.8, 2.5, "NIT:                   " .$data[0]['nit_cliente']); 
            $pdf->Text(9.8, 3.0, "Direccion:         " .$data[0]['direccion_cliente']);
            $pdf->Text(9.8, 3.5, "Telefono:         " .$data[0]['telefono_cliente']);

            // titulo tabla 
            $pdf->SetY(7.5);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0.6,"-",1,0,'C');
            $pdf->Cell(2,0.6,"NIT",1,0,'C');
            $pdf->Cell(7,0.6,"UUID",1,0,'C');
            $pdf->Cell(5,0.6,"NOMBRE",1,0,'C');
            $pdf->Cell(3,0.6,"DIRECCION",1,0,'C');
            $pdf->Cell(2,0.6,"TOTAL",1,0,'C');
            $pdf->Ln();
            // detalle factura
            foreach($data as $row){
                $pdf->SetFont('Arial','B',7.5);            
                $pdf->Cell(1,0.6,"-",1,0,'C');
                $pdf->Cell(2,0.6,$row['nit'],1,0,'C');
                $pdf->Cell(7,0.6,$row['factura_uuid'],1,0,'C');
                $pdf->Cell(5,0.6,$row['nombre'],1,0,'C');
                $pdf->Cell(3,0.6,$row['direccion'],1,0,'C');
                $pdf->Cell(2,0.6,$row['total_factura'],1,0,'R');
                $pdf->Ln();
            }
            $pdf->Ln();

        
            $formato = explode("/", explode(';',$data[0]['logo_cliente'])[0])[1];
        
            $rutaImagenSalida = __DIR__."/PDF/logo.".$formato;
            $imagenBinaria = base64_decode(explode(',', $data[0]['logo_cliente'])[1]);
            $bytes = file_put_contents($rutaImagenSalida, $imagenBinaria);
            $pdf->Image($rutaImagenSalida, 2.2,2,-600);
           
            $pdf->Output(); 
            //$pdf->Output("D", "Factura - " .$data[0]['factura_uuid'].".pdf");
        }
        BasicTable($certificacion);
        header("Location: certificacion.php");
    }
}







?>