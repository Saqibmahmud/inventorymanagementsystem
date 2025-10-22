  @foreach ($suppliers as $d )
        <tr>
        <td>{{$d['supplier_name']}}</td>
        <td>{{$d['contact_name']}}</td>
          <td>{{$d['email']}}</td>
        <td>{{$d['phone']}}</td>
        <td>{{$d['address']}}</td>
        <td>{{$d['created_at']}}</td>
        <td>{{$d['updated_at']}}</td>
        <td>
        <a href="{{route('customers.edit',['customer'=>$d['id']])}}"class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" onclick="deleteCustomer({{$d['id']}},'{{$d['customer_name']}}',this)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
        </td>

        </tr>
        @endforeach