<?php echo date("d-m-Y", strtotime($atten->date)); ?>
<?php  echo date('h:i a', strtotime($atten->time));  ?>
date('Y-m-d\TH:i', strtotime($exampleDate))
<input type="datetime-local name="date" value="date('Y-m-d\TH:i', strtotime($exampleDate))">
