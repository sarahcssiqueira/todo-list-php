<?php

// Require the Composer autoloader
require '../vendor/autoload.php';

//Connect MySQL
include_once '../db/db_connect.php';

// Recover data
$query_task = "SELECT id, title, date_time, checked FROM task";

// Prepare and execute QUERY
$result_task = $conn->prepare($query_task);
$result_task->execute();


//Set style of the report
$print = "<link rel='stylesheet' href='http://localhost/todo-list/style/print.css'";


// Print on report - Header
$print .= "<!DOCTYPE html> 
         <html lang='pt-br'>
         <title>Tasks To Do</title>
         <h1>Tasks to Do</h1>
         <h2>A simple report</h2>";

// Read DB registers
    while($row_task = $result_task->fetch(PDO::FETCH_ASSOC)){
        extract($row_task);
        //$print .= "ID: $id <br>";
        $print .= "Task: $title <br>";
        $print .= "Date: $date_time <br>";
        $print .= "Status: $checked <br>";
        
    }

// Reference the Dompdf namespace
use Dompdf\Dompdf;

// Instantiate and use the dompdf class and allow use CSS
$dompdf = new Dompdf(['enable_remote' => true]);

// Instantiate load html method
$dompdf->loadHtml($print);

// Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();