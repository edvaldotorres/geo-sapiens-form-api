<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreFormRequest;
use App\Http\Resources\Api\V1\FormResource;
use App\Repositories\Eloquent\FormRepository;
use Illuminate\Http\JsonResponse;

class FormController extends Controller
{
    public function __construct(private FormRepository $repository)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormRequest $request, string $id_form): JsonResponse
    {
        $validatedData = $request->validated();

        $form = $this->repository->create([
            'form_id' => $id_form,
            'data' => $validatedData['data'],
        ]);

        return (new FormResource($form))->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_form)
    {
        $form = $this->repository->getFormById($id_form);
        return new FormResource($form);
    }
}
