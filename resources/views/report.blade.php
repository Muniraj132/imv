<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{!! trans('main.site_title') !!} Vote Results for {{ $role }}, 2021-2024</title>
    <style>
      table {
        width: 100%;
      }
      .rptfinal {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      .rptfinal td, .rptfinal th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      .rptfinal tr:nth-child(even){background-color: #f2f2f2;}

      .rptfinal tr:hover {background-color: #ddd;}

      .rptfinal th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
      }

      .rptfinal2 {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      .rptfinal2 td, .rptfinal2 th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      .rptfinal2 tr:nth-child(even){background-color: #f2f2f2;}

      .rptfinal2 tr:hover {background-color: #ddd;}

      .rptfinal2 th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #336699;
        color: white;
      }
      </style>
  </head>
  <body>
    <div align="center">
      <header>
        <h1>{!! trans('main.site_title') !!} Election {{ date('Y')+1 }}</h1>
        <h2>{{ $role }}s Section</h2>
      </header>
      <table class="rptfinal">
      <thead>
        <tr>
          <th><b>Name</b></th>
          <th><b>Email</b></th>
         
          <th><b>No Of Votes</b></th>
        </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
        <tr>
          <td>
            {{ $user->name.' '.$user->cong_abbr }}
          </td>
          <td>
            {{ $user->email }}
          </td>
          
          <td align="center">
            {{ $user->votecnt ?? '0'}}
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>
      <div style="margin-top:20px !important">
        <h2>Vote Details</h2>
        <table class="rptfinal2">
          <thead>
            <tr>
              <th>Vote Detail</th>
              <th>Total Vote Percentage</th>
              <th>Printed At</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              @php
              date_default_timezone_set('Asia/Kolkata');

                @endphp
              <td>Out of {{ $totalusers }} {{ $role }}s, {{ $voted }} Have voted</td>
              <td>{{ round($percentage) }} %</td>
              <td>{{ date('d-m-Y h:i A') }}</td>
            </tr>
          </tbody>
        </table>
        
      </div>
      <div id="footer">
       <p class="page">Copyright &copy; 2021 <b>VI<sup>th</sup> IMV Chapter {{ date('Y')+1 }}</b>, powered by <b><a href="https://www.boscosofttech.com/" style="text-decoration: none !important; color: black;">Bosco Soft Technologies Private Limited</a></b></p>
     </div>
    </div>
  </body>
</html>