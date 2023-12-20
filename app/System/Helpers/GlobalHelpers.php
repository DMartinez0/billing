<?php

    function flashCode($code){ // Los 5 primeros digitos de una cadena
        return strtoupper(substr($code,0, 5));  
    }

     function tipoCuenta($cuenta){
        if ($cuenta == NULL) { return 'Ninguno'; }
        if ($cuenta == 1) { return 'Tarjeta de Credito'; }
        if ($cuenta == 2) { return 'Chequera'; }
        if ($cuenta == 3) { return 'Cuenta Bancaria'; }
        if ($cuenta == 4) { return 'Caja Chica'; }
     }

     function tipoGasto($cuenta){
        if ($cuenta == 1) { return 'Sin Comprobante'; }
        if ($cuenta == 2) { return 'Con Comprobante'; }
        if ($cuenta == 3) { return 'Adelanto a Personal'; }
     }

     function tipoPago($cuenta){
        if ($cuenta == 1) { return 'Efectivo'; }
        if ($cuenta == 2) { return 'Tarjeta'; }
        if ($cuenta == 3) { return 'Transferencia'; }
        if ($cuenta == 4) { return 'Cheque'; }
     }

     function edoCorte($cuenta){
        if ($cuenta == 0) { return 'Eliminado'; }
        if ($cuenta == 1) { return 'Activo'; }
        if ($cuenta == 2) { return 'Cerrado'; }
     }

    
     function edoSistema($edo){
        if ($edo == 0) { return 'Inactivo'; }
        if ($edo == 1) { return 'Activo'; }
        if ($edo == 2) { return 'Por Vencer'; }
        if ($edo == 3) { return 'Vencido'; }
     }

     function tipoSistema($edo){
        if ($edo == 1) { return 'Basico'; }
        if ($edo == 2) { return 'Profesional'; }
        if ($edo == 3) { return 'Empresa'; }
     }

     function plataforma($edo){
        if ($edo == 1) { return 'Local'; }
        if ($edo == 2) { return 'Web'; }
     }


