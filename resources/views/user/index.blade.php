@extends('layouts.app')

@section('page-header')
@include('components.admin.page-header', [
'title_page' => 'User',
'breadcrumb' => [
[
'label' => 'Pengguna',
'url' => route('dashboard'),
'icon' => 'pe-7s-home',
],
[
'label' => 'User',
'url' => "#",
'icon' => 'pe-7s-users',
'active' => true,
],
],
])
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>List Pengguna</h5>
        </div>
        <div class="card-block row">
            <div class="col-sm-12 col-lg-12 col-xl-12">
                <div class="table-responsive">
                    <table class="table table-styling">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
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
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" type="text" placeholder="First name" required="">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="username">Username</label>
                                <input class="form-control" id="username" type="text" placeholder="Username"
                                    aria-describedby="username" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" type="text" placeholder="email"
                                    aria-describedby="email" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03">City</label>
                                <input class="form-control" id="validationDefault03" type="text" placeholder="City"
                                    required="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault04">State</label>
                                <input class="form-control" id="validationDefault04" type="text" placeholder="State"
                                    required="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault05">Zip</label>
                                <input class="form-control" id="validationDefault05" type="text" placeholder="Zip"
                                    required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input class="form-control" id="password" type="text" placeholder="password"
                                        aria-describedby="password" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="button" id="save">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function loadPage(page) {
        $.ajax({
            type: "get",
            url: "{{ route('users.index') }}",
            data: { page: page },
            success: function (response) {
                let data = response.data;
                let html = '';

                data.forEach((item, index) => {
                    html += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${item.name}</td>
                            <td>${item.username}</td>
                            <td>${item.email}</td>
                            <td>${item.is_active == 1 ? 'Aktif' : 'Nonaktif'}</td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-warning btn-sm btn-edit" data-id="${item.uuid}"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('users.index') }}/${item.id}" class="btn btn-danger btn-sm" data-method="delete" data-confirm="Are you sure?"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    `;
                });

                // Update the HTML for pagination
                let paginationHtml = '';
                let totalPages = response.meta.last_page;

                // Add Previous button
                paginationHtml += `<li class="page-item ${response.meta.current_page === 1 ? 'disabled' : ''}">
                                    <a class="page-link" href="#" data-page="${response.meta.current_page - 1}">Previous</a>
                                </li>`;

                // Loop to add page numbers
                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml += `<li class="page-item ${response.meta.current_page === i ? 'active' : ''}">
                                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                                    </li>`;
                }

                // Add Next button
                paginationHtml += `<li class="page-item ${response.meta.current_page === totalPages ? 'disabled' : ''}">
                                    <a class="page-link" href="#" data-page="${response.meta.current_page + 1}">Next</a>
                                </li>`;

                // Set HTML pagination to the element with id 'pagination'
                $('#pagination').html(paginationHtml);
                $('#pengguna').html(html);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
    let uuid = ""
    $('#pengguna').on('click','.btn-edit', function () {
        //get data form pengguna
        uuid = ""
        $('#save').removeAttr('data-id');
        let id = $(this).data('id');
        let url = "{{ route('users.index') }}/" + id;
        $.ajax({
            type: "get",
            url: url,
            success: function (data) {
                $('.modal-title').text('Edit Pengguna');
                $('#modal-form').modal('show');
                $('#name').val(data.data.name)
                $('#username').val(data.data.username)
                $('#email').val(data.data.email)
                uuid = data.data.uuid
            },
            error: function (error) {
            }
        });

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
        let url = "{{ route('users.index') }}/" + uuid;
        //form data
        let data = {
            name: $('#name').val(),
            username: $('#username').val(),
            email: $('#email').val(),
            _token: "{{ csrf_token() }}"
        }
        $.ajax({
            type: "put",
            url: url,
            data: data,
            success: function (data) {
                loadPage(1);
                $('#modal-form').modal('hide');
            }
        });
    });

</script>
@endpush