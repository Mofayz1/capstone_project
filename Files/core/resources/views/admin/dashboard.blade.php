@extends('admin.layouts.app')
@section('panel')
  @if(@json_decode($general->sys_version)->version > systemDetails()['version'])
    <div class="row">
        <div class="col-md-12">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">
                    <h3 class="card-title"> @lang('New Version Available') <button class="btn btn--dark float-right">@lang('Version') {{json_decode($general->sys_version)->version}}</button> </h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-dark">@lang('What is the Update ?')</h5>
                    <p><pre  class="f-size--24">{{json_decode($general->sys_version)->details}}</pre></p>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(@json_decode($general->sys_version)->message)
    <div class="row">
        @foreach(json_decode($general->sys_version)->message as $msg)
          <div class="col-md-12">
              <div class="alert border border--primary" role="alert">
                  <div class="alert__icon bg--primary"><i class="far fa-bell"></i></div>
                  <p class="alert__message">@php echo $msg; @endphp</p>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
          </div>
        @endforeach
    </div>
    @endif

<div class="row mt-50 mb-none-30">
    <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--10 b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-shopping-bag"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{ $doctor['all'] }}</span>
                </div>
                <div class="desciption">
                    <span>@lang('Total Doctor')</span>
                </div>
                <a href="{{ route('admin.doctor.index') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--18 b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{ $doctor['pending']  }}</span>
                </div>
                <div class="desciption">
                    <span>@lang('Total Pending Doctor')</span>
                </div>

                <a href="{{ route('admin.doctor.pending') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
            <div class="icon">
                <i class="lab la-servicestack"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{ $doctor['approved'] }}</span>
                </div>
                <div class="desciption">
                    <span>@lang('Total Approved Doctor')</span>
                </div>

                <a href="{{route('admin.doctor.approved')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--14 b-radius--10 box-shadow">
            <div class="icon">
                <i class="fa fa-spinner"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{ $doctor['banned'] }}</span>
                </div>
                <div class="desciption">
                    <span>@lang('Total Banned Doctor')</span>
                </div>

                <a href="{{ route('admin.doctor.banned') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--19 b-radius--10 box-shadow" >
            <div class="icon">
               <i class="las la-user-nurse"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{__($city)}}</span>
                </div>
                <div class="desciption">
                    <span>@lang('Total City')</span>
                </div>
                <a href="{{route('admin.city.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--3 b-radius--10 box-shadow" >
            <div class="icon">
               <i class="las la-window-minimize"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{__($department)}}</span>
                </div>
                <div class="desciption">
                    <span>@lang('Total Department')</span>
                </div>
                <a href="{{route('admin.department.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--12 b-radius--10 box-shadow" >
            <div class="icon">
               <i class="lab la-adversal"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{__($ads)}}</span>
                </div>
                <div class="desciption">
                    <span>@lang('Total Advertisement')</span>
                </div>

                <a href="{{route('admin.ads.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--6 b-radius--10 box-shadow">
            <div class="icon">
                <i class="fa fa-spinner"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{__($subscribers)}}</span>
                </div>
                <div class="desciption">
                    <span>@lang('Total Subscribers')</span>
                </div>
                <a href="{{ route('admin.subscriber.index') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div>

</div>

