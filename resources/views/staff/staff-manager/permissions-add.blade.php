
<div class="form-group row mt-2 mb-0">
    <label class="control-label col-md-3 p-0 m-0">

        <span class="required">  </span>
    </label>
    <div class="col-md-5">
        <h3 class="m-0">
            <input
            type="checkbox" 
            id="selectAll" >
        <label for="selectAll" class="col-form-label-sm">
            @lang('staff.Select All')
        </label>
            @lang('staff.Permission')
        </h3>
    </div>
</div>
    <div class="form-group row">
        @foreach ($groups as $group)
        <div class="col-md-6">
            <label class="control-label col-md-3">????
            </label>

            <div class="col-md-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header class="d-flex justify-content-between">
                            {{ $group->group }} 
                            <div class="">
                                <input
                                type="checkbox" 
                                class="selectAllGroup" >
                                <label for="selectAll" class="col-form-label-sm">
                                    @lang('staff.Select All Group')
                                </label>
                            </div>
                        </header>
                    </div>

                    <div class="card-body " id="bar-parent2">
                        <div class="row">
                            @foreach($permissions as $permission)
                                @if ($permission->groupP == $group->group)
                                    <div class="col-md-6 col-sm-6">
                                        <div class="checkbox checkbox-icon-black">
                                            <input
                                                id="permissions_{{ $permission->id }}"
                                                type="checkbox" 
                                                name="permissions[]"
                                                class="check-all check-group"
                                                value="{{ $permission->id }}"
                                                {{ ( is_array(old('permissions')) && in_array($permission->id, old('permissions')) ) ? 'checked ' : '' }}
                                                >
                                            <label for="permissions_{{ $permission->id }}">
                                                {{ $permission->description }}
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>