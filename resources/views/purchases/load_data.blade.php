  @foreach ($purchases as $d )
 
        <tr>
        <td>{{$d->supplier->supplier_name}}</td>
        <td>{{$d->purchase_date}}</td>
          <td>{{$d->total_amount}}</td>
        <td>{{$d->status}}</td>
        <td>{{$d->user->name}}</td>
        <td>{{$d->updated_user->name?? ''}}</td>
          <td>{{$d->paid_with}}</td>
        <td>{{$d->created_at->format('Y-m-d')}}</td>
        <td>{{$d->updated_at->format('Y-m-d')}}</td>
        <td>
        <a href="{{route('purchases.edit',['purchase'=>$d->id])}}"class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
        
        <a href="{{route('purchases.show',['purchase'=>$d->id])}}"class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

        </td>

        </tr>
        @endforeach

        