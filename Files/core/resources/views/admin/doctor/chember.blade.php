@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Location')</th>
                                    <th>@lang('Visiting Hour')</th>
                                    <th>@lang('Appoinment - Email')</th>
                                    <th>@lang('Last Update')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($chembers as $chember)
                                    <tr>
                                        <td data-label="@lang('Name')">{{__($chember->name)}}</td>
                                        <td data-label="@lang('Location')">{{__($chember->location->name)}} - {{__($chember->location->city->name)}}</td>
                                        <td data-label="@lang('Visiting Hour')">{{__($chember->start_time)}} - {{__($chember->end_time)}}</td>
                                        <td data-label="@lang('Appoinment -Email')">
                                            <span>{{__($chember->appoinment)}}</span><br>
                                            <span>{{__($chember->email)}}</span>
                                        </td>
                                        <td data-label="@lang('Last Update')">
                                            {{ showDateTime($chember->updated_at) }}<br> {{ diffForHumans($chember->updated_at) }}
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <a href="javascript:void(0)" class="icon-btn btn--primary ml-1 updateChember"
                                                data-id="{{$chember->id}}"
                                                data-name="{{$chember->name}}"
                                                data-email="{{$chember->email}}"
                                                data-appoinment="{{$chember->appoinment}}"
                                                data-location_id="{{$chember->location_id}}"
                                                data-start_time="{{$chember->start_time}}"
                                                data-end_time="{{$chember->end_time}}"
                                            ><i class="las la-pen"></i></a>
                                            <a href="javascript:void(0)" class="icon-btn btn--danger ml-1 deleteChember" data-id="{{$chember->id}}"><i class="las la-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{__($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($chembers) }}
                </div>
            </div>
        </div>
    </div>


    <div id="departmentModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add Chember')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.doctor.chember.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="doctor" value="{{$doctorId}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Name')</label>
                            <input type="text" class="form-control form-control-lg" name="name" placeholder="@lang("Chember Name")"  maxlength="255" required="">
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Select Location')</label>
                            <select class="form-control form-control-lg" name="location">
                                <option value="" disabled="" selected="">@lang('Select One')</option>
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}">{{__($location->name)}} - {{__($location->city->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name" class="font-weight-bold">@lang('Start Time')</label>
                            <input type="text" id="timePicker" name="start_time" class="form-control form-control-lg" placeholder="@lang('Start Time')" required="">
                        </div>
                         
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">@lang('End Time')</label>
                            <input type="text" id="endTimePicker" name="end_time" placeholder="@lang('End Time')"  class="form-control form-control-lg" required="">
                        </div>


                        <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Email')</label>
                            <input type="Email" class="form-control form-control-lg" name="email" placeholder="@lang("Chember Email")"  maxlength="60" required="">
                        </div>

                         <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Appoinment')</label>
                            <input type="text" class="form-control form-control-lg" name="appoinment" placeholder="@lang("Appoinment Number")"  maxlength="60" required="">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Create')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="updateDepartmentModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Update Chember')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.doctor.chember.update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <input type="hidden" name="doctor" value="{{$doctorId}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Name')</label>
                            <input type="text" class="form-control form-control-lg" name="name" placeholder="@lang("Chember Name")"  maxlength="255" required="">
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Select Location')</label>
                            <select class="form-control form-control-lg" name="location">
                                <option value="" disabled="" selected="">@lang('Select One')</option>
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}">{{__($location->name)}} - {{__($location->city->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name" class="font-weight-bold">@lang('Start Time')</label>
                            <input type="text" id="timePickerUpdate" name="start_time" class="form-control form-control-lg" placeholder="@lang('Start Time')" required="">
                        </div>
                         
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">@lang('End Time')</label>
                            <input type="text" id="endTimePickerUpdate" name="end_time" placeholder="@lang('End Time')"  class="form-control form-control-lg" required="">
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Email')</label>
                            <input type="Email" class="form-control form-control-lg" name="email" placeholder="@lang("Chember Email")"  maxlength="60" required="">
                        </div>

                         <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Appoinment')</label>
                            <input type="text" class="form-control form-control-lg" name="appoinment" placeholder="@lang("Appoinment Number")"  maxlength="60" required="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="deleteChemberModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Delete Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.doctor.chember.delete')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to remove this chember')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success"><i class="fa fa-fw fa-paper-plane"></i>@lang('Delete')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="javascript:void(0)" class="btn btn-sm btn--primary box--shadow1 text--small addChember" ><i class="fa fa-fw fa-paper-plane"></i>@lang('Add Chember')</a>
@endpush

@push('script-lib')
    <script src="{{asset('assets/admin/js/vendor/jquery-timepicky.js')}}"></script>
@endpush

@push('script')
    <script>
        "use strict";
        $("#timePicker").timePicky();
        $("#endTimePicker").timePicky();
        $("#timePickerUpdate").timePicky();
        $("#endTimePickerUpdate").timePicky();


        $('.addChember').on('click', function() {
            $('#departmentModel').modal('show');
        });

         $('.deleteChember').on('click', function() {
            var modal = $('#deleteChemberModel');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.modal('show');
        });

        $('.updateChember').on('click', function() {
            var modal = $('#updateDepartmentModel');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('input[name=name]').val($(this).data('name'));
            modal.find('input[name=email]').val($(this).data('email'));
            modal.find('input[name=appoinment]').val($(this).data('appoinment'));
            modal.find('select[name=location]').val($(this).data('location_id'));
            modal.find('input[name=start_time]').val($(this).data('start_time'));
            modal.find('input[name=end_time]').val($(this).data('end_time'));
            modal.modal('show');
        });

    </script>
@endpush
