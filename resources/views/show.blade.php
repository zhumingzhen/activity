<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>复联大集结，等你救世界</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="padding: 10px">
    <div>
        <h2 style="color: red;text-align: center">复联大集结，等你救世界</h2>
        <img src="{{asset('image/lz.jpg')}}" style="width: 100%" alt="">
        <form action="/activity/store" method="post" style="margin-top: 20px;">
            {{ csrf_field() }}
            <div class="form-group">
                {{--<label for="exampleInputEmail1">姓名</label>--}}
                <input type="text" class="form-control" name="username" id="text" placeholder="输入姓名">
            </div>
            <button type="submit" class="btn btn-success btn-block">查看您的复联专属人物</button>
        </form>
    </div>
    <div style="display: none">
        <script src="https://s22.cnzz.com/z_stat.php?id=1273742257&web_id=1273742257" language="JavaScript"></script>
    </div>
</body>
</html>