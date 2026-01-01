<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transactions Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #f59e0b;
        }
        .header h1 {
            color: #1f2937;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #6b7280;
            margin: 5px 0;
        }
        .summary {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .summary-item {
            display: table-cell;
            width: 33.33%;
            text-align: center;
            padding: 15px;
            background: #f9fafb;
            border-radius: 8px;
        }
        .summary-item:not(:last-child) {
            margin-right: 10px;
        }
        .summary-label {
            font-size: 11px;
            color: #6b7280;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .summary-value {
            font-size: 18px;
            font-weight: bold;
        }
        .summary-income { color: #10b981; }
        .summary-expense { color: #ef4444; }
        .summary-balance { color: #3b82f6; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #f9fafb;
            color: #374151;
            text-align: left;
            padding: 12px 8px;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            border-bottom: 2px solid #e5e7eb;
        }
        td {
            padding: 10px 8px;
            border-bottom: 1px solid #f3f4f6;
        }
        tr:hover {
            background-color: #f9fafb;
        }
        .type-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
        }
        .type-income {
            background-color: #d1fae5;
            color: #065f46;
        }
        .type-expense {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .amount-income {
            color: #10b981;
            font-weight: 600;
        }
        .amount-expense {
            color: #ef4444;
            font-weight: 600;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            color: #9ca3af;
            font-size: 10px;
        }
        .no-data {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Transaction Report</h1>
        <p>Customer: {{ $customer->name }}</p>
        <p>Generated on: {{ $generatedDate }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="summary-label">Total Income</div>
            <div class="summary-value summary-income">${{ number_format($totalIncome, 2) }}</div>
        </div>
        <div class="summary-item">
            <div class="summary-label">Total Expenses</div>
            <div class="summary-value summary-expense">${{ number_format($totalExpenses, 2) }}</div>
        </div>
        <div class="summary-item">
            <div class="summary-label">Net Balance</div>
            <div class="summary-value summary-balance">${{ number_format($balance, 2) }}</div>
        </div>
    </div>

    @if($transactions->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Payment</th>
                    <th style="text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ date('M d, Y', strtotime($transaction->transaction_date)) }}</td>
                        <td>
                            <span class="type-badge type-{{ $transaction->type }}">
                                {{ ucfirst($transaction->type) }}
                            </span>
                        </td>
                        <td>{{ $transaction->category->name }}</td>
                        <td>{{ $transaction->description ?? 'N/A' }}</td>
                        <td>{{ $transaction->payment_method ?? 'N/A' }}</td>
                        <td style="text-align: right;">
                            <span class="amount-{{ $transaction->type }}">
                                {{ $transaction->type === 'income' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <p>No transactions found for the selected filters.</p>
        </div>
    @endif

    <div class="footer">
        <p>Budget Calculator - DisciFlow &copy; {{ date('Y') }}</p>
    </div>
</body>
</html>
