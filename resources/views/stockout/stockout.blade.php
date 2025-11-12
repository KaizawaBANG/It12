<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Out - Inventory Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
        }

        .main-container {
            display: flex;
            flex: 1;
        }

        .content-wrapper {
            flex: 1;
            margin-left: 280px;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .page-title {
            font-size: 28px;
            color: #111827;
            font-weight: 600;
        }

        .breadcrumb {
            color: #6b7280;
            font-size: 14px;
        }

        .breadcrumb a {
            color: #3b82f6;
            text-decoration: none;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 18px;
            color: #111827;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header h2 i {
            color: #ef4444;
        }

        .card-body {
            padding: 24px;
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
            font-size: 14px;
        }

        .form-label.required::after {
            content: " *";
            color: #ef4444;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .form-hint {
            font-size: 12px;
            color: #6b7280;
            margin-top: 6px;
        }

        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: "▼";
            font-size: 12px;
            color: #6b7280;
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* Stock Availability */
        .stock-info {
            background: #f0f9ff;
            border: 1px solid #e0f2fe;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .stock-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .stock-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: white;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }

        .stock-name {
            font-weight: 500;
            color: #111827;
        }

        .stock-quantity {
            font-weight: 600;
            color: #10b981;
        }

        .stock-low {
            color: #f59e0b;
        }

        .stock-out {
            color: #ef4444;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .items-table th {
            background: #f9fafb;
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        .items-table td {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }

        .items-table input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }

        .items-table input:focus {
            outline: none;
            border-color: #ef4444;
        }

        .available-stock {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        .remove-item {
            color: #ef4444;
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .remove-item:hover {
            background: #fee2e2;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-outline:hover {
            background: #f9fafb;
        }

        /* Recent Stock Outs */
        .recent-stockouts {
            margin-top: 10px;
        }

        .stockout-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-bottom: 1px solid #f3f4f6;
        }

        .stockout-item:last-child {
            border-bottom: none;
        }

        .stockout-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #ef4444;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .stockout-details {
            flex: 1;
        }

        .stockout-title {
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }

        .stockout-info {
            color: #6b7280;
            font-size: 14px;
        }

        .stockout-amount {
            font-weight: 600;
            color: #ef4444;
        }

        /* Reason Types */
        .reason-types {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }

        .reason-type {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .reason-type:hover {
            border-color: #ef4444;
        }

        .reason-type.active {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .reason-icon {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            background: #ef4444;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .reason-name {
            font-weight: 500;
            color: #111827;
            font-size: 14px;
        }

        @media (max-width: 1024px) {
            .content-wrapper {
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .content-wrapper {
                padding: 15px;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .stock-details {
                grid-template-columns: 1fr;
            }
            
            .reason-types {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Sidebar Navigation -->
        @include('layouts.navigation')
        
        <!-- Main Content -->
        <div class="content-wrapper">
            <div class="container">
                <div class="header">
                    <div>
                        <h1 class="page-title">Stock Out</h1>
                        
                    </div>
                </div>

                <!-- Stock Out Form -->
                <div class="content-card">
                    <div class="card-header">
                        <h2><i class="fas fa-arrow-up"></i> New Stock Out Entry</h2>
                    </div>
                    <div class="card-body">
                        <form id="stockOutForm">
                            <div class="form-grid">
                                <!-- Stock Out Information -->
                                <div class="form-group">
                                    <label class="form-label required" for="referenceNo">Reference No.</label>
                                    <input type="text" id="referenceNo" class="form-control" placeholder="STK-OUT-2024-001" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label required" for="stockOutDate">Stock Out Date</label>
                                    <input type="date" id="stockOutDate" class="form-control" required>
                                </div>

                                <!-- Reason for Stock Out -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Reason for Stock Out</label>
                                    <div class="reason-types">
                                        <div class="reason-type active" data-reason="sale">
                                            <div class="reason-icon">
                                                <i class="fas fa-shopping-cart"></i>
                                            </div>
                                            <div class="reason-name">Sale</div>
                                        </div>
                                        <div class="reason-type" data-reason="damaged">
                                            <div class="reason-icon">
                                                <i class="fas fa-ban"></i>
                                            </div>
                                            <div class="reason-name">Damaged</div>
                                        </div>
                                        <div class="reason-type" data-reason="return">
                                            <div class="reason-icon">
                                                <i class="fas fa-undo"></i>
                                            </div>
                                            <div class="reason-name">Return</div>
                                        </div>
                                        <div class="reason-type" data-reason="internal">
                                            <div class="reason-icon">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <div class="reason-name">Internal Use</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Customer/Recipient Information -->
                                <div class="form-group">
                                    <label class="form-label" for="customer">Customer/Recipient</label>
                                    <input type="text" id="customer" class="form-control" placeholder="Enter customer or recipient name">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="issuedBy">Issued By</label>
                                    <input type="text" id="issuedBy" class="form-control" placeholder="Enter issuer name">
                                </div>

                                <!-- Available Stock -->
                                <div class="form-group full-width">
                                    <label class="form-label">Available Stock</label>
                                    <div class="stock-info">
                                        <div class="stock-details">
                                            <div class="stock-item">
                                                <div class="stock-name">Oak Wood Planks</div>
                                                <div class="stock-quantity">45 pcs</div>
                                            </div>
                                            <div class="stock-item">
                                                <div class="stock-name">Tempered Glass Sheets</div>
                                                <div class="stock-quantity stock-low">8 sheets</div>
                                            </div>
                                            <div class="stock-item">
                                                <div class="stock-name">Aluminum Rods</div>
                                                <div class="stock-quantity">120 pcs</div>
                                            </div>
                                            <div class="stock-item">
                                                <div class="stock-name">Plywood Sheets</div>
                                                <div class="stock-quantity">85 sheets</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Items to Stock Out -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Items to Stock Out</label>
                                    <table class="items-table">
                                        <thead>
                                            <tr>
                                                <th>Material</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Current Stock</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="itemsTableBody">
                                            <tr>
                                                <td>
                                                    <div class="select-wrapper">
                                                        <select class="form-control material-select" onchange="updateAvailableStock(this)">
                                                            <option value="">Select Material</option>
                                                            <option value="oak_planks" data-stock="45">Oak Wood Planks</option>
                                                            <option value="tempered_glass" data-stock="8">Tempered Glass Sheets</option>
                                                            <option value="aluminum_rods" data-stock="120">Aluminum Rods</option>
                                                            <option value="plywood" data-stock="85">Plywood Sheets</option>
                                                            <option value="pine_timber" data-stock="32">Pine Timber</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control quantity" value="1" min="1" max="45" onchange="validateQuantity(this)">
                                                    <div class="available-stock">Available: <span class="available-count">0</span></div>
                                                </td>
                                                <td>
                                                    <div class="select-wrapper">
                                                        <select class="form-control unit">
                                                            <option value="pcs">Pieces</option>
                                                            <option value="sheets">Sheets</option>
                                                            <option value="kg">Kilograms</option>
                                                            <option value="m">Meters</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="current-stock">-</span>
                                                </td>
                                                <td>
                                                    <div class="remove-item" onclick="removeItem(this)">
                                                        <i class="fas fa-times"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-outline" onclick="addNewItem()" style="margin-top: 15px;">
                                        <i class="fas fa-plus"></i> Add Another Item
                                    </button>
                                </div>

                                <!-- Additional Information -->
                                <div class="form-group full-width">
                                    <label class="form-label" for="notes">Notes</label>
                                    <textarea id="notes" class="form-control" rows="3" placeholder="Additional notes about this stock out..."></textarea>
                                </div>
                            </div>

                            <!-- Summary -->
                            <div class="form-group full-width" style="background: #fef2f2; padding: 20px; border-radius: 8px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <div style="font-weight: 600; color: #111827; margin-bottom: 5px;">Total Items to Remove</div>
                                        <div style="font-size: 24px; font-weight: 700; color: #ef4444;" id="totalItems">1</div>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-size: 14px; color: #6b7280; margin-bottom: 5px;">Total Quantity: <span id="totalQuantity">1</span></div>
                                        <div style="font-size: 14px; color: #ef4444; font-weight: 500;" id="stockWarning"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <button type="button" class="btn btn-outline">
                                    <i class="fas fa-times"></i> Cancel
                                </button>
                                <button type="button" class="btn btn-outline">
                                    <i class="fas fa-save"></i> Save Draft
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-check"></i> Process Stock Out
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Recent Stock Outs -->
                <div class="content-card">
                    <div class="card-header">
                        <h2><i class="fas fa-history"></i> Recent Stock Outs</h2>
                    </div>
                    <div class="card-body">
                        <div class="recent-stockouts">
                            <div class="stockout-item">
                                <div class="stockout-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="stockout-details">
                                    <div class="stockout-title">Customer Sale - ABC Construction</div>
                                    <div class="stockout-info">Ref: STK-OUT-2024-015 • 3 items</div>
                                </div>
                                <div class="stockout-amount">-25 pcs</div>
                            </div>
                            <div class="stockout-item">
                                <div class="stockout-icon" style="background: #f59e0b;">
                                    <i class="fas fa-ban"></i>
                                </div>
                                <div class="stockout-details">
                                    <div class="stockout-title">Damaged Goods - Quality Control</div>
                                    <div class="stockout-info">Ref: STK-OUT-2024-014 • 2 items</div>
                                </div>
                                <div class="stockout-amount">-8 sheets</div>
                            </div>
                            <div class="stockout-item">
                                <div class="stockout-icon" style="background: #3b82f6;">
                                    <i class="fas fa-undo"></i>
                                </div>
                                <div class="stockout-details">
                                    <div class="stockout-title">Supplier Return - Defective Items</div>
                                    <div class="stockout-info">Ref: STK-OUT-2024-013 • 1 item</div>
                                </div>
                                <div class="stockout-amount">-15 pcs</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Reason type selection
        document.querySelectorAll('.reason-type').forEach(reason => {
            reason.addEventListener('click', function() {
                document.querySelectorAll('.reason-type').forEach(r => r.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Update available stock when material is selected
        function updateAvailableStock(select) {
            const row = select.closest('tr');
            const selectedOption = select.options[select.selectedIndex];
            const availableStock = selectedOption.getAttribute('data-stock') || '0';
            
            row.querySelector('.available-count').textContent = availableStock;
            row.querySelector('.current-stock').textContent = availableStock;
            
            // Update quantity input max value
            const quantityInput = row.querySelector('.quantity');
            quantityInput.max = availableStock;
            quantityInput.value = Math.min(parseInt(quantityInput.value), availableStock);
            
            updateTotals();
        }

        // Validate quantity doesn't exceed available stock
        function validateQuantity(input) {
            const row = input.closest('tr');
            const maxStock = parseInt(input.max);
            const currentValue = parseInt(input.value) || 0;
            
            if (currentValue > maxStock) {
                input.value = maxStock;
                showStockWarning(`Quantity cannot exceed available stock of ${maxStock}`);
            } else if (currentValue < 1) {
                input.value = 1;
            }
            
            updateTotals();
        }

        // Show stock warning
        function showStockWarning(message) {
            const warningElement = document.getElementById('stockWarning');
            warningElement.textContent = message;
            setTimeout(() => {
                warningElement.textContent = '';
            }, 3000);
        }

        // Add new item row
        function addNewItem() {
            const tbody = document.getElementById('itemsTableBody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <div class="select-wrapper">
                        <select class="form-control material-select" onchange="updateAvailableStock(this)">
                            <option value="">Select Material</option>
                            <option value="oak_planks" data-stock="45">Oak Wood Planks</option>
                            <option value="tempered_glass" data-stock="8">Tempered Glass Sheets</option>
                            <option value="aluminum_rods" data-stock="120">Aluminum Rods</option>
                            <option value="plywood" data-stock="85">Plywood Sheets</option>
                            <option value="pine_timber" data-stock="32">Pine Timber</option>
                        </select>
                    </div>
                </td>
                <td>
                    <input type="number" class="form-control quantity" value="1" min="1" max="45" onchange="validateQuantity(this)">
                    <div class="available-stock">Available: <span class="available-count">0</span></div>
                </td>
                <td>
                    <div class="select-wrapper">
                        <select class="form-control unit">
                            <option value="pcs">Pieces</option>
                            <option value="sheets">Sheets</option>
                            <option value="kg">Kilograms</option>
                            <option value="m">Meters</option>
                        </select>
                    </div>
                </td>
                <td>
                    <span class="current-stock">-</span>
                </td>
                <td>
                    <div class="remove-item" onclick="removeItem(this)">
                        <i class="fas fa-times"></i>
                    </div>
                </td>
            `;
            tbody.appendChild(newRow);
            updateTotals();
        }

        // Remove item row
        function removeItem(button) {
            const row = button.closest('tr');
            if (document.querySelectorAll('#itemsTableBody tr').length > 1) {
                row.remove();
                updateTotals();
            }
        }

        // Update totals
        function updateTotals() {
            let totalItems = 0;
            let totalQuantity = 0;
            let hasLowStock = false;

            document.querySelectorAll('#itemsTableBody tr').forEach(row => {
                const quantity = parseInt(row.querySelector('.quantity').value) || 0;
                const availableStock = parseInt(row.querySelector('.available-count').textContent) || 0;
                
                totalItems++;
                totalQuantity += quantity;
                
                if (quantity > availableStock * 0.5) { // Warning if using more than 50% of stock
                    hasLowStock = true;
                }
            });

            document.getElementById('totalItems').textContent = totalItems;
            document.getElementById('totalQuantity').textContent = totalQuantity;

            if (hasLowStock) {
                document.getElementById('stockWarning').textContent = 'Warning: High quantity removal may affect stock levels';
            } else {
                document.getElementById('stockWarning').textContent = '';
            }
        }

        // Form submission
        document.getElementById('stockOutForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate stock availability
            let canProceed = true;
            document.querySelectorAll('#itemsTableBody tr').forEach(row => {
                const quantity = parseInt(row.querySelector('.quantity').value) || 0;
                const availableStock = parseInt(row.querySelector('.available-count').textContent) || 0;
                const materialSelect = row.querySelector('.material-select');
                
                if (materialSelect.value === '') {
                    alert('Please select a material for all items');
                    canProceed = false;
                    return;
                }
                
                if (quantity > availableStock) {
                    alert('Quantity cannot exceed available stock');
                    canProceed = false;
                    return;
                }
            });

            if (canProceed) {
                if (confirm('Are you sure you want to process this stock out? This action cannot be undone.')) {
                    alert('Stock Out processed successfully!');
                    // Add your form submission logic here
                }
            }
        });

        // Initialize with current date
        document.getElementById('stockOutDate').valueAsDate = new Date();
    </script>
</body>
</html>