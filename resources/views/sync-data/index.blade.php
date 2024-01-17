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
  {{ date('Y-m-d H:i:s') }}
  <br>
  {{ json_encode($data) }}
  <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
  <script>
    $(document).ready(function() {
      window.setTimeout( function() {
        window.location.reload();
      }, 90000);
    });
  </script>
</body>
</html>