<button
    class="btn btn-default btn-sm"
    data-request="onPing"
    data-request-data="{record_id: <?= $record->id ?>}"
    data-request-message="Pinging"
    data-stripe-load-indicator
    title="Click to ping the client status web"
>
    <span class="icon-wifi"></span>
    Ping
</button>