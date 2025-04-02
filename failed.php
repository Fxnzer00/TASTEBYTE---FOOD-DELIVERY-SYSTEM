<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        ._failed { border-bottom: solid 4px red !important; }
        ._failed i { color: red !important; }

        ._success, ._failed {
            animation: fadeInDown 1s ease-in-out;
            box-shadow: 0 15px 25px #00000019;
            padding: 45px;
            width: 100%;
            text-align: center;
            margin: 40px auto;
        }

        ._success i, ._failed i {
            font-size: 55px;
            color: #28a745; /* You can adjust the color accordingly */
        }

        ._success h2, ._failed h2 {
            margin-bottom: 12px;
            font-size: 40px;
            font-weight: 500;
            line-height: 1.2;
            margin-top: 10px;
        }

        ._success p, ._failed p {
            margin-bottom: 0px;
            font-size: 18px;
            color: #495057;
            font-weight: 500;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="message-box _failed" id="failedMessage">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
                <h2>Your payment failed</h2>
                <p>Insufficient funds. Order not placed</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Redirect to index_user.php after 5 seconds
    setTimeout(function() {
        window.location.href = 'index_user.php';
    }, 5000);
</script>

</body>
</html>
