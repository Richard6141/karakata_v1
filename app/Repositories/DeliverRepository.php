<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Deliver;
use App\Models\AvailableDeliver;
use Illuminate\Support\Facades\DB;
use App\Interfaces\DeliverRepositoryInterface;

class DeliverRepository implements DeliverRepositoryInterface 
{

    public function createDeliver(array $deliverDetails): object
    {
        $deliver = Order::create($deliverDetails);
        return $deliver;

    }
    

    public function getAllDelivers(): mixed {
        return Deliver::all();
    }

    public function updateDeliver(string $deliverId, array $deliverDetails) 
    {
        return Deliver::whereId($deliverId)->update($deliverDetails);
    }

    //Commande validée, assignée et non livrée
    public function getOderAssignedUndelivered() {
        return Order::where('deliver_id', '!=', null)
            ->where('status_order', true)
            ->where('status_delivery', false)
            ->select('deliver_id')
            ->get();
    }

    public function getdeliverById( string $deliverId) 
    { 
        
        $deliver =  Deliver::findOrFail($deliverId);
        return $deliver;

    }
    public function getAvailableDeleverById( string $deliverId) 
    {
        return AvailableDeliver::find($deliverId);
    }

    public function deleteDeliver(string $deliverId) 
    {
        Order::destroy($deliverId);
    }
    
    public function getAllAvailableDeliver() 
    {
        return AvailableDeliver::where('status', true)->get();
    }
    public function getTodayUnassignedOrder() 
    {
        return Order::where('deliver_id', null)
            ->where('date', $date)
            ->get();
    }
    
    //Entreprise commande du jour, non payée

    public function getCompanyOrderUnfinished() 
    {
        $date = date('Y-m-d');
        return DB::table('orders')
            ->where('finished', false)
            ->where('date', $date)
            ->join('customers', 'customers.id', 'orders.customer_id')
            ->join('companies', 'companies.id', 'customers.companies_id')
            ->join('districts', 'districts.id', 'orders.district_id')
            ->select(
                'customers.*',
                'companies.*',
                'orders.*',
                'districts.*',
                'orders.id As order_id'
            )
            ->orderBy('customer_delivery_time', 'asc')
            ->get()
            ->toArray();
    }

    //Entreprise commande d'aujourd'hui non assignée, non livrée,

    public function getCompanyOrderNotDelivered() 
    {
        $date = date('Y-m-d');
        return DB::table('orders')
            ->where('deliver_id', null)
            ->where('date', $date)
            ->where('status_delivery', false)
            ->join('customers', 'customers.id', 'orders.customer_id')
            ->join('companies', 'companies.id', 'customers.companies_id')
            ->join('districts', 'districts.id', 'orders.district_id')
            ->select(
                'customers.*',
                'companies.*',
                'orders.*',
                'districts.*',
                'orders.id As order_id'
            )
            ->orderBy('customer_delivery_time')
            ->get()
            ->toArray();
    }
    //Entreprise commande d'aujourd'hui non assignée, non livrée,

    public function getCompanyOrderAssignedNotDelivered(string $deliverId) 
    {
        $date = date('Y-m-d');
        $orders = DB::table('orders')
            ->where('deliver_id', $deliverId)
            ->where('date', $date)
            ->where('status_delivery', false)
            ->join('customers', 'customers.id', 'orders.customer_id')
            ->join('companies', 'companies.id', 'customers.companies_id')
            ->join('districts', 'districts.id', 'orders.district_id')
            ->join('delivers', 'delivers.id', 'orders.deliver_id')
            ->select(
                'customers.*',
                'companies.*',
                'orders.*',
                'districts.*',
                'delivers.lastname As nom',
                'delivers.firstname As prenom',
                'orders.id As order_id'
            )
            ->orderBy('customer_delivery_time', 'asc')
            ->get()
            ->toArray();
        return $orders;
    }
    //Entreprise commande d'aujourd'hui, assignée,  livrée,

    public function getCompanyOrderAssignedDelivered(string $deliverId) 
    {
        $date = date('Y-m-d');
        return DB::table('orders')
            ->where('deliver_id', $deliverId)
            ->where('status_delivery', true)
            ->join('customers', 'customers.id', 'orders.customer_id')
            ->join('companies', 'companies.id', 'customers.companies_id')
            ->join('districts', 'districts.id', 'orders.district_id')
            ->join('delivers', 'delivers.id', 'orders.deliver_id')
            ->select(
                'customers.*',
                'companies.*',
                'orders.*',
                'delivers.firstname As prenom',
                'delivers.lastname As nom',
                'districts.*',
                'orders.id As order_id'
            )
            ->orderBy('customer_delivery_time', 'asc')
            ->get()
            ->toArray();
    }
    public function getOrdersByCustomerId(string $deliverId) 
    {
        $orders1 = DB::table('orders')
            ->where('deliver_id', $deliverId)
            // ->where('status_delivery', true)
            ->join('customers', 'customers.id', 'orders.customer_id')
            ->join('companies', 'companies.id', 'customers.companies_id')
            ->join('districts', 'districts.id', 'orders.district_id')
            ->join('delivers', 'delivers.id', 'orders.deliver_id')
            ->select(
                'customers.*',
                'companies.*',
                'orders.*',
                // 'delivers.firstname As prenom',
                // 'delivers.lastname As nom',
                'districts.*',
                'orders.id As order_id'
            )
            ->orderBy('customer_delivery_time', 'asc')
            ->get()
            ->toArray();
        $orders2 = DB::table('orders')
            ->where('deliver_id', $deliverId)
            ->where('status_delivery', true)
            ->join('customers', 'customers.id', 'orders.customer_id')
            ->join('particulars', 'particulars.id', 'customers.particulars_id')
            ->join('districts', 'districts.id', 'orders.district_id')
            ->select(
                'customers.*',
                // 'companies.*',
                'orders.*',
                // 'delivers.firstname As prenom',
                // 'delivers.lastname As nom',
                'districts.*',
                'orders.id As order_id'
            )
            ->orderBy('customer_delivery_time', 'asc')
            ->get()
            ->toArray();

            $orders = array_merge($orders1, $orders2);

            return $orders;
    }
    public function getOrdersByCustomerIdNumber(string $deliverId) 
    {
        $orders = DB::table('orders')
            ->where('deliver_id', $deliverId)
            ->where('status_delivery', true)
            ->get()
            ->toArray();
            return $orders;
    }


