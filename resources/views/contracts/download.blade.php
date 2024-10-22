<!DOCTYPE html>
<html>
<head>
    <title>Contract PDF</title>
</head>
<body>
    <h1>AMC Contract: {{ $contract->ref_no }}</h1>
    <p><strong>Type:</strong> {{ $contract->type }}</p>
    <p><strong>Location:</strong> {{ $contract->location }}</p>
    <p><strong>Status:</strong> {{ $contract->status }}</p>

    <!-- Additional contract details -->

    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contract->items as $item)
                <tr>
                    <td>{{ $item->product_desc }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->rate }}</td>
                    <td>{{ $item->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
