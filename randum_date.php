
//get date randum
public function dayDetail()
{
    // if($request->periodicity=='0' || $request->periodicity=='1' || $request->periodicity=='2' || $request->periodicity=='7')
    // {
        $allSisMonth=[];
        for ($i = 1; $i <= 6; $i++) 
        {
           $oldmonths[] = date("d-m-Y", strtotime( date( '01-m-Y' )." -$i months"));
        }
        $oldSixMonth=$oldmonths[5];
        $ary=[];
        for($i=1;$i<=15;$i++)
        {
            $start = strtotime($oldSixMonth);  //start date
            $end = strtotime(date('d-m-Y'));  //end date
            $val = rand($start, $end);
            $ary[]=date('d-m-Y ', $val);
            // $ary_temp[]=date('d-m-Y 00:00:00', $val);
        }
        $ary_data=array_unique($ary);
        $mainArray=[];
        for($i=0;$i<11;$i++)
        {
            $mainArray[]=$ary_data[$i];
        }
        return implode(",", $mainArray);
    // }
    
}


//get previous 2 month randum
public function monthDetail()
{
    $allSisMonth=[];
    for ($i = 1; $i <= 6; $i++) 
    {
       $oldmonths[] = date("Y-m-d", strtotime( date( 'Y-m-01' )." -$i months"));
    }
    $oldSixMonth=$oldmonths[5];
    $ary=[];
    for($i=1;$i<=12;$i++)
    {
        $start = strtotime($oldSixMonth);  //start date
        $end = strtotime(date('Y-m-d'));  //end date
        $val = rand($start, $end);
        $ary[]=date('F', $val);
    }
    $ary_data=array_unique($ary);
    $mainArray=[];
    // dd($ary_data);
    for($i=0;$i<2;$i++)
    {
        $mainArray[]=$ary_data[$i];
    }
    return implode(",", $mainArray); 
}



//get month in string (March)
public function weekDetail()
{
    $allSisMonth=[];
    for ($i = 1; $i <= 6; $i++) 
    {
       $oldmonths[] = date("Y-m-d", strtotime( date( 'Y-m-01' )." -$i months"));
    }
    $oldSixMonth=$oldmonths[5];
    $ary=[];
    for($i=1;$i<=12;$i++)
    {
        $start = strtotime($oldSixMonth);  //start date
        $end = strtotime(date('Y-m-d'));  //end date
        $val = rand($start, $end);
        $ary[]=date('F', $val);
    }
    $ary_data=array_unique($ary);
    $mainArray=[];
    // dd($ary_data);
    for($i=0;$i<1;$i++)
    {
        $mainArray[]=$ary_data[$i];
    }
    return implode(",", $mainArray); 
}
