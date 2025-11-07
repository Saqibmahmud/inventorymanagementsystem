@foreach ($sales as $sale)
    <tr>
        <td>{{$sale->id}}</td>
 <td>{{$sale->creation_date}}</td>
    <td>{{$sale->total_amount}}</td>
     <td>{{$sale->due_amount}}</td>
      <td>{{$sale->status}}</td>
       <td>{{$sale->user->name}}</td>
        <td>{{$sale->updating_user->name}}</td>
         <td>{{$sale->paid_with}}</td>
         <td>{{$d->created_at->format('Y-m-d')}}</td>
        <td>{{$d->updated_at->format('Y-m-d')}}</td>
        <td>
        <a href="{{route('sales.edit',['sale'=>$sale->id])}}"class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
        <a href="{{route('sales.show',['sale'=>$sale->id])}}"class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

        </td>


    </tr>
@endforeach