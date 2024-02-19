<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $sql = database_path('permisos.sql');
        // DB::unprepared(file_get_contents($sql));
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        
        $role1 = Role::create(['name' => 'Root',]);
        $role2 = Role::create(['name' => 'Gerencia']);
        $role3 = Role::create(['name' => 'Administracion']);
        $role4 = Role::create(['name' => 'Cajero']);
        $role5 = Role::create(['name' => 'Usuario']);
        $role6 = Role::create(['name' => 'Contador']);
        
        
        Permission::create(['name' => 'dashboard', 'description' => 'Dashboard del estado del sistema'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'cashdrawer', 'description' => 'Acceso a cajas de cobro'])->assignRole([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'inventory', 'description' => 'Ver listado de productos del inventario'])->assignRole([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'inventory-register', 'description' => 'Registrar de productos'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'inventory-edit', 'description' => 'Editar Productos'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'inventory-add', 'description' => 'Agregar mas productos al inventario'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'inventory-failure', 'description' => 'Agregar productos averiados'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'inventory-linked', 'description' => 'Ver productos vinculados o agrupados'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'inventory-stock', 'description' => 'Ver Existencias de los productos'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'inventory-expiration', 'description' => 'Productos expirados o por expirar'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'inventory-karex', 'description' => 'Kardex de productos existentes'])->assignRole([$role1, $role2, $role3]);

        Permission::create(['name' => 'cash-bills', 'description' => 'Registro de gastos'])->assignRole([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'cash-remittance', 'description' => 'Registro de remesas de efectivo'])->assignRole([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'cash-accounts', 'description' => 'Cuentas bancarias'])->assignRole([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'cash-inout', 'description' => 'Entradas y salidas de efectivo'])->assignRole([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'cash-history', 'description' => 'Historial de transacciones'])->assignRole([$role1, $role2, $role3, $role4]);

        Permission::create(['name' => 'credits-receivable', 'description' => 'Cuentas por cobrar'])->assignRole([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'credits-payable', 'description' => 'Cuantas por pagar'])->assignRole([$role1, $role2, $role3, $role4]);

        Permission::create(['name' => 'directory', 'description' => 'Directorio de clientes'])->assignRole([$role1, $role2, $role3, $role4, $role5]);

        Permission::create(['name' => 'histories-sales', 'description' => 'Historial de ventas'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'histories-bills', 'description' => 'Historial de gastos'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'histories-remittance', 'description' => 'Historial de remesas'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'histories-cut', 'description' => 'Historial de cortes de caja'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'histories-discount', 'description' => 'Historial de descuentos'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'histories-list', 'description' => 'Historial y Listado de ventas'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'histories-by-user', 'description' => 'Historial de Ventas por usuario'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'histories-deleted', 'description' => 'Ordenes eliminadas'])->assignRole([$role1, $role2, $role3]);

        Permission::create(['name' => 'tools-commissions', 'description' => 'Lstado de comisones'])->assignRole([$role1, $role2, $role3]);
        Permission::create(['name' => 'tools-adjustment', 'description' => 'Ajuste de inventario'])->assignRole([$role1, $role2, $role3]);

        Permission::create(['name' => 'reports-sales', 'description' => 'Reporte de ventas'])->assignRole([$role1, $role2, $role3, $role6]);
        Permission::create(['name' => 'reports-bills', 'description' => 'Reporte de gastos'])->assignRole([$role1, $role2, $role3, $role6]);
        Permission::create(['name' => 'reports-products', 'description' => 'Reporte de productos ingresados'])->assignRole([$role1, $role2, $role3, $role6]);

        Permission::create(['name' => 'invoices-documents', 'description' => 'Facturas o documentos emitidos'])->assignRole([$role1, $role2, $role3, $role4, $role6]);
        Permission::create(['name' => 'invoices-electronic', 'description' => 'Facturacion electrónica'])->assignRole([$role1, $role2, $role3, $role4, $role6]);
        Permission::create(['name' => 'invoices-search', 'description' => 'Busqueda de facturas o documentos'])->assignRole([$role1, $role2, $role3, $role4, $role6]);

        Permission::create(['name' => 'config', 'description' => 'Configuración Principal'])->assignRole([$role1]);
        Permission::create(['name' => 'config-products', 'description' => 'Configuración de productos'])->assignRole([$role1, $role2, $role3]);






        
    }
}