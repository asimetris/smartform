@extends('master.master_page')

@section('custom-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
<style>
    .text-right {
        text-align: right;
    }
    .m-0 {
        margin: 0;
    }
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Dashboard Form Inspeksi Catering</h6>
                    </div>
                </div>
                <div class="card-body my-1">

                    <div class="d-flex align-items-center ms-3">
                        <a href="{{ route('bss-form.she-019B.form-inspeksi-catering') }}">
                            <button class="btn btn-primary ms-auto uploadBtn" id="coba">
                                New Form
                            </button>
                        </a>
                    </div>

                    <div class="table-responsive p-0">
                        <table id="list-req-fuel" data-toggle="table" data-ajax="fetchFormsData"
                            data-side-pagination="server"
                            data-page-list="[10, 25, 50, 100, all]" data-sortable="true"
                            data-content-type="application/json" data-data-type="json" data-pagination="true"
                            data-unique-id="id">
                            <thead>
                                <tr>
                                    <th data-field="id" data-align="left" data-halign="text-center" data-sortable="true">No</th>
                                    <th data-field="loker" data-align="left" data-halign="text-center" data-sortable="true">Lokasi Kerja</th>
                                    <th data-field="action" data-formatter="actionFormatter" >Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('custom-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.29.0/tableExport.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.29.0/libs/jsPDF/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.2/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.7.7/dist/axios.min.js"></script>
    <script type="text/javascript">
        var $table = $("#list-req-fuel");
        var btnFilterSubmit = document.getElementById("btnFilterSubmit")
        var additonalQuery = {
            tanggal: null,
            nama: null
        }

        btnClearFilter.addEventListener("click", function(e) {

        })
        
        function debounce (func, wait){
            let timeout;
            
            return function executedFunction(...args) {
                var later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };

                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        };        

        function fetchFormsData(params) {
            params.data = {...params.data, ...additonalQuery}
            var url = '/bss-form/she-019B/list-inspeksi-catering'
            // console.log(params.data)
            $.get(url + '?' + $.param(params.data)).then(function(res) {
                params.success(res.data)
            })
        }

        
        function myFunction() {
            if(!confirm("Yakin ingin menghapus data ini?"))
            event.preventDefault();
        }

        // <a class="btn btn-info btn-action btn-sm me-1" href="/bss-form/log/edit-inspeksi-catering/${row.id}">Edit</a>
        function actionFormatter(value, row, index) {
            return `
                <a class="btn btn-danger btn-action btn-sm" onclick="return myFunction();" href="/bss-form/she-019B/delete-inspeksi-catering/${row.id}">Delete</a>
                <a class="btn btn-primary btn-action btn-sm" href="/bss-form/she-019B/pdf-inspeksi-catering/${row.id}">Pdf</a>
            `;
        }

    </script>
@endsection
