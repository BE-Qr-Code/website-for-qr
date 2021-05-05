<?php
// Include the main TCPDF library (search for installation path).
require_once('./TCPDF-main/tcpdf.php');// Extend the TCPDF class to create custom Header and Footer

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

// $pdf->Write(0, 'Example of HTML tables', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);


// Getting data from database

include 'connect.php';
// session_start();
$subjectId = $_GET['subjectId'];
$deptid = $_GET['deptid'];
$teacherName =  $_GET['teacherName'];
$total_students =  $_GET['total_students'];

// using queries to find total no. of lectures
$result1= mysqli_query($connection,"SELECT count(*) as totalLec FROM qrcode where DepartrQID='$deptid' AND SubjectQID='$subjectId';");
if ($result1->num_rows>0) {
    $row = mysqli_fetch_array($result1);
    $totalLec = $row['totalLec'];
} 

// Set some content to print
$html = <<<EOD
<h1>Overall Attendance Report</h1>
<table style="font-size: 15px;">
 <tr>
  <td style="width: 95px; text-align: left;">Prof. Name:</td>
  <td>$teacherName</td>
  <td style="text-align: right;">Total Students:</td>
  <td style="text-align: left;">$total_students</td>
 </tr>
 <tr>
  <td style="width: 95px; text-align: right;">Subject:</td>
  <td>$subjectId</td>
  <td style="text-align: right;">Total Lectures:</td>
  <td style="text-align: left;">$totalLec</td>
 </tr>
</table>
<br>
EOD;

// Creating table using HTML
$a = '<table style="font-size: 12px;" border="1" nobr="true">';
$b .= '<tr style="font-weight: bold;"><th>Sr No.</th><th>Moodle Id</th><th>Name</th><th>Total Lectures ('.$totalLec.')</th></tr>';

// using queries to find total lec attended by the students
$i = 0;
$result1= mysqli_query($connection,"SELECT count(a1.MoodleID) as totalLec, r1.MoodleID, concat(fname, ' ', lname) as fullName 
                                    FROM test.registration r1 LEFT JOIN test.attendance a1 ON a1.SubjectID='$subjectId' and a1.MoodleID = r1.MoodleID
                                    where r1.DepartID='$deptid' group by r1.MoodleID;");
if ($result1->num_rows>0) {
    while($row = $result1->fetch_assoc()) {
        $i = $i+1;
        $b .= '<tr><td>'.$i.'</td><td>'.$row['MoodleID'].'</td><td>'.$row['fullName'].'</td><td>'.$row['totalLec'].'</td></tr>';
    }
}
// $result1= mysqli_query($connection,"select count(*) from test.qrcode where SubjectQID='$subjectId';");

// if ($result1->num_rows>0) {
//     while($row = $result1->fetch_assoc()) {
//         $i = $i+1;
//         $b .= '<tr><td>'.$i.'</td><td>'.$row['MoodleID'].'</td><td>'.$row['fullName'].'</td><td>Present</td></tr>';
//     }
// }
$c = '</table>';

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->writeHTML($a.$b.$c, true, false, false, false, '');

//Close and output PDF document
ob_end_clean();
$pdf->Output('example_048.pdf', 'I');
?>