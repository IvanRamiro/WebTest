// Navigation Hover Effect
let list = document.querySelectorAll(".navigation li");

function activeLink() {
    list.forEach((item) => item.classList.remove("hovered"));
    this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};

// DOM Content Loaded Event
document.addEventListener("DOMContentLoaded", function () {
    const addItemBtn = document.querySelector(".addItem");
    const tableBody = document.querySelector(".itemOrders tbody");

    // Add Item Function
    addItemBtn.addEventListener("click", function () {
        let itemName = prompt("Enter Item Name:");
        let itemPrice = prompt("Enter Item Price ($):");
        let itemSales = prompt("Enter Sales Status (Paid/Due):");
        let itemStatus = prompt("Enter Status (Delivered/Pending/Return/In Progress):");

        if (itemName && itemPrice && itemSales && itemStatus) {
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td>${itemName}</td>
                <td>$${itemPrice}</td>
                <td>${itemSales}</td>
                <td><span class="status ${getStatusClass(itemStatus)}">${itemStatus}</span></td>
                <td>
                    <button class="editBtn">Edit</button>
                    <button class="deleteBtn">Delete</button>
                </td>
            `;
            tableBody.appendChild(newRow);
            addRowListeners(newRow);
        }
    });

    // Edit & Delete Functions
    function addRowListeners(row) {
        row.querySelector(".editBtn").addEventListener("click", function () {
            let newName = prompt("Edit Item Name:", row.children[0].textContent);
            let newPrice = prompt("Edit Item Price ($):", row.children[1].textContent.replace("$", ""));
            let newSales = prompt("Edit Sales Status (Paid/Due):", row.children[2].textContent);
            let newStatus = prompt("Edit Status (Delivered/Pending/Return/In Progress):", row.children[3].textContent);

            if (newName && newPrice && newSales && newStatus) {
                row.children[0].textContent = newName;
                row.children[1].textContent = `$${newPrice}`;
                row.children[2].textContent = newSales;
                row.children[3].innerHTML = `<span class="status ${getStatusClass(newStatus)}">${newStatus}</span>`;
            }
        });

        row.querySelector(".deleteBtn").addEventListener("click", function () {
            if (confirm("Are you sure you want to delete this item?")) {
                row.remove();
            }
        });
    }

    // Assign listeners to existing rows
    document.querySelectorAll(".itemOrders tbody tr").forEach(addRowListeners);

    // Function to assign correct status class
    function getStatusClass(status) {
        let statusLower = status.toLowerCase();
        if (statusLower === "delivered") return "delivered";
        if (statusLower === "pending") return "pending";
        if (statusLower === "return") return "return";
        if (statusLower === "in progress") return "inProgress";
        return "";
    }
});