@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Finance</span>
        </div>

    </div>

    <div class="row mb-3">
        <div class="card-deck flex-column flex-lg-row col-12">
            <div class="card radius-15 bg-info">
                <div class="card-body text-center">
                    <div class="widgets-icons mx-auto rounded-circle bg-white"><i class="bx bx-time"></i>
                    </div>
                    <h4 class="mb-0 font-weight-bold mt-3 text-white">{{ \App\Helpers\AppHelper::currency() }} {{number_format($total_pending,2)}}</h4>
                    <p class="mb-0 text-white">Pending Payment</p>
                </div>
            </div>
            <div class="card radius-15 bg-wall">
                <div class="card-body text-center">
                    <div class="widgets-icons mx-auto bg-white rounded-circle"><i class="bx bx-bookmark-alt"></i>
                    </div>
                    <h4 class="mb-0 font-weight-bold mt-3 text-white">{{ \App\Helpers\AppHelper::currency() }} {{number_format($total_product_cost,2)}}</h4>
                    <p class="mb-0 text-white">Total Products Cost</p>
                </div>
            </div>
            <div class="card radius-15 bg-rose">
                <div class="card-body text-center">
                    <div class="widgets-icons mx-auto bg-white rounded-circle"><i class="bx bx-bulb"></i>
                    </div>
                    <h4 class="mb-0 font-weight-bold mt-3 text-white">{{ \App\Helpers\AppHelper::currency() }} {{number_format($total_shipping_cost,2)}}</h4>
                    <p class="mb-0 text-white">Total Shipping Cost</p>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.flash_message')
    <form action="">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="search" value="{{$search}}" name="search" placeholder="Search by Order ID Or Supplier Name"
                           class="form-control h-100">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" >Search</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">
            <div class="card radius-15">
                {{--                    <div class="card-header bulk-div" style="display: none">--}}
                {{--                        <div class="btn-group">--}}
                {{--                            <button class="btn btn-outline-secondary btn-sm bulk-wallet-btn">Pay in Bulk</button>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                <div class="card-body table-responsive">
                    @if (count($finances) > 0)

                        <table class="table table-hover table-borderless">
                            <thead class="border-bottom">
                            <tr>
                                <th>Supplier Name</th>
                                <th>Order#</th>
                                <th>Total Products</th>
                                <th>Cost of Products</th>
                                <th>Shipping Cost</th>
                                <th>Total Cost</th>
{{--                                <th>Earning</th>--}}
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="">
                            @foreach($finances as $index => $finance)

                                <tr  class="mb-0 collapsed" data-toggle="collapse" data-target="#accordion-tab-{{$loop->index}}" aria-expanded="false" aria-controls="accordion-tab-1-content-3">
                                    <td>
                                        {{$finance->supplier->name}}
                                    </td>
                                    <td>
                                        {{$finance->order->admin_shopify_name }}
                                    </td>
                                    <td>
                                        {{ $finance->no_products  }}
                                    </td>
                                    <td>
                                       {{ \App\Helpers\AppHelper::currency() }} {{number_format($finance->cost_products,2) }}
                                    </td>
                                    <td>
                                       {{ \App\Helpers\AppHelper::currency() }} {{number_format($finance->cost_shipping,2) }}
                                    </td>
                                    <td>{{ \App\Helpers\AppHelper::currency() }} {{ number_format($finance->cost_products+$finance->cost_shipping,2)  }}</td>
{{--                                    <td></td>--}}
                                    <td>
                                        @if($finance->is_paid == '0')
                                            <span class="badge badge-warning text-white"> Pending </span>
                                        @elseif($finance->is_paid == '1')
                                            <span class="badge badge-success"> Paid </span>
                                        @elseif($finance->is_paid == '2')
                                            <span class="badge badge-danger"> Refused</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($finance->is_paid == '0')
                                        <a href="{{route('admin.finance.pay',$finance->id)}}" class="btn btn-success">Pay Now</a>
                                        @else
                                        <button class="btn btn-success" disabled>Paid</button>
                                        @endif
                                    </td>


                                </tr>
                                <tr  class="collapse" id="accordion-tab-{{$loop->index}}" aria-labelledby="accordion-tab-1-heading-3" data-parent="#accordion-tab-1" style="" style="background-color: rgba(0, 0, 0, 0.075);">

                                   <td colspan="9">
                                       @if(count($finance->logs) > 0)
                                           <div class="col-9">
                                               <div class="">
                                                   @foreach($finance->logs as $log)
                                                       <div class="row">
                                                       @if($loop->index == 0)
                                                           <!-- timeline item 1 left dot -->
                                                               <div class="col-auto text-center flex-column d-none d-sm-flex">
                                                                   <div class="row h-50">
                                                                       <div class="col">&nbsp;</div>
                                                                       <div class="col">&nbsp;</div>
                                                                   </div>
                                                                   <h5 class="m-2">
                                                                       <span class="badge badge-pill bg-light border">&nbsp;</span>
                                                                   </h5>
                                                                   @if(!$loop->last)
                                                                       <div class="row h-50">
                                                                           <div class="col border-right">&nbsp;</div>
                                                                           <div class="col">&nbsp;</div>
                                                                       </div>
                                                                   @endif
                                                               </div>
                                                               <!-- timeline item 1 event content -->
                                                           @elseif($loop->last)

                                                               <div class="col-auto text-center flex-column d-none d-sm-flex">
                                                                   <div class="row h-50">
                                                                       <div class="col border-right">&nbsp;</div>
                                                                       <div class="col">&nbsp;</div>
                                                                   </div>
                                                                   <h5 class="m-2">
                                                                       <span class="badge badge-pill bg-primary">&nbsp;</span>
                                                                   </h5>
                                                                   <div class="row h-50">
                                                                       <div class="col">&nbsp;</div>
                                                                       <div class="col">&nbsp;</div>
                                                                   </div>
                                                               </div>

                                                           @else
                                                               <div class="col-auto text-center flex-column d-none d-sm-flex">
                                                                   <div class="row h-50">
                                                                       <div class="col border-right">&nbsp;</div>
                                                                       <div class="col">&nbsp;</div>
                                                                   </div>
                                                                   <h5 class="m-2">
                                                                       <span class="badge badge-pill bg-light border">&nbsp;</span>
                                                                   </h5>
                                                                   <div class="row h-50">
                                                                       <div class="col border-right">&nbsp;</div>
                                                                       <div class="col">&nbsp;</div>
                                                                   </div>
                                                               </div>
                                                           @endif
                                                           <div class="col py-2">
                                                               <div class="card @if($loop->last) border-primary shadow @endif radius-15">
                                                                   <div class="card-body">
                                                                       <div class="float-right @if($loop->last) text-primary @else text-muted @endif">{{date_create($log->created_at)->format('d M, Y h:i a')}}</div>
                                                                       <h4 class="card-title @if($loop->last) text-primary @else text-muted @endif">{{$log->title}}</h4>
                                                                       <p class="card-text">{{$log->description}}</p>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </div>

                                                   @endforeach

                                               </div>
                                           </div>
                                       @endif
                                   </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-12 text-center" style="font-size: 17px">
                                {!! $finances->appends(request()->input())->links("pagination::bootstrap-4") !!}
                            </div>
                        </div>
                    @else
                        <p>No Record Found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
