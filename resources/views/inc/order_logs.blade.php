<div class="card">

    <div class="card-body">

        <ul class="nav nav-tabs" data-toggle="tabs" role="tablist">

            <li class="nav-item">
                <a class="nav-link active" href="#order_history">Order History</a>
            </li>

        </ul>
        <div class="card-body tab-content">

            <div class="tab-pane active" id="order_history" role="tabpanel">
                @if(count($order->logs) > 0)
                    <div class="">
                        <div class="">
                            @foreach($order->logs as $log)
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
                                                <h4 class="card-title @if($loop->last) text-primary @else text-muted @endif">{{$log->status}}</h4>
                                                <p class="card-text">{{$log->message}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                @else
                    <p class="m-0 p-2 text-center"> No Order Logs Found </p>
                @endif
            </div>

        </div>


    </div>
</div>
