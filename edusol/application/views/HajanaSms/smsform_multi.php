<!DOCTYPE html>
<html lang="en">
<head>
    <title>Send Branded SMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="" style="width:40%;margin:0 auto;">
  <h2 class="text-info text-center">Send Branded SMS</h2>
  <div class="panel panel-info center-block">
    <div class="panel-heading">Panel Heading</div>
    <div class="panel-body">
        <form class="form-horizontal" action="<?php echo base_url(); ?>SmsHajana/sendMultiNumber" method="post">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">SMS Text</label>
                <div class="col-sm-10">
                    <textarea name="sms" rows="4" cols="20" class="form-control" required placeholder="Type Your SMS here..."></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary pull-right">Send</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>   
</body>
</html>