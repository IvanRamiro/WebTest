<?php include 'header.php'; ?>
<?php include 'config.php'; ?>

<!-- ==================== INVENTORY ITEMS ==================== -->
<div class="details">
    <div class="inventoryContainer">
        <div class="cardHeader">
            <h2>Inventory List</h2>
            <button class="btn addItem" onclick="document.getElementById('addForm').style.display='block'">Add Item</button>
        </div>
        
        <!-- Add Item Form -->
        <div id="addForm" style="display: none;">
            <form action="add_item.php" method="POST">
                <input type="text" name="name" placeholder="Item Name" required>
                <input type="number" name="stock" placeholder="Stock" required>
                <input type="number" name="price" placeholder="Price" required>
                <button type="submit">Add</button>
                <button type="button" onclick="document.getElementById('addForm').style.display='none'">Cancel</button>
            </form>
        </div>

        <!-- Edit Item Form -->
        <div id="editForm" style="display: none;">
            <form action="edit_item.php" method="POST">
                <input type="hidden" name="id" id="editId">
                <input type="text" name="name" id="editName" placeholder="Item Name" required>
                <input type="number" name="stock" id="editStock" placeholder="Stock" required>
                <input type="number" name="price" id="editPrice" placeholder="Price" required>
                <button type="submit">Update</button>
                <button type="button" onclick="document.getElementById('editForm').style.display='none'">Cancel</button>
            </form>
        </div>

        <div class="tableContainer">
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
                    <?php
                    $sql = "SELECT * FROM inventory";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td>" . htmlspecialchars($row['stock']) . "</td>
                                <td>$" . htmlspecialchars($row['price']) . "</td>
                                <td>
                                    <button class='editBtn' onclick='openEditForm({$row['id']}, \"{$row['name']}\", {$row['stock']}, {$row['price']})'>Edit</button>
                                    <button class='deleteBtn' onclick='confirmDelete({$row['id']})'>Delete</button>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No items found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    const confirmationBox = document.createElement('div');
    confirmationBox.innerHTML = `
        <div class='confirm-box'>
            <p>Are you sure you want to delete this item?</p>
            <button onclick="window.location.href='delete_item.php?id=' + id" class='confirm-btn'>Yes</button>
            <button onclick="document.body.removeChild(this.parentNode)" class='cancel-btn'>No</button>
        </div>`;
    
    confirmationBox.style.position = 'fixed';
    confirmationBox.style.top = '50%';
    confirmationBox.style.left = '50%';
    confirmationBox.style.transform = 'translate(-50%, -50%)';
    confirmationBox.style.background = '#fff';
    confirmationBox.style.padding = '20px';
    confirmationBox.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.2)';
    confirmationBox.style.borderRadius = '8px';
    document.body.appendChild(confirmationBox);
}

function openEditForm(id, name, stock, price) {
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editStock').value = stock;
    document.getElementById('editPrice').value = price;
    document.getElementById('editForm').style.display = 'block';
}
</script>

<?php include 'footer.php'; ?>
