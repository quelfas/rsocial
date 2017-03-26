<?php
return [
		/*
		|--------------------------------------------------------------------------
		| Validation Language Lines
		|--------------------------------------------------------------------------
		|
		| The following language lines contain the default error messages used by
		| the validator class. Some of these rules have multiple versions such
		| as the size rules. Feel free to tweak each of these messages here.
		|
		*/
		'accepted'             => 'El campo :attribute debe ser aceptado.',
		'active_url'           => 'El campo :attribute no es una URL v&aacute;lida.',
		'after'                => 'El campo :attribute debe ser una fecha posterior a :date.',
		'alpha'                => 'El campo :attribute s&oacute;lo puede contener letras.',
		'alpha_dash'           => 'El campo :attribute s&oacute;lo puede contener letras, n&ntilde;meros y guiones (a-z, 0-9, -_).',
		'alpha_num'            => 'El campo :attribute s&oacute;lo puede contener letras y n&ntilde;meros.',
		'array'                => 'El campo :attribute debe ser un array.',
		'before'               => 'El campo :attribute debe ser una fecha anterior a :date.',
		'between'              => [
				'numeric' => 'El campo :attribute debe ser un valor entre :min y :max.',
				'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
				'string'  => 'El campo :attribute debe contener entre :min y :max caracteres.',
				'array'   => 'El campo :attribute debe contener entre :min y :max elementos.',
		],
		'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
		'confirmed'            => 'El campo confirmaci&oacute;n de :attribute no coincide.',
		'date'                 => 'El campo :attribute no corresponde con una fecha v&aacute;lida.',
		'date_format'          => 'El campo :attribute no corresponde con el formato de fecha :format.',
		'different'            => 'Los campos :attribute y :other han de ser diferentes.',
		'digits'               => 'El campo :attribute debe ser un n&ntilde;mero de :digits d&iacute;gitos.',
		'digits_between'       => 'El campo :attribute debe contener entre :min y :max d&iacute;gitos.',
		'filled'               => 'El campo :attribute es obligatorio.',
		'exists'               => 'El campo :attribute no existe.',
		'image'                => 'El campo :attribute debe ser una imagen.',
		'in'                   => 'El campo :attribute debe ser igual a alguno de estos valores :values',
		'integer'              => 'El campo :attribute debe ser un n&ntilde;mero entero.',
		'ip'                   => 'El campo :attribute debe ser una direcci&oacute;n IP v&aacute;lida.',
		'json'                 => 'El campo :attribute debe ser una cadena de texto JSON v&aacute;lida.',
		'email'                => 'El campo :attribute no corresponde con una direcci&oacute;n de e-mail v&aacute;lida.',
		"recaptcha" 	       => 'El campo :attribute no es correcto.',
		'max'                  => [
				'numeric' => 'El campo :attribute debe ser menor que :max.',
				'file'    => 'El archivo :attribute debe pesar meno que :max kilobytes.',
				'string'  => 'El campo :attribute debe contener menos de :max caracteres.',
				'array'   => 'El campo :attribute debe contener al menos :max elementos.',
		],
		'mimes'                => 'El campo :attribute debe ser un archivo de tipo :values.',
		'min'                  => [
				'numeric' => 'El campo :attribute debe tener al menos :min.',
				'file'    => 'El archivo :attribute debe pesar al menos :min kilobytes.',
				'string'  => 'El campo :attribute debe contener al menos :min caracteres.',
				'array'   => 'El campo :attribute no debe contener m&aacute;s de :min elementos.',
		],
		'not_in'               => 'El campo :attribute seleccionado es invalido.',
		'numeric'              => 'El campo :attribute debe ser un numero.',
		'regex'                => 'El formato del campo :attribute es inv&aacute;lido.',
		'required'             => 'El campo :attribute es obligatorio',
		'required_if'          => 'El campo :attribute es obligatorio cuando el campo :other es :value.',
		'required_with'        => 'El campo :attribute es obligatorio cuando :values est&aacute; presente.',
		'required_with_all'    => 'El campo :attribute es obligatorio cuando :values est&aacute; presente.',
		'required_without'     => 'El campo :attribute es obligatorio cuando :values no est&aacute; presente.',
		'required_without_all' => 'El campo :attribute es obligatorio cuando ning&ntilde;n campo :values est&aacute;n presentes.',
		'same'                 => 'Los campos :attribute y :other deben coincidir.',
		'size'                 => [
				'numeric' => 'El campo :attribute debe ser :size.',
				'file'    => 'El archivo :attribute debe pesar :size kilobytes.',
				'string'  => 'El campo :attribute debe contener :size caracteres.',
				'array'   => 'El campo :attribute debe contener :size elementos.',
		],
		'string'               => 'El campo :attribute debe contener solo caracteres.',
		'timezone'             => 'El campo :attribute debe contener una zona v&aacute;lida.',
		'unique'               => 'El elemento :attribute ya est&aacute; en uso.',
		'url'                  => 'El formato de :attribute no corresponde con el de una URL v&aacute;lida.',
		'hash'							 	 => 'El :attribute no corresponde con el campo clave',
		/*
		|--------------------------------------------------------------------------
		| Custom Validation Language Lines
		|--------------------------------------------------------------------------
		|
		| Here you may specify custom validation messages for attributes using the
		| convention "attribute.rule" to name the lines. This makes it quick to
		| specify a specific custom language line for a given attribute rule.
		|
		*/
		'custom' => [
				'attribute-name' => [
						'rule-name' => 'custom-message',
				],
		],
		/*
		|--------------------------------------------------------------------------
		| Custom Validation Attributes
		|--------------------------------------------------------------------------
		|
		| The following language lines are used to swap attribute place-holders
		| with something more reader friendly such as E-Mail Address instead
		| of "email". This simply helps us make messages a little cleaner.
		|
		*/
		'attributes' => [],
];
