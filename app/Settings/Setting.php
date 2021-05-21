<?php

namespace App\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Model;

class Setting extends Model
{
	use HasFactory;
	protected $fillable = ['setting_key', 'value'];

	protected $primaryKey = 'setting_key';
}
