var voyageId = new Array(); 
$("input[name='qualification[]']:checked:enabled").each(function () {
voyageId.push($(this).val());
});


var file = $('#pic')[0].files[0]
if (file){
console.log(file.name);
// console.log(file.size);
}
