<div>
    <?php if(!empty($formModel->client_data)): ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Version</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($formModel->client_data->plugins as $plugin): ?>
            <tr>
                <td><strong><?= $plugin->name ?></strong> <br> <small><?= $plugin->code; ?></small></td>
                <td><?= $plugin->description; ?></td>
                <td><?= $plugin->version ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>Not found data!</p>
    <?php endif; ?>
</div>