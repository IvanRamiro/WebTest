<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOAN MANAGEMENT DASHBOARD</title>
    
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="dashboard.js" defer></script>

</head>
<body>
    
<div class="dashboard-grid">
    <div class="calendar-container">
        <h2 class="calendar-main-header">CALENDAR</h2>
        <div class="calendar-header">
            <div class="widget-title" id="current-month-year">CALENDAR</div>
            <div class="calendar-nav-actions">
                <button class="calendar-nav-btn" id="prev-month"><i class="fas fa-chevron-left"></i> Prev</button>
                <button class="calendar-nav-btn" id="today-btn">Today</button>
                <button class="calendar-nav-btn" id="next-month">Next <i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="calendar-nav-actions">
                <button class="calendar-nav-btn" id="month-view">Month View</button>
                <button class="calendar-nav-btn" id="add-event">+ Add Event</button>
            </div>
        </div>
        <div class="calendar-grid" id="calendar-grid"></div>
    </div>

    <div class="todo-container">
        <div class="widget-header">
            <h3 class="widget-title">To-Do List</h3>
            <button id="filter-todos" style="background: none; border: none; cursor: pointer;">
                <i class="fas fa-filter" style="color: var(--black2);"></i>
            </button>
        </div>
        <div class="todo-list" id="todo-list"></div>
        <form class="todo-add" id="todo-form">
            <input type="text" class="todo-input" id="new-todo" placeholder="Add new task..." required>
            <button type="submit" class="todo-submit">Add</button>
        </form>
    </div>

<!-- Recent Logs Container -->
<div class="logs-container">
    <h3>Recent Customer Applications</h3>
    <?php
    include 'config.php';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->query("
            SELECT first_name, last_name, submitted_at 
            FROM loan_application 
            ORDER BY submitted_at DESC 
            LIMIT 5
        ");
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $time = date("h:i A", strtotime($row['submitted_at']));
            $date = date("M j, Y", strtotime($row['submitted_at']));
            echo '
            <div class="log-item">
                <div class="log-content">
                    <i class="fas fa-user-circle log-icon"></i>
                    <strong>'.htmlspecialchars($row['first_name'].' '.htmlspecialchars($row['last_name'])).'</strong>
                </div>
                <div class="log-time">
                    '.$time.' on '.$date.'
                </div>
            </div>';
        }
    } catch(PDOException $e) {
        echo '<div class="log-item">Error loading recent applications: '.htmlspecialchars($e->getMessage()).'</div>';
    }
    ?>
</div>

<!-- Modals (same as before) -->
<div class="modal" id="event-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Add Event</h3>
            <button class="modal-close" id="close-event-modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label" for="event-date">Date</label>
                <input type="date" class="form-control" id="event-date">
            </div>
            <div class="form-group">
                <label class="form-label" for="event-content">Event Details</label>
                <textarea class="form-control" id="event-content" rows="4" placeholder="Enter event description"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-secondary" id="cancel-event">Cancel</button>
            <button class="modal-btn modal-btn-primary" id="save-event">Save</button>
        </div>
    </div>
</div>

<div class="modal" id="todo-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Task</h3>
            <button class="modal-close" id="close-todo-modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label" for="edit-todo-text">Task</label>
                <input type="text" class="form-control" id="edit-todo-text">
            </div>
            <div class="form-group">
                <label class="form-label" for="edit-todo-status">Status</label>
                <select class="form-select" id="edit-todo-status">
                    <option value="pending">Pending</option>
                    <option value="in-progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-secondary" id="cancel-todo">Cancel</button>
            <button class="modal-btn modal-btn-primary" id="save-todo">Save</button>
            <button class="modal-btn modal-btn-secondary" id="delete-todo" style="background: #f44336; color: white;">Delete</button>
        </div>
    </div>
</div>

