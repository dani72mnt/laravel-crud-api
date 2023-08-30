<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\PhoneNumber;

class CustomerCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'phone_number' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Use Google LibPhoneNumber to validate the phone number
                    $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
                    try {
                        $phoneNumber = $phoneNumberUtil->parse($value, null);
                        if (!$phoneNumberUtil->isValidNumber($phoneNumber) || !$phoneNumberUtil->isPossibleNumber($phoneNumber)) {
                            $fail('The ' . $attribute . ' is not a valid mobile number.');
                        }
                    } catch (\libphonenumber\NumberFormatException $e) {
                        $fail('The ' . $attribute . ' is not a valid mobile number.');
                    }
                },
            ],
            'email' => 'required|email|unique:customers,email',
            'bank_account_number' => 'required|string|max:50', // Adjust as needed
        ];
    }
}
