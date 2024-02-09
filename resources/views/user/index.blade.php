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
                    {{-- paginasi --}}

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
</div>
@endsection

@push('js')
<script>
    // Function to make AJAX request with a specific page
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
                            <a href="{{ route('users.index') }}/${item.id}/edit" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
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

</script>
@endpush