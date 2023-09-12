<div class="flex space-x-8">
    <div class="card card-bordered shadow-xl shadow-base-300 p-4">
        <div class="card-body">
            <h1>Total Users</h1>
            <h2><?= $totalUsers; ?> users</h2>
        </div>
        <div class="card-actions justify-end">
            <a class="btn btn-secondary btn-sm" href="<?= \Core\Router::generateRoute("admin.users.viewAll") ?>">
                <i class="fa fa-eye"></i>
            </a>
            <a class="btn btn-success btn-sm" href="<?= \Core\Router::generateRoute("admin.users.create") ?>">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    <div class="card card-bordered shadow-xl shadow-base-300 p-4">
        <div class="card-body">
            <h1>Total Categories</h1>
            <h2><?= $totalCategories; ?> categories</h2>
        </div>

        <div class="card-actions justify-end">
            <a class="btn btn-secondary btn-sm" href="<?= \Core\Router::generateRoute("admin.categories.index") ?>">
                <i class="fa fa-eye"></i>
            </a>
            <a class="btn btn-success btn-sm" href="<?= \Core\Router::generateRoute("admin.categories.create") ?>">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    <div class="card card-bordered shadow-xl shadow-base-300 p-4">
        <div class="card-body">
            <h1>Total Pages</h1>
            <h2><?= $totalPages; ?> pages</h2>
        </div>

        <div class="card-actions justify-end">
            <a class="btn btn-secondary btn-sm" href="<?= \Core\Router::generateRoute("admin.page.list") ?>">
                <i class="fa fa-eye"></i>
            </a>
            <a class="btn btn-success btn-sm" href="<?= \Core\Router::generateRoute("admin.page.create") ?>">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
</div>
