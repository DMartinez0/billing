<?php
/*
Este archivo es de helpers globales para su uso solo debe llamarse la funcion
*/

use Illuminate\Support\Facades\View;

    function flashCode($code){ // Los 5 primeros digitos de una cadena
        return strtoupper(substr($code,0, 5));  
    }

   function toMoney($quantity, $number = 2)
   {
      return number_format($quantity, $number, '.', ',');
   }



   /** RESPUESTAS DEL SERVIDOR */
   function errorResponse($text = 'Registro no encontrado!', $status = 404)
   {
      return response()->json(['message' => $text, 'type' => 'error'], $status);
   }

   function successResponse($text = 'Realizado!', $status = 200)
   {
      return response()->json(['message' => $text, 'type' => 'successful'], $status);
   }



   /** FUNCIONES PARA FECHAS */
   function dateAddDays($date, $quantyOfDays, $justDate = false)
   {
      $date->toDateString();
      $datePase =  $date->addDay($quantyOfDays);
      if ($justDate) {
         return $datePase->toDateString();
      }
      return $datePase;
   }

   function dateSubDays($date, $quantyOfDays, $justDate = false)
   {
      $date->toDateString();
      $datePase =  $date->subDay($quantyOfDays);
      if ($justDate) {
         return $datePase->toDateString();
      }
      return $datePase;
   }

   function dateAddMonth($date, $quantyOfMonth, $justDate = false)
   {
      $date->toDateString();
      $datePase =  $quantyOfMonth == 1 ? $date->addMonth() : $date->addMonths($quantyOfMonth);
      if ($justDate) {
         return $datePase->toDateString();
      }
      return $datePase;
   }

   function dateSubMonth($date, $quantyOfMonth, $justDate = false)
   {
      $date->toDateString();
      $datePase =  $quantyOfMonth == 1 ? $date->subMonth() : $date->subMonths($quantyOfMonth);
      if ($justDate) {
         return $datePase->toDateString();
      }
      return $datePase;
   }

   function dateAddYear($date, $quantyOfYear, $justDate = false)
   {
      $date->toDateString();
      $datePase =  $quantyOfYear == 1 ? $date->addYear() : $date->addYears($quantyOfYear);
      if ($justDate) {
         return $datePase->toDateString();
      }
      return $datePase;
   }

   function dateSubYear($date, $quantyOfYear, $justDate = false)
   {
      $date->toDateString();
      $datePase =  $quantyOfYear == 1 ? $date->subYear() : $date->subYears($quantyOfYear);
      if ($justDate) {
         return $datePase->toDateString();
      }
      return $datePase;
   }


   function dateDayName($date)
   {
      $date->toDateString();
      return $date->isoFormat('dddd');
   }

   function dateMonthName($date)
   {
      $date->toDateString();
      return $date->isoFormat('MMMM');
   }



   
   function nombreDepartamento($idDepartamento) {
      $rutaArchivoJson = public_path('el-salvador.json');
      if (file_exists($rutaArchivoJson)) {
         $contenidoJson = file_get_contents($rutaArchivoJson);
         $data = json_decode($contenidoJson, true);
  
         foreach ($data['departamentos'] as $departamento) {
            if ($departamento['id'] == $idDepartamento) {
               return $departamento['nombre'];
            }
         }
      }
      return null; // Departamento no encontrado
  }
  
  function nombreMunicipio($idDepartamento, $idMunicipio) {
      $rutaArchivoJson = public_path('el-salvador.json');
      if (file_exists($rutaArchivoJson)) {
         $contenidoJson = file_get_contents($rutaArchivoJson);
         $data = json_decode($contenidoJson, true);
  
         foreach ($data['departamentos'] as $departamento) {
            if ($departamento['id'] == $idDepartamento) {
               foreach ($departamento['municipios'] as $municipio) {
                  if ($municipio['id_mun'] == $idDepartamento."".$idMunicipio) {
                     return $municipio['nombre'];
                  }
               }
            }
         }
      }
      return null; // Municipio no encontrado
  }

      /**
     * establece la vista si existe segun numero de  tenant o establece la default
     */
    function formatView($path, $nit, $viewName)
    {
         if (View::exists($path .'.'.$nit.'.'.$viewName)) {
              return $path .'.'.$nit.'.'.$viewName;
         } else {
              return $path .'.default.'.$viewName;
         }
    }