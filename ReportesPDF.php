<?php
session_start();
require_once "session_config.php";
require('PDF/fpdf/fpdf.php');
require_once "config.php";

//Reporte Cliente
if(!empty($_GET['Reporte-Cliente'])){
    $id = intval($_GET['Reporte-Cliente']);
    // Contriumos el reporte
    function ReporteGeneralPDF($id_cliente, $db){
        $sql = "SELECT
        F.id_factura as ID,
        F.nit AS NIT, 
        F.nombre AS `NOMBRE FACTURACION`, 
        F.factura_uuid AS UUID, 
        F.direccion AS DIRECCION, 
        F.iva_factura AS `IVA POR PAGAR`, 
        F.total_factura AS `TOTAL FACTURA`, 
        F.creado AS `FECHA CREACION`,
        C.nit_cliente AS `NIT CLIENTE`,
        C.nombre_cliente AS `NOMBRE CLIENTE`,
        C.direccion_cliente AS `DIRECCION CLIENTE`,
        C.telefono_cliente AS `TELEFONO CLIENTE`,
        C.logo_cliente AS LOGO
        FROM factura F 
        LEFT JOIN cliente C ON F.cliente_id = C.id_cliente
        WHERE C.id_cliente= ?";  
        // Listar Empresas
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s",$id_cliente);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        //$titulos = $result->fetch_assoc();
        $certificacion = $result->fetch_all(MYSQLI_ASSOC); // fetch data  
        $stmt->close();
    
        function BasicTable1($data)
        {
            date_default_timezone_set('America/Guatemala');
            $FechaActual = "Fecha de Generacion: ".date('d-m-y h:i:s');
    
            $pdf = new FPDF('P', 'cm', 'Letter');
            $pdf->AddPage();
            $pdf->SetFont('Arial','', 10);
            //Fecha Generacion
            
            $pdf->Text(7,1,$FechaActual );        
    
            $pdf->SetFont('Arial','B', 18);
            // TITULO
            $pdf->SetXY(7,1);
            $pdf->Cell(3, 2, 'REPORTE CLIENTE', 0, 0);
            $pdf->SetFont('Arial','B', 10);
            // 
            $pdf->SetXY(13,3);
            $pdf->Cell(2, 0.5, 'Empresa', 0, 0);
            $pdf->Cell(5, 0.5, $data[0]['NOMBRE CLIENTE'], 0, 1);
            $pdf->SetX(13);
            $pdf->Cell(2, 0.5, 'NIT', 0, 0); 
            $pdf->Cell(4, 0.5, $data[0]['NIT'], 0, 1); 
            $pdf->SetX(13);
            $pdf->Cell(2, 0.5, 'Direccion', 0, 0);
            $pdf->Cell(5, 0.5, $data[0]['DIRECCION CLIENTE'], 0, 1);
            $pdf->SetX(13);
            $pdf->Cell(2, 0.5, 'Telefono', 0, 0);
            $pdf->Cell(4, 0.5, $data[0]['TELEFONO CLIENTE'], 0, 1);
    
            // // titulo tabla 
            $pdf->SetXY(0.7,6.5);
            $fill = true;
            $border = 1;
            //Restauraci??n de colores y fuentes
            $pdf->SetFillColor(0,0,0);
            $pdf->SetTextColor(255);
            $pdf->SetFont('','B',9);
            $pdf->Cell(0.6, 0.6,"ID",$border,0,'C',$fill);
            $pdf->SetFont('','B',9);
            $pdf->Cell(2,0.6,'NIT',$border,0,'C',$fill);
            $pdf->SetFont('','B',9);
            $pdf->Cell(4.5,0.6,'FACTURA A NOMBRE DE:',$border,0,'C',$fill);
            $pdf->SetFont('','B',9);
            $pdf->Cell(1.8,0.6,'TOTAL Q.',$border,0,'C',$fill);
            $pdf->SetFont('','B',9);
            $pdf->Cell(1.3,0.6,'IVA Q.',1,0,'C',$fill);
            $pdf->SetFont('','B',9);
            $pdf->Cell(6.5,0.6,'UUID',$border,0,'C',$fill);
            $pdf->SetFont('','B',9);
            $pdf->Cell(2,0.6,'FECHA',$border,0,'C',$fill);
            $pdf->SetFont('','B',9);
            $pdf->Cell(1.5,0.6,'HORA',$border,0,'C',$fill);
    
            //Datos
            $pdf->Ln();
            $no = 0;

            foreach($data as $row){
                $pdf->SetFont('Arial','', 8);
                $pdf->SetX(0.7);
        
                $border = true;
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0);
                $pdf->SetLineWidth(0.01);
                $no++;
                
                $creado = explode(" ",$row['FECHA CREACION']);
                $FECHA_FACTURA = $creado[0]; 
                $HORA_FACTURA = $creado[1];
                $pdf->Cell(0.6,0.6,$row["ID"],$border,0,'C');
                $pdf->Cell(2,0.6,$row['NIT'],$border,0,'C');
                $pdf->Cell(4.5,0.6,$row['NOMBRE FACTURACION'],$border,0,'C');
                $pdf->Cell(1.8,0.6,$row['TOTAL FACTURA'],$border,0,'R');
                $pdf->Cell(1.3,0.6,$row['IVA POR PAGAR'],$border,0,'R');
                $pdf->Cell(6.5,0.6,$row['UUID'],$border,0,'R');
                $pdf->Cell(2,0.6,$FECHA_FACTURA,$border,0,'C');
                $pdf->Cell(1.5,0.6,$HORA_FACTURA,$border,0,'C');
                $pdf->Ln();
                $fill=false;
            }
            $pdf->Ln();
    
            $img = explode(',', $data[0]['LOGO']);
            $formato = explode("/", explode(';',$img[0])[0])[1];
        
            $rutaImagenSalida = __DIR__."/PDF/logo.".$formato;
            $imagenBinaria = base64_decode(explode(',', $data[0]['LOGO'])[1]);
            $bytes = file_put_contents($rutaImagenSalida, $imagenBinaria);
            $pdf->Image($rutaImagenSalida, 4,3,-600);
        
            //$file = $pdf->Output("");
            $pdf->Output("D",$data[0]['NOMBRE CLIENTE']."- Reporte Cliente".".pdf");
        }
        if (!empty($certificacion)){
            BasicTable1($certificacion);
        }
        else{
            echo "No hay Informacion Disponible";
        }
        
       
    }

    // Generamos el reporte
    ReporteGeneralPDF($id, $db);   
}
//Fin Reporte Cliente

