@extends('layout')

@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div style="padding: 10px;">
        <a class="btn btn-success btn-sm" href="javascript:void(0)" id="createNewProduct"> Tambah Product</a>
    </div>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga Modal</th>
                <th>Harga Jual</th>
                <th>Merek</th>
                <th>Satuan</th>
                <th>Kualitas</th>
                <th>Stok</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Nama Produk</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="masukkan nama produk" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="name" class="col-sm-12 control-label">Harga Modal</label>
                            <div class="col-sm-12">
                                <input type="text" min="0" class="form-control" id="capital_price" name="capital_price" placeholder="masukkan modal" value="" maxlength="50" required="" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="name" class="col-sm-12 control-label">Harga Jual</label>
                            <div class="col-sm-12">
                                <input type="text" min="0" class="form-control" id="selling_price" name="selling_price" placeholder="masukkan harga jual" value="" maxlength="50" required="" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="name" class="col-sm-2 control-label">Merek</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="merk" name="merk" placeholder="masukkan merek" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group col-md-4">                            
                            <label for="name" class="col-sm-2 control-label">Stok</label>
                            <div class="col-sm-12">
                                <input type="number" min="0" class="form-control" id="stok" name="stok" placeholder="stok" value="" maxlength="50" required="" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="name" class="col-sm-2 control-label">Kualitas</label>
                            <div class="col-sm-12">
                                <select class="custom-select" name="quality" id="quality" required>
                                    <option value="">Pilih Kulitas </option>
                                    <option value="Asli">Asli</option>
                                    <option value="Palsu">Palsu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="name" class="col-sm-2 control-label">Satuan</label>
                            <div class="col-sm-12">
                                <select class="custom-select" name="unit" id="unit" required>
                                    <option value="">Pilih Satuan </option>
                                    <option value="Unit">Unit</option>
                                    <option value="Lembar">Lembar</option>
                                    <option value="Set">Set</option>
                                    <option value="Liter">Liter</option>
                                    <option value="Buah">Buah</option>
                                </select>

                            </div>
                        </div>
                    </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModelBeli" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="float-left">
                    <h4 class="modal-title" id="modelHeadingBeli"></h4>
                </div>
                <div class="float-left">
                    <table>
                    <tr>
                        <td>Harga</td>
                        <td> : </td>
                        <td>
                            <b id="modelHeadingPrice"></b><br>
                        </td>
                    </tr>    
                    <tr>
                        <td>Merk </td>
                        <td> : </td>
                        <td>
                            <b id="modelHeadingMerk"></b>
                        </td>
                    </tr>       
                    <tr>
                        <td>Stok </td>
                        <td> : </td>
                        <td>
                            <b id="modelHeadingStok"></b>
                        </td>
                    </tr>   
                    </table>                  
                </div>
            </div>
            <div class="modal-body">
                <form id="productFormBeli" name="productFormBeli" class="form-horizontal">
                    <input type="hidden" name="product_id" id="product_id_beli">
                    <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Jumlah</label>
                        <div class="col-sm-12">
                            <input type="number" min="0" class="form-control" id="kurang_stok" name="kurang_stok" placeholder="masukkan jumlah yang ingin dibeli" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="name_beli" name="name" placeholder="masukkan nama produk" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" id="capital_price_beli" name="capital_price" placeholder="masukkan modal" value="" maxlength="50" required="" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" id="selling_price_beli" name="selling_price" placeholder="masukkan harga jual" value="" maxlength="50" required="" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" id="merk_beli" name="merk" placeholder="masukkan merek" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" id="stok_beli" name="stok" placeholder="stok" value="" maxlength="50" required="" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <select class="custom-select" name="quality" id="quality_beli" hidden>
                                    <option value="">Pilih Kulitas </option>
                                    <option value="Asli">Asli</option>
                                    <option value="Palsu">Palsu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <select class="custom-select" name="unit" id="unit_beli" hidden>
                                    <option value="">Pilih Satuan </option>
                                    <option value="Unit">Unit</option>
                                    <option value="Lembar">Lembar</option>
                                    <option value="Set">Set</option>
                                    <option value="Liter">Liter</option>
                                    <option value="Buah">Buah</option>
                                </select>

                            </div>
                        </div>
                    </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtnBeli" value="create">Beli
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.index') }}",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'capital_price',
                    name: 'capital_price'
                },
                {
                    data: 'selling_price',
                    name: 'selling_price'
                },
                {
                    data: 'merk',
                    name: 'merk'
                },
                {
                    data: 'unit',
                    name: 'unit'
                },
                {
                    data: 'quality',
                    name: 'quality'
                },
                {
                    data: 'stok',
                    name: 'stok'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $('#createNewProduct').click(function() {
            $('#saveBtn').val("create-product");
            $('#product_id').val('');
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Tambah Product");
            $('#ajaxModel').modal('show');
        });
        $('body').on('click', '.editProduct', function() {
            var product_id = $(this).data('id');    
            $.get("{{ route('product.index') }}" + '/' + product_id + '/edit', function(data) {
                console.log(data)
                $('#modelHeading').html("Edit Product");
                $('#saveBtn').val("edit-product");
                $('#ajaxModel').modal('show');                
                $('#product_id').val(data.id);
                $('#name').val(data.name);
                $('#capital_price').val(data.capital_price);
                $('#selling_price').val(data.selling_price);
                $('#merk').val(data.merk);
                $('#unit').val(data.unit);
                $('#quality').val(data.quality);
                $('#stok').val(data.stok);
            })
        });
        $('body').on('click', '.beliProduct', function() {
            var product_id = $(this).data('id');
            $.get("{{ route('product.index') }}" + '/' + product_id + '/edit', function(data) {
                $('#modelHeadingMerk').html(data.merk);
                $('#modelHeadingPrice').html(data.selling_price);
                $('#modelHeadingBeli').html(data.name);
                $('#modelHeadingStok').html(data.stok);
                $('#saveBtn').val("beli-product");
                $('#ajaxModelBeli').modal('show');                
                $('#product_id_beli').val(data.id);
                $('#name_beli').val(data.name);
                $('#capital_price_beli').val(data.capital_price);
                $('#selling_price_beli').val(data.selling_price);
                $('#merk_beli').val(data.merk);
                $('#unit_beli').val(data.unit);
                $('#quality_beli').val(data.quality);
                $('#stok_beli').val(data.stok);
            })
        });
        $('#saveBtn').click(function(e) {            
            e.preventDefault();            
            $(this).html('Save');

            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('product.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    
                    $('#productForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();

                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });
        $('#saveBtnBeli').click(function(e) {     
            console.log(e.preventDefault())       
            e.preventDefault();            
            $(this).html('Beli');

            $.ajax({
                data: $('#productFormBeli').serialize(),
                url: "{{ route('product.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    $('#productFormBeli').trigger("reset");
                    $('#ajaxModelBeli').modal('hide');
                    table.draw();

                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Beli');
                }
            });
        });

        $('body').on('click', '.deleteProduct', function() {

            var product_id = $(this).data("id");
            confirm("Are You sure want to delete !");

            $.ajax({
                type: "DELETE",
                url: "{{ route('product.store') }}" + '/' + product_id,
                success: function(data) {
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });

    });
</script>
<script type="text/javascript">
		var capitalPrice = document.getElementById('capital_price');
		capitalPrice.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			capitalPrice.value = formatRupiah(this.value,'Rp.');
		});

        var sellingPrice = document.getElementById('selling_price');
        sellingPrice.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            sellingPrice.value = formatRupiah(this.value,'Rp.');
        });

		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp.' +rupiah : '');
		}   
	</script>
@endsection