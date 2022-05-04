<?php echo date("d-m-Y", strtotime($atten->date)); ?>
<?php  echo date('h:i a', strtotime($atten->time));  ?>
date('Y-m-d\TH:i', strtotime($exampleDate))
<input type="datetime-local name="date" value="date('Y-m-d\TH:i', strtotime($exampleDate))">
                                                                                           
                                                                                           
                                                                                           
                                                                                           
How to get next 30 days:- 
$today = date('Y-m-d'); //only date month year                                                                                           
$today = date('Y-m-d h:i:s', time());  //with time
$document_date=substr($today,0,10);  
$checkdate=date('Y-m-d',strtotime('+30 days',strtotime($document_date)));
