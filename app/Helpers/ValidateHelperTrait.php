<?php

namespace App\Helpers;

trait ValidateHelperTrait
{

	public int $minLengthPassword = 5;
	public int $minLengthPhoneNumber = 18;

	public function getValidateFields(array $fields = []): array
	{
		$allFields = [
			'name' => ['string', 'required'],
			'email' => ['string', 'email:dns'],
			'phone' => ['required', 'string'],
			'password' => ['required', "min:{$this->minLengthPassword}"]
		];

		if (!$fields) return $allFields;

		$custom = [];
		foreach ($fields as $field) {
			if (array_key_exists($field, $allFields)) {
				$custom[$field] = $allFields[$field];
			}
		}

		return $custom;
	}

	public function correctPhoneNumber(string $phone): string
	{
		return preg_replace('/\W+/', '', $phone);
	}

}