<div class="row mt-50 mb-none-30">
    <div class="col-lg-12 mb-30">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('Name - Designation')</th>
                                <th>@lang('Appoinment - Visiting Hour')</th>
                                <th>@lang('Currently work - Department')</th>
                                <th>@lang('Featured Doctor')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($doctors as $doctor)
                            <tr>
                                <td data-label="@lang('Name - Designation')">
                                    <span>{{__($doctor->name)}}</span><br>
                                    <span>{{__($doctor->designation)}}</span>
                                </td>
                                
                                <td data-label="@lang('Appoinment - Visiting Hour')">
                                    <span>{{__($doctor->appoinment)}}</span><br>
                                    <span>{{$doctor->start_time}} - {{$doctor->end_time}}</span>
                                </td>
                                
                                <td data-label="@lang('Currently work - Department')">
                                    <span>{{__($doctor->present_work)}}</span><br>
                                    <span>{{__($doctor->department->name)}}</span>
                                </td>

                                <td data-label="@lang('Featured Doctor')">
                                    @if($doctor->featured == 1)
                                        <span class="badge badge--success">@lang('Included')</span>
                                        <a href="javascript:void(0)" class="icon-btn btn--info ml-2 notInclude" data-toggle="tooltip" title="" data-original-title="@lang('Not Include')" data-id="{{ $doctor->id }}">
                                            <i class="las la-arrow-alt-circle-left"></i>
                                        </a>
                                    @else
                                        <span class="badge badge--warning">@lang('Not included')</span>
                                        <a href="javascript:void(0)" class="icon-btn btn--success ml-2 include text-white" data-toggle="tooltip" title="" data-original-title="@lang('Include')" data-id="{{ $doctor->id }}">
                                            <i class="las la-arrow-alt-circle-right"></i>
                                        </a>
                                    @endif
                                </td>

                                <td data-label="@lang('Status')">
                                    @if($doctor->status == 1)
                                        <span class="badge badge--success">@lang('Active')</span>
                                    @elseif($doctor->status == 2)
                                        <span class="badge badge--danger">@lang('Banned')</span>
                                    @else
                                        <span class="badge badge--primary">@lang('Pending')</span>
                                    @endif
                                </td>

                                <td data-label="@lang('Action')">
                                    @if($doctor->status == 2)
                                        <a href="javascript:void(0)" class="icon-btn btn--success ml-1 approved" data-toggle="tooltip" data-original-title="@lang('Approve')" data-id="{{$doctor->id}}"><i class="las la-check"></i></a> 
                                    @elseif($doctor->status == 1)
                                        <a href="javascript:void(0)" class="icon-btn btn--danger ml-1 cancel" data-toggle="tooltip" data-original-title="@lang('Banned')" data-id="{{$doctor->id}}"><i class="las la-times"></i></a> 
                                    @elseif($doctor->status == 0)
                                        <a href="javascript:void(0)" class="icon-btn btn--success ml-1 approved" data-toggle="tooltip" data-original-title="@lang('Approve')" data-id="{{$doctor->id}}"><i class="las la-check"></i></a> 
                                        <a href="javascript:void(0)" class="icon-btn btn--danger ml-1 cancel" data-toggle="tooltip" data-original-title="@lang('Banned')" data-id="{{$doctor->id}}"><i class="las la-times"></i></a> 
                                    @endif
                                    <a href="{{route('admin.doctor.chember.list', $doctor->id)}}" class="icon-btn btn--info ml-1" data-toggle="tooltip" data-original-title="@lang('Chember List')"
                                    ><i class="las la-list"></i></a> 
                                    <a href="{{route('admin.doctor.edit', $doctor->id)}}" class="icon-btn btn--primary ml-1" data-toggle="tooltip" data-original-title="@lang('Edit')"
                                    ><i class="las la-pen"></i></a> 
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">@lang('Data not found')</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="approvedby" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Approval Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            
            <form action="{{route('admin.doctor.approvedBy')}}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to approved this doctor?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="cancelBy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Cancel Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            
            <form action="{{ route('admin.doctor.cancelBy') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to banned this doctor?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="includeFeatured" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Featured Item Include')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{ route('admin.doctor.featured.include') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure include this doctor featured list?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="NotincludeFeatured" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Featured Item Remove')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{ route('admin.doctor.featured.remove') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure remove this doctor featured list?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection




@push('script')
<script>
    'use strict';
    $('.approved').on('click', function () {
        var modal = $('#approvedby');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });
    $('.cancel').on('click', function () {
        var modal = $('#cancelBy');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });

    $('.include').on('click', function () {
        var modal = $('#includeFeatured');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });

    $('.notInclude').on('click', function () {
        var modal = $('#NotincludeFeatured');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });
</script>
@endpush

