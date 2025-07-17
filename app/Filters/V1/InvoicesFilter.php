<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter{
    protected $safeParms = [
        "customerId" => ["eq"],
        "amount" => ['eq', 'lt', 'gt'],
        "status" => ["eq", "ne"],
        "billed_date" => ['eq', 'lt', 'gt'],
        "paid_date" => ['eq', 'lt', 'gt']
    ];

    protected $columnMap = [
        'customerId' => 'customer_id'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'le' => '<=',
        'gt' => '>',
        'ge' => '>=',
        'ne' => '!='
    ];
}