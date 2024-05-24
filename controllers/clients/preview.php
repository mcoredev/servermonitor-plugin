<?php Block::put('breadcrumb') ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Backend::url('mcore/servermonitor/clients') ?>">Clients</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= e($this->pageTitle) ?></li>
    </ol>
<?php Block::endPut() ?>

<?php if (!$this->fatalError): ?>

    <div data-control="toolbar" class="mb-3">
        <a
                href="<?= Backend::url('mcore/servermonitor/clients/update/'.$formModel->id) ?>"
                class="btn btn-primary oc-icon-pencil">
            Edit
        </a>&nbsp;

        <button
                type="button"
                class="oc-icon-trash-o btn btn-danger"
                data-request="onDelete"
                data-load-indicator="<?= e(trans('backend::lang.form.deleting_name', ['name'=>$formRecordName])) ?>"
                data-request-confirm="<?= e(trans('backend::lang.form.confirm_delete')) ?>">
            Delete
        </button>
    </div>

    <div class="form-preview">
        <?= $this->formRenderPreview() ?>
    </div>

<?php else: ?>

    <p class="flash-message static error"><?= e($this->fatalError) ?></p>
    <p><a href="<?= Backend::url('mcore/servermonitor/clients') ?>" class="btn btn-default"><?= e(trans('backend::lang.form.return_to_list')) ?></a></p>

<?php endif ?>
