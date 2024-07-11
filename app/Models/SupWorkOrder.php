<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupWorkOrder extends Model
{
    use HasFactory;

    protected $table = "sup_work_orders";
    protected $primaryKey = "work_order_id";
    public $incrementing = false;
    protected $keyType = "string";
    public $timestamps = false;

    protected $fillable = [
        "work_order_id",
        "employee_id",
        "type_report_id",
        "contract_num",
        "order_channel",
        "issue_date",
        "order_precedents",
        "order_status",
        "order_abclaim",
        "solution_date",
        "order_initial_abis",
        "order_initial_potency",
        "order_final_abis",
        "order_initial_diagnosis",
        "order_solution",
        "order_final_potency",
        "order_final_diagnosis",
        "value_due",
    ];
     
    protected static function booted() {
        static::creating(function ($model) {
            $orderwork = static::max("work_order_id");
            $nextNumber = $orderwork
                ? intval(substr($orderwork, 4)) + 1
                : 1;
            $model->work_order_id =
                "ORT-" . str_pad($nextNumber, 2, "0", STR_PAD_LEFT);
        });
    }

    public static function getWorkOrders()
{
    return self::with(['typeReport', 'employee', 'contract'])
        ->get()
        ->map(function ($workOrder) {
            return [
                'work_order_id' => $workOrder->work_order_id,
                'employee_id' => $workOrder->employee_id,
                'employee_name' => $workOrder->employee->name,
                'type_report_id' => $workOrder->type_report_id,
                'report_name' => $workOrder->typeReport->report_name,
                'contract_num' => $workOrder->contract_num,
                'contract_client' => $workOrder->contract->client->client_name,
                'order_channel' => $workOrder->order_channel,
                'issue_date' => $workOrder->issue_date,
                'order_precedents' => $workOrder->order_precedents,
                'order_status' => $workOrder->order_status,
                'order_abclaim' => $workOrder->order_abclaim,
                'solution_date' => $workOrder->solution_date,
                'order_initial_abis' => $workOrder->order_initial_abis,
                'order_initial_potency' => $workOrder->order_initial_potency,
                'order_final_abis' => $workOrder->order_final_abis,
                'order_initial_diagnosis' => $workOrder->order_initial_diagnosis,
                'order_solution' => $workOrder->order_solution,
                'order_final_potency' => $workOrder->order_final_potency,
                'order_final_diagnosis' => $workOrder->order_final_diagnosis,
                'value_due' => $workOrder->value_due,
            ];
        });
}


    public function typeReport()
    {
        return $this->belongsTo(SupTypeReport::class, "type_report_id", "type_report_id");
    }

    public function employee()
    {
        return $this->belongsTo(User::class, "employee_id", "id");
    }

    public function contract()
    {
        return $this->belongsTo(ConContract::class, "contract_num", "contract_num");
    }
    public function movements()
    {
        return $this->hasMany(InvMovement::class, "work_order_id", "work_order_id");
    }
    
}
