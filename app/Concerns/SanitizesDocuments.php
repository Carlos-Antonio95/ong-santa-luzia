<?php

namespace App\Concerns;

trait SanitizesDocuments
{
    private function onlyNumbers(?string $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        return preg_replace('/\D+/', '', $value);
    }

    private function formatCpf(?string $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        $value = $this->onlyNumbers($value);

        if (strlen($value) !== 11) {
            return $value;
        }

        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $value);
    }

    private function formatPhone(?string $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        $value = $this->onlyNumbers($value);

        if (strlen($value) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $value);
        }

        if (strlen($value) === 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $value);
        }

        return $value;
    }
}