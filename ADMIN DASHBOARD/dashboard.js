// DOM Elements
const toggle = document.querySelector('.toggle');
const navigation = document.querySelector('.navigation');
const main = document.querySelector('.main');
const themeToggle = document.querySelector('#theme-toggle');
const overlay = document.createElement('div');

overlay.classList.add('nav-overlay');
document.body.appendChild(overlay);

document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark');
    }
    
    setActiveNavItem();
    
    document.querySelectorAll('.deleteBtn').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.getAttribute('data-id');
            deleteItem(itemId);
        });
    });
});

toggle.onclick = function() {
    navigation.classList.toggle('active');
    main.classList.toggle('active');
    overlay.classList.toggle('active');
};

overlay.onclick = function() {
    navigation.classList.remove('active');
    main.classList.remove('active');
    overlay.classList.remove('active');
};

function setActiveNavItem() {
    const navItems = document.querySelectorAll('.navigation li:not(.logo)');
    const currentPage = window.location.pathname.split('/').pop();
    
    navItems.forEach(item => {
        const link = item.querySelector('a');
        const itemPage = link.getAttribute('href');
        
        if (itemPage === currentPage) {
            item.classList.add('active');
            localStorage.setItem('activeNavItem', itemPage);
        }
        
        item.addEventListener('click', function(e) {
            if (e.target.tagName === 'A') return;
            
            navItems.forEach(navItem => {
                navItem.classList.remove('active');
            });
            
            this.classList.add('active');
            
            localStorage.setItem('activeNavItem', itemPage);
        });
    });
    
    if (!document.querySelector('.navigation li.active')) {
        const storedActiveItem = localStorage.getItem('activeNavItem');
        if (storedActiveItem) {
            navItems.forEach(item => {
                if (item.querySelector('a').getAttribute('href') === storedActiveItem) {
                    item.classList.add('active');
                }
            });
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Calendar functionality
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    let selectedDate = null;
    let notes = JSON.parse(localStorage.getItem('calendarNotes')) || {};
    let todos = JSON.parse(localStorage.getItem('todos')) || [];
    
    // Initialize the calendar
    function initCalendar() {
        renderCalendar(currentMonth, currentYear);
        renderTodos();
    }
    
    // Render the calendar for a specific month and year
    function renderCalendar(month, year) {
        const calendarGrid = document.getElementById('calendar-grid');
        const monthYearDisplay = document.getElementById('current-month-year');
        
        // Clear previous calendar
        calendarGrid.innerHTML = '';
        
        // Set month and year display
        const monthNames = ["January", "February", "March", "April", "May", "June", 
                          "July", "August", "September", "October", "November", "December"];
        monthYearDisplay.textContent = `${monthNames[month]} ${year}`;
        
        // Get first day of month and total days in month
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        
        // Get days from previous month to show
        const prevMonthDays = new Date(year, month, 0).getDate();
        
        // Add day headers
        const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        dayNames.forEach(day => {
            const dayHeader = document.createElement('div');
            dayHeader.className = 'calendar-day-header';
            dayHeader.textContent = day;
            calendarGrid.appendChild(dayHeader);
        });
        
        // Add days from previous month
        for (let i = firstDay - 1; i >= 0; i--) {
            const dayElement = createDayElement(prevMonthDays - i, month - 1, year, true);
            calendarGrid.appendChild(dayElement);
        }
        
        // Add days from current month
        const today = new Date();
        for (let i = 1; i <= daysInMonth; i++) {
            const isToday = i === today.getDate() && month === today.getMonth() && year === today.getFullYear();
            const dayElement = createDayElement(i, month, year, false, isToday);
            calendarGrid.appendChild(dayElement);
        }
        
        // Add days from next month to fill the grid
        const totalCells = firstDay + daysInMonth;
        const remainingCells = totalCells <= 35 ? 35 - totalCells : 42 - totalCells;
        
        for (let i = 1; i <= remainingCells; i++) {
            const dayElement = createDayElement(i, month + 1, year, true);
            calendarGrid.appendChild(dayElement);
        }
    }
    
    // Create a day element for the calendar
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
        
        // Check if this date has a note
        const dateKey = `${year}-${month + 1}-${day}`;
        if (notes[dateKey]) {
            dayElement.classList.add('has-note');
        }
        
        // Add click event
        dayElement.addEventListener('click', function() {
            selectedDate = new Date(year, month, day);
            openNoteModal(selectedDate);
        });
        
        return dayElement;
    }
    
    // Navigation buttons
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
    });
    
    // Todo List functionality
    function renderTodos(filter = 'all') {
        const todoList = document.getElementById('todo-list');
        todoList.innerHTML = '';
        
        let filteredTodos = todos;
        
        if (filter === 'pending') {
            filteredTodos = todos.filter(todo => todo.status === 'pending');
        } else if (filter === 'in-progress') {
            filteredTodos = todos.filter(todo => todo.status === 'in-progress');
        } else if (filter === 'done') {
            filteredTodos = todos.filter(todo => todo.status === 'done');
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
    
    // Add new todo
    document.getElementById('todo-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const todoInput = document.getElementById('new-todo');
        const todoText = todoInput.value.trim();
        
        if (todoText) {
            todos.push({
                text: todoText,
                status: 'pending',
                createdAt: new Date().toISOString()
            });
            
            saveTodos();
            todoInput.value = '';
            renderTodos();
        }
    });
    
    // Save todos to localStorage
    function saveTodos() {
        localStorage.setItem('todos', JSON.stringify(todos));
    }
    
    // Delete todo
    function deleteTodo(index) {
        if (confirm('Are you sure you want to delete this task?')) {
            todos.splice(index, 1);
            saveTodos();
            renderTodos();
        }
    }
    
    // Filter todos
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
        renderTodos(newFilter);
    });
    
    // Modal functionality
    function openNoteModal(date) {
        const modal = document.getElementById('note-modal');
        const dateString = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
        const dateDisplay = `${date.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}`;
        
        document.getElementById('note-date').value = dateDisplay;
        document.getElementById('note-content').value = notes[dateString] || '';
        
        modal.style.display = 'flex';
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
    
    // Close modals
    function closeModals() {
        document.getElementById('note-modal').style.display = 'none';
        document.getElementById('todo-modal').style.display = 'none';
    }
    
    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal')) {
            closeModals();
        }
    });
    
    // Close buttons
    document.getElementById('close-note-modal').addEventListener('click', closeModals);
    document.getElementById('close-todo-modal').addEventListener('click', closeModals);
    document.getElementById('cancel-note').addEventListener('click', closeModals);
    document.getElementById('cancel-todo').addEventListener('click', closeModals);
    
    // Save note and add to todo list
    document.getElementById('save-note').addEventListener('click', function() {
        const dateString = `${selectedDate.getFullYear()}-${selectedDate.getMonth() + 1}-${selectedDate.getDate()}`;
        const noteContent = document.getElementById('note-content').value.trim();
        
        if (noteContent) {
            notes[dateString] = noteContent;
            
            // Add the note as a todo item
            todos.push({
                text: `Note: ${noteContent}`,
                status: 'pending',
                createdAt: new Date().toISOString(),
                isNote: true,
                noteDate: dateString
            });
            
            saveTodos();
            localStorage.setItem('calendarNotes', JSON.stringify(notes));
            renderCalendar(currentMonth, currentYear);
            renderTodos();
            closeModals();
        } else {
            delete notes[dateString];
            localStorage.setItem('calendarNotes', JSON.stringify(notes));
            renderCalendar(currentMonth, currentYear);
            closeModals();
        }
    });
    
    // Save todo changes
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
    
    // Delete todo from modal
    document.getElementById('delete-todo').addEventListener('click', function() {
        const index = this.dataset.id;
        deleteTodo(index);
        closeModals();
    });
    
    // Initialize the app
    initCalendar();
});
