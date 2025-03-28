<?php include 'header.php'; ?>

<!-- ==================== INVENTORY ITEMS ==================== -->
<div class="details">
    <div class="cardHeader">
        <h2>Inventory List</h2>
        <button class="btn addItem">Add Item</button>
    </div>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Stock</td>
                <td>Price</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Dell Laptop</td>
                <td>10</td>
                <td>$150</td>
                <td>
                    <button class="editBtn">Edit</button>
                    <button class="deleteBtn">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
