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
        $(document).ready(function () {
            newbg();
        });
        function newbg() {
            var deg = 180;
            var r1 = 255;
            var g1 = 255;
            var b1 = 255;
            var r0 = 0;
            var g0 = 0;
            var b0 = 0;
            setInterval(() => {
                deg = ranposneg(deg,0,360);
                r1 = ranposneg(r1,0,360);
                g1 = ranposneg(g1,0,360);
                b1 = ranposneg(b1,0,360);
                r0 = ranposneg(r0,0,360);
                g0 = ranposneg(g0,0,360);
                b0 = ranposneg(b0,0,360);

                var ligrad = 'linear-gradient(';
                ligrad += deg+'deg, ';
                ligrad += 'rgb('+r1+','+g1+','+b1+'),';
                ligrad += 'rgb('+r0+','+g0+','+b0+')';
                ligrad += ')';

                $('body').css('background-image', ligrad);
            }, 100);
        }
        function ranposneg(d,n,x) {
            var c = Math.random() < 0.5 ? -1 : 1;
            if (c<n) {c=n;}
            if (c>x) {c=x;}
            return c;
        }
    </script>
</body>
</html>