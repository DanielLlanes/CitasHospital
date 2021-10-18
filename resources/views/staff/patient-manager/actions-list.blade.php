{{-- <style>
ul.table_icons {
  margin: 0;
  padding: 0;
  width: 100%;
  text-align: center;
}

ul.table_icons > li {
  display: inline-block;
}

ul.table_icons > li > a,
ul.table_icons > li > button {
    display: inline-block;
    line-height: 28px;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    color: #fff;
    margin: 0 3px 3px 0;
    transition: box-shadow .28s cubic-bezier(.4, 0, .2, 1);
}

ul.table_icons > li > button {
    outline: 0!important;
    border: none;
    padding: 0;
    background: none;
}

ul.table_icons > li > a:hover,
ul.table_icons > li > button:hover {
    text-decoration: none;
    background-color: transparent;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}
</style> --}}
<ul class="table_icons">
    <li>
        <a href="{{ route("staff.patients.edit", $id) }}" title="" class="bg-secondary">
            <span class="icon fa fa-pencil"></span>
        </a>
    </li>
    <li>
        <button class="eliminar mb-1 bg-danger">
            <span class="icon fa fa-trash-o"></span>
        </button>
    </li>
</ul>



