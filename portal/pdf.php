<?php
/**
 * Proxy de descarga de PDFs.
 * Llama al endpoint móvil que devuelve {file_name, pdf_base64} y se lo entrega
 * al navegador como descarga PDF nativa (Content-Disposition).
 *
 * Uso:
 *   pdf.php?type=autorizacion&id=123
 *   pdf.php?type=reintegro&id=456
 */
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

portal_require_auth();

$type = $_GET['type'] ?? '';
$id   = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    http_response_code(400);
    exit('ID inválido');
}

$endpoint = match ($type) {
    'autorizacion' => "/authorization-requests/{$id}/pdf",
    'reintegro'    => "/reimbursements/{$id}/pdf",
    default        => null,
};

if ($endpoint === null) {
    http_response_code(400);
    exit('Tipo inválido. Usá type=autorizacion o type=reintegro.');
}

$res = api_get($endpoint, portal_token());

$code = $res['_http_code'] ?? 0;
if ($code !== 200) {
    http_response_code($code ?: 500);
    $msg = htmlspecialchars(api_first_error($res) ?: 'No se pudo generar el PDF.');
    echo "<!DOCTYPE html><html lang='es'><meta charset='UTF-8'>";
    echo "<body style='font-family:sans-serif;padding:40px;text-align:center;'>";
    echo "<h2 style='color:#a33d3d;'>{$msg}</h2>";
    echo "<p><a href='javascript:history.back()'>Volver</a></p></body></html>";
    exit;
}

$fileName = $res['file_name']  ?? "documento-{$id}.pdf";
$base64   = $res['pdf_base64'] ?? '';

if ($base64 === '') {
    http_response_code(500);
    exit('La respuesta no incluye el PDF.');
}

$binary = base64_decode($base64, true);
if ($binary === false) {
    http_response_code(500);
    exit('No se pudo decodificar el PDF.');
}

// Sanitizar el nombre de archivo
$safeName = preg_replace('/[^A-Za-z0-9._-]/', '_', $fileName);

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $safeName . '"');
header('Content-Length: ' . strlen($binary));
header('Cache-Control: private, max-age=0, no-cache');
header('Pragma: no-cache');
echo $binary;
