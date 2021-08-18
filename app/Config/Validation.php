<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
		\Myth\Auth\Authentication\Passwords\ValidationRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $asset_types = [
		'name' => [
			'rules'  => 'required|regex_match[/^[\w\s ,.()&\/]+$/]',
			'errors' => [
				'required' => 'Wajib diisi!',
			]
		],
	];

	public $main_assets = [
		'name' => [
			'rules'  => 'required|regex_match[/^[\w\s ,.()&\/]+$/]',
			'errors' => [
				'required' => 'Wajib diisi!',
			]
		],
		'type_asset' => [
			'rules'  => 'required|numeric',
			'errors' => [
				'required' => 'Wajib diisi!',
				'numeric' => 'Wajib angka',
			]
		],
		'detail' => [
			'rules'  => 'permit_empty|regex_match[/^[\w\s ,.()&\/]+$/]',
		],
		'total' => [
			'rules'  => 'required|numeric',
			'errors' => [
				'required' => 'Wajib diisi!',
				'numeric' => 'Wajib angka',
			]
		],
		'price' => [
			'rules'  => 'required|numeric',
			'errors' => [
				'required' => 'Wajib diisi!',
				'numeric' => 'Wajib angka',
			]
		],
	];

	public $consumables = [
		'name' => [
			'rules'  => 'required|regex_match[/^[\w\s ,.()&\/]+$/]',
			'errors' => [
				'required' => 'Wajib diisi!',
			]
		],
		'type_asset' => [
			'rules'  => 'required|numeric',
			'errors' => [
				'required' => 'Wajib diisi!',
				'numeric' => 'Wajib angka',
			]
		],
		'detail' => [
			'rules'  => 'permit_empty|regex_match[/^[\w\s ,.()&\/]+$/]',
		],
		'qty' => [
			'rules'  => 'required|numeric',
			'errors' => [
				'required' => 'Wajib diisi!',
				'numeric' => 'Wajib angka',
			]
		],
		'price' => [
			'rules'  => 'required|numeric',
			'errors' => [
				'required' => 'Wajib diisi!',
				'numeric' => 'Wajib angka',
			]
		],
	];

	public $asset_purchase = [
		'asset_id' => [
			'rules'  => 'required|numeric',
			'errors' => [
				'required' => 'Wajib diisi!',
				'numeric' => 'Wajib angka',
			]
		],
		'total' => [
			'rules'  => 'required|numeric',
			'errors' => [
				'required' => 'Wajib diisi!',
				'numeric' => 'Wajib angka',
			]
		],
		'price' => [
			'rules'  => 'required|numeric',
			'errors' => [
				'required' => 'Wajib diisi!',
				'numeric' => 'Wajib angka',
			]
		],
		'total_price' => [
			'rules'  => 'required|numeric',
			'errors' => [
				'required' => 'Wajib diisi!',
				'numeric' => 'Wajib angka',
			]
		],
		'seller' => [
			'rules'  => 'required|regex_match[/^[\w\s ,.()&\/]+$/]',
			'errors' => [
				'required' => 'Wajib diisi!',
			]
		],
		'date' => [
			'rules'  => 'required|valid_date[Y-m-d]',
			'errors' => [
				'required' => 'Wajib diisi!',
			]
		],
	];

	public $positions = [
		'name' => [
			'rules'  => 'required|regex_match[/^[\w\s ,.()&\/]+$/]',
			'errors' => [
				'required' => 'Wajib diisi!',
			]
		],
	];

	public $departments = [
		'name' => [
			'rules'  => 'required|regex_match[/^[\w\s ,.()&\/]+$/]',
			'errors' => [
				'required' => 'Wajib diisi!',
			]
		],
	];
}
