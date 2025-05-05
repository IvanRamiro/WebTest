<?php include 'header.php'; ?>

<!-- ==================== SETTINGS ==================== -->
<div class="main-content">
    <div class="cardHeader">
        <h2>System Settings</h2>
    </div>
    
    <div class="settings-container">
        <!-- Account Settings -->
        <div class="settings-card">
            <div class="settings-header">
                <i class="fa-solid fa-user-shield"></i>
                <h3>Account Security</h3>
            </div>
            <form class="settings-form">
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" placeholder="Enter current password">
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" placeholder="Enter new password">
                </div>
                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" placeholder="Confirm new password">
                </div>
                <button type="submit" class="btn">Update Password</button>
            </form>
        </div>
        
        <!-- System Preferences -->
        <div class="settings-card">
            <div class="settings-header">
                <i class="fa-solid fa-sliders"></i>
                <h3>System Preferences</h3>
            </div>
            <form class="settings-form">
                <div class="form-group">
                    <label>Theme Preference</label>
                    <select>
                        <option>Light Theme</option>
                        <option>Dark Theme</option>
                        <option>System Default</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Notifications</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" checked> Email Notifications</label>
                        <label><input type="checkbox" checked> SMS Alerts</label>
                        <label><input type="checkbox"> Push Notifications</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Records Per Page</label>
                    <input type="number" value="25" min="10" max="100">
                </div>
                <button type="submit" class="btn">Save Preferences</button>
            </form>
        </div>
        
        <!-- System Information -->
        <div class="settings-card">
            <div class="settings-header">
                <i class="fa-solid fa-circle-info"></i>
                <h3>System Information</h3>
            </div>
            <div class="system-info">
                <div class="info-item">
                    <span>System Version:</span>
                    <strong>v2.5.1</strong>
                </div>
                <div class="info-item">
                    <span>Last Updated:</span>
                    <strong>May 15, 2023</strong>
                </div>
                <div class="info-item">
                    <span>Database Size:</span>
                    <strong>45.7 MB</strong>
                </div>
                <div class="info-item">
                    <span>Server Status:</span>
                    <strong class="status delivered">Online</strong>
                </div>
            </div>
            <div class="settings-actions">
                <button class="btn"><i class="fa-solid fa-download"></i> Backup Database</button>
                <button class="btn"><i class="fa-solid fa-rotate"></i> Check for Updates</button>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>