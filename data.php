<?php
    require_once('connect.php');
    if(isset($_POST['btn-save']))
    {
        $Topic=mysqli_real_escape_string($con,$_POST['topic']);
        $Words=mysqli_real_escape_string($con,$_POST['words']);
        $Info=mysqli_real_escape_string($con,$_POST['info']);
        if(empty($Topic)||empty($Words)||empty($Info))
            {
                echo "please fill in details";
                exit();
            }
        if($Words>1000)
        {
            echo "number of words should be less than 1000";
            exit();
        }    
        $sql="SELECT * from inputtable";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        if(!$row)
            {
                $inc="1 day";
                $del=date('Y-m-d',strtotime($inc)); 
                $q1="INSERT INTO inputtable(topic,no_of_words,info,del_date) values ('$Topic','$Words','$Info','$del')";
                $r1=mysqli_query($con,$q1);
            }
         else
            {
                $date = date('Y-m-d',strtotime("1 day"));//start date for tomorrow
	                
	            $end_date = '2020-12-31';// End date (just for loop,an b updated to further date later)
                while (strtotime($date) <= strtotime($end_date))
                {    
                    
	
                    $query="SELECT no_of_words from inputtable  WHERE del_date='$date'";
                    $r2=mysqli_query($con,$query);
                    $sum=0;
                    while($row=mysqli_fetch_assoc($r2))
                    {
                        $sum=$sum+$row['no_of_words'];
                    }
                    if($sum+$Words<=1000)
                    {
                        $q2="INSERT INTO inputtable(topic,no_of_words,info,del_date) values ('$Topic','$Words','$Info','$date')";
                        $r3=mysqli_query($con,$q2);
                        echo "happy to be at your service";
                        break;
                    }
                    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
            }        
     }

    

?>