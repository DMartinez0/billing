<?php

    function flashCode($code){ // Los 5 primeros digitos de una cadena
        return strtoupper(substr($code,0, 5));  
    }