    //Particulier commande du jour, non payée
    public function getParticularOrderUnfinished() 
    {
        $date = date('Y-m-d');
        return DB::table('orders')
            ->where('finished', false)
            ->where('date', $date)
            ->join('customers', 'customers.id', 'orders.customer_id')
            ->join('particulars', 'particulars.id', 'customers.particulars_id')
            ->join('districts', 'districts.id', 'orders.district_id')
            ->select(
                'customers.*',
                'particulars.*',
                'orders.*',
                'districts.*',
                'orders.id As order_id'
            )
            ->get()
            ->toArray();
    }
    //Particulier commande d'aujourd'hui non assignée, non livrée,
    public function getParticularOrderNotDelivered() 
    {
        $date = date('Y-m-d');
        return DB::table('orders')
            ->where('deliver_id', null)
            ->where('date', $date)
            ->where('status_delivery', false)
            ->join('customers', 'customers.id', 'orders.customer_id')
            ->join('particulars', 'particulars.id', 'customers.particulars_id')
            ->join('districts', 'districts.id', 'orders.district_id')
            ->select(
                'customers.*',
                'particulars.*',
                'orders.*',
                'districts.*',
                'orders.id As order_id'
            )
            ->get()
            ->toArray();
    }

    //Particulier commande d'aujourd'hui non assignée, non livrée,
    public function getParticularOrderAssignedNotDelivered(string $deliverId) 
    {
        $date = date('Y-m-d');
        return DB::table('orders')
            ->where('deliver_id', $deliverId)
            ->where('date', $date)
            ->where('status_delivery', false)
            ->join('customers', 'customers.id', 'orders.customer_id')
            ->join('particulars', 'particulars.id', 'customers.particulars_id')
            ->join('districts', 'districts.id', 'orders.district_id')
            ->join('delivers', 'delivers.id', 'orders.deliver_id')
            ->select(
                'customers.*',
                'orders.*',
                'districts.*',
                'delivers.firstname As prenom',
                'delivers.lastname As nom',
                'orders.id As order_id'
            )
            ->get()
            ->toArray();
    }
    public function getParticularOrderAssignedDelivered(string $deliverId) 
    {
        $date = date('Y-m-d');
        return DB::table('orders')
            ->where('deliver_id', $deliverId)
            ->where('status_delivery', true)
            ->join('customers', 'customers.id', 'orders.customer_id')
            ->join('particulars', 'particulars.id', 'customers.particulars_id')
            ->join('districts', 'districts.id', 'orders.district_id')
            ->join('delivers', 'delivers.id', 'orders.deliver_id')
            ->select(
                'customers.*',
                'particulars.*',
                'orders.*',
                'delivers.firstname As prenom',
                'delivers.lastname As nom',
                'districts.*',
                'orders.id As order_id'
            )
            ->get()
            ->toArray();

    }

    public function deliverOrderDeliveredCount(string $deliverId){
        return DB::table('orders')
            ->where('deliver_id', $deliverId)
            ->where('status_delivery', true)
            ->select('date', DB::raw('count(*) as total'))
            ->orderBy('date', 'desc')
            ->groupBy('date')
            ->get();
    }

    //Commandes du jour non payées

    public function getTodayUnfinishedOrder() {
        return array_merge($this->getCompanyOrderUnfinished(), $this->getParticularOrderUnfinished());
    }
    public function getTodayOrderNotDelivered() {
        $orders = array_merge($this->getParticularOrderNotDelivered(), $this->getCompanyOrderNotDelivered());
        return $orders;
    }
    public function getAllOrderAssignedNotDelivered(string $deliverId) {
        return array_merge($this->getCompanyOrderAssignedNotDelivered($deliverId), $this->getParticularOrderAssignedNotDelivered($deliverId));
    }
    public function getAllOrderAssignedDelivered(string $deliverId) {
        return array_merge($this->getCompanyOrderAssignedDelivered($deliverId), $this->getParticularOrderAssignedDelivered($deliverId));
    }
}