<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" >
    <script src="ckeditor.js"></script>
    <script src="plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="samples/js/sample.js"></script>
    <link href="samples/css/samples.css" rel="stylesheet">
</head>
<body>
<div class="container" style="margin-top:200px;">
    <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
            <form action="testing.php" method="POST">
                <input type="hidden" id="hidden" name="math" value="">
                <div id="editor" >
                    <math xmlns="http://www.w3.org/1998/Math/MathML"><msqrt><mn>4</mn></msqrt></math>
                </div>
                <input type="submit" >
            </form>
        </div>
    </div>
</div>
</body>
</html>
<script>
        initSample();
        // var imgHtml = CKEDITOR.dom.element.createFromHtml('<math xmlns="http://www.w3.org/1998/Math/MathML"><msqrt><mn>4</mn></msqrt></math>');
        // CKEDITOR.instances.body.insertElement(imgHtml);
        
        // CKEDITOR.instances['editor'].setData('');
        
         CKEDITOR.instances['editor'].on('change', function() {
            //  $('#hidden').val(btoa(CKEDITOR.instances['editor'].getData()));
             $('#hidden').val(CKEDITOR.instances['editor'].getData());
             console.log($('#hidden').val());
         });
        
</script>