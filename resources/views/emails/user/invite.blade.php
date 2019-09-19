<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>website Team</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<table>
    <tr>
        <td>
            You have invite from {{ $name  }} in website account, please open
            @if($fast)
                <a href="{{ config('app.api_app_url') . "/v1/invite/accept/?token=$token" }}">this link</a>.
            @else
                <a href="{{ config('app.website_app_url') . "/welcome/?token=$token&source=email" }}">this link</a>.
            @endif
        </td>
    </tr>
</table>
</body>
</html>
