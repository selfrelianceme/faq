<?php 
namespace Selfreliance\Faq\Facades;  

use Illuminate\Support\Facades\Facade;  

class Faq extends Facade 
{
	protected static function getFacadeAccessor() { 
		return 'faq';
	}
}
