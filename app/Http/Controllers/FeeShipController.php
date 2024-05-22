<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\FeeShip;
use App\Models\Province;
use App\Models\Wards;

use Illuminate\Http\Request;

class FeeShipController extends Controller
{
    public function AuthLogin(){
        $admin_id = session()->get('admin_id');
        if($admin_id){
            return redirect('/admin/home');
        }
        else{
            return redirect('/admin/login')->send();
        }
    }
    public function index(Request $request){
        $this->AuthLogin();
        $city = City::orderBy('matp','ASC')->get();

        return view('BackEnd.delivery.manageFeeShip')->with(compact('city'));
    }

    public function select_feeship( Request $request){
        // Lấy dữ liệu từ yêu cầu
        $data = $request->all();
        $output = '';
    
        // Kiểm tra xem action và ma_id có được đặt trong dữ liệu yêu cầu không
        if(isset($data['action']) && isset($data['ma_id'])){
            // Xử lý dựa trên action
            if($data['action'] == 'city'){
                // Nếu action là 'city', lấy danh sách tỉnh/thành phố dựa trên ID tỉnh/thành phố được cung cấp
                $select_province = Province::where('matp', $data['ma_id'])->orderBy('maqh','ASC')->get();
                $output .= '<option value="">--Chọn quận/huyện--</option>'; // Thiết lập lại dropdown
                foreach($select_province as $province) {
                    $output .= '<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }
            } else {
                // Nếu action không phải là 'city', giả sử nó là 'province' và lấy danh sách xã/phường dựa trên ID quận/huyện được cung cấp
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderBy('xaid','ASC')->get();
                $output .= '<option value="">--Chọn thị trấn/xã phường--</option>'; // Thiết lập lại dropdown
                foreach($select_wards as $wards) {
                    $output .= '<option value="'.$wards->xaid.'">'.$wards->name_xaphuongthitran.'</option>';
                }
            }
        } else {
            // Nếu action hoặc ma_id bị thiếu, trả về một option trống
            $output .= '<option value="">--Không có dữ liệu--</option>';
        }
        
        // Trả về dữ liệu đã xử lý
        return $output;
    }

    public function insert(Request $request){
        // $data = $request->all();
        // $fee_feeship = new FeeShip();
        // $fee_feeship->fee_matp = $data['city'];
        // $fee_feeship->fee_maqh = $data['province'];
        // $fee_feeship->fee_xaid = $data['wards'];
        // $fee_feeship->fee_feeship = $data['fee_feeship'];
        // $fee_feeship->save();
        $data = $request->all();

        // Tạo một đối tượng FeeShip mới và lưu vào cơ sở dữ liệu
        $fee_feeship = new FeeShip();
        $fee_feeship->fee_matp = $data['city'];
        $fee_feeship->fee_maqh = $data['province'];
        $fee_feeship->fee_xaid = $data['wards'];
        $fee_feeship->fee_feeship = $data['fee_feeship'];
        $fee_feeship->save();

        return response()->json(['success' => true, 'message' => 'Thêm phí vận chuyển thành công']);
    }

    public function manage(Request $request){
        $this->AuthLogin();
        $feeship = FeeShip::orderBy('fee_id','DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên thành phố</th>
                                    <th>Tên quận huyện</th>
                                    <th>Tên xã phường</th>
                                    <th>Phí Ship</th>
                                </tr>
                            </thead>
                            <tbody>';
    
        foreach($feeship as $key=>$fee){
            $output .= '<tr>
                            <td>'.$fee->city->name_city.'</td>
                            <td>'.$fee->province->name_quanhuyen.'</td>
                            <td>'.$fee->wards->name_xaphuongthitran.'</td>
                            <td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">
                                '.number_format($fee->fee_feeship,0,',','.').'
                            </td>
                        </tr>';
        }
        $output .= '</tbody>
                    </table>
                </div>';
        
        echo $output;
    }

    public function update(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $fee_feeship = FeeShip::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'],'.');
        $fee_feeship->fee_feeship = $fee_value;
        $fee_feeship->save();
    }
}
