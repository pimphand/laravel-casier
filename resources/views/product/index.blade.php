@extends('layouts.app')

@section('page-header')
@include('components.admin.page-header', [
'title_page' => 'Produk',
'breadcrumb' => [
[
    'label' => 'Pengguna',
    'url' => route('dashboard'),
    'icon' => 'pe-7s-home',
],
[
'label' => 'Produk',
'url' => "#",
'icon' => 'pe-7s-users',
'active' => true,
],
],
])
@endsection

@section('content')
@php
$url = route('products.index');
@endphp
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h5>Data Produk</h5>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">
                        <a href="javascript:void(0)" class="btn btn-primary" id="btn-add"><i class="fa fa-plus"></i>
                            Tambah
                            Produk</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-block row">
            <div class="col-sm-12 col-lg-12 col-xl-12">
                <div class="table-responsive">
                    <table class="table table-styling">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok & Variasi</th>
                                <th scope="col"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody id="pengguna">

                        </tbody>
                    </table>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="text-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center pagination-primary" id="pagination">
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form method="post" id="form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Kategori</label>
                                <select class="js-example-placeholder-multiple col-sm-6" style="width: 100%;"
                                    id="category" name="category_id" type="text" placeholder="kategori">
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name">Nama Produk</label>
                                <input class="form-control js-example-placeholder-multiple" id="name" name="name"
                                    type="text" placeholder="nama produk" required="">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" type="text"
                                    placeholder="kategori" required=""></textarea>
                            </div>
                        </div>

                        {{-- variasi --}}
                        <div class="form-row" id="original-row">
                            <div class="col-md-6 mb-3">
                                <label for="price">price</label>
                                <input class="form-control" id="price" name="price[]" type="text" placeholder="harga"
                                    required="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stock">stock</label>
                                <input class="form-control" id="stock" name="stock[]" type="text" placeholder="stock"
                                    required="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="image">image</label>
                                <input class="form-control" id="image" name="image[]" type="file" placeholder="gambar"
                                    required="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <button class="btn btn-primary mt-4" type="button" id="add-variation">Tambah
                                    Variasi</button>
                            </div>
                        </div>
                        <div id="variation-container"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" data-type="post" type="button" id="save">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/select2.css">
@endpush

@push('js')
<script src="{{ asset('assets') }}/js/select2/select2.full.min.js"></script>
<script>
    $(document).ready(function () {
        var i = 1; // Initialize i as a counter variable

        $('#add-variation').on('click', function () {
            var clone = $('#original-row').clone();
            clone.removeAttr('id'); // Remove the ID to avoid duplicates
            clone.find('#add-variation')
                .text('Hapus Variasi') // Change button text
                .attr('id', 'original-row-' + i) // Change button ID
                .attr('data-id', i) // Change button ID
                .removeClass('btn-primary') // Remove primary class
                .addClass('btn-danger remove-variation'); // Add danger class

                // Change the event handler for the newly cloned button
                clone.find('.remove-variation').on('click', function () {
                $(this).closest('.form-row').remove();
            });

            $('#variation-container').append(clone);
            i++;
        });

            // Handle removing variations
        $('#variation-container').on('click', '.remove-variation', function () {
            $(this).closest('.form-row').fadeOut(3000, function () {
                $(this).remove();
            });
        });

        let uuid = ""
        let type = ""
        $('#btn-add').click(function (e) {
            e.preventDefault();
            $('#modal-form').modal('show');
            type = "post";
        });

        // Function to load data for a given page
        $('#category').select2({
            ajax: {
                url: '{{ route("categories.index") }}',
                dataType: 'json',
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                data: function (params) {
                    return {
                        search: params.term, // Add the search term as a parameter
                        page: params.page
                    };
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data.data.map(function (item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    };
                },
                cache: true
            },
            placeholder: 'Search...',
        });

        function loadPage(page) {
            const url = "{{ $url }}";
            const paginationElement = $('#pagination');
            const dataElement = $('#pengguna');

            $.ajax({
                type: "get",
                url: "{{ $url }}",
                data: { page: page },
                success: function (response) {
                    let data = response.data;
                    let html = '';

                    if (response.data.length > 0) {
                        data.forEach((item, index) => {
                            let priceRange = determinePriceRange(item);
                            html += `
                                <tr>
                                    <th scope="row">${index + 1}</th>
                                    <td>${item.name}</td>
                                    <td>${item.category.name}</td>
                                    <td>Rp. ${item.minPrice} - Rp. ${item.maxPrice}</td>
                                    <td>
                                        Varian : ${item.skus.length} <br>
                                        Stok : ${item.skus.reduce((acc, curr) => acc + curr.stock, 0)}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-warning btn-sm btn-edit" data-name="${item.name}" data-id="${item.id}"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('users.index') }}/${item.id}" class="btn btn-danger btn-sm" data-method="delete" data-confirm="Are you sure?"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            `;
                        });

                         // Update the HTML for pagination
                        let paginationHtml = generatePaginationHtml(response);

                        // Set HTML pagination to the element with id 'pagination'
                        paginationElement.html(paginationHtml);

                        $('#pengguna').html(html);
                    }else{
                        html += `<tr>
                                    <td colspan="6" class="text-center">Data tidak ditemukan</td>
                                </tr>`;
                        $('#pengguna').html(html);
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        function determinePriceRange(item) {
        // Implement logic to determine price range based on your data structure
        // For example, if there is a property called price_range in the item object
            return item.price_range || 'N/A';
        }
        $('#pengguna').on('click','.btn-edit', function () {
            //get data form pengguna
            let id = $(this).data('id');
            uuid = id;
            console.log(uuid);
            $('.modal-title').text('Edit Pengguna');
            $('#modal-form').modal('show');
            $('#name').val($(this).data('name'));
            type = "put";
        });

        // Event delegation for handling pagination clicks
        $('#pagination').on('click', '.page-link', function (event) {
            event.preventDefault();
            let page = $(this).data('page');
            let searchTerm = $('#searchInput').val();
            loadData(page, searchTerm);
        });

        // Event listener for handling search input
        $('#searchInput').on('keyup', function (event) {
            if (event.keyCode === 13) {
                let searchTerm = $(this).val();
                loadData(1, searchTerm);
            }
        });

        loadPage(1);

        $('#save').on('click', function () {
            var form = $('#form')[0];
            var formData = new FormData(form);

            if (type === "post") {
                save('post', "{{ $url }}", formData);
            } else {
                save('put', "{{ $url }}/" + uuid, formData);
            }

        });

        function save(type, url, data) {
            $.ajax({
                method: type,
                url: url,
                data: data,
                contentType: false,
                processData: false,
                success: function (data) {
                    loadPage(1);
                    $('#modal-form').modal('hide');
                }
            });
        }
    });
</script>
@endpush
