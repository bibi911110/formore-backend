<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        .error-template 
        {
            padding: 40px 15px;
            text-align: center;
            margin-top: 12%;
        }
        .error-actions 
        {
            margin-top:15px;
            margin-bottom:15px;
        }
        .error-actions .btn 
        { 
            margin-right:10px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="error-template">
                <h1><i class="fa fa-frown-o" aria-hidden="true"></i> Oops!</h1>
                <h2>404 Not Found</h2>
                <div class="error-details">
                    Sorry, an error has occured, You don't have to permission to access this page!<br>
                </div>
                <div class="error-actions">
                    <a href="{{ URL::previous() }}" class="btn btn-primary">
                        <i class="icon-home icon-white"></i> Return Back 
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>