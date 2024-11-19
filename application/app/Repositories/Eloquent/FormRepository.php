<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Form;

class FormRepository extends AbstractRepository
{
    protected static $model = Form::class;

    public function getFormById(string $formId): ?Form
    {
        return static::loadModel()::where('form_id', $formId)->firstOrFail();
    }
}
