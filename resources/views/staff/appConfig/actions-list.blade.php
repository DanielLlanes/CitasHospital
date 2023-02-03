

<ul class="table_icons">
    <li>
        <button type="button" class="tbl-edit mb-1 bg-secondary" data-id="{{ $id }}" >
            <span class="icon fa fa fa-pencil"></span>
        </button>
    </li>
    <li>
        <button type="button" class="eliminar mb-1 bg-danger" data-id="{{ $id }}">
            <span class="icon fa fa-trash-o"></span>
        </button>
    </li>

        <li>
            <button type="submit" title="Change permisions" class="changePermissions bg-warning" data-id="{{ $id }}">
                <i class="fa fa-key"></i>
            </button>
        </li>

    
</ul>
