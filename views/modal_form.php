<div class="modal" id="userModal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modalTitle">Add User</h2>
        <form id="userForm">
            <input type="hidden" name="id" id="userId">
            <div>
                <label for="userName">Name:</label>
                <input type="text" name="name" id="userName" autocomplete="name" required>
            </div>
            <div>
                <label for="userEmail">Email:</label>
                <input type="email" name="email" id="userEmail" autocomplete="email" required>
            </div>
            <button type="submit" id="submitBtn">Save</button>
        </form>
    </div>
</div>