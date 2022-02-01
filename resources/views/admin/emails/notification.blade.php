<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <style type="text/css">
        *{
            font-family: Verdana, Geneva, Tahoma, sans-serif
        }

        a:hover {
            text-decoration: underline !important;
        }

        body {
            direction: ltr; 
        }
        
        table{
            font-family: 'Cairo';
        }



    </style>
    
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" >
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <a href="{{$domain}}" title="logo" target="_blank">
                                <img width="250" src="{{$logo}}" title="logo"
                                    alt="logo">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" >
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                 {!! $notification['body'] !!}
                                </tr>
                                {{-- <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr> --}}
                            </table>
                        </td>
                    <tr>
                        <td style="text-align:center;">
                            <p
                                style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">
                                &copy; All rights reserved to {{$website_name}} {{Date('Y')}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 5px">&nbsp;</td>
                    </tr>
    
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>
