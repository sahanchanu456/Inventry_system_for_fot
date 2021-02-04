<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  } 
?>
<?php require_once('external.php'); ?>
<?php require_once('connection.php'); ?>

<?php 
	//echo "ok";

	$tabel_body = "";
  	$table_name = "";
  	$table_head = "";
 	$select = "";

 	
      $select = mysqli_real_escape_string($conn,$_GET['selected']);
      //$select = "NSI";

      	include('pdf_survayreport.php');
	
		//make new object
		
		$pdf = new PDF_MC_Table();
		
		
		//add page, set font
		
		
		//$pdf = new FPDF('P','mm','A3');
		$pdf->AddPage('L', 'A3', 0);
		
		
		$pdf->SetFont('Arial','B',20);

		//set line height. This is the height of each lines, not rows.
		$pdf->SetLineHeight(5);
		

   		if ($select=="NSI") {
   			$table_name = "New Survey Item";
   			$pdf->Cell(40,5,$table_name,0,0,'L',0);

   			//set width for each column 
			$pdf->SetWidths(Array(30,30,25,25,30,35,30,20,25,35,25,25,30,30));

   			//add table heading using standard cells
			//set font to bold
		   	$pdf->Ln();
		   	$pdf->Ln();
			$pdf->SetFont('Arial','B',10);
			
			$pdf->Row(Array(
		      "surver_id",
		      "surve_id",
		      "date",
		      "item_id",
		      "item_name",
		      "item_department",
		      "model_name",
		      "catagory",
		      "move_state",
		      "warranty",
		      "add_user",
		      "move_department",
		      "current_department",
		      "current_state",
		    ));
          	
          	$query = "SELECT * FROM surver_data";
          	$result = mysqli_query($conn,$query);
          	if ($result) {
          	  if (mysqli_num_rows($result)>0) {
          	    //create table body........
          	    while ($detail = mysqli_fetch_assoc($result)) {
          	    	$pdf->Row(Array(
	                $detail['surver_id'],
					$detail['surve_id'],
					$detail['date'],
					$detail['item_id'],
					$detail['item_name'],
					$detail['item_department'],
					$detail['model_name'],
					$detail['catagory'],
					$detail['move_state'],
					$detail['warranty'],
					$detail['add_user'],
					$detail['move_department'],
					$detail['current_department'],
					$detail['current_state'],
	              ));
          	    }
          	  }
          	}
   		}else{
   			switch ($select) {
        		case 'AII':
        		  $table_name = "All Inventry Item";
        		  $pdf->Cell(40,5,$table_name,0,0,'L',0);
        		  $query = "SELECT * FROM item WHERE current_state NOT REGEXP '^-?[0-9]*\\.?[0-9]+([Ee][+-][0-9]+)?$'";
        		  break;
        		case 'NSI':
        		  
        		  break;
        		case 'MI':
        		  $table_name = "Missing Item";
        		  $pdf->Cell(40,5,$table_name,0,0,'L',0);
        		  $query = "SELECT * FROM item WHERE item_id=(SELECT item_id FROM item WHERE current_state='using' EXCEPT (SELECT item_id FROM surver_data))";
        		  break;
        		case 'DI':
        		  $table_name = "Distroid Item";
        		  $pdf->Cell(40,5,$table_name,0,0,'L',0);
        		  $query = "SELECT * FROM item WHERE current_state='distroid'";
        		  break;
        		case 'SI':
        		  $table_name = "Sell Item";
        		  $pdf->Cell(40,5,$table_name,0,0,'L',0);
        		  $query = "SELECT * FROM item WHERE concat('',current_state * 1)";
        		  break;
        		case 'WI':
        		  $table_name = "Warranty Item";
        		  $pdf->Cell(40,5,$table_name,0,0,'L',0);
        		  $query = "SELECT * FROM item WHERE current_state='warranty'";
        		  break;
        		case 'RI':
        		  $table_name = "Repayar Item";
        		  $pdf->Cell(40,5,$table_name,0,0,'L',0);
        		  $query = "SELECT * FROM item WHERE current_state='repayar'";
        		  break;
        		case 'SW':
        		  $table_name = "Ship to wellamadama";
        		  $pdf->Cell(40,5,$table_name,0,0,'L',0);
        		  $query = "SELECT * FROM item WHERE current_state='wellamadama'";
        		  break;
        		
        		default:
        		  # code...
          		break;
      		}
      		//set width for each column 
			$pdf->SetWidths(Array(20,45,100,25,25,30,23,15,20,35,25,18,20));
      		//add table heading using standard cells
			//set font to bold
		   	$pdf->Ln();
		   	$pdf->Ln();
			$pdf->SetFont('Arial','B',10);
			
			$pdf->Row(Array(
		      "Item Id",
		      "Item Name",
		      "Description",
		      "Add Date",
		      "Warranty",
		      "Model Name",
		      "Purchesed Companty",
		      "Price",
		      "Invoice No",
		      "Sirial No",
		      "Current Department",
		      "GRN",
		      "Current State",
		    ));
		      
  
	        $result = mysqli_query($conn,$query);
	        if ($result) {
	          if (mysqli_num_rows($result)>0) {
	            //create table body........
	            //$pdf->Ln();
	  		  //reset font
	  		  $pdf->SetFont('Arial','',10);
	            while ($detail = mysqli_fetch_assoc($result)) {
	              $pdf->Row(Array(
	                $detail['item_id'],
	                $detail['name'],
	                $detail['description'],
	                $detail['date'],
	                $detail['warranty'],
	                $detail['model_id'],
	                $detail['purchesed_companty'],
	                $detail['price'],
	                $detail['invoice_no'],
	                $detail['serial_number'],
	                $detail['current_department'],
	                $detail['GRN_no'],
	                $detail['current_state'],
	              ));
	            }
	          }
	        }
		    
   		}
	  

    //output the pdf
	$pdf->Output();



 ?>