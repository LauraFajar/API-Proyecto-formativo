<?php

    // Retorna la URL base del proyecto
    function base_url()
    {
        return BASE_URL;
    }

    // Retorna la URL de los recursos (Assets)
    function media()
    {
        return BASE_URL . "Assets";
    }

    function dep($data)
    {
        $format  = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');
        return $format;
    }

    function strClean($strCadena)
    {
        $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strCadena);
        $string = trim($string); 
        $string = stripslashes($string); 
        $string = htmlspecialchars($string); 
        $string = str_ireplace([
            "<script>", "</script>", "<script src>", "<script type=>",
            "SELECT * FROM", "DELETE FROM", "INSERT INTO", "SELECT COUNT(*) FROM",
            "DROP TABLE", "OR '1'='1", 'OR "1"="1"', 'OR ´1´=´1´',
            "is NULL; --", "LIKE '", 'LIKE "', "LIKE ´", "OR 'a'='a",
            'OR "a"="a"', "OR ´a´=´a", "--", "^", "[", "]", "=="
        ], '', $string);
        return $string;
    }

    function jsonResponse(array $arrData, int $statusCode = 200) {
        header("Content-Type: application/json");
        http_response_code($statusCode);
        echo json_encode($arrData);
        exit;
    }

    function testString(string $data)
    {
        $re = '/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/m';
        return preg_match($re, $data) ? true : false;
    }

    function testEntero($numero)
    {
        $re = '/^[0-9]+$/m';
        return preg_match($re, $numero) ? true : false;
    }

    function testEmail(string $email)
    {
        $re = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/m';
        return preg_match($re, $email) ? true : false;
    }

    function testFecha(string $fecha)
    {
        $re = '/^\d{4}-\d{2}-\d{2}$/';
        return preg_match($re, $fecha) ? true : false;
    }

    function testDecimal($numero)
    {
        $re = '/^\d+(\.\d{1,2})?$/';
        return preg_match($re, $numero) ? true : false;
    }

    function formatFecha(string $fecha)
    {
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $timestamp = strtotime($fecha);
        return strftime("%d de %B de %Y", $timestamp);
    }

?>