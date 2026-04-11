<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; }
        .header { background: #00FF41; padding: 40px; text-align: center; border-radius: 20px 20px 0 0; }
        .content { padding: 40px; background: #fff; border: 1px solid #eee; border-radius: 0 0 20px 20px; }
        .footer { padding: 20px; text-align: center; font-size: 12px; color: #999; }
        .amount { font-size: 32px; font-weight: 900; color: #000; margin: 20px 0; }
        .btn { display: inline-block; background: #000; color: #fff; padding: 15px 30px; text-decoration: none; border-radius: 10px; font-weight: bold; text-transform: uppercase; font-size: 14px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin:0; font-style: italic; text-transform: uppercase;">Elite Impact</h1>
    </div>
    <div class="content">
        <h2>Dear Supporter,</h2>
        <p>On behalf of the <strong>Think Right Football Academy</strong>, we want to express our deepest gratitude for your generous donation.</p>
        
        <p>Your contribution is a direct investment in the future of our young athletes. It helps us provide world-class training, better equipment, and the mentorship they need to excel on and off the pitch.</p>

        <div style="background: #f9f9f9; padding: 30px; border-radius: 15px; text-align: center;">
            <p style="margin:0; text-transform: uppercase; font-size: 10px; font-weight: 900; color: #999; letter-spacing: 2px;">Amount Donated</p>
            <div class="amount">₦{{ number_format($payment->amount, 2) }}</div>
            <p style="margin:0; font-size: 12px; color: #666;">Reference: {{ $payment->reference }}</p>
        </div>

        @if($payment->campaign_id)
            <p style="margin-top: 20px; font-style: italic; color: #666;">Supported Campaign: <strong>{{ \App\Models\FundingCampaign::find($payment->campaign_id)?->title }}</strong></p>
        @endif

        <p>We are committed to transparency and excellence. You can follow our progress and see how your donation is making an impact through our website.</p>

        <a href="{{ url('/') }}" class="btn">Visit Our Website</a>

        <p style="margin-top: 40px;">Sincerely,<br><strong>The TRFA Leadership Team</strong></p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Think Right Football Academy. All Rights Reserved.
    </div>
</body>
</html>
