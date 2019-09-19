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
            UserId: {{ $withdrawalDto->getUserId() }}
            RewardId: {{ $withdrawalDto->getRewardId() }}

            In your website account was updates withdrawal, please open
            <a href="{{ config('app.frontend_app_url') . "/admin/rewards/withdrawals/" }}">
                this link
            </a>.
        </td>
    </tr>
</table>
</body>
</html>