<!-- JavaScript (same as before) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    let selectedDate = null;
    let todos = JSON.parse(localStorage.getItem('todos')) || [];
    
    function initCalendar() {
        renderCalendar(currentMonth, currentYear);
        renderTodos();
        setupEventListeners();
    }
    
    function setupEventListeners() {
        
        document.getElementById('prev-month').addEventListener('click', function() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar(currentMonth, currentYear);
        });
        
        document.getElementById('next-month').addEventListener('click', function() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar(currentMonth, currentYear);
        });
        
        document.getElementById('today-btn').addEventListener('click', function() {
            currentDate = new Date();
            currentMonth = currentDate.getMonth();
            currentYear = currentDate.getFullYear();
            renderCalendar(currentMonth, currentYear);
            renderTodos(new Date().toISOString().split('T')[0]);
        });
        
        document.getElementById('add-event').addEventListener('click', function() {
            const modal = document.getElementById('event-modal');
            const today = new Date().toISOString().split('T')[0];
            
            document.getElementById('event-date').value = today;
            document.getElementById('event-content').value = '';
            
            modal.style.display = 'flex';
        });
        
        document.getElementById('month-view').addEventListener('click', function() {
            renderCalendar(currentMonth, currentYear);
        });
        
        document.getElementById('todo-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const todoInput = document.getElementById('new-todo');
            const todoText = todoInput.value.trim();
            
            if (todoText) {
                todos.push({
                    text: todoText,
                    status: 'pending',
                    createdAt: new Date().toISOString(),
                    eventDate: new Date().toISOString().split('T')[0] 
                });
                
                saveTodos();
                todoInput.value = '';
                renderTodos();
            }
        });
        
        document.getElementById('save-event').addEventListener('click', function() {
            const eventContent = document.getElementById('event-content').value.trim();
            const eventDate = document.getElementById('event-date').value;
            
            if (eventContent) {
                todos.push({
                    text: eventContent,
                    status: 'pending',
                    createdAt: new Date().toISOString(),
                    eventDate: eventDate
                });
                
                saveTodos();
                renderTodos(eventDate);
                closeModals();
            }
        });
        
        document.getElementById('close-event-modal').addEventListener('click', closeModals);
        document.getElementById('cancel-event').addEventListener('click', closeModals);
        
        document.getElementById('filter-todos').addEventListener('click', function() {
            const currentFilter = this.dataset.filter || 'all';
            let newFilter;
            
            switch (currentFilter) {
                case 'all':
                    newFilter = 'pending';
                    this.innerHTML = '<i class="fas fa-filter" style="color: var(--secondary);"></i>';
                    break;
                case 'pending':
                    newFilter = 'in-progress';
                    break;
                case 'in-progress':
                    newFilter = 'done';
                    break;
                case 'done':
                    newFilter = 'all';
                    this.innerHTML = '<i class="fas fa-filter" style="color: var(--black2);"></i>';
                    break;
            }
            
            this.dataset.filter = newFilter;
            renderTodos(null, newFilter);
        });
    }
    
    function renderCalendar(month, year) {
        const calendarGrid = document.getElementById('calendar-grid');
        const monthYearDisplay = document.getElementById('current-month-year');
        
        calendarGrid.innerHTML = '';
        
        const monthNames = ["January", "February", "March", "April", "May", "June", 
                          "July", "August", "September", "October", "November", "December"];
        monthYearDisplay.textContent = `${monthNames[month]} ${year}`;
        
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const prevMonthDays = new Date(year, month, 0).getDate();
        
        const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        dayNames.forEach(day => {
            const dayHeader = document.createElement('div');
            dayHeader.className = 'calendar-day-header';
            dayHeader.textContent = day;
            calendarGrid.appendChild(dayHeader);
        });
        
        for (let i = firstDay - 1; i >= 0; i--) {
            const dayElement = createDayElement(prevMonthDays - i, month - 1, year, true);
            calendarGrid.appendChild(dayElement);
        }
        
        const today = new Date();
        for (let i = 1; i <= daysInMonth; i++) {
            const isToday = i === today.getDate() && month === today.getMonth() && year === today.getFullYear();
            const dayElement = createDayElement(i, month, year, false, isToday);
            calendarGrid.appendChild(dayElement);
        }
        
        const totalCells = firstDay + daysInMonth;
        const remainingCells = totalCells <= 35 ? 35 - totalCells : 42 - totalCells;
        
        for (let i = 1; i <= remainingCells; i++) {
            const dayElement = createDayElement(i, month + 1, year, true);
            calendarGrid.appendChild(dayElement);
        }
    }
    
    function createDayElement(day, month, year, isOtherMonth, isToday = false) {
        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day';
        dayElement.textContent = day;
        
        if (isOtherMonth) {
            dayElement.classList.add('other-month');
        }
        
        if (isToday) {
            dayElement.classList.add('today');
        }
        
        const dateKey = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const hasTodos = todos.some(todo => todo.eventDate === dateKey);
        
        if (hasTodos) {
            dayElement.classList.add('has-todos');
        }
        
        dayElement.addEventListener('click', function() {
            renderTodos(dateKey);
        });
        
        return dayElement;
    }
    
    function renderTodos(dateFilter = null, statusFilter = 'all') {
        const todoList = document.getElementById('todo-list');
        todoList.innerHTML = '';
        
        let filteredTodos = todos;
        
        if (dateFilter) {
            filteredTodos = todos.filter(todo => todo.eventDate === dateFilter);
        }
        
        if (statusFilter === 'pending') {
            filteredTodos = filteredTodos.filter(todo => todo.status === 'pending');
        } else if (statusFilter === 'in-progress') {
            filteredTodos = filteredTodos.filter(todo => todo.status === 'in-progress');
        } else if (statusFilter === 'done') {
            filteredTodos = filteredTodos.filter(todo => todo.status === 'done');
        }
        
        if (filteredTodos.length === 0) {
            const emptyMessage = document.createElement('div');
            emptyMessage.textContent = 'No tasks found';
            emptyMessage.style.textAlign = 'center';
            emptyMessage.style.padding = '20px';
            emptyMessage.style.color = 'var(--black2)';
            todoList.appendChild(emptyMessage);
            return;
        }
        
        filteredTodos.forEach((todo, index) => {
            const todoItem = document.createElement('div');
            todoItem.className = 'todo-item';
            todoItem.dataset.id = index;
            
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.className = 'todo-checkbox';
            checkbox.checked = todo.status === 'done';
            
            const todoText = document.createElement('div');
            todoText.className = 'todo-text';
            if (todo.status === 'done') {
                todoText.classList.add('completed');
            }
            todoText.textContent = todo.text;
            
            const todoStatus = document.createElement('span');
            todoStatus.className = `todo-status ${todo.status.replace(' ', '-')}`;
            todoStatus.textContent = todo.status === 'in-progress' ? 'In Progress' : 
                                   todo.status === 'done' ? 'Done' : 'Pending';
            
            const todoActions = document.createElement('div');
            todoActions.className = 'todo-actions';
            
            const editBtn = document.createElement('button');
            editBtn.className = 'todo-action-btn';
            editBtn.innerHTML = '<i class="fas fa-edit"></i>';
            editBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                openTodoModal(index);
            });
            
            const deleteBtn = document.createElement('button');
            deleteBtn.className = 'todo-action-btn';
            deleteBtn.innerHTML = '<i class="fas fa-trash"></i>';
            deleteBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                deleteTodo(index);
            });
            
            todoActions.appendChild(editBtn);
            todoActions.appendChild(deleteBtn);
            
            checkbox.addEventListener('change', function() {
                todo.status = this.checked ? 'done' : 'pending';
                todoText.classList.toggle('completed', this.checked);
                todoStatus.textContent = this.checked ? 'Done' : 'Pending';
                todoStatus.className = `todo-status ${todo.status.replace(' ', '-')}`;
                saveTodos();
            });
            
            todoItem.appendChild(checkbox);
            todoItem.appendChild(todoText);
            todoItem.appendChild(todoStatus);
            todoItem.appendChild(todoActions);
            
            todoList.appendChild(todoItem);
        });
    }
    
    function openTodoModal(index) {
        const modal = document.getElementById('todo-modal');
        const todo = todos[index];
        
        document.getElementById('edit-todo-text').value = todo.text;
        document.getElementById('edit-todo-status').value = todo.status;
        document.getElementById('save-todo').dataset.id = index;
        document.getElementById('delete-todo').dataset.id = index;
        
        modal.style.display = 'flex';
    }
    
    function deleteTodo(index) {
        if (confirm('Are you sure you want to delete this task?')) {
            todos.splice(index, 1);
            saveTodos();
            renderTodos();
        }
    }
    
    function saveTodos() {
        localStorage.setItem('todos', JSON.stringify(todos));
    }
    
    function closeModals() {
        document.getElementById('event-modal').style.display = 'none';
        document.getElementById('todo-modal').style.display = 'none';
    }
    
    window.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal')) {
            closeModals();
        }
    });
    
    document.getElementById('close-todo-modal').addEventListener('click', closeModals);
    document.getElementById('cancel-todo').addEventListener('click', closeModals);
    
    document.getElementById('save-todo').addEventListener('click', function() {
        const index = this.dataset.id;
        const text = document.getElementById('edit-todo-text').value.trim();
        const status = document.getElementById('edit-todo-status').value;
        
        if (text) {
            todos[index].text = text;
            todos[index].status = status;
            saveTodos();
            renderTodos();
            closeModals();
        }
    });
    
    document.getElementById('delete-todo').addEventListener('click', function() {
        const index = this.dataset.id;
        deleteTodo(index);
        closeModals();
    });
    
    initCalendar();
});
</script>

    <?php include 'footer.php'; ?>
</body>
</html>