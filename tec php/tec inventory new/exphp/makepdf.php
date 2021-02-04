<?php require_once('../conn/connection.php'); ?>
<?php
    require "fpdf.php";

    /*------get pass value------*/
  $subcatecory= $_POST['cat_N'];
  $model= $_POST['model_N'];

    
    class myPDF extends FPDF{
        function header(){
            $year=date('Y-m');
            //$this->Image('logo.png',10,6);
            $this->SetFont('Arial','B',18);
            
            $this->Cell(200,5,'REPORT ('.$year.') SURVEY',0,0,'C');
            $this->Ln(20);
        }

        function footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','',8);
            $this->Cell(0,10,'page'.$this->PageNo().'/{nb}',0,0,'C');
        }
        
        function missing_table($conn ){
				           $item="SELECT * FROM item";
         				$item_filter_result=mysqli_query($conn,$item) or die (mysql_error($conn));
           
            

            if ($item_filter_result) {
                if (mysqli_num_rows($item_filter_result)>0) {
                  
                    $this->SetFont('Times','B',12);
                    $this->Cell(15,10,'id',1,0,'C');
                    $this->Cell(20,10,'model',1,0,'C');
                    $this->Cell(20,10,'state',1,0,'C');
                    $this->Cell(20,10,'description',1,0,'C');
                    $this->SetFont('Times','',12);
                    while ($item_filter_row = $item_filter_result-> fetch_assoc()){
                        $this->Cell(15,10,$item_filter_row['item_id'],1,0,'L');
                        $this->Cell(20,10,$item_filter_row['name'],1,0,'L');
                        $this->Cell(20,10,$item_filter_row['move_sate'],1,0,'L');
                        $this->Cell(20,10,$item_filter_row['description'],1,0,'L');
                       
                        
                        $this->MultiCell(20,10,4,4);
                        
                    }
                }
            }
            $this->Ln(20);
        }
        
    }

    $pdf = new myPDF('p','mm','A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->missing_table($conn);

    
    
    
    $pdf->Output();
?>