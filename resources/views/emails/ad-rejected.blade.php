<!DOCTYPE html>
<html>
<head>
    <title>Ad Not Approved</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">

    <h2 style="color: #dc2626;">Your Ad Was Not Approved</h2>

    <p>Hi {{ $advertisement->user->name }},</p>

    <p>Unfortunately your advertisement has been reviewed and was not approved at this time.</p>

    <table style="border-collapse: collapse; width: 100%; margin: 20px 0;">
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9;"><strong>Title</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $advertisement->title }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9;"><strong>Category</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $advertisement->category->name }}</td>
        </tr>
    </table>

    <p>You can edit your ad and resubmit it for review.</p>

    <p>Thank you for using our platform!</p>

</body>
</html>