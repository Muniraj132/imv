<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="format-detection" content="telephone=no" />
    <title>Indian Mission Vicariate</title>
    <style>
      @keyframes blink {
        from {
          opacity: 1;
        }

        to {
          opacity: 0;
        }
      }
    </style>
  </head>
  <body>
    <div style="width:100%!important;height:100%;background:#efefef">
      <table style="width:100%!important;height:100%;background:#efefef">
        <tbody>
          <tr>
            <td style="display:block!important;clear:both!important;margin:0 auto!important;max-width:580px!important">

              <table>
                <tbody>
                  <tr>
                    <td align="center" style="padding:40px 0;background:#71bc37;color:white">
                      <h1>Indian Mission Vicariate</h1>
                      <p>Election of Delegates for the &#8547; IMV Chapter</p>
                    </td>
                  </tr>

                  <tr>
                    <td style="background:white;padding:30px 35px">
                      <h2>Dear {!! $mdata['role'] !!} {!! $mdata['name'] !!},</h2>
                      <p style="font-size:16px;font-weight:normal;margin-bottom:20px">
                        <p>{!! $mdata['message'] !!}</p>
                        <p>{!! $mdata['note'] !!}</p>
                      </p>

                      <table align="center">
                        <tbody>
                          <tr>
                            <td >
                              <center>
                                <p style="font-size:16px;font-weight:normal;margin-bottom:20px">
                                <a href="{{ URL::to($mdata['sipurl']) }}" style="display:inline-block;color:white;background:#71bc37;border:solid #71bc37;border-width:10px 20px 8px;font-weight:bold;border-radius:4px;text-decoration:none;animation-duration: 1000ms;animation-name: blink;animation-iteration-count: infinite;">Click here to Proceed</a>
                                </p>
                              </center>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td align="center" style="padding:20px 0;background:#71bc37;color:white">
                      Copyright &copy; {{ date('Y') }}.  Boscosoft Technologies Pvt Ltd, All Rights Reserved
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>
