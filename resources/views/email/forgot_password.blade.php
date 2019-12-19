<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
   <head>
      <!-- NAME: HERO IMAGE -->
      <!--[if gte mso 15]>
      <xml>
         <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
         </o:OfficeDocumentSettings>
      </xml>
      <![endif]-->
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>
         Newsletter
      </title>
      <head>
         <style type="text/css">
            body {
            font-family: 'Open Sans', sans-serif;
            font-size: 15px;
            color: #666;
            line-height:24px;
            margin:0;
            padding:0;
            }
            @media (max-width:649px) {
            .full-width {
            width: 100% !important;
            }
            }
         </style>
   </head>
   <body style="padding-left:15px; padding-right:15px; background-color:#1C2754;" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
      <table style="width:100%; padding-top:48px;"  border="0" cellpadding="0" cellspacing="0">
         <tr>
            <td align="center">
               <table class="full-width" style="max-width:650px; width:100%; background-color:#fff; box-shadow: 0 0 4px #4b4c4c; border-radius:3px;" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td style="text-align: center; padding-top:64px;">

                        <img class="img-fluid" src="{{url('/public/images/login_logo.png')}}" alt="Logo" />

                     </td>
                  </tr>
                  <tr>
                     <td style="font-size:26px; text-align:center; padding:32px; color:#333;">
                       Forget Password
                     </td>
                  </tr>


                  <tr>

                     <td style="font-weight:600; text-align:center; padding:0 32px; ">Hello {{$username}}</td>

                  </tr>


                  <tr>

                     <td style="text-align:center;    padding:0 32px 32px;    border-bottom: solid 1px #f0f0f0;">

                       {{$mesage}}
                         <a style="text-decoration:none; color:#1c2754; font-weight:600; " href="#">{{$otp}}</a>
                      </td>

                  </tr>



                  <tr>
                     <td align="center" style="font-size:13px; padding-top:15px;">Copyright © 2019-2020</td>
                  </tr>
                  <tr>
                     <td align="center" style="font-size:13px; padding-bottom:64px;"> All rights reserved. Confidential and Proprietary.</td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
   </body>
   </body>
</html>
