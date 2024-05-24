<span class="form-control">
    <span class="
        <?php if (in_array($formModel->status, [500, 404])) {
        echo 'text-danger';
    }
    elseif (in_array($formModel->status, [200, 201])) {
        echo 'text-success';
    } ?>
    ">
        <span class="oc-icon-circle-full"><?= $formModel->status ?? 'Not available' ?></span>
    </span>
</span>