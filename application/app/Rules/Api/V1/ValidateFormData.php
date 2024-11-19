<?php

namespace App\Rules\Api\V1;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ValidateFormData implements ValidationRule
{
    protected $formId;

    /**
     * Constructor for the ValidateFormData class.
     *
     * @param string $formId The ID of the form to be validated.
     */
    public function __construct(string $formId)
    {
        $this->formId = $formId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $formDefinitions = json_decode(Storage::get('forms_definition.json'), true);

        $form = collect($formDefinitions)->firstWhere('id', $this->formId);

        if (!$form) {
            throw new HttpResponseException(response()->json([
                'message' => 'The form with ID "' . $this->formId . '" does not exist.',
            ], Response::HTTP_NOT_FOUND));
        }

        foreach ($form['fields'] as $field) {
            $fieldId = $field['id'];
            $fieldLabel = $field['label'];
            $fieldValue = $value[$fieldId] ?? null;

            if ($field['required'] && (is_null($fieldValue) || $fieldValue === '')) {
                $fail("The field '{$fieldLabel}' is required and cannot be empty.");
                return;
            }

            if (!is_null($fieldValue)) {
                switch ($field['type']) {
                    case 'text':
                        if (!is_string($fieldValue)) {
                            $fail("The field '{$fieldLabel}' must be a string.");
                            return;
                        }
                        break;

                    case 'number':
                        if (!is_numeric($fieldValue)) {
                            $fail("The field '{$fieldLabel}' must be a valid number (integer or decimal).");
                            return;
                        }
                        break;

                    case 'select':
                        if (!is_string($fieldValue) || !in_array($fieldValue, $field['choices'], true)) {
                            $fail("The field '{$fieldLabel}' must be one of the valid options: " . implode(', ', $field['choices']) . ".");
                            return;
                        }
                        break;

                    default:
                        $fail("The field '{$fieldLabel}' has an unsupported type '{$field['type']}'.");
                        return;
                }
            }
        }
    }
}
