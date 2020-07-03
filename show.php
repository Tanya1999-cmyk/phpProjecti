<?php
require_once('connect.php');
$query = "SELECT * FROM inputtable ORDER BY del_date ASC";
 
 
echo '<table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          
          <th> <font face="Arial">topic</font> </th> 
          <th> <font face="Arial">no. of words</font> </th> 
          <th> <font face="Arial">info</font> </th> 
          <th> <font face="Arial">delivery date</font> </th> 
      </tr>';
 
if ($result = mysqli_query($con,$query)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $field1name = $row["topic"];
        $field2name = $row["no_of_words"];
        $field3name = $row["info"];
        $field4name = $row["del_date"];
        
 
        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
                  <td>'.$field4name.'</td> 
                  
              </tr>';
    }
    
} 
?>