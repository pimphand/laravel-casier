@extends('layouts.app')

@section('page-header')
@include('components.admin.page-header', [
'title_page' => 'Kategori',
'breadcrumb' => [
[
'label' => 'Pengguna',
'url' => route('dashboard'),
'icon' => 'pe-7s-home',
],
[
'label' => 'Kategori',
'url' => "#",
'icon' => 'pe-7s-users',
'active' => true,
],
],
])
@endsection

@section('content')
@php
$url = route('categories.index');
@endphp
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h5>Data Kategori</h5>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">
                        <a href="javascript:void(0)" class="btn btn-primary" id="btn-add"><i class="fa fa-plus"></i>
                            Tambah
                            Kategori</a>
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" type="text" placeholder="kategori" required="">
                            </div>
                        </div>
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

@push('js')
<script>
    $(document).ready(function () {
        let uuid = ""
        let type = ""
        $('#btn-add').click(function (e) {
            e.preventDefault();
            $('#modal-form').modal('show');
            type = "post";
        });

        function loadPage(page) {
            $.ajax({
                type: "get",
                url: "{{ $url }}",
                data: { page: page },
                success: function (response) {
                    let data = response.data;
                    let html = '';

                    data.forEach((item, index) => {
                            html += `<tr>
                                <td>${index + 1}</td>
                                <td>${item.name}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn-edit" data-id="${item.id}" data-name="${item.name}"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0)" class="btn-delete" data-id="${item.id}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>`;
                    });

                    let paginationHtml = generatePaginationHtml(response);

                    // Set HTML pagination to the element with id 'pagination'
                    paginationElement.html(paginationHtml);

                    if (response.meta.total <1) {
                        html += `<tr>
                                <td colspan="3" class="text-center">Data tidak ditemukan</td>
                            </tr>`;
                    }
                    $('#pengguna').html(html);
                },
                error: function (error) {
                    console.log(error);
                }
            });
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
            let name = $('#name').val();
            let data = {
                name: name,
                _token: "{{ csrf_token() }}"
            }
            if (type === "post") {
                save('post', "{{ $url }}", data);
            } else {
                save('put', "{{ $url }}/" + uuid, data);
            }

        });

        function save(type, url, data) {
            $.ajax({
                type: type,
                url: url,
                data: data,
                success: function (data) {
                    loadPage(1);
                    $('#modal-form').modal('hide');
                }
            });
        }
    });
</script>
@endpush
