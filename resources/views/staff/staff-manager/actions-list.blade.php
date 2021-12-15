
@php
	// $btn_delete = '<button type="submit" class="btn btn-tbl-delete btn-xs eliminar" data-id="$id"><i class="fa fa-trash-o"></i></button>';
	// $btn_edit = '<a href="'.route("staff.staff.edit", $id).'" class="btn btn-tbl-edit btn-xs editar-staff"><i class="fa fa-pencil"></i></a>';
	// $btn_reset_password = '<button type="submit" class="btn btn-tbl-delete btn-xs ressetPass bg-info" data-id="$id"><i class="fa fa-refresh"></i></button>';

	$staff_edit = Auth::guard('staff')->user()->can('staff.edit');
	$staff_edit_admins = Auth::guard('staff')->user()->can('admin.edit');

	$staff_destroy = Auth::guard('staff')->user()->can('staff.destroy');
	$staff_destroy_admins = Auth::guard('staff')->user()->can('admin.destroy');
	

	$staff_reset_password = Auth::guard('staff')->user()->can('staff.reset.password');
	$staff_reset_password_admins = Auth::guard('staff')->user()->can('admin.reset.password');


	$staff_change_permissions = Auth::guard('staff')->user()->can('staff.permisions');
	$staff_change_permissions_admins = Auth::guard('staff')->user()->can('admin.permisions');


	$myselfId = Auth::guard('staff')->user()->id;


	if (!$staff_edit_admins && !$staff_edit) { //no staff no admins
		$btn_edit = '<button type="button" title="Edit Staff" class="mb-1 bg-secondary" style="visibility: hidden;"><i class="fa fa-pencil"></i></button>';
	} elseif (!$staff_edit_admins && $staff_edit) {
		if ($roles[0]['name'] == 'administrator') {
			$btn_edit = '<button type="button" title="Edit Staff" class="mb-1 bg-secondary" style="visibility: hidden;"><i class="fa fa-pencil"></i></button>';
		}
	} elseif ($staff_edit_admins && !$staff_edit) { // admins no estaff
		if ($roles[0]['name'] != 'administrator') {
			$btn_edit = '<a href="'.route("staff.staff.edit", $id).'" title="Edit Staff" class="mb-1 bg-secondary editar-staff"><i class="fa fa-pencil"></i></a>';
		}
	} elseif ($staff_edit_admins && $staff_edit) { // sdind rstaff
		$btn_edit = '<a href="'.route("staff.staff.edit", $id).'" title="Edit Staff" class="mb-1 bg-secondary editar-staff"><i class="fa fa-pencil"></i></a>';
	}


	if (!$staff_destroy_admins && !$staff_destroy) {
		$btn_delete = '<button type="button" title="Delete user" class="mb-1 bg-danger btn-xs" style="visibility: hidden;"><i class="fa fa-trash-o"></i></button>';	
	} elseif (!$staff_destroy_admins && $staff_destroy) {
		if ($roles[0]['name'] == 'administrator') {
			$btn_delete = '<button type="button" title="Delete user" class="mb-1 bg-danger btn-xs" style="visibility: hidden;"><i class="fa fa-trash-o"></i></button>';	
		}
	} elseif ($staff_destroy_admins && !$staff_destroy) {
		if ($roles[0]['name'] != 'administrator') {
			$btn_delete = '<button type="submit" title="Delete user" class="mb-1 bg-danger eliminar" data-id="'. $id .'"><i class="fa fa-trash-o"></i></button>';
		}
	} elseif ($staff_destroy_admins && $staff_destroy) {
		$btn_delete = '<button type="submit" title="Delete user" class="mb-1 bg-danger eliminar" data-id="'. $id .'"><i class="fa fa-trash-o"></i></button>';
	}


	if (!$staff_reset_password_admins && !$staff_reset_password) {
		$btn_reset_password = '<button type="submit" title="Reset password" class="mb-1 bg-info"><i class="fa fa-refresh"></i></button>';
	} elseif (!$staff_reset_password_admins && $staff_reset_password) {
		if ($roles[0]['name'] == 'administrator') {
			$btn_reset_password = '<button type="submit" title="Reset password" class="mb-1 bg-info"><i class="fa fa-refresh"></i></button>';
		}
	} elseif ($staff_reset_password_admins && !$staff_reset_password) {
		if ($roles[0]['name'] != 'administrator') {
			$btn_reset_password = '<button type="submit" title="Reset password" class="mb-1 bg-info ressetPass" data-id="'.$id.'><i class="fa fa-refresh"></i></button>';
		}
	} elseif ($staff_reset_password_admins && $staff_reset_password) {
		$btn_reset_password = '<button type="submit" title="Reset password" class="mb-1 bg-info ressetPass" data-id="'.$id.'"><i class="fa fa-refresh"></i></button>';
	}


	if (!$staff_change_permissions_admins && !$staff_change_permissions) {
		$btn_set_permissions = '<button type="submit" title="Change permisions" class="mb-1 bg-warning"><i class="fa  fa-ban"></i></button>';
	} elseif (!$staff_change_permissions_admins && $staff_change_permissions) {
		if ($roles[0]['name'] == 'administrator') {
			$btn_set_permissions = '<button type="submit" title="Change permisions" class="mb-1 bg-warning"><i class="fa  fa-ban"></i></button>';
		}
	} elseif ($staff_change_permissions_admins && !$staff_change_permissions) {
		if ($roles[0]['name'] != 'administrator') {
			$btn_set_permissions = '<button type="submit" title="Change permisions" class="mb-1 changePermissions bg-warning" data-id="'.$id.'><i class="fa fa-key"></i></button>';
		}
	} elseif ($staff_change_permissions_admins && $staff_change_permissions) {
		$btn_set_permissions = '<button type="submit" title="Change permisions" class="mb-1 changePermissions bg-warning" data-id="'.$id.'"><i class="fa fa-key"></i></button>';
	}

@endphp

<ul class="table_icons">
	@if ( $myselfId != $id )
		<li>{!! $btn_edit !!}</li>
	@endif

<li>{!! $btn_reset_password !!}</li>
<li>{!! $btn_set_permissions  !!}</li>
@can('staff.publicProfile')
    @if ($public_profile == 0)
    	<li><a href="{{ route("staff.staff.edit", $id) }}" title="Public profile" class="mb-1 bg-success"><i class="fa fa-user"></i></a></li>
    @endif
@endcan

@if (Auth::guard('staff')->user()->id != $id )
	<li>{!! $btn_delete !!}</li>
@endif
