<?php
include 'db.php';

$moduleToEdit = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $module_name = $_POST['module_name'];
        $description = $_POST['description'];
        $category = $_POST['category'];

        $stmt = $pdo->prepare("INSERT INTO modules (module_name, description, category) VALUES (?, ?, ?)");
        $stmt->execute([$module_name, $description, $category]);
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $module_name = $_POST['module_name'];
        $description = $_POST['description'];
        $category = $_POST['category'];

        $stmt = $pdo->prepare("UPDATE modules SET module_name = ?, description = ?, category = ? WHERE id = ?");
        $stmt->execute([$module_name, $description, $category, $id]);
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM modules WHERE id = ?");
    $stmt->execute([$id]);
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM modules WHERE id = ?");
    $stmt->execute([$id]);
    $moduleToEdit = $stmt->fetch(PDO::FETCH_ASSOC);
}

$stmt = $pdo->query("SELECT * FROM modules");
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Platform Pembelajaran Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container">
        <h2 class="mt-5">Platform Pembelajaran Online</h2>

        <form action="" method="post" class="mb-4">
            <div class="mb-3">
                <label for="module_name" class="form-label">Module Name</label>
                <input type="text" class="form-control" name="module_name" value="<?= $moduleToEdit ? htmlspecialchars($moduleToEdit['module_name']) : '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" required><?= $moduleToEdit ? htmlspecialchars($moduleToEdit['description']) : '' ?></textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" name="category" value="<?= $moduleToEdit ? htmlspecialchars($moduleToEdit['category']) : '' ?>" required>
            </div>
            <?php if ($moduleToEdit): ?>
                <input type="hidden" name="id" value="<?= $moduleToEdit['id'] ?>">
                <button type="submit" class="btn btn-primary" name="submit">Add Module</button>
                <button type="submit" class="btn btn-success" name="update">Update Module</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="submit">Add Module</button>
            <?php endif; ?>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Module Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($modules as $module): ?>
                <tr>
                    <td><?= $module['id'] ?></td>
                    <td><?= htmlspecialchars($module['module_name']) ?></td>
                    <td><?= htmlspecialchars($module['description']) ?></td>
                    <td><?= htmlspecialchars($module['category']) ?></td>
                    <td>
                        <a href="?edit=<?= $module['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="?delete=<?= $module['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
