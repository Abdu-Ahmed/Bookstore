<?php

namespace App\Core;

class Validator {
    protected $errors = [];

    // Validate required fields
    public function required($field, $value) {
        if (empty($value)) {
            $this->errors[$field] = "$field is required.";
        }
        return $this;
    }

    // Validate string length
    public function length($field, $value, $min, $max) {
        $length = strlen($value);
        if ($length < $min || $length > $max) {
            $this->errors[$field] = "$field must be between $min and $max characters.";
        }
        return $this;
    }

    // Validate email format
    public function email($field, $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = "Invalid email format.";
        }
        return $this;
    }

    // Validate numeric values
    public function numeric($field, $value) {
        if (!is_numeric($value)) {
            $this->errors[$field] = "$field must be a number.";
        }
        return $this;
    }

    // Validate minimum value
    public function min($field, $value, $min) {
        if ($value < $min) {
            $this->errors[$field] = "$field must be at least $min.";
        }
        return $this;
    }

    // Validate maximum value
    public function max($field, $value, $max) {
        if ($value > $max) {
            $this->errors[$field] = "$field must not exceed $max.";
        }
        return $this;
    }
    public function url($field, $value) {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            $this->errors[$field] = 'Invalid URL';
        }
        return $this;
    }
    // Get all validation errors
    public function errors() {
        return $this->errors;
    }

    // Check if there are any validation errors
    public function fails() {
        return !empty($this->errors);
    }
    public function sanitizeInput($field) {
        return htmlspecialchars(strip_tags(trim($field)));
    }
}