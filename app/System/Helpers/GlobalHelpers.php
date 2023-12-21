<?php
/*
Este archivo es de helpers globales para su uso solo debe llamarse la funcion
*/

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

