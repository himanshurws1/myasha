<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Enquiry Confirmation</title>
    </head>
    <body style="font-family: Arial, sans-serif; color: #10212d; line-height: 1.6;">
        <h2 style="margin-bottom: 12px;">Thank you for contacting {{ config('app.name') }}</h2>

        <p>Hello {{ $enquiry->name }},</p>

        <p>
            We have received your enquiry successfully. Our team will review your message and get back to you soon.
        </p>

        <p><strong>Your submitted details:</strong></p>

        <table cellpadding="8" cellspacing="0" border="0" style="border-collapse: collapse;">
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

        <p style="margin-top: 24px;">Regards,<br>{{ config('app.name') }}</p>
    </body>
</html>
