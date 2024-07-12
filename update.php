<form action="" method="post" class="mb-4">
    <input type="hidden" name="id" value="<?= $moduleToEdit ? $moduleToEdit['id'] : '' ?>">
    <div class="mb-3">
        <label for="module_name" class="form-label">Module Name</label>
        <input type="text" class="form-control" name="module_name" value="<?= $moduleToEdit ? $moduleToEdit['module_name'] : '' ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" required><?= $moduleToEdit ? $moduleToEdit['description'] : '' ?></textarea>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <input type="text" class="form-control" name="category" value="<?= $moduleToEdit ? $moduleToEdit['category'] : '' ?>" required>
    </div>
    <button type="submit" class="btn btn-primary" name="<?= $moduleToEdit ? 'update' : 'submit' ?>"><?= $moduleToEdit ? 'Update Module' : 'Add Module' ?></button>
</form>
