<?php

use Illuminate\Database\Seeder;
use VNPCMS\Setting\Setting;

class SettingsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run()
	{
		DB::table('settings')->truncate();

		$settings = [

			['key' => 'url', 'value' => Config::get('VNPCMS.url')],
			['key' => 'crmname', 'value' => Config::get('VNPCMS.crmname')],
			['key' => 'crmdescription', 'value' => Config::get('VNPCMS.crmdescription')],
			['key' => 'crmfooter', 'value' => Config::get('VNPCMS.crmfooter')],
			['key' => 'orgname', 'value' => Config::get('VNPCMS.orgname')],
			['key' => 'orgdescription', 'value' => Config::get('VNPCMS.orgdescription')],
			['key' => 'address', 'value' => Config::get('VNPCMS.address')],
			['key' => 'locale', 'value' => Config::get('VNPCMS.locale')],
			['key' => 'theme', 'value' => Config::get('VNPCMS.theme')],
			['key' => 'enable_registration', 'value' => Config::get('VNPCMS.enable_registration')],
			['key' => 'new_user_role', 'value' => Config::get('VNPCMS.new_user_role')],

		];

		foreach ($settings as $setting) {
			Setting::create($setting);
		}
	}
}
