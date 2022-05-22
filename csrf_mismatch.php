<meta name="csrf-token1" content="{{ csrf_token() }}">
var data=new FormData($("#myform")[0]);


headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
},
