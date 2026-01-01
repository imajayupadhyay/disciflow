<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Alert</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .alert-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .content {
            padding: 30px 20px;
        }
        .alert-message {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .alert-message p {
            margin: 0;
            color: #92400e;
            font-size: 16px;
            font-weight: 500;
        }
        .alert-details {
            background-color: #f9fafb;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #6b7280;
        }
        .detail-value {
            color: #111827;
            font-weight: 500;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            margin: 5px 0;
        }
        @media only screen and (max-width: 600px) {
            .container {
                margin: 0;
                border-radius: 0;
            }
            .content {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="alert-icon">⚠️</div>
            <h1>Budget Alert Triggered</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Hello <strong>{{ $customer->name }}</strong>,</p>

            <p>This is an automated alert from your DisciFlow Budget Tracker.</p>

            <!-- Alert Message -->
            <div class="alert-message">
                <p>{{ $alertMessage }}</p>
            </div>

            <!-- Alert Details -->
            <div class="alert-details">
                <div class="detail-row">
                    <span class="detail-label">Alert Name:</span>
                    <span class="detail-value">{{ $alert->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Alert Type:</span>
                    <span class="detail-value">{{ ucwords(str_replace('_', ' ', $alert->alert_type)) }}</span>
                </div>
                @if($alert->budget)
                <div class="detail-row">
                    <span class="detail-label">Budget:</span>
                    <span class="detail-value">{{ $alert->budget->category->name ?? 'N/A' }}</span>
                </div>
                @endif
                @if($alert->category)
                <div class="detail-row">
                    <span class="detail-label">Category:</span>
                    <span class="detail-value">{{ $alert->category->name }}</span>
                </div>
                @endif
                <div class="detail-row">
                    <span class="detail-label">Threshold:</span>
                    <span class="detail-value">
                        @if($alert->condition_type === 'percentage')
                            {{ $alert->threshold_value }}%
                        @else
                            ${{ number_format($alert->threshold_value, 2) }}
                        @endif
                    </span>
                </div>
                @if($currentValue)
                <div class="detail-row">
                    <span class="detail-label">Current Value:</span>
                    <span class="detail-value">
                        @if($alert->condition_type === 'percentage')
                            {{ number_format($currentValue, 1) }}%
                        @else
                            ${{ number_format($currentValue, 2) }}
                        @endif
                    </span>
                </div>
                @endif
                <div class="detail-row">
                    <span class="detail-label">Date:</span>
                    <span class="detail-value">{{ now()->format('F d, Y h:i A') }}</span>
                </div>
            </div>

            <!-- Call to Action -->
            <center>
                <a href="{{ env('APP_URL') }}/trackers/budget-calculator/alerts" class="cta-button">
                    View Budget Dashboard
                </a>
            </center>

            <p style="margin-top: 20px; color: #6b7280; font-size: 14px;">
                You're receiving this email because you enabled email notifications for this alert.
                You can manage your alert settings in your budget dashboard.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>DisciFlow</strong> - Smart Budget Tracking</p>
            <p>&copy; {{ date('Y') }} DisciFlow. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
