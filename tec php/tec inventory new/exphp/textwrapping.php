<?php
require('fpdf.php');
?>

<?php
  require_once('../connection.php');
?>

<?php
          $error="";
          /*---------load item table------*/
         $item="SELECT * FROM item";
         $item_result=mysqli_query($conn,$item) or die (mysql_error($conn)); 




//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//dummy data
//data with medium text's length


//data which possibly contains long text

$data2=array(
	
      
	
);

if(mysqli_num_rows($item_result) > 0){
   while($item_row=mysqli_fetch_assoc($item_result)){
	$subarray = array(
		"{$item_row['item_id']}",
	 	"{$item_row['barcode']}",
	 	"{$item_row['name']}",
	 	"{$item_row['description']}",
	 	"{$item_row['price']}",
	 	"{$item_row['serial_number']}",
	 	"{$item_row['model_id']}",
	 	"{$item_row['catagory']}",
	 	"{$item_row['sub_catagory']}",
	 	"{$item_row['invoice_no']}",
		"{$item_row['warranty']}",
		"{$item_row['date']}",
		"{$item_row['purchesed_companty']}",
		"{$item_row['inventory_page_no']}",
		"{$item_row['current_department']}",
		"{$item_row['GRN_no']}",
		"{$item_row['move_sate']}",
		"{$item_row['owner_department']}",
		"{$item_row['current_department']}",
		"{$item_row['image']}",
		"{$item_row['pdf']}",
		"{$item_row['add_user']}",
	 	"This is a quite long text for a cell. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore egggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggt dolore magna aliqua.",
	 	"Something" );

	array_push($data2, $subarray);
	}
}




$pdf = new FPDF('P','mm','A3');

$pdf->AddPage();

$pdf->SetFont('Arial','',12);
//define standard font size
$fontSize=12;



//multicell method
$pdf->Cell(150,5,"MultiCell method",0,1);
foreach($data2 as $item){
	$cellWidth=80;//wrapped cell width
	$cellHeight=10;//normal one-line cell height
	
	//check whether the text is overflowing
	if($pdf->GetStringWidth($item[2]) < $cellWidth){
		//if not, then do nothing
		$line=1;
	}else{
		//if it is, then calculate the height needed for wrapped cell
		//by splitting the text to fit the cell width
		//then count how many lines are needed for the text to fit the cell
		
		$textLength=strlen($item[2]);	//total text length
		$errMargin=10;		//cell width error margin, just in case
		$startChar=0;		//character start position for each line
		$maxChar=0;			//maximum character in a line, to be incremented later
		$textArray=array();	//to hold the strings for each line
		$tmpString="";		//to hold the string for a line (temporary)
		
		while($startChar < $textLength){ //loop until end of text
			//loop until maximum character reached
			while( 
			$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
			($startChar+$maxChar) < $textLength ) {
				$maxChar++;
				$tmpString=substr($item[2],$startChar,$maxChar);
			}
			//move startChar to next line
			$startChar=$startChar+$maxChar;
			//then add it into the array so we know how many line are needed
			array_push($textArray,$tmpString);
			//reset maxChar and tmpString
			$maxChar=0;
			$tmpString='';
			
		}
		//get number of line
		$line=count($textArray);
	}
	
	//write the cells
	$pdf->Cell(10,($line * $cellHeight),$item[0],1,0); //adapt height to number of lines
	$pdf->Cell(60,($line * $cellHeight),$item[1],1,0); //adapt height to number of lines
	
	//use MultiCell instead of Cell
	//but first, because MultiCell is always treated as line ending, we need to 
	//manually set the xy position for the next cell to be next to it.
	//remember the x and y position before writing the multicell
	$xPos=$pdf->GetX();
	$yPos=$pdf->GetY();
	$pdf->MultiCell($cellWidth,$cellHeight,$item[2],1);
	
	//return the position for next cell next to the multicell
	//and offset the x with multicell width
	$pdf->SetXY($xPos + $cellWidth , $yPos);
	
	$pdf->Cell(50,($line * $cellHeight),$item[3],1,1); //adapt height to number of lines
	
	
	
	
	
	
	
	
	
	
	
	
	
}






































$pdf->Output();
?>
