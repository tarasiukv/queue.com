<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MailServiceFacade extends Facade
{
protected static function getFacadeAccessor()
{
return \App\Services\MailService::class;
}
}
