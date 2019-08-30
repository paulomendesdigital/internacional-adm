<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-mail de Contato</title>

<style>
    *,::after,::before{box-sizing:border-box}
    html{font-family:sans-serif;line-height:1.15;-webkit-text-size-adjust:100%;-webkit-tap-highlight-color:transparent}
    body{margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";font-size:1rem;font-weight:400;line-height:1.5;color:#212529;text-align:left;background-color:#fff}[tabindex="-1"]
    hr{box-sizing:content-box;height:0;overflow:visible}
    h1,h2,h3,h4,h5,h6{margin-top:0;margin-bottom:.5rem}
    p{margin-top:0;margin-bottom:1rem}
    dl,ol,ul{margin-top:0;margin-bottom:1rem}
    ol ol,ol ul,ul ol,ul ul{margin-bottom:0}
    b,strong{font-weight:bolder}
    small{font-size:80%}
    a:hover{color:#0056b3;text-decoration:underline}
    a:not([href]):not([tabindex]){color:inherit;text-decoration:none}
    a:not([href]):not([tabindex]):focus,
    a:not([href]):not([tabindex]):hover{color:inherit;text-decoration:none}
    a:not([href]):not([tabindex]):focus{outline:0}
    img{vertical-align:middle;border-style:none}
    table{border-collapse:collapse}
    th{text-align:inherit}
    .h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{margin-bottom:.5rem;font-weight:500;line-height:1.2}
    .h1,h1{font-size:2.5rem}
    .h2,h2{font-size:2rem}
    .h3,h3{font-size:1.75rem}
    .h4,h4{font-size:1.5rem}
    .h5,h5{font-size:1.25rem}
    .h6,h6{font-size:1rem}
    .lead{font-size:1.25rem;font-weight:300}
    .container{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}
    @media (min-width:576px){.container{max-width:540px}}
    @media (min-width:768px){.container{max-width:720px}}
    @media (min-width:992px){.container{max-width:960px}}
    @media (min-width:1200px){.container{max-width:1140px}}
    .container-fluid{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}
    .row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}
    .col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto,{position:relative;width:100%;padding-right:15px;padding-left:15px}
    @media (min-width:768px){
        .col-md{-ms-flex-preferred-size:0;flex-basis:0;-ms-flex-positive:1;flex-grow:1;max-width:100%}
        .col-md-auto{-ms-flex:0 0 auto;flex:0 0 auto;width:auto;max-width:100%}
        .col-md-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}
        .col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}
        .col-md-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}
        .col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}
        .col-md-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}
        .col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
        .col-md-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}
        .col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}
        .col-md-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}
        .col-md-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}
        .col-md-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}
        .col-md-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
    }

</style>
</head>
<body>
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <h1>E-mail de contato.</h1>

                <br>

                <p>
                    <b>{{ $data['name'] }}</b>: {{ $data['email'] }}
                </p>

                <p>
                    <b>Assunto</b>: {{ $data['subject'] }}
                </p>

                <p>
                    <b>Mensagem:</b>
                    <br>
                    {{ $data['message'] }}
                </p>
            </div>
        </div>
    </div>
</body>
</html>
