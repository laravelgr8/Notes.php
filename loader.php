<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #loading {
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0.7;
        background-color: gray;
        z-index: 99;
        }

        #loading-image {
        z-index: 100;
        }
    </style>
</head>
<body>
<div id="loading">
  <img id="loading-image" src="https://media.istockphoto.com/vectors/loading-icon-vector-illustration-vector-id1335247217?k=20&m=1335247217&s=612x612&w=0&h=CQFY4NO0j2qc6kf4rTc0wTKYWL-9w5ldu-wF8D4oUBk=" alt="Loading..." />
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js""></script>
<script>
  $(window).on('load', function () {
    // $('#loading').hide();
  }) 
</script>
</body>
</html>
