@extends('layouts.app')
@section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">

			</div>

			<div class="title_right">
				<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
					<div class="input-group">

					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>{{$title}} </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#">Settings 1</a>
									</li>
									<li><a href="#">Settings 2</a>
									</li>
								</ul>
							</li>
							<li><a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br />
					</div>
					<div class="container">
						<br />
						<button class="btn btn-success" onclick="add_data()"><i class="glyphicon glyphicon-plus"></i> Tambah {{$title}}</button>
						<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
						<br />
						<br />
						<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
							<tr>
								<th>ID</th>
								<th>nama</th>
								<th style="width:125px;">Action</th>
							</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="form" class="form-horizontal">
					<input type="hidden" value="" name="id"/>
					<div class="form-group">
						<label for="nama">nama</label>
						<input type="text" class="form-control"   name="nama" placeholder="nama" >
						<span class="help-block"></span>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('customjs')
<script type="text/javascript">
	var save_method; //for save method string
	var table;

	$(document).ready(function() {

		//datatables
		table = $('#table').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"headers": {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				},
				"url": "{{ url($mainUrl.'/get_data') }}",
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columnDefs": [
				{
					"targets": [ -1 ], //last column
					"orderable": false, //set not orderable
				},
			],
		});
	});
		//set input/textarea/select event when change value, remove class error and remove text help block
	function add_data()
	{
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#form-control-asal').show();
		$('#form-control-tujuan').show();
		$('#modal_form').modal('show'); // show bootstrap modal
		$('.modal-title').text('Add {{$title}}'); // Set Title to Bootstrap modal title
	}

	function edit_data(id)
	{
		save_method = 'update';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url : "{{ url($mainUrl.'/edit') }}" + "/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$.each(data, function(index, value){
					console.log(index);
					$('[name="'+index+'"]').val(value);
				})
				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit {{$title}}'); // Set title to Bootstrap modal title
			},
			error: function (data)
			{
				console.log(data);
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table()
	{
		table.ajax.reload(null,false); //reload datatable ajax
	}

	function save()
	{
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled',true); //set button disable
		var url;
		var method;

		if(save_method == 'add') {
			url = "{{ url($mainUrl) }}";
			method = "POST";
		} else {
			url = "{{ url($mainUrl) }}";
			method = "PUT";
		}
		
		// e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		// ajax adding data to database
			console.log("{{ url($mainUrl) }}");

		$.ajax({
			url : url,
			type: method,
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status == true) //if success close modal and reload ajax table
				{
					$('#modal_form').modal('hide');
					reload_table();
				}
				else
				{
					console.log(data)
					for(var key in data.inputerror){
						$('[name="'+key+'"]').parent().addClass('has-error');
						$('[name="'+key+'"]').closest('div').find('.help-block').text(data.inputerror[key][0]);
					};
				}
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable
			},
			error: function (data)
			{
				console.log(data);
				alert('Error adding / update data');
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable
			}
		});
	}

	function delete_data(id)
	{
		if(confirm('Are you sure delete this data?'))
		{
			// ajax delete data to database
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
			$.ajax({
				url : "{{ url($mainUrl) }}"+ "/" + id,
				type: "DELETE",
				dataType: "JSON",
				success: function(data)
				{
					//if success reload ajax table
					$('#modal_form').modal('hide');
					reload_table();
				},
				error: function (data)
				{
					console.log(data);
					alert('Error deleting data');
				}
			});

		}
	}

</script>
@endsection