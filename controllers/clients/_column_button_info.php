<button
    class="btn btn-default btn-sm"
    data-request="onPing"
    data-request-data="{record_id: <?= $record->id ?>}"
    data-request-message="Downloading client status"
    data-stripe-load-indicator
    title="Click to manual update client data"
>
    <span class="icon-save-cloud"></span>
    Update status
</button>