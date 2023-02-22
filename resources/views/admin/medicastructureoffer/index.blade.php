@extends('admin.layouts.master')

@section('content')

@if(((Auth::user()->role_id) == 12) || ((Auth::user()->role_id) == 1))
<p style="margin-top:15px; margin-left:40px">{!! link_to_route(config('quickadmin.route').'.medicastructureoffer.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>
@endif
@if ($medicastructureoffer->count())
<div class="x_panel">
<div class="x_content" style="width:92%; margin-left:50px; overflow: hidden;">
            <table class="table table-striped responsive-utilities jambo_table datatable"  id="datatable">
            <thead style="position: sticky; top: 0; z-index: 999;">
            <tr class="headings">
                    @if(((Auth::user()->role_id) == 12) || ((Auth::user()->role_id) == 1))
                        <th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th>
                    @endif
                        <th>Medical Structure</th>
<th>Offer</th>
<th>Begginning Date</th>
<th>End Date</th>
<th>Activated</th>
@if(((Auth::user()->role_id) == 12) || ((Auth::user()->role_id) == 1))

                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @foreach ($medicastructureoffer as $row)
                        <tr>
                        @if(((Auth::user()->role_id) == 12) || ((Auth::user()->role_id) == 1))

                            <td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td>
                            @endif
                            <td>{!! link_to_route(config('quickadmin.route').'.medicalstructure.edit', $row->medicalstructure->label, array($row->medicalstructure->id), array('style' => 'background-color:  #e6f2ff')) !!}</td>
<td>{!! link_to_route(config('quickadmin.route').'.offertype.edit', $row->offertype->name, array($row->offertype->id), array('style' => 'background-color:  #e6f2ff')) !!}</td>
<td>{{ $row->begginningdate }}</td>
<td>{{ $row->enddate }}</td>
<td>{!! Form::checkbox('activated', 1, $row->activated == 1, array('class'=>'marg5','data-toggle'=>'toggle','disabled ','data-size'=>'mini','data-onstyle'=>'success','data-offstyle'=>'danger')) !!}</td>
@if(((Auth::user()->role_id) == 12) || ((Auth::user()->role_id) == 1))
                            <td style="width:15%">
                                {!! link_to_route(config('quickadmin.route').'.medicastructureoffer.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                <!--{!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.medicastructureoffer.destroy', $row->id))) !!}
                                {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}-->
                                <button class="btn btn-danger btn-xs" onclick="deleteone({!!$row->id!!})" >
                                    delete
                                 </button>
                                 {!! Form::open(['route' => config('quickadmin.route').'.medicastructureoffer.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                                 <input type="hidden" id="send" name="toDelete">
                                 {!! Form::close() !!}
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if(((Auth::user()->role_id) == 12) || ((Auth::user()->role_id) == 1))
            <div class="row">
                <div class="col-xs-12">
                <br>
                    <button class="btn btn-danger" id="delete">
                        {{ trans('quickadmin::templates.templates-view_index-delete_checked') }}
                    </button>
                </div>
            </div>
            {!! Form::open(['route' => config('quickadmin.route').'.medicastructureoffer.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                <input type="hidden" id="send" name="toDelete">
            {!! Form::close() !!}
            @endif
        </div>
	</div>
</div>
@else
    No data yet.
@endif

@endsection

@section('javascript')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>

function deleteone(id) {
           swal({
                title: 'Are you sure?',
                text: 'This record Type and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                if (value) {
                    var toDelete = [];
                    var send = $('#send');
                    toDelete.push(id);
                    send.val(JSON.stringify(toDelete));
                    $('#massDelete').submit();           
                }    
        })
    }
        $(document).ready(function () {
            $('#delete').click(function () {

event.preventDefault();
const url = $(this).attr('href');
swal({
title: 'Are you sure?',
text: 'This record Type and it`s details will be permanantly deleted!',
icon: 'warning',
buttons: ["Cancel", "Yes!"],
}).then(function(value) {
if (value) {

    var send = $('#send');
    var mass = $('.mass').is(":checked");
    if (mass == true) {
        send.val('mass');
    } else {
        var toDelete = [];
        $('.single').each(function () {
            if ($(this).is(":checked")) {
                toDelete.push($(this).data('id'));
            }
        });
        send.val(JSON.stringify(toDelete));
    }
    $('#massDelete').submit();
 
}
});
});
        });
    </script>
@stop