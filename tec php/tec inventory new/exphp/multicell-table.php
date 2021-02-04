
<?php
  require_once('../connection.php');
?>

<?php
//include pdf_mc_table.php, not fpdf17/fpdf.php
 $subcatecory= $_POST['cat_N'];
 $model= $_POST['model_N'];



include('pdf_mc_table.php');

//make new object

$pdf = new PDF_MC_Table();


//add page, set font


//$pdf = new FPDF('P','mm','A3');
$pdf->AddPage('L', 'A3', 0);


$pdf->SetFont('Arial','',6);

//set width for each column (6 columns)
$pdf->SetWidths(Array(40,30,70,10,25,25,12,15,20,15,15,18,15,17,10,17,15,15,15));

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//load json data
if(($subcatecory == "0") && ($model == "0")){
    $item_filter="SELECT * FROM item";
    $item_filter_result=mysqli_query($conn,$item_filter) or die (mysql_error($conn)); 
  }else{
    if(($subcatecory == "0") && ($model != "0")){
    $item_filter="SELECT * FROM item WHERE model_id = '$model'";
    $item_filter_result = mysqli_query($conn,$item_filter) or die (mysql_error($conn));  
    }else{
      if(($subcatecory != "0") && ($model != "0")){
        $item_filter="SELECT * FROM item WHERE model_id = '$model' AND sub_catagory = '$subcatecory'";
        $item_filter_result = mysqli_query($conn,$item_filter) or die (mysql_error($conn)); 
        }else{
          if(($subcatecory != "0") && ($model == "0")){
            $item_filter="SELECT * FROM item WHERE sub_catagory = '$subcatecory'";
            $item_filter_result = mysqli_query($conn,$item_filter) or die (mysql_error($conn));  
            }else{
              
            }
        }
    }
  }

if(mysqli_num_rows($item_filter_result ) == 0){
	echo '<script>alert("DATA EMPTY canot genarate PDF")</script>'; 
}else{





//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',7);
$pdf->Cell(40,5,"barcode",1,0);
$pdf->Cell(30,5,"name",1,0);
$pdf->Cell(70,5,"description",1,0);
$pdf->Cell(10,5,"price",1,0);
$pdf->Cell(25,5,"serial",1,0);
$pdf->Cell(25,5,"model",1,0);
$pdf->Cell(12,5,"catagory",1,0);
$pdf->Cell(15,5,"sub cata",1,0);
$pdf->Cell(20,5,"invoice",1,0);
$pdf->Cell(15,5,"warranty",1,0);
$pdf->Cell(15,5,"date",1,0);
$pdf->Cell(18,5,"companty",1,0);
$pdf->Cell(15,5,"inv_page",1,0);
$pdf->Cell(17,5,"current_dep",1,0);
$pdf->Cell(10,5,"GRN",1,0);
$pdf->Cell(17,5,"move_sate",1,0);
$pdf->Cell(15,5,"owner_dep",1,0);
$pdf->Cell(15,5,"state",1,0);
$pdf->Cell(15,5,"add_user",1,0);


$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',6);
//loop the data
while($item_row=mysqli_fetch_assoc($item_filter_result)){

	//write data using Row() method containing array of values.
	$pdf->Row(Array(
		$item_row['barcode'],
		$item_row['name'],
		$item_row['description'],
		$item_row['price'],
		$item_row['serial_number'],
		$item_row['model_id'],
		$item_row['catagory'],
		$item_row['sub_catagory'],
		$item_row['invoice_no'],
		$item_row['warranty'],
		$item_row['date'],
		$item_row['purchesed_companty'],
		$item_row['inventory_page_no'],
		$item_row['current_department'],
		$item_row['GRN_no'],
		$item_row['move_sate'],
		$item_row['owner_department'],
		$item_row['current_state'],
		$item_row['add_user'],
		
		
	));
	
}

//output the pdf
$pdf->Output();

	} 

?>