//Reporte General
if(!empty($_GET['Reporte-General'])){
    $id = intval($_GET['Reporte-General']);
    // Contriumos el reporte
    function ReporteGeneralPDF($id_cliente, $db){
        $sql = "SELECT
        C.id_cliente AS ID,
        C.nit_cliente AS NIT,
        C.nombre_cliente AS NOMBRE,
        C.direccion_cliente AS DIRECCION,
        C.telefono_cliente AS TELEFONO,
        C.logo_cliente AS LOGO,
        sum(distinct F.iva_factura) as IVA,
        sum(distinct F.total_factura) as TOTAL_FACTURADO,
        NOW() as 'FECHA_GENERADO'
        FROM factura F 
        LEFT JOIN cliente C ON F.cliente_id = C.id_cliente
        WHERE C.id_cliente = ?
        group by id_cliente;";  
        // Listar Empresas
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s",$id_cliente);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        //$titulos = $result->fetch_assoc();
        $certificacion = $result->fetch_all(MYSQLI_ASSOC); // fetch data  
        $stmt->close();
    
        function BasicTable1($data)
        {
            date_default_timezone_set('America/Guatemala');
            $FechaActual = "Fecha de Generacion: ".date('d-m-y h:i:s');
    
            $pdf = new FPDF('P', 'cm', 'Letter');
            $pdf->AddPage();
            $pdf->SetFont('Arial','', 10);
            //Fecha Generacion
            
            $pdf->Text(7,1,$FechaActual );        
    
            $pdf->SetFont('Arial','B', 18);
            // TITULO
            $pdf->SetXY(7,1);
            $pdf->Cell(3, 2, 'REPORTE GENERAL', 0, 0);
            $pdf->SetFont('Arial','B', 10);
            // 
            $pdf->SetXY(13,3);
            $pdf->Cell(2, 0.5, 'Empresa', 0, 0);
            $pdf->Cell(5, 0.5, $data[0]['NOMBRE'], 0, 1);
            $pdf->SetX(13);
            $pdf->Cell(2, 0.5, 'NIT', 0, 0); 
            $pdf->Cell(4, 0.5, $data[0]['NIT'], 0, 1); 
            $pdf->SetX(13);
            $pdf->Cell(2, 0.5, 'Direccion', 0, 0);
            $pdf->Cell(5, 0.5, $data[0]['DIRECCION'], 0, 1);
            $pdf->SetX(13);
            $pdf->Cell(2, 0.5, 'Telefono', 0, 0);
            $pdf->Cell(4, 0.5, $data[0]['TELEFONO'], 0, 1);
    
            // // titulo tabla 
            $pdf->SetXY(0.7,6.5);
            $fill = true;
            $border = 1;
            //Restauraci??n de colores y fuentes
            $pdf->SetFillColor(0,0,0);
            $pdf->SetTextColor(255);
            $pdf->SetFont('','B',9);
            $pdf->Cell(1, 0.6,"ID",$border,0,'C',$fill);
            $pdf->SetFont('','B',12);
            $pdf->Cell(3,0.6,'nit',$border,0,'C',$fill);
            $pdf->SetFont('','B',12);
            $pdf->Cell(8,0.6,'EMPRESA',$border,0,'C',$fill);
            $pdf->SetFont('','B',12);
            $pdf->Cell(4,0.6,'IVA POR PAGAR',1,0,'C',$fill);
            $pdf->SetFont('','B',12);
            $pdf->Cell(4,0.6,'FACTURADO',$border,0,'C',$fill);
    
            //Datos
            $pdf->Ln();
            $no = 0;
            foreach($data as $row){
                $pdf->SetFont('Arial','', 12);
                $pdf->SetX(0.7);
        
                $border = true;
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0);
                $pdf->SetLineWidth(0.01);
                $no++;
                
                $creado = explode(" ",$row['FECHA_GENERADO']);
                $fecha = $creado[0]; 
                $hora = $creado[1];
                $pdf->Cell(1.5,0.6,$row["ID"],$border,0,'C');
                $pdf->Cell(3,0.6,$row['NIT'],$border,0,'C');
                $pdf->Cell(7.5,0.6,$row['NOMBRE'],$border,0,'C');
                $pdf->Cell(4,0.6,"Q. " .$row['IVA'],$border,0,'C');
                $pdf->Cell(4,0.6,"Q. " .$row['TOTAL_FACTURADO'],$border,0,'C');
                $pdf->Ln();
                $fill=false;
            }
            $pdf->Ln();
    
            $img = explode(',', $data[0]['LOGO']);
            $formato = explode("/", explode(';',$img[0])[0])[1];
        
            $rutaImagenSalida = __DIR__."/PDF/logo.".$formato;
            $imagenBinaria = base64_decode(explode(',', $data[0]['LOGO'])[1]);
            $bytes = file_put_contents($rutaImagenSalida, $imagenBinaria);
            $pdf->Image($rutaImagenSalida, 4,3,-600);
        
            //$pdf->Output("");
            $pdf->Output("D",$data[0]['NOMBRE']."- Reporte General".".pdf");
        }
        if (!empty($certificacion)){
            BasicTable1($certificacion);
        }
        else{
            echo "No hay Informacion Disponible";
        }
        
       
    }

    // Generamos el reporte
    ReporteGeneralPDF($id, $db);   
}
//Fin Reporte General 

