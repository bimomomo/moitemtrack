<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COLOR GRADIENT ANIMATION</title>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: rgb(75, 75, 75);
        }
    </style>
</head>
<body>
    <script>
        var d = false;
        $(document).ready(function () {
            newbg();
        });
        function newbg() {
            var deg = 100;
            var r1 = 125;
            var g1 = 125;
            var b1 = 125;
            var r0 = 100;
            var g0 = 100;
            var b0 = 100;
            setInterval(() => {
                deg = ranposneg(deg,1,359);
                r1 = ranposneg(r1,0,255);
                g1 = ranposneg(g1,0,255);
                b1 = ranposneg(b1,0,255);
                r0 = ranposneg(r0,0,255);
                g0 = ranposneg(g0,0,255);
                b0 = ranposneg(b0,0,255);

                var ligrad = 'linear-gradient(';
                ligrad += deg+'deg, ';
                ligrad += 'rgb('+r1+','+g1+','+b1+'),';
                ligrad += 'rgb('+r0+','+g0+','+b0+')';
                ligrad += ')';

                $('body').css('background-image', ligrad);
            }, 100);
        }
        function ranposneg(d,n,x) {
            var c = d + (Math.random() < 0.5 ? -5 : 5);
            if (c<n) {c=n;}
            if (c>x) {c=x;}
            return c;
        }
    </script>
</body>
</html>