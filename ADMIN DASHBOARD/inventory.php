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
                            echo "<tr id='item-{$row['id']}'>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            
            fetch(`delete_item.php?id=${id}`, { method: "GET" })
                .then(response => {
                    if (response.ok) {
                        return response.text();
                    } else {
                        throw new Error("Failed to delete item.");
                    }
                })
                .then(() => {
                    // Show success message
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your item has been deleted.",
                        icon: "success"
                    }).then(() => {
                        // Reload the page after the success alert
                        location.reload();
                    });
                })
                .catch(error => {
                    Swal.fire("Error!", error.message, "error");
                });
        }
    });
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