//Reporte status
if(!empty($_GET['Reporte-Estatus'])){
    $id = intval($_GET['Reporte-Estatus']);
    // Contriumos el reporte
    function ReporteGeneralPDF($id_cliente, $db){
        $sql = "SELECT 
            C.id_cliente as ID, 
            C.nit_cliente AS NIT, 
            C.nombre_cliente AS NOMBRE, 
            C.direccion_cliente AS DIRECCION, 
            C.telefono_cliente AS TELEFONO, 
            C.verificado VERIFICADO, 
            C.creado FECHA_GENERADO,
            C.logo_cliente as LOGO, 
            C.actualizado, 
            IF(F.estado_id = 2, 'OMISOS', 'SIN OMISO' ) AS OMISO, 
            F.estado_id, 
            F.id_factura, 
            F.nit  AS 'NIT FACTURA'
        FROM cliente C 
            LEFT JOIN factura F 
                ON F.cliente_id = C.id_cliente 
            GROUP BY id_cliente 
            ORDER BY C.nombre_cliente ASC;        
        ";  
        // Listar Empresas
        $stmt = $db->prepare($sql);
        //$stmt->bind_param("s",$id_cliente);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        //$titulos = $result->fetch_assoc();
        $certificacion = $result->fetch_all(MYSQLI_ASSOC); // fetch data  
        $stmt->close();
    
        function BasicTable1($data)
        {
            date_default_timezone_set('America/Guatemala');
            $FechaActual = "Fecha de Estatus: ".date('d-m-y h:i:s');
    
            $pdf = new FPDF('P', 'cm', 'Letter');
            $pdf->AddPage();
            $pdf->SetFont('Arial','', 10);
            //Fecha Generacion
            
            $pdf->Text(7,1,$FechaActual );        
    
            $pdf->SetFont('Arial','B', 18);
            // TITULO
            $pdf->SetXY(7,1);
            $pdf->Cell(3, 2, 'REPORTE ESTATUS', 0, 0);
            $pdf->SetFont('Arial','B', 10);
            // 
            $pdf->SetXY(13,3);
            $pdf->Cell(2, 0.5, 'Empresa', 0, 0);
            $pdf->Cell(5, 0.5, $data[0]['NOMBRE'], 0, 1);
            $pdf->SetX(13);
            $pdf->Cell(2, 0.5, 'NIT', 0, 0); 
            $pdf->Cell(4, 0.5, $data[0]['NIT'], 0, 1); 
            $pdf->SetX(13);
            $pdf->Cell(2, 0.5, 'Direccion', 0, 0);
            $pdf->Cell(5, 0.5, $data[0]['DIRECCION'], 0, 1);
            $pdf->SetX(13);
            $pdf->Cell(2, 0.5, 'Telefono', 0, 0);
            $pdf->Cell(4, 0.5, $data[0]['TELEFONO'], 0, 1);
    
            // // titulo tabla 
            $pdf->SetXY(0.7,6.5);
            $fill = true;
            $border = 1;
            //Restauraci??n de colores y fuentes
            $pdf->SetFillColor(0,0,0);
            $pdf->SetTextColor(255);
            $pdf->SetFont('Arial','B',8.5);
            $pdf->Cell(0.9, 0.6,"ID",$border,0,'C',$fill);
            $pdf->SetFont('Arial','B',8.5);
            $pdf->Cell(2,0.6,'NIT',$border,0,'C',$fill);
            $pdf->SetFont('Arial','B',8.5);
            $pdf->Cell(4.5,0.6,'NOMBRE',$border,0,'C',$fill);
            $pdf->SetFont('Arial','B',8.5);
            $pdf->Cell(6,0.6,'DIRECCION',1,0,'C',$fill);
            $pdf->SetFont('Arial','B',8.5);
            $pdf->Cell(2,0.6,'ESTATUS',$border,0,'C',$fill);
            $pdf->Cell(2,0.6,'ID FACTURA',$border,0,'C',$fill);
            $pdf->Cell(2.5,0.6,'FECHA',$border,0,'C',$fill);
    
            //Datos
            $pdf->Ln();
            $no = 0;
            foreach($data as $row){
                $pdf->SetFont('Arial','', 8);
                $pdf->SetX(0.7);
                $fecha_facura ="";
                $border = true;
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0);
                $pdf->SetLineWidth(0.01);
                $no++;
                
                $creado = explode(" ",$row['FECHA_GENERADO']);
                $fecha = $creado[0]; 
                $hora = $creado[1];
                $pdf->Cell(0.9,0.6,$row["ID"],$border,0,'C');
                $pdf->Cell(2,0.6,$row['NIT'],$border,0,'R');
                $pdf->Cell(4.5,0.6,$row['NOMBRE'],$border,0,'C');
                $pdf->Cell(6,0.6,$row['DIRECCION'],$border,0,'C');
                if($row['OMISO'] =="OMISOS"){
                  $pdf->SetFillColor(200,0,0);
                  $fecha_facura =  $row['FECHA_GENERADO'];
                }else{
                    $pdf->SetFillColor(0,200,0);
                    $fecha_facura = "";
                }
                $pdf->SetFont('Arial','B', 6.5);
                $pdf->Cell(2,0.6,$row['OMISO'],$border,0,'C',1);
                $pdf->Cell(2,0.6,$row['id_factura'],$border,0,'C',0);
                $pdf->Cell(2.5,0.6,$fecha_facura,$border,0,'C',0);
                $pdf->Ln();
                $fill=false;
            }
            $pdf->Ln();
    
            $img = explode(',', $data[0]['LOGO']);
            $formato = explode("/", explode(';',$img[0])[0])[1];
        
            $rutaImagenSalida = __DIR__."/PDF/logo.".$formato;
            $imagenBinaria = base64_decode(explode(',', $data[0]['LOGO'])[1]);
            $bytes = file_put_contents($rutaImagenSalida, $imagenBinaria);
            $pdf->Image($rutaImagenSalida, 4,3,-600);
        
            //$pdf->Output("");
            $pdf->Output("D",$data[0]['NOMBRE']."- Reporte Estatus".".pdf");
        }
        if (!empty($certificacion)){
            BasicTable1($certificacion);
        }
        else{
            echo "No hay Informacion Disponible";
        }
        
       
    }

    // Generamos el reporte
    ReporteGeneralPDF($id, $db);   
}
//Fin Reporte Status 

