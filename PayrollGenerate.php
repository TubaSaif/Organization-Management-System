<?php
include('db.php');
	require_once('TCPDF/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Payroll:');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  
    $content = ''; 
    
      /* *******************Deductions********************** */
      $sql = "SELECT *, SUM(damount) as total_amount FROM deduction";
      $query = $con->query($sql);
      $drow = $query->fetch_assoc();
      $deduction = $drow['total_amount'];

      
      $to = date('Y-m-d');
      $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

      if(isset($_GET['range'])){
        $range = $_GET['range'];
        $ex = explode(' - ', $range);
        $from = date('Y-m-d', strtotime($ex[0]));
        $to = date('Y-m-d', strtotime($ex[1]));
      }
    /* *******************Fetch Record From Attendance********************** */
    $sql = "SELECT * from employee";

    $query = $con->query($sql);
    $total = 0;
    while($row = $query->fetch_assoc()){
    $empid = $row['id'];
    /* **************** Cash Advance ********************* */
        $casql = "SELECT *, SUM(aamount) AS cashamount FROM advance WHERE id='$empid' AND adate BETWEEN '$from' AND '$to'";
        
        $caquery = $con->query($casql);
        $carow = $caquery->fetch_assoc();
        $cashadvance = $carow['cashamount'];

        $gross = $row['Salary'] ;
        $total_deduction = $deduction + $cashadvance;
        $net =  $gross - $total_deduction ;
        


    $content .= '
      	
    <h2 align="center">MONITASK</h2>
    <h4 align="center">'.$net." - ".$net.'</h4>
    <table cellspacing="0" cellpadding="3">  
             <tr>  
              <td width="25%" align="right">Employee Name: </td>
                 <td width="25%"><b>'.$row['firstname']." ".$row['lastname'].'</b></td>
         <td width="25%" align="right">Rate per Hour: </td>
                 <td width="25%" align="right">'.$net.'</td>
          </tr>
          <tr>
            <td width="25%" align="right">Employee ID: </td>
         <td width="25%">'.$net.'</td>   
         <td width="25%" align="right">Total Hours: </td>
         <td width="25%" align="right">'.$net.'</td> 
          </tr>
          <tr> 
            <td></td> 
            <td></td>
         <td width="25%" align="right"><b>Gross Pay: </b></td>
         <td width="25%" align="right"><b>'.$net.'</b></td> 
          </tr>
          <tr> 
            <td></td> 
            <td></td>
         <td width="25%" align="right">Deduction: </td>
         <td width="25%" align="right">'.$net.'</td> 
          </tr>
          <tr> 
            <td></td> 
            <td></td>
         <td width="25%" align="right">Cash Advance: </td>
         <td width="25%" align="right">'.$net.'</td> 
          </tr>
          <tr> 
            <td></td> 
            <td></td>
         <td width="25%" align="right"><b>Total Deduction:</b></td>
         <td width="25%" align="right"><b>'.$net.'</b></td> 
          </tr>
          <tr> 
            <td></td> 
            <td></td>
         <td width="25%" align="right"><b>Net Pay:</b></td>
         <td width="25%" align="right"><b>'.$net.'</b></td> 
          </tr>
        </table>
        <br><hr>      

      ';  
    } 
    $pdf->writeHTML($content);  
    $pdf->Output('payroll.pdf', 'I');
?>
