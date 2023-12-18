<?php
// Retrieve invoice data from the database or other sources
$invoiceNumber = "INV-123";
$invoiceDate = "2023-06-21";
$customerName = "John Doe";
$items = [
    ['description' => 'Product 1', 'quantity' => 2, 'price' => 10],
    ['description' => 'Product 2', 'quantity' => 1, 'price' => 20],
];

// Calculate totals
$subTotal = 0;
foreach ($items as $item) {
    $subTotal += $item['quantity'] * $item['price'];
}
$taxRate = 0.15;
$taxAmount = $subTotal * $taxRate;
$grandTotal = $subTotal + $taxAmount;

// Generate the invoice HTML
$invoiceHTML = '<html>
<head>
    <title>Invoice</title>
    <style>
        /* Define your CSS styles for the invoice layout */
        /* ... */
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <h1>Invoice</h1>
            <!-- Output header information like invoice number, date, and customer details -->
            <p>Invoice Number: ' . $invoiceNumber . '</p>
            <p>Invoice Date: ' . $invoiceDate . '</p>
            <p>Customer Name: ' . $customerName . '</p>
        </div>
        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>';
                
foreach ($items as $item) {
    $total = $item['quantity'] * $item['price'];
    $invoiceHTML .= '<tr>
                        <td>' . $item['description'] . '</td>
                        <td>' . $item['quantity'] . '</td>
                        <td>' . $item['price'] . '</td>
                        <td>' . $total . '</td>
                    </tr>';
}

$invoiceHTML .= '</tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Subtotal</td>
                        <td>' . $subTotal . '</td>
                    </tr>
                    <tr>
                        <td colspan="3">Tax (' . ($taxRate * 100) . '%)</td>
                        <td>' . $taxAmount . '</td>
                    </tr>
                    <tr>
                        <td colspan="3">Grand Total</td>
                        <td>' . $grandTotal . '</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>';

// Output the generated invoice
echo $invoiceHTML;
?>