//Reporte SAT
if(!empty($_GET['Reporte-SAT'])){
    $id = intval($_GET['Reporte-SAT']);
    // Contriumos el reporte
    function ReporteGeneralPDF($id_cliente, $db){
        $sql = "SELECT
        C.id_cliente AS ID,
        C.nit_cliente AS NIT,
        C.nombre_cliente AS NOMBRE,
        C.direccion_cliente AS DIRECCION,
        C.telefono_cliente AS TELEFONO,
        C.logo_cliente AS LOGO
        FROM cliente C ";  
        // Listar Empresas
        $stmt = $db->prepare($sql);
        //$stmt->bind_param("s",$id_cliente);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        //$titulos = $result->fetch_assoc();
        $certificacion = $result->fetch_all(MYSQLI_ASSOC); // fetch data  
        $stmt->close();
    
        function BasicTable1($data, $db)
        {
            date_default_timezone_set('America/Guatemala');
            $FechaActual = "Fecha de Generacion: ".date('d-m-y h:i:s');
    
            $pdf = new FPDF('P', 'cm', 'Letter');
            $pdf->AddPage();
            $pdf->SetFont('Arial','', 10);
            //Fecha Generacion
            
            $pdf->Text(7,1,$FechaActual );        
    
            $pdf->SetFont('Arial','B', 18);
            // TITULO
            $pdf->SetXY(7,1);
            $pdf->Cell(3, 2, 'REPORTE SAT', 0, 0);
            $pdf->SetFont('Arial','B', 10);
            // 
            $pdf->SetXY(13,3);
            $pdf->Cell(2, 0.5, 'Empresa', 0, 0);
            $pdf->Cell(5, 0.5, $data[0]['NOMBRE'], 0, 1);
            $pdf->SetX(13);
            $pdf->Cell(2, 0.5, 'NIT', 0, 0); 
            $pdf->Cell(4, 0.5, $data[0]['NIT'], 0, 1); 
            $pdf->SetX(13);
            $pdf->Cell(2, 0.5, 'Direccion', 0, 0);
            $pdf->Cell(5, 0.5, $data[0]['DIRECCION'], 0, 1);
            $pdf->SetX(13);
            $pdf->Cell(2, 0.5, 'Telefono', 0, 0);
            $pdf->Cell(4, 0.5, $data[0]['TELEFONO'], 0, 1);
    

            $sql = "SELECT
            F.id_factura AS ID,
            F.nit AS NIT_CLIENTE,
            F.nombre AS NOMBRE,
            F.direccion AS DIRECCION,
            F.fecha AS FECHA_FACTURA,
            F.factura_uuid AS UUID,
            F.iva_factura AS IVA,
            F.total_factura  AS TOTAL,
            F.creado AS FECHA,
            C.nombre_cliente as EMPRESA,
            C.nit_cliente as NIT_EMPRESA
            FROM factura F
            JOIN cliente C ON C.id_cliente = F.cliente_id
            WHERE f.estado_id  <> 2 ";  
            // Listar Empresas
            $stmt = $db->prepare($sql);
            //$stmt->bind_param("s",$id_cliente);
            $stmt->execute();
            $result = $stmt->get_result(); // get the mysqli result
            //$titulos = $result->fetch_assoc();
            $data_facturas = $result->fetch_all(MYSQLI_ASSOC); // fetch data  
            $stmt->close();
            // // titulo tabla 
            $pdf->SetXY(0.7,6.5);
            $fill = true;
            $border = 1;
            //Restauraci??n de colores y fuentes
            $pdf->SetFillColor(0,0,0);
            $pdf->SetTextColor(255);
            $pdf->SetFont('','B',7);
            $pdf->Cell(0.7, 0.6,"ID",$border,0,'C',$fill);
            $pdf->SetFont('','B',7);
            $pdf->Cell(1.5,0.6,'NIT',$border,0,'C',$fill);
            $pdf->SetFont('','B',7);
            $pdf->Cell(4,0.6,'EMPRESA',$border,0,'C',$fill);
            $pdf->SetFont('','B',7);
            $pdf->Cell(6,0.6,'CLIENTE FACTURA',$border,0,'C',$fill);
            $pdf->SetFont('','B',7);
            $pdf->Cell(1.5,0.6,'NIT',$border,0,'C',$fill);
            $pdf->SetFont('','B',7);
            $pdf->Cell(2,0.6,'IVA POR PAGAR',1,0,'C',$fill);
            $pdf->SetFont('','B',7);
            $pdf->Cell(4,0.6,'FACTURADO',$border,0,'C',$fill);
    
            //Datos
            $pdf->Ln();
            $no = 0;
            foreach($data_facturas as $rowFactura){
                $pdf->SetFont('Arial','', 6);
                $pdf->SetX(0.7);
        
                $border = true;
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0);
                $pdf->SetLineWidth(0.01);
                $no++;
                
                $creado = explode(" ",$rowFactura['FECHA']);
                $fecha = $creado[0]; 
                $hora = $creado[1];
                $pdf->Cell(0.7,0.6,$rowFactura["ID"],$border,0,'C');
                $pdf->Cell(1.5,0.6,$rowFactura['NIT_EMPRESA'],$border,0,'C');
                $pdf->Cell(4,0.6,$rowFactura['EMPRESA'],$border,0,'C');
                $pdf->Cell(6,0.6,$rowFactura['NOMBRE'],$border,0,'C');
                $pdf->Cell(1.5,0.6,$rowFactura['NIT_CLIENTE'],$border,0,'C');
                $pdf->Cell(2,0.6,"Q. " .$rowFactura['IVA'],$border,0,'C');
                $pdf->Cell(4,0.6,"Q. " .$rowFactura['TOTAL'],$border,0,'C');
                $pdf->Ln();
                $fill=false;
            }
            $pdf->Ln();
    
            $img = explode(',', $data[0]['LOGO']);
            $formato = explode("/", explode(';',$img[0])[0])[1];
        
            $rutaImagenSalida = __DIR__."/PDF/logo.".$formato;
            $imagenBinaria = base64_decode(explode(',', $data[0]['LOGO'])[1]);
            $bytes = file_put_contents($rutaImagenSalida, $imagenBinaria);
            $pdf->Image($rutaImagenSalida, 4,3,-600);
        
            //$pdf->Output("");
            $pdf->Output("D",$data[0]['NOMBRE']."- Reporte SAT".".pdf");
        }
        if (!empty($certificacion)){
            BasicTable1($certificacion, $db);
        }
        else{
            echo "No hay Informacion Disponible";
        }
        
       
    }

    // Generamos el reporte
    ReporteGeneralPDF($id, $db);   
}
//Fin Reporte SAT

?>