<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	app()["cache"]->forget("spatie.permission.cache");
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        //Permission list
        //calendar
        Permission::create([
            "name" => "calendar.list",
            "guard_name" => "staff",
            "description_es" => "Mostrar eventos calendario",
            "group_es" => "Calendario",
            "description_en" => "Show calendar events",
            "group_en" => "Calendar"
        ]);
        Permission::create([
            "name" => "calendar.edit",
            "guard_name" => "staff",
            "description_es" => "Editar eventos de calendario",
            "group_es" => "Calendario",
            "description_en" => "Edit calendar events",
            "group_en" => "Calendar"
        ]);
        Permission::create([
            "name" => "calendar.create",
            "guard_name" => "staff",
            "description_es" => "Crear eventos de calendario",
            "group_es" => "Calendario",
            "description_en" => "Create calendar events",
            "group_en" => "Calendar"
        ]);
        Permission::create([
            "name" => "calendar.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar eventos de calendario",
            "group_es" => "Calendario",
            "description_en" => "Delete calendar events",
            "group_en" => "Calendar"
        ]);
        Permission::create([
            "name" => "calendar.show",
            "guard_name" => "staff",
            "description_es" => "ver detalles de eventos",
            "group_es" => "Calendario",
            "description_en" => "view event details",
            "group_en" => "Calendar"
        ]);

        //team
        Permission::create([
            "name" => "staff.list",
            "guard_name" => "staff",
            "description_es" => "Mostrar listado personal",
            "group_es" => "Personal",
            "description_en" => "Show staff list",
            "group_en" => "Staff"
        ]);
        Permission::create([
            "name" => "staff.create",
            "guard_name" => "staff",
            "description_es" => "Crear miembros del staff",
            "group_es" => "Personal",
            "description_en" => "Create staff",
            "group_en" => "Staff"
        ]);
        Permission::create([
            "name" => "staff.edit",
            "guard_name" => "staff",
            "description_es" => "Editar personal",
            "group_es" => "Personal",
            "description_en" => "Edit staff",
            "group_en" => "Staff"
        ]);
        Permission::create([
            "name" => "staff.activate",
            "guard_name" => "staff",
            "description_es" => "Activar y desactivar personal",
            "group_es" => "Personal",
            "description_en" => "Activate and deactivate staff",
            "group_en" => "Staff"
        ]);
        Permission::create([
            "name" => "staff.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar personal",
            "group_es" => "Personal",
            "description_en" => "Delete staff",
            "group_en" => "Staff"
        ]);
        Permission::create([
            "name" => "staff.publicProfile",
            "guard_name" => "staff",
            "description_es" => "Crear o actualizar perfil público del personal",
            "group_es" => "Personal",
            "description_en" => "Set or update staff public profile",
            "group_en" => "Staff"
        ]);
        Permission::create([
            "name" => "staff.show",
            "guard_name" => "staff",
            "description_es" => "ver detalles de personal",
            "group_es" => "Personal",
            "description_en" => "view staff details",
            "group_en" => "Staff"
        ]);
        Permission::create([
            "name" => "staff.reset.password",
            "guard_name" => "staff",
            "description_es" => "Restablecer contraseña del personal",
            "group_es" => "Personal",
            "description_en" => "Reset staff password",
            "group_en" => "Staff"
        ]);
        Permission::create([
            "name" => "staff.permisions",
            "guard_name" => "staff",
            "description_es" => "Asignar permisos a personal",
            "group_es" => "Personal",
            "description_en" => "Assign permissions to staff",
            "group_en" => "Staff"
        ]);

        //admin
        Permission::create([
            "name" => "admin.list",
            "guard_name" => "staff",
            "description_es" => "Mostrar listado admins",
            "group_es" => "Administrador",
            "description_en" => "Show admins list",
            "group_en" => "Administrator"
        ]);
        Permission::create([
            "name" => "admin.create",
            "guard_name" => "staff",
            "description_es" => "Crear admins",
            "group_es" => "Administrador",
            "description_en" => "Create admins",
            "group_en" => "Administrator"
        ]);
        Permission::create([
            "name" => "admin.edit",
            "guard_name" => "staff",
            "description_es" => "Editar admins",
            "group_es" => "Administrador",
            "description_en" => "Edit admins",
            "group_en" => "Administrator"
        ]);
        Permission::create([
            "name" => "admin.activate",
            "guard_name" => "staff",
            "description_es" => "Activar y desactivar admins",
            "group_es" => "Administrador",
            "description_en" => "Activate and deactivate admins",
            "group_en" => "Administrator"
        ]);
        Permission::create([
            "name" => "admin.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar admins",
            "group_es" => "Administrador",
            "description_en" => "Delete admins",
            "group_en" => "Administrator"
        ]);
        Permission::create([
            "name" => "admin.show",
            "guard_name" => "staff",
            "description_es" => "ver detalles de admins",
            "group_es" => "Administrador",
            "description_en" => "view admins details",
            "group_en" => "Administrator"
        ]);
        Permission::create([
            "name" => "admin.reset.password",
            "guard_name" => "staff",
            "description_es" => "Restablecer contraseña de admins",
            "group_es" => "Administrador",
            "description_en" => "Reset admins password",
            "group_en" => "Administrator"
        ]);
        Permission::create([
            "name" => "admin.permisions",
            "guard_name" => "staff",
            "description_es" => "Asignar permisos a admins",
            "group_es" => "Administrador",
            "description_en" => "Assign permissions to Admins",
            "group_en" => "Administrator"
        ]);
        
        // applications
        Permission::create([
            "name" => "applications.list",
            "guard_name" => "staff",
            "description_es" => "Listado aplicacion por especialidades",
            "group_es" => "Aplicaciones",
            "description_en" => "List applications by specialies",
            "group_en" => "Applications"
        ]);
        Permission::create([
            "name" => "applications.all",
            "guard_name" => "staff",
            "description_es" => "Ver detalles de aplicaciones",
            "group_es" => "Aplicaciones",
            "description_en" => "View aplication details",
            "group_en" => "Applications"
        ]);
        Permission::create([
            "name" => "applications.edit",
            "guard_name" => "staff",
            "description_es" => "Editar Aplicaciones",
            "group_es" => "Aplicaciones",
            "description_en" => "Editar applications",
            "group_en" => "Applications"
        ]);
        Permission::create([
            "name" => "applications.create",
            "guard_name" => "staff",
            "description_es" => "Crear aplicaciones",
            "group_es" => "Aplicaciones",
            "description_en" => "Create applications",
            "group_en" => "Applications"
        ]);
        Permission::create([
            "name" => "applications.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar aplicaciones",
            "group_es" => "Aplicaciones",
            "description_en" => "Delete applications",
            "group_en" => "Applications"
        ]);
        Permission::create([
            "name" => "applications.details",
            "guard_name" => "staff",
            "description_es" => "Mostrar detalles aplicaciones",
            "group_es" => "Aplicaciones",
            "description_en" => "Show applications details",
            "group_en" => "Applications"
        ]);
        Permission::create([
            "name" => "applications.setprice",
            "guard_name" => "staff",
            "description_es" => "Establecer y editar precio de aplicaciones",
            "group_es" => "Aplicaciones",
            "description_en" => "Set and edit app pricing",
            "group_en" => "Applications"
        ]);
        Permission::create([
            "name" => "applications.changeCoordinator",
            "guard_name" => "staff",
            "description_es" => "Establecer y editar cordinadores",
            "group_es" => "Aplicaciones",
            "description_en" => "Set and edit application coorfinators",
            "group_en" => "Applications"
        ]);
        Permission::create([
            "name" => "applications.changeStaff",
            "guard_name" => "staff",
            "description_es" => "Establecer y editar personal",
            "group_es" => "Aplicaciones",
            "description_en" => "Set and edit application staff",
            "group_en" => "Applications"
        ]);
        Permission::create([
            "name" => "applications.show",
            "guard_name" => "staff",
            "description_es" => "Ver detalles de aplications",
            "group_es" => "Aplicaciones",
            "description_en" => "View aplication details",
            "group_en" => "Applications"
        ]);
        Permission::create([
            "name" => "applications.debate",
            "guard_name" => "staff",
            "description_es" => "Ver detalles de aplications",
            "group_es" => "Aplicaciones",
            "description_en" => "View aplication details",
            "group_en" => "Applications"
        ]);
        Permission::create([
            "name" => "applications.timeline",
            "guard_name" => "staff",
            "description_es" => "Ver detalles de aplications",
            "group_es" => "Aplicaciones",
            "description_en" => "View aplication details",
            "group_en" => "Applications"
        ]);
        Permission::create([
            "name" => "applications.logisticNotes",
            "guard_name" => "staff",
            "description_es" => "Ver detalles de aplications",
            "group_es" => "Aplicaciones",
            "description_en" => "View aplication details",
            "group_en" => "Applications"
        ]);

        //patients
        Permission::create([
            "name" => "patients.list",
            "guard_name" => "staff",
            "description_es" => "Mostrar listado Pacientes",
            "group_es" => "Pacientes",
            "description_en" => "Show patients list",
            "group_en" => "Patients"
        ]);
        Permission::create([
            "name" => "patients.edit",
            "guard_name" => "staff",
            "description_es" => "Editar información pacientes",
            "group_es" => "Pacientes",
            "description_en" => "Edit patients info",
            "group_en" => "Patients"
        ]);
        Permission::create([
            "name" => "patients.create",
            "guard_name" => "staff",
            "description_es" => "Crear nuevos pacientes",
            "group_es" => "Pacientes",
            "description_en" => "Create new patients",
            "group_en" => "Patients"
        ]);
        Permission::create([
            "name" => "patients.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar Pacientes",
            "group_es" => "Pacientes",
            "description_en" => "Delete patients",
            "group_en" => "Patients"
        ]);
        Permission::create([
            "name" => "patients.details",
            "guard_name" => "staff",
            "description_es" => "Ver información de pacientes",
            "group_es" => "Pacientes",
            "description_en" => "View patient information",
            "group_en" => "Patients"
        ]);
        Permission::create([
            "name" => "patients.show",
            "guard_name" => "staff",
            "description_es" => "ver datos generales de patientes",
            "group_es" => "Pacientes",
            "description_en" => "view general patient data",
            "group_en" => "Patients"
        ]);
        
        //payments
        Permission::create([
            "name" => "payments.list",
            "guard_name" => "staff",
            "description_es" => "Mostrar pagos",
            "group_es" => "Pagos",
            "description_en" => "Show payments",
            "group_en" => "Payments"
        ]);
        Permission::create([
            "name" => "payments.edit",
            "guard_name" => "staff",
            "description_es" => "Editar pagos",
            "group_es" => "Pagos",
            "description_en" => "Edit payments",
            "group_en" => "Payments"
        ]);
        Permission::create([
            "name" => "payments.create",
            "guard_name" => "staff",
            "description_es" => "Agregar pagos",
            "group_es" => "Pagos",
            "description_en" => "Add payments",
            "group_en" => "Payments"
        ]);
        Permission::create([
            "name" => "payments.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar pagos",
            "group_es" => "Pagos",
            "description_en" => "Delete payments",
            "group_en" => "Payments"
        ]);
        Permission::create([
            "name" => "payments.show",
            "guard_name" => "staff",
            "description_es" => "Ver detalles de pagos",
            "group_es" => "Pagos",
            "description_en" => "view payments details",
            "group_en" => "Payments"
        ]);
        Permission::create([
            "name" => "payments.details",
            "guard_name" => "staff",
            "description_es" => "Ver detalles de pagos",
            "group_es" => "Pagos",
            "description_en" => "view payments details",
            "group_en" => "Payments"
        ]);

        //Treatment
        Permission::create([
            "name" => "treatment.list",
            "guard_name" => "staff",
            "description_es" => "Mostrar Lista de tratamientos",
            "group_es" => "Tratamientos",
            "description_en" => "Show treatment list",
            "group_en" => "Treatment"
        ]);
        Permission::create([
            "name" => "treatment.edit",
            "guard_name" => "staff",
            "description_es" => "Editar tratamientos",
            "group_es" => "Tratamientos",
            "description_en" => "Edit treatment",
            "group_en" => "Treatment"
        ]);
        Permission::create([
            "name" => "treatment.create",
            "guard_name" => "staff",
            "description_es" => "Crear nuevos tratamientos",
            "group_es" => "Tratamientos",
            "description_en" => "create new treatment",
            "group_en" => "Treatment"
        ]);
        Permission::create([
            "name" => "treatment.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar tratamientos",
            "group_es" => "Tratamientos",
            "description_en" => "Edit treatment",
            "group_en" => "Treatment"
        ]);
        Permission::create([
            "name" => "treatment.activate",
            "guard_name" => "staff",
            "description_es" => "Activar tratamientos",
            "group_es" => "Tratamientos",
            "description_en" => "Activate treatment",
            "group_en" => "Treatment"
        ]);
        
        //configuration
        //specialties
        Permission::create([
            "name" => "specialties.list",
            "guard_name" => "staff",
            "description_es" => "Mostrar Lista de especialidades",
            "group_es" => "Especialidades",
            "description_en" => "Show specialities list",
            "group_en" => "Specialties"
        ]);
        Permission::create([
            "name" => "specialties.edit",
            "guard_name" => "staff",
            "description_es" => "Editar especialidades",
            "group_es" => "Procedimientos",
            "description_en" => "Edit specialties",
            "group_en" => "Specialties"
        ]);
        Permission::create([
            "name" => "specialties.create",
            "guard_name" => "staff",
            "description_es" => "Crear nuevas especialidades",
            "group_es" => "Especialidades",
            "description_en" => "create new specialities",
            "group_en" => "Specialties"
        ]);
        Permission::create([
            "name" => "specialties.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar especialidades",
            "group_es" => "Especialidades",
            "description_en" => "Delete specialties",
            "group_en" => "Specialties"
        ]);
        Permission::create([
            "name" => "specialties.activate",
            "guard_name" => "staff",
            "description_es" => "Activar especialidades",
            "group_es" => "Especialidades",
            "description_en" => "Activate specialties",
            "group_en" => "Specialties"
        ]);

        //Services
        Permission::create([
            "name" => "services.list",
            "guard_name" => "staff",
            "description_es" => "Mostrar Lista de servicios",
            "group_es" => "Servicios",
            "description_en" => "Show services list",
            "group_en" => "Services"
        ]);
        Permission::create([
            "name" => "services.edit",
            "guard_name" => "staff",
            "description_es" => "Editar Servicios",
            "group_es" => "Servicios",
            "description_en" => "Edit services",
            "group_en" => "Services"
        ]);
        Permission::create([
            "name" => "services.create",
            "guard_name" => "staff",
            "description_es" => "Crear nuevos servicios",
            "group_es" => "Servicios",
            "description_en" => "create new services",
            "group_en" => "Services"
        ]);
        Permission::create([
            "name" => "services.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar servicios",
            "group_es" => "Servicios",
            "description_en" => "Delete services",
            "group_en" => "Services"
        ]);
        Permission::create([
            "name" => "services.activate",
            "guard_name" => "staff",
            "description_es" => "Activar servicios",
            "group_es" => "Servicios",
            "description_en" => "Activate services",
            "group_en" => "Services"
        ]);

        //packages
        Permission::create([
            "name" => "packages.list",
            "guard_name" => "staff",
            "description_es" => "Mostrar Lista de paquetes",
            "group_es" => "Paquetes",
            "description_en" => "Show packages list",
            "group_en" => "Packages"
        ]);
        Permission::create([
            "name" => "packages.edit",
            "guard_name" => "staff",
            "description_es" => "Editar paquetes",
            "group_es" => "Paquetes",
            "description_en" => "Edit packages",
            "group_en" => "Packages"
        ]);
        Permission::create([
            "name" => "packages.create",
            "guard_name" => "staff",
            "description_es" => "Crear nuevos paquetes",
            "group_es" => "Paquetes",
            "description_en" => "create new packages",
            "group_en" => "Packages"
        ]);
        Permission::create([
            "name" => "packages.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar paquetes",
            "group_es" => "Paquetes",
            "description_en" => "Edit packages",
            "group_en" => "Packages"
        ]);
        Permission::create([
            "name" => "packages.activate",
            "guard_name" => "staff",
            "description_es" => "Activar paquetes",
            "group_es" => "Paquetes",
            "description_en" => "Activate packages",
            "group_en" => "Packages"
        ]);

        //Brand
        Permission::create([
            "name" => "brand.list",
            "guard_name" => "staff",
            "description_es" => "Mostrar lista de marcas",
            "group_es" => "Marcas",
            "description_en" => "Show brand list",
            "group_en" => "Brands"
        ]);
        Permission::create([
            "name" => "brand.edit",
            "guard_name" => "staff",
            "description_es" => "Editar marcas",
            "group_es" => "Marcas",
            "description_en" => "Edit brand",
            "group_en" => "Brands"
        ]);
        Permission::create([
            "name" => "brand.create",
            "guard_name" => "staff",
            "description_es" => "Crear nuevos marcas",
            "group_es" => "Marcas",
            "description_en" => "Create new brand",
            "group_en" => "Brands"
        ]);
        Permission::create([
            "name" => "brand.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar marcas",
            "group_es" => "Marcas",
            "description_en" => "Delete brand",
            "group_en" => "Brands"
        ]);
        Permission::create([
            "name" => "brand.activate",
            "guard_name" => "staff",
            "description_es" => "Activar marcas",
            "group_es" => "Marcas",
            "description_en" => "Activate brand",
            "group_en" => "Brands"
        ]);

        //procedures
        Permission::create([
            "name" => "procedures.list",
            "guard_name" => "staff",
            "description_es" => "Mostrar listade Procedimientos",
            "group_es" => "Procedimientos",
            "description_en" => "Show procedures list",
            "group_en" => "Procedures"
        ]);
        Permission::create([
            "name" => "procedures.edit",
            "guard_name" => "staff",
            "description_es" => "Editar Procedimientos",
            "group_es" => "Procedimientos",
            "description_en" => "Edit procedures",
            "group_en" => "Procedures"
        ]);
        Permission::create([
            "name" => "procedures.create",
            "guard_name" => "staff",
            "description_es" => "Crear nuevos Procedimientos",
            "group_es" => "Procedimientos",
            "description_en" => "Create new procedures",
            "group_en" => "Procedures"
        ]);
        Permission::create([
            "name" => "procedures.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar Procedimientos",
            "group_es" => "Procedimientos",
            "description_en" => "Delete procedures",
            "group_en" => "Procedures"
        ]);
        Permission::create([
            "name" => "procedures.activate",
            "guard_name" => "staff",
            "description_es" => "Activar Procedimientos",
            "group_es" => "Procedimientos",
            "description_en" => "Activate procedures",
            "group_en" => "Procedures"
        ]);

        //roles
        Permission::create([
            "name" => "roles.list",
            "guard_name" => "staff",
            "description_es" => "Mostrar lista de Roles",
            "group_es" => "Roles",
            "description_en" => "Show role list",
            "group_en" => "Roles",
            "show" => false,
            "active" => false,
        ]);
        Permission::create([
            "name" => "roles.edit",
            "guard_name" => "staff",
            "description_es" => "Editar Role",
            "group_es" => "Roles",
            "description_en" => "Edit role",
            "group_en" => "Roles",
            "show" => false,
            "active" => false,
        ]);
        Permission::create([
            "name" => "roles.create",
            "guard_name" => "staff",
            "description_es" => "Crear nuevos roles",
            "group_es" => "Roles",
            "description_en" => "Create new role",
            "group_en" => "Roles",
            "show" => false,
            "active" => false,
        ]);
        Permission::create([
            "name" => "roles.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar Roles",
            "group_es" => "Roles",
            "description_en" => "Delete roles",
            "group_en" => "Roles",
            "show" => false,
            "active" => false,
        ]);

        //permissions
        Permission::create([
            "name" => "permission.list",
            "guard_name" => "staff",
            "description_es" => "Mostrar lista de permisos",
            "group_es" => "Permisos",
            "description_en" => "Show permission list",
            "group_en" => "Permission",
            "show" => false,
            "active" => false,
        ]);
        Permission::create([
            "name" => "permission.edit",
            "guard_name" => "staff",
            "description_es" => "Editar permisos",
            "group_es" => "Permisos",
            "description_en" => "Edit permission",
            "group_en" => "Permission",
            "show" => false,
            "active" => false,
        ]);
        Permission::create([
            "name" => "permission.create",
            "guard_name" => "staff",
            "description_es" => "Crear nuevos permisos",
            "group_es" => "Permisos",
            "description_en" => "Create new permission",
            "group_en" => "Permission",
            "show" => false,
            "active" => false,
        ]);
        Permission::create([
            "name" => "permission.destroy",
            "guard_name" => "staff",
            "description_es" => "Eliminar permisos",
            "group_es" => "Permisos",
            "description_en" => "Delete permission",
            "group_en" => "Permission",
            "show" => false,
            "active" => false,
        ]);


        //Dashboard
        Permission::create([
            "name" => "dashboard.wiew",
            "guard_name" => "staff",
            "description_es" => "Ver tablero",
            "group_es" => "Tablero",
            "description_en" => "view dashboard",
            "group_en" => "Dashboard"
        ]);

    }
}
