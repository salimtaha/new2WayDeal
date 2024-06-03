<?php

namespace App\Http\Controllers\Admin\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function detail($id)
    {
        $order = Order::with('orderDetails')->findOrFail($id);
        return view('admin.pages.users.orders.detail' , compact('order'));
    }
    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $user_id = $order->user->id;

        try{
            if($order->status == "completed"){
                $order->delete();
                session()->flash('success' , 'تم حذف الطلب بنجاح');
                return redirect()->route('admin.users.show' ,$user_id);
            }else{
                session()->flash('failed' , 'لا يمكن حذف الاوردر الا بعد التسليم');
                return redirect()->back();
            }


        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
}
