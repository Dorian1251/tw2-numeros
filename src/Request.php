<?php

class Request
{
    private $get;
    private $post;
    private $data = [];
    private $errors = [];

    public function __construct(array $get, array $post)
    {
        $this->get = $get;
        $this->post = $post;
    }

    public function getInt($key, $default = null)
    {
        if (isset($this->post[$key])) {
            $value = $this->post[$key];
        } elseif (isset($this->get[$key])) {
            $value = $this->get[$key];
        } else {
            return $default;
        }

        $filtered = filter_var($value, FILTER_VALIDATE_INT);
        return $filtered !== false ? $filtered : $default;
    }

    public function validate()
    {
        $this->errors = [];
        $this->data = [];

        $n = $this->getInt('n', null);
        $min = $this->getInt('min', null);
        $max = $this->getInt('max', null);

        if ($n === null) {
            $this->errors['n'] = 'El campo n es requerido';
        } elseif ($n < 1 || $n > 1000) {
            $this->errors['n'] = 'El valor de n debe estar entre 1 y 1000';
        }

        $defaultMin = 1;
        $defaultMax = 10000;

        $effectiveMin = ($min !== null) ? $min : $defaultMin;
        $effectiveMax = ($max !== null) ? $max : $defaultMax;

        if ($min !== null && $max !== null) {
            if ($min >= $max) {
                $this->errors['range'] = 'El valor mínimo debe ser menor que el máximo';
            }
        }

        $this->data = [
            'n' => $n,
            'min' => $effectiveMin,
            'max' => $effectiveMax
        ];

        return ['errors' => $this->errors, 'data' => $this->data];
    }

    public function all()
    {
        return array_merge($this->get, $this->post);
    }
}
