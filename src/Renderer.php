<?php

class Renderer
{
    private $viewsPath;

    public function __construct()
    {
        $this->viewsPath = __DIR__ . '/../views/';
    }

    public function escape($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public function renderForm($data = [])
    {
        $n = isset($data['n']) ? $data['n'] : '';
        $min = isset($data['min']) ? $data['min'] : '';
        $max = isset($data['max']) ? $data['max'] : '';
        $errors = isset($data['errors']) ? $data['errors'] : [];
        $renderer = $this;

        ob_start();
        include $this->viewsPath . 'form.php';
        return ob_get_clean();
    }

    public function renderResults($numbers, $stats, $previousInput = [])
    {
        $renderer = $this;

        ob_start();
        include $this->viewsPath . 'results.php';
        return ob_get_clean();
    }
}
