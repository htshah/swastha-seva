<script id="data-list-template" type="text/template">
    @{{#stream_items}}
    <li class="collection-item left-align">
        <span class="title">@{{publishers}}</span>
        <p>@{{data_text}}</p>
    </li>
    @{{/stream_items}}
    @{{^stream_items}}
        <li class="collection-item center-align">
            <span class="title">No data found in Blockchain.</span>
        </li>
    @{{/stream_items}}
</script>