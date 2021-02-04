<?php
include('pdf_mc_table.php');



//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//dummy data
//data with medium text's length
$data1=array(
	array(
		"1",
		"Foo, overflowed text length",
		"This contains a long text. not too long but longer than cell's width.",
		"Something"
	),
	array(
		"1",
		"Bar, normal text length",
		"This should not exceed the cell's width.",
		"Something else"
	),
	array(
		"1",
		"Baz, overflowed text length",
		"This also contains a long text, not too long but longer than cell's width.",
		"Something else"
	)
);

//data which possibly contains long text

//set width for each column (6 columns)
$pdf->SetWidths(Array(20,40,40,30,20));

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);
$data2=array(
	array(
		"1",
		"Foo, overflowed text length",
		"This is a quite long text for a cell. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
		"Something",
		"Something"
	),
	array(
		"1",
		"Bar, normal length",
		"This is normalkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk length for a cell.",
		"Something else",
		"Something"
	),
	array(
		"1",
		"Baz, overflowed text length",
		"This is also a quite long text for a cell. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
		"Something else",
		"Something"
	),
	array(
		"1",
		"Baz, overflowed text length",
		"This is also a quite long text for a cell. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
		"Something else",
		"Something"
	),
);

$pdf = new FPDF('P','mm','A4');


$pdf->AddPage();

$pdf->SetFont('Arial','',12);
//define standard font size
$fontSize=12;

//shrinking method
$pdf->Cell(150,5,"Font size shrinking method",0,1);
//define a temporary font size
$tempFontSize=$fontSize;
//loop the data
foreach($data1 as $item){
	$pdf->Cell(10,5,$item[0],1,0);
	$pdf->Cell(60,5,$item[1],1,0);
	
	//shrink font size until it fits the cell width
	$cellWidth=80;
	while($pdf->GetStringWidth($item[2]) > $cellWidth){ //loop until the string width is smaller than cell width
		$pdf->SetFontSize($tempFontSize -= 0.1);
	}
	$pdf->Cell($cellWidth,5,$item[2],1,0);
	//reset font size to standard
	$tempFontSize=$fontSize;
	$pdf->SetFontSize($fontSize);
	
	$pdf->Cell(40,5,$item[3],1,1);
}

$pdf->Ln(10);

//multicell method
$pdf->Cell(150,5,"MultiCell method",0,1);
foreach($data2 as $item){
	$cellWidth=80;//wrapped cell width
	$cellHeight=5;//normal one-line cell height
	
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
	
	$pdf->Cell(40,($line * $cellHeight),$item[3],1,1); //adapt height to number of lines
	
	
	
	
	
	
	
	
	
	
	
	
	
}






































$pdf->Output();
?>
