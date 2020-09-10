
    <div style="border: 1px dotted forestgreen;">
        <h3 align="center">Thông tin khách hàng</h3>
        Họ tên:{{ $data['name'] }} <br>
        Sđt:{{ $data['phone'] }} <br>
        email: {{ $data['email'] }} <br>
        địa chỉ : {{ $data['address'] }}
    </div>
    <table style="width: 100%;" >
        <thead style="background-color: cornflowerblue;">
            <tr>
                <th>Mã Sản phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['show-order']->order as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}:
                    @foreach ($row->attr as $value)
                    {{ $value->name }}:{{ $value->value }}
                    @endforeach
                    </td>
                    <td>{{ $row->quantity }}</td>
                    <td>{{ number_format($row->price,0,'','.') }} đ</td>
                    <td>{{ number_format($row->quantity*$row->price,0,'','.') }} đ</td>
                </tr>
            @endforeach
            
            
    
            <tr style="font-size: 30px; font-weight: bold; color: red;">
                <td >Tổng tiền</td>
                <td  colspan="4" align="right">{{ $data['total'] }} VNĐ</td>
            </tr>
          
        </tbody>
    </table>
    <p align="center" style="font-weight: bold;">Cảm ơn bạn đã mua hàng của chúng tôi</p>
    



