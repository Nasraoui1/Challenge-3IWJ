<!-- updateUserForm.php -->
<div class="update-card">
    <h3>Update User</h3>
    <form method="post" action="/dashboard/updateUser">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
        <label for="update-firstname">Prénom:</label>
        <input type="text" id="update-firstname" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" required>
        <label for="update-lastname">Nom:</label>
        <input type="text" id="update-lastname" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>" required>
        <label for="update-email">Email:</label>
        <input type="email" id="update-email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        <label for="update-role">Rôle:</label>
        <input type="text" id="update-role" name="role" value="<?= htmlspecialchars($user['role']) ?>" required>
        <button type="submit">Update</button>
        <button type="button" onclick="window.location.href='/dashboard/users'">Cancel</button>
    </form>
</div>
