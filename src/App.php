<?php

class App
{
    private $request;
    private $renderer;

    public function __construct(Request $request, Renderer $renderer)
    {
        $this->request = $request;
        $this->renderer = $renderer;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'POST') {
            $this->handlePost();
        } else {
            $this->handleGet();
        }
    }

    private function handlePost()
    {
        $validation = $this->request->validate();
        $errors = $validation['errors'];
        $data = $validation['data'];

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['previous_input'] = $_POST;
            $this->redirectToGet();
        }

        $generator = new RandomGenerator($data['n'], $data['min'], $data['max']);
        $numbers = $generator->generate();

        $stats = [
            'sum' => $generator->getSum(),
            'average' => $generator->getAverage(),
            'min' => $generator->getMin(),
            'max' => $generator->getMax()
        ];

        $_SESSION['results'] = [
            'numbers' => $numbers,
            'stats' => $stats,
            'input' => [
                'n' => $data['n'],
                'min' => $data['min'],
                'max' => $data['max']
            ]
        ];

        $this->redirectToGet();
    }

    private function handleGet()
    {
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
        $previousInput = isset($_SESSION['previous_input']) ? $_SESSION['previous_input'] : [];
        $results = isset($_SESSION['results']) ? $_SESSION['results'] : null;

        unset($_SESSION['errors'], $_SESSION['previous_input']);

        if ($results !== null) {
            unset($_SESSION['results']);
        }

        echo $this->renderHtml($errors, $previousInput, $results);
    }

    private function renderHtml($errors, $previousInput, $results)
    {
        $html = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Números Aleatorios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Generador de Números Aleatorios</h2>';

        $formData = [
            'errors' => $errors,
            'n' => isset($previousInput['n']) ? $previousInput['n'] : '',
            'min' => isset($previousInput['min']) ? $previousInput['min'] : '',
            'max' => isset($previousInput['max']) ? $previousInput['max'] : ''
        ];
        $html .= $this->renderer->renderForm($formData);

        if ($results !== null) {
            $html .= $this->renderer->renderResults($results['numbers'], $results['stats'], $results['input']);
        }

        $html .= '</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>';

        return $html;
    }

    private function redirectToGet()
    {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $uri = $_SERVER['REQUEST_URI'];
        $path = strtok($uri, '?');

        header('Location:' .$scheme . '://' . $host . $path);
        exit;
    }
}
