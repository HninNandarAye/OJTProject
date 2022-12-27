<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body class="body-bg">
    <div class="col-md-12 mt-5 d-flex justify-content-center">
    <img class="mt-3 mt-5" src="{{asset('images/error.jfif')}}" alt="" >
    </div>
    
    <div class="col-md-6 mx-auto mt-3">
        <h4 class="text-center text-danger">@lang("public.dberror")<i class="bi bi-exclamation-circle"></i></h4>
    </div>
</body>

</html>