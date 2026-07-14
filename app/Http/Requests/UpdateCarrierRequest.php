<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarrierRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('customer_groups') && is_string($this->customer_groups)) {
            $this->merge([
                'customer_groups' => json_decode($this->customer_groups, true)
            ]);
        }

        if ($this->has('ranges') && is_string($this->ranges)) {
            $this->merge([
                'ranges' => json_decode($this->ranges, true)
            ]);
        }

        if (filter_var($this->is_free, FILTER_VALIDATE_BOOLEAN)) {
            $this->merge(['ranges' => []]);
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'transit_time' => 'nullable|string|max:255',
            'speed_grade' => 'nullable|integer|min:0|max:9',
            'tracking_url' => 'nullable|url|max:255',
            'is_free' => 'boolean',
            'active' => 'boolean',
            'logo' => 'nullable|image|max:2048',
            'billing_behavior' => 'required|in:price,weight',
            'out_of_range_behavior' => 'required|in:highest_range,disable',
            'max_width' => 'nullable|numeric|min:0',
            'max_height' => 'nullable|numeric|min:0',
            'max_depth' => 'nullable|numeric|min:0',
            'max_weight' => 'nullable|numeric|min:0',
            
            // Validaciones para grupos de clientes
            'customer_groups' => 'nullable|array',
            'customer_groups.*' => 'integer|exists:customer_groups,id',

            // Validaciones para rangos
            'ranges' => 'nullable|array',
            'ranges.*.delimiter1' => 'required|numeric|min:0',
            'ranges.*.delimiter2' => 'required|numeric|gt:ranges.*.delimiter1',
            'ranges.*.prices' => 'nullable|array',
            'ranges.*.prices.*' => 'numeric|min:0',
        ];
    }
}
