<!DOCTYPE html>
<html>
<head>
    <title>Ad Approved</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">

    <h2 style="color: #16a34a;">Your Ad Has Been Approved! 🎉</h2>

    <p>Hi {{ $advertisement->user->name }},</p>

    <p>Great news! Your advertisement has been reviewed and approved. It is now live on our platform.</p>

    <table style="border-collapse: collapse; width: 100%; margin: 20px 0;">
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9;"><strong>Title</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $advertisement->title }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9;"><strong>Category</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $advertisement->category->name }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; background: #f9f9f9;"><strong>Price</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">LKR {{ number_format($advertisement->price) }}</td>
        </tr>
    </table>

    <p>Thank you for using our platform!</p>

</body>
</html>