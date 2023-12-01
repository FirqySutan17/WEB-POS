<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SYNC DATA</title>
</head>
<body>
  SYNC DATA
  <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
  <script>
    let cashflow = <?php echo json_encode($cashflow) ?>;
    $(document).ready(function() {
      console.log(cashflow);
      $.ajax({
            url: cashflow.url,
            type: "GET",
            data: {
                "query": cashflow.query,
            },
            success: function(response) {
              console.log(response);
            }
        });
    });
  </script>
</body>
</html>