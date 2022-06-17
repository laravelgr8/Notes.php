$("#approve").on("click",function(){
    var ary=[];
    $(".chk:checked").each(function(){
        ary.push($(this).val());
    });
    $.ajax({
        url : 'multiApprove',
        type: 'GET',
        data: {id:ary},
        success:function(data)
        {
            console.log(data);
        }
    });
});



On controller:
//multi approve
public function multiApprove(Request $request)
{
    $id=$request->id;
    $str=implode(",", $id);
    $ary=explode(",", $str);

    // ->whereIn("office",[$findFobData])
    $data=DB::table('rob_forms')->whereIn("Pk_id",$ary)->update([
        "approve" => 1
    ]);
    return response()->json(["Approved success"]);
}



On view :-
<span class="btn btn-info" id="approve">Approve</span>
<input type="checkbox" name="getid[]" class="chk" value="{{$item->Pk_id}}">
