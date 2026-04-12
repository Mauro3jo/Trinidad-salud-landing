<?php
// Carga .env desde la raíz del proyecto (un nivel arriba de /portal)
(function () {
    $env_file = dirname(__DIR__, 2) . '/.env';
    if (!is_readable($env_file)) return;
    foreach (file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#')) continue;
        [$key, $val] = array_map('trim', explode('=', $line, 2)) + ['', ''];
        if ($key !== '' && !array_key_exists($key, $_ENV)) {
            $_ENV[$key] = $val;
        }
    }
})();

define('PORTAL_API_BASE', $_ENV['PORTAL_API_BASE'] ?? 'https://trinidadsalud.online/api/mobile');

function api_get(string $endpoint, string $token): array {
    return api_call('GET', $endpoint, [], $token);
}

function api_post(string $endpoint, array $data, string $token = ''): array {
    return api_call('POST', $endpoint, $data, $token);
}

function api_put(string $endpoint, array $data, string $token): array {
    return api_call('PUT', $endpoint, $data, $token);
}

function api_call(string $method, string $endpoint, array $data, string $token): array {
    $url = PORTAL_API_BASE . $endpoint;
    $ch  = curl_init($url);

    $headers = ['Accept: application/json', 'Content-Type: application/json'];
    if ($token) {
        $headers[] = 'Authorization: Bearer ' . $token;
    }

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT        => 15,
    ]);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    } elseif ($method === 'PUT') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response  = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_err  = curl_error($ch);
    curl_close($ch);

    if ($curl_err) {
        return ['_error' => 'No se pudo conectar con el servidor.', '_http_code' => 0];
    }

    $decoded = json_decode($response, true) ?? [];
    $decoded['_http_code'] = $http_code;
    return $decoded;
}

function api_first_error(array $response): string {
    if (!empty($response['message'])) {
        return $response['message'];
    }
    if (!empty($response['errors'])) {
        $first = reset($response['errors']);
        return is_array($first) ? $first[0] : $first;
    }
    return 'Ocurrió un error inesperado.';
}
