<?php

require '../vendor/autoload.php';

use App\Controllers\GithubController;
use App\Services\GithubService;

$githubService = new GithubService();
$controller = new GithubController($githubService);

$repositories = [];
$query = '';

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $repositories = $controller->search($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GitHub Repo Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">GitHub Repository Search</h1>

        <form method="GET" action="" class="mb-4">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Search for repositories"
                    value="<?php echo htmlspecialchars($query); ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <?php if (!empty($repositories)): ?>
            <div class="list-group">
                <?php foreach ($repositories as $repo): ?>
                    <a href="<?php echo $repo['html_url']; ?>" class="list-group-item list-group-item-action" target="_blank">
                        <h5 class="mb-1"><?php echo htmlspecialchars($repo['name']); ?></h5>
                        <p class="mb-1"><?php echo htmlspecialchars($repo['description']); ?></p>
                        <small>Stars: <?php echo $repo['stargazers_count']; ?></small>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php elseif ($query): ?>
            <div class="alert alert-warning">No repositories found for "<?php echo htmlspecialchars($query); ?>"</div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>