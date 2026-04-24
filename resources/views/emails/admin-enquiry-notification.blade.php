<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>New Enquiry</title>
    </head>
    <body style="font-family: Arial, sans-serif; color: #10212d; line-height: 1.6;">
        <h2 style="margin-bottom: 12px;">New enquiry received on {{ config('app.name') }}</h2>

        <p>A new enquiry has been submitted from the website contact form.</p>

        <table cellpadding="8" cellspacing="0" border="0" style="border-collapse: collapse;">
            <tr>
                <td><strong>Name</strong></td>
                <td>{{ $enquiry->name }}</td>
            </tr>
            <tr>
                <td><strong>Company</strong></td>
                <td>{{ $enquiry->company ?: 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td>{{ $enquiry->email }}</td>
            </tr>
            <tr>
                <td><strong>Phone</strong></td>
                <td>{{ $enquiry->phone ?: 'N/A' }}</td>
            </tr>
        </table>

        <p style="margin-top: 16px;"><strong>Message</strong></p>
        <p>{{ $enquiry->message }}</p>
    </body>
</html>
