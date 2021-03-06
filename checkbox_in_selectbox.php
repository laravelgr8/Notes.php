<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>jQuery Multi Select Dropdown with Checkboxes</title>

<link href="https://unpkg.com/bootstrap@3.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap@3.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/js/bootstrap-multiselect.js"></script>
<link href="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/css/bootstrap-multiselect.css" rel="stylesheet"/>
<style type="text/css">
  .multiselect-container>li>a>label {
  padding: 4px 20px 3px 20px;
}
</style>
</head>

<body>

<form id="form1">
  <div style="padding:20px">

    <select id="chkveg" multiple="multiple">
      <option value="cheese">Cheese</option>
      <option value="tomatoes">Tomatoes</option>
      <option value="mozarella">Mozzarella</option>
      <option value="mushrooms">Mushrooms</option>
      <option value="pepperoni">Pepperoni</option>
      <option value="onions">Onions</option>
    </select>
    
    <br /><br />

    <input type="button" id="btnget" value="Get Selected Values" />
  </div>
</form>

<script type="text/javascript">
  $(function() {

  $('#chkveg').multiselect({
    includeSelectAllOption: true
  });

  $('#btnget').click(function() {
    alert($('#chkveg').val());
  });
});
</script>
</body>
</html>
