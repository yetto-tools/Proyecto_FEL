<?php
require('../fpdf/fpdf.php');
require_once "config.php";
require_once "session_config.php";

function ReporteClientes($nit, $db){
    $sql = "SELECT 
    F.id_factura,nit, 
    F.nombre, 
    F.factura_uuid, 
    F.direccion, 
    F.iva_factura, 
    F.total_factura, 
    F.creado,
    C.nit_cliente,
    C.nombre_cliente,
    C.direccion_cliente,
    C.telefono_cliente,
    C.logo_cliente
    FROM factura F 
    LEFT JOIN cliente C ON F.cliente_id = C.id_cliente
    WHERE nit=?";  
    // Listar Empresas
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s",$nit);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    //$titulos = $result->fetch_assoc();
    $certificacion = $result->fetch_all(MYSQLI_ASSOC); // fetch data  
    $stmt->close();
            // Simple table
    function BasicTable1($data)
    {
        date_default_timezone_set('America/Guatemala');
        $FechaActual = date('d-m-y h:i:s');

        $pdf = new FPDF('P', 'cm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B', 9);
        //Fecha Generacion
        $pdf->Text(18,0.5,$FechaActual );        
        // 
        $pdf->SetXY(13,2);
        $pdf->Cell(2, 0.5, 'Empresa', 0, 0);
        $pdf->Cell(5, 0.5, $data[0]['nombre_cliente'], 0, 1);
        $pdf->SetX(13);
        $pdf->Cell(2, 0.5, 'NIT', 0, 0); 
        $pdf->Cell(4, 0.5, $data[0]['nit_cliente'], 0, 1); 
        $pdf->SetX(13);
        $pdf->Cell(2, 0.5, 'Direccion', 0, 0);
        $pdf->Cell(5, 0.5, $data[0]['direccion_cliente'], 0, 1);
        $pdf->SetX(13);
        $pdf->Cell(2, 0.5, 'Telefono', 0, 0);
        $pdf->Cell(4, 0.5, $data[0]['telefono_cliente'], 0, 1);

        // // titulo tabla 
        $pdf->SetXY(0.7,6.5);
        $fill = true;
        $border = 1;
        //Restauración de colores y fuentes
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255);
        $pdf->SetFont('','B');
        $pdf->Cell(0.5,0.6,"#",$border,0,'C',$fill);
        $pdf->Cell(2,0.6,'Nit',$border,0,'C',$fill);
        $pdf->Cell(5.5,0.6,'Factura UUID',$border,0,'C',$fill);
        $pdf->Cell(5.5,0.6,'Nombre',$border,0,'C',$fill);
        $pdf->Cell(1.5,0.6,'Fecha',1,0,'C',$fill);
        $pdf->Cell(1.2,0.6,'Hora',1,0,'C',$fill);
        $pdf->Cell(2,0.6,'Impuesto',$border,0,'C',$fill);
        $pdf->Cell(2,0.6,'Total',$border,0,'C',$fill);
        //Datos
        $pdf->Ln();
        $no = 0;
        foreach($data as $row){
            $pdf->SetFont('Arial','', 7);
            $pdf->SetX(0.7);
    
            $border = true;
            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(0);
            $pdf->SetLineWidth(0.01);
            $no++;
            $creado = explode(" ",$row['creado']);
            $fecha = $creado[0]; 
            $hora = $creado[1];
            $pdf->Cell(0.5,0.6,$no,$border,0,'C');
            $pdf->Cell(2,0.6,$row['nit'],$border,0,'C');
            $pdf->Cell(5.5,0.6,$row['factura_uuid'],$border,0,'C');
            $pdf->Cell(5.5,0.6,$row['nombre'],$border,0,'C');
            $pdf->Cell(1.5,0.6,$fecha,1,0,'C');
            $pdf->Cell(1.2,0.6,$hora,1,0,'C');
            $pdf->Cell(2,0.6,"Q. " .$row['iva_factura'],$border,0,'C');
            $pdf->Cell(2,0.6,"Q. " .$row['total_factura'],$border,0,'C');
            $pdf->Ln();
            $fill=false;
        }
        $pdf->Ln();

        $img = explode(',', $data[0]['logo_cliente']);
        $formato = explode("/", explode(';',$img[0])[0])[1];
    
        $rutaImagenSalida = __DIR__."/PDF/logo.".$formato;
        $imagenBinaria = base64_decode(explode(',', $data[0]['logo_cliente'])[1]);
        $bytes = file_put_contents($rutaImagenSalida, $imagenBinaria);
        $pdf->Image($rutaImagenSalida, 2.2,2,-600);
    
        $pdf->Output();
    }
    if (!empty($certificacion)){
        BasicTable1($certificacion);
    }
    

}

 
?>