<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Adjustment - Inventory Management</title>
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
            color: #f59e0b;
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
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
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

        /* Adjustment Types */
        .adjustment-types {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .adjustment-type {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .adjustment-type:hover {
            border-color: #f59e0b;
        }

        .adjustment-type.active {
            border-color: #f59e0b;
            background: #fffbeb;
        }

        .adjustment-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .adjustment-increase .adjustment-icon { background: #10b981; }
        .adjustment-decrease .adjustment-icon { background: #ef4444; }
        .adjustment-correction .adjustment-icon { background: #3b82f6; }
        .adjustment-transfer .adjustment-icon { background: #8b5cf6; }

        .adjustment-info {
            flex: 1;
        }

        .adjustment-name {
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }

        .adjustment-desc {
            font-size: 12px;
            color: #6b7280;
        }

        /* Stock Summary */
        .stock-summary {
            background: #f0f9ff;
            border: 1px solid #e0f2fe;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .summary-item {
            text-align: center;
            padding: 15px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .summary-value {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 5px;
        }

        .summary-label {
            font-size: 12px;
            color: #6b7280;
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
            border-color: #f59e0b;
        }

        .stock-info {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        .adjustment-badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-increase {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-decrease {
            background: #fee2e2;
            color: #991b1b;
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

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-outline:hover {
            background: #f9fafb;
        }

        /* Recent Adjustments */
        .recent-adjustments {
            margin-top: 10px;
        }

        .adjustment-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-bottom: 1px solid #f3f4f6;
        }

        .adjustment-item:last-child {
            border-bottom: none;
        }

        .adjustment-item-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
        }

        .adjustment-increase .adjustment-item-icon { background: #10b981; }
        .adjustment-decrease .adjustment-item-icon { background: #ef4444; }
        .adjustment-correction .adjustment-item-icon { background: #3b82f6; }

        .adjustment-details {
            flex: 1;
        }

        .adjustment-title {
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }

        .adjustment-info {
            color: #6b7280;
            font-size: 14px;
        }

        .adjustment-amount {
            font-weight: 600;
        }

        .adjustment-positive {
            color: #10b981;
        }

        .adjustment-negative {
            color: #ef4444;
        }

        /* Reason Types */
        .reason-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }

        .reason-option {
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

        .reason-option:hover {
            border-color: #f59e0b;
        }

        .reason-option.active {
            border-color: #f59e0b;
            background: #fffbeb;
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
            
            .adjustment-types {
                grid-template-columns: 1fr;
            }
            
            .summary-grid {
                grid-template-columns: 1fr;
            }
            
            .reason-options {
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
                        <h1 class="page-title">Stock Adjustment</h1>
                       
                    </div>
                </div>

                <!-- Stock Adjustment Form -->
                <div class="content-card">
                    <div class="card-header">
                        <h2><i class="fas fa-exchange-alt"></i> New Stock Adjustment</h2>
                    </div>
                    <div class="card-body">
                        <form id="stockAdjustmentForm">
                            <div class="form-grid">
                                <!-- Adjustment Information -->
                                <div class="form-group">
                                    <label class="form-label required" for="referenceNo">Reference No.</label>
                                    <input type="text" id="referenceNo" class="form-control" placeholder="ADJ-2024-001" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label required" for="adjustmentDate">Adjustment Date</label>
                                    <input type="date" id="adjustmentDate" class="form-control" required>
                                </div>

                                <!-- Adjustment Type -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Adjustment Type</label>
                                    <div class="adjustment-types">
                                        <div class="adjustment-type adjustment-increase active" data-type="increase">
                                            <div class="adjustment-icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="adjustment-info">
                                                <div class="adjustment-name">Stock Increase</div>
                                                <div class="adjustment-desc">Add stock to inventory</div>
                                            </div>
                                        </div>
                                        <div class="adjustment-type adjustment-decrease" data-type="decrease">
                                            <div class="adjustment-icon">
                                                <i class="fas fa-minus"></i>
                                            </div>
                                            <div class="adjustment-info">
                                                <div class="adjustment-name">Stock Decrease</div>
                                                <div class="adjustment-desc">Remove stock from inventory</div>
                                            </div>
                                        </div>
                                        <div class="adjustment-type adjustment-correction" data-type="correction">
                                            <div class="adjustment-icon">
                                                <i class="fas fa-wrench"></i>
                                            </div>
                                            <div class="adjustment-info">
                                                <div class="adjustment-name">Stock Correction</div>
                                                <div class="adjustment-desc">Correct stock discrepancies</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reason for Adjustment -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Reason for Adjustment</label>
                                    <div class="reason-options">
                                        <div class="reason-option active" data-reason="count_error">
                                            <div class="reason-name">Counting Error</div>
                                        </div>
                                        <div class="reason-option" data-reason="damaged">
                                            <div class="reason-name">Damaged Goods</div>
                                        </div>
                                        <div class="reason-option" data-reason="theft">
                                            <div class="reason-name">Theft/Loss</div>
                                        </div>
                                        <div class="reason-option" data-reason="expired">
                                            <div class="reason-name">Expired Items</div>
                                        </div>
                                        <div class="reason-option" data-reason="found">
                                            <div class="reason-name">Found Items</div>
                                        </div>
                                        <div class="reason-option" data-reason="other">
                                            <div class="reason-name">Other</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Stock Summary -->
                                <div class="form-group full-width">
                                    <label class="form-label">Current Stock Summary</label>
                                    <div class="stock-summary">
                                        <div class="summary-grid">
                                            <div class="summary-item">
                                                <div class="summary-value">856</div>
                                                <div class="summary-label">Total Items</div>
                                            </div>
                                            <div class="summary-item">
                                                <div class="summary-value">₱2,847,890</div>
                                                <div class="summary-label">Total Value</div>
                                            </div>
                                            <div class="summary-item">
                                                <div class="summary-value" style="color: #10b981;">425</div>
                                                <div class="summary-label">Wood Items</div>
                                            </div>
                                            <div class="summary-item">
                                                <div class="summary-value" style="color: #87CEEB;">268</div>
                                                <div class="summary-label">Glass Items</div>
                                            </div>
                                            <div class="summary-item">
                                                <div class="summary-value" style="color: #A9A9A9;">163</div>
                                                <div class="summary-label">Aluminum Items</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Items to Adjust -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Items to Adjust</label>
                                    <table class="items-table">
                                        <thead>
                                            <tr>
                                                <th>Material</th>
                                                <th>Current Stock</th>
                                                <th>Adjustment</th>
                                                <th>New Stock</th>
                                                <th>Reason</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="itemsTableBody">
                                            <tr>
                                                <td>
                                                    <div class="select-wrapper">
                                                        <select class="form-control material-select" onchange="updateStockInfo(this)">
                                                            <option value="">Select Material</option>
                                                            <option value="oak_planks" data-stock="45" data-value="1250">Oak Wood Planks</option>
                                                            <option value="tempered_glass" data-stock="8" data-value="890">Tempered Glass Sheets</option>
                                                            <option value="aluminum_rods" data-stock="120" data-value="450">Aluminum Rods</option>
                                                            <option value="plywood" data-stock="85" data-value="680">Plywood Sheets</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="current-stock">-</span>
                                                    <div class="stock-info">Value: ₱<span class="stock-value">0</span></div>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control adjustment-amount" value="0" onchange="calculateNewStock(this)">
                                                    <div class="stock-info">
                                                        <span class="adjustment-badge badge-increase" style="display: none;">+Increase</span>
                                                        <span class="adjustment-badge badge-decrease" style="display: none;">-Decrease</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="new-stock">-</span>
                                                    <div class="stock-info">New Value: ₱<span class="new-value">0</span></div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control item-reason" placeholder="Reason for this item">
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
                                    <label class="form-label" for="notes">Adjustment Notes</label>
                                    <textarea id="notes" class="form-control" rows="3" placeholder="Detailed explanation for this stock adjustment..."></textarea>
                                </div>

                                <!-- Adjusted By -->
                                <div class="form-group">
                                    <label class="form-label required" for="adjustedBy">Adjusted By</label>
                                    <input type="text" id="adjustedBy" class="form-control" placeholder="Enter name" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="approvedBy">Approved By</label>
                                    <input type="text" id="approvedBy" class="form-control" placeholder="Approver name">
                                </div>
                            </div>

                            <!-- Adjustment Summary -->
                            <div class="form-group full-width" style="background: #fffbeb; padding: 20px; border-radius: 8px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <div style="font-weight: 600; color: #111827; margin-bottom: 5px;">Adjustment Summary</div>
                                        <div style="font-size: 18px; color: #f59e0b; font-weight: 600;" id="adjustmentSummary">0 items adjusted</div>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-size: 14px; color: #6b7280; margin-bottom: 5px;">Net Change: <span id="netChange">0</span></div>
                                        <div style="font-size: 14px; color: #6b7280;">Value Impact: ₱<span id="valueImpact">0.00</span></div>
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
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-check"></i> Process Adjustment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Recent Adjustments -->
                <div class="content-card">
                    <div class="card-header">
                        <h2><i class="fas fa-history"></i> Recent Stock Adjustments</h2>
                    </div>
                    <div class="card-body">
                        <div class="recent-adjustments">
                            <div class="adjustment-item adjustment-increase">
                                <div class="adjustment-item-icon">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="adjustment-details">
                                    <div class="adjustment-title">Stock Counting Correction</div>
                                    <div class="adjustment-info">Ref: ADJ-2024-015 • 3 items adjusted</div>
                                </div>
                                <div class="adjustment-amount adjustment-positive">+25 pcs</div>
                            </div>
                            <div class="adjustment-item adjustment-decrease">
                                <div class="adjustment-item-icon">
                                    <i class="fas fa-minus"></i>
                                </div>
                                <div class="adjustment-details">
                                    <div class="adjustment-title">Damaged Goods Write-off</div>
                                    <div class="adjustment-info">Ref: ADJ-2024-014 • 2 items adjusted</div>
                                </div>
                                <div class="adjustment-amount adjustment-negative">-8 sheets</div>
                            </div>
                            <div class="adjustment-item adjustment-correction">
                                <div class="adjustment-item-icon">
                                    <i class="fas fa-wrench"></i>
                                </div>
                                <div class="adjustment-details">
                                    <div class="adjustment-title">Inventory Reconciliation</div>
                                    <div class="adjustment-info">Ref: ADJ-2024-013 • 5 items corrected</div>
                                </div>
                                <div class="adjustment-amount adjustment-positive">+15 pcs</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Adjustment type selection
        document.querySelectorAll('.adjustment-type').forEach(type => {
            type.addEventListener('click', function() {
                document.querySelectorAll('.adjustment-type').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                updateAdjustmentType(this.dataset.type);
            });
        });

        // Reason option selection
        document.querySelectorAll('.reason-option').forEach(reason => {
            reason.addEventListener('click', function() {
                document.querySelectorAll('.reason-option').forEach(r => r.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Update adjustment type behavior
        function updateAdjustmentType(type) {
            const adjustmentInputs = document.querySelectorAll('.adjustment-amount');
            adjustmentInputs.forEach(input => {
                if (type === 'increase') {
                    input.min = 1;
                    input.placeholder = 'Positive number';
                } else if (type === 'decrease') {
                    input.min = 1;
                    input.placeholder = 'Positive number';
                } else {
                    input.min = -9999;
                    input.placeholder = 'Positive or negative';
                }
            });
            updateAllCalculations();
        }

        // Update stock information when material is selected
        function updateStockInfo(select) {
            const row = select.closest('tr');
            const selectedOption = select.options[select.selectedIndex];
            const currentStock = selectedOption.getAttribute('data-stock') || '0';
            const stockValue = selectedOption.getAttribute('data-value') || '0';
            
            row.querySelector('.current-stock').textContent = currentStock;
            row.querySelector('.stock-value').textContent = stockValue;
            
            calculateNewStock(row.querySelector('.adjustment-amount'));
        }

        // Calculate new stock based on adjustment
        function calculateNewStock(input) {
            const row = input.closest('tr');
            const currentStock = parseInt(row.querySelector('.current-stock').textContent) || 0;
            const stockValue = parseInt(row.querySelector('.stock-value').textContent) || 0;
            const adjustment = parseInt(input.value) || 0;
            
            const adjustmentType = document.querySelector('.adjustment-type.active').dataset.type;
            let newStock;
            
            if (adjustmentType === 'increase') {
                newStock = currentStock + Math.abs(adjustment);
            } else if (adjustmentType === 'decrease') {
                newStock = Math.max(0, currentStock - Math.abs(adjustment));
            } else {
                newStock = currentStock + adjustment;
            }
            
            const unitValue = stockValue / currentStock;
            const newValue = newStock * unitValue;
            
            row.querySelector('.new-stock').textContent = newStock;
            row.querySelector('.new-value').textContent = newValue.toFixed(2);
            
            // Update adjustment badge
            const increaseBadge = row.querySelector('.badge-increase');
            const decreaseBadge = row.querySelector('.badge-decrease');
            
            if (adjustment > 0) {
                increaseBadge.style.display = 'inline';
                decreaseBadge.style.display = 'none';
            } else if (adjustment < 0) {
                increaseBadge.style.display = 'none';
                decreaseBadge.style.display = 'inline';
            } else {
                increaseBadge.style.display = 'none';
                decreaseBadge.style.display = 'none';
            }
            
            updateAdjustmentSummary();
        }

        // Update all calculations
        function updateAllCalculations() {
            document.querySelectorAll('.adjustment-amount').forEach(input => {
                calculateNewStock(input);
            });
        }

        // Update adjustment summary
        function updateAdjustmentSummary() {
            let totalItems = 0;
            let netChange = 0;
            let valueImpact = 0;
            
            document.querySelectorAll('#itemsTableBody tr').forEach(row => {
                const currentStock = parseInt(row.querySelector('.current-stock').textContent) || 0;
                const newStock = parseInt(row.querySelector('.new-stock').textContent) || 0;
                const stockValue = parseInt(row.querySelector('.stock-value').textContent) || 0;
                const newValue = parseFloat(row.querySelector('.new-value').textContent) || 0;
                
                if (currentStock !== newStock) {
                    totalItems++;
                    netChange += (newStock - currentStock);
                    valueImpact += (newValue - stockValue);
                }
            });
            
            document.getElementById('adjustmentSummary').textContent = `${totalItems} items adjusted`;
            document.getElementById('netChange').textContent = netChange > 0 ? `+${netChange}` : netChange;
            document.getElementById('netChange').style.color = netChange > 0 ? '#10b981' : netChange < 0 ? '#ef4444' : '#6b7280';
            document.getElementById('valueImpact').textContent = valueImpact.toFixed(2);
            document.getElementById('valueImpact').style.color = valueImpact > 0 ? '#10b981' : valueImpact < 0 ? '#ef4444' : '#6b7280';
        }

        // Add new item row
        function addNewItem() {
            const tbody = document.getElementById('itemsTableBody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <div class="select-wrapper">
                        <select class="form-control material-select" onchange="updateStockInfo(this)">
                            <option value="">Select Material</option>
                            <option value="oak_planks" data-stock="45" data-value="1250">Oak Wood Planks</option>
                            <option value="tempered_glass" data-stock="8" data-value="890">Tempered Glass Sheets</option>
                            <option value="aluminum_rods" data-stock="120" data-value="450">Aluminum Rods</option>
                            <option value="plywood" data-stock="85" data-value="680">Plywood Sheets</option>
                        </select>
                    </div>
                </td>
                <td>
                    <span class="current-stock">-</span>
                    <div class="stock-info">Value: ₱<span class="stock-value">0</span></div>
                </td>
                <td>
                    <input type="number" class="form-control adjustment-amount" value="0" onchange="calculateNewStock(this)">
                    <div class="stock-info">
                        <span class="adjustment-badge badge-increase" style="display: none;">+Increase</span>
                        <span class="adjustment-badge badge-decrease" style="display: none;">-Decrease</span>
                    </div>
                </td>
                <td>
                    <span class="new-stock">-</span>
                    <div class="stock-info">New Value: ₱<span class="new-value">0</span></div>
                </td>
                <td>
                    <input type="text" class="form-control item-reason" placeholder="Reason for this item">
                </td>
                <td>
                    <div class="remove-item" onclick="removeItem(this)">
                        <i class="fas fa-times"></i>
                    </div>
                </td>
            `;
            tbody.appendChild(newRow);
            
            // Update adjustment type for new row
            const activeType = document.querySelector('.adjustment-type.active');
            if (activeType) {
                updateAdjustmentType(activeType.dataset.type);
            }
        }

        // Remove item row
        function removeItem(button) {
            const row = button.closest('tr');
            if (document.querySelectorAll('#itemsTableBody tr').length > 1) {
                row.remove();
                updateAdjustmentSummary();
            }
        }

        // Form submission
        document.getElementById('stockAdjustmentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            let canProceed = true;
            let hasAdjustments = false;
            
            document.querySelectorAll('#itemsTableBody tr').forEach(row => {
                const materialSelect = row.querySelector('.material-select');
                const adjustment = parseInt(row.querySelector('.adjustment-amount').value) || 0;
                
                if (materialSelect.value === '') {
                    alert('Please select a material for all items');
                    canProceed = false;
                    return;
                }
                
                if (adjustment !== 0) {
                    hasAdjustments = true;
                }
            });

            if (!hasAdjustments) {
                alert('Please make at least one adjustment');
                canProceed = false;
            }

            if (canProceed) {
                if (confirm('Are you sure you want to process this stock adjustment?')) {
                    alert('Stock Adjustment processed successfully!');
                    // Add your form submission logic here
                }
            }
        });

        // Initialize with current date
        document.getElementById('adjustmentDate').valueAsDate = new Date();
        
        // Set default adjusted by to current user (you can modify this)
        document.getElementById('adjustedBy').value = 'Current User';
    </script>
</body>
</html>