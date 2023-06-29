

<ul class="table_icons">
    <li>
        <button class="edit-quote mb-1 bg-secondary seleccionar" data-id="{{ $apps->id }}" data-app="{{ $apps->staff->id }}">
            <span class="icon fa fa fa-pencil"></span>
        </button>
    </li>
    <li>
        <button class="edit-quote mb-1 bg-danger eliminarAss" data-id="{{ $apps->id }}" data-app="{{ $apps->staff->id }}">
            <span class="icon fa fa fa-trash"></span>
        </button>
    </li>
</ul>