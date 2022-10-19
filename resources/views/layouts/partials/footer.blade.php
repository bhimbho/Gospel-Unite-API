<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                2020 &copy; Gospel Unites
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->
</div>
</div>
<!-- Vendor js -->
<script src="{{asset('admin/js/vendor.min.js')}}"></script>
<!-- KNOB JS -->
<script src="{{asset('admin/libs/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- Chart JS -->
<script src="{{asset('admin/libs/chart-js/Chart.bundle.min.js')}}"></script>
<!-- Datatable js -->
<script src="{{asset('admin/libs/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/libs/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/libs/datatables/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/libs/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/libs/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/libs/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin/libs/datatables/buttons.flash.min.js')}}"></script>
<script src="{{asset('admin/libs/datatables/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('admin/libs/datatables/dataTables.select.min.js')}}"></script>
<!-- <script src="{{asset('admin/js/pages/datatables.init.js')}}"></script> -->
<script src="{{asset('admin/libs/rwd-table/rwd-table.min.js')}}"></script>
<script src="{{asset('admin/libs/dropify/js/dropify.min.js')}}"></script>
<script src="{{asset('admin/libs/select2/select2.min.js')}}"></script>
<script src="{{asset('admin/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
<!-- PDF and Excel Button -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script src="{{asset('admin/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>

<script src="{{asset('admin/js/pages/form-advanced.init.js')}}"></script>
<script src="{{asset('admin/js/pages/responsive-table.init.js')}}"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>ZZ
<!-- App js -->
<script src="{{asset('admin/js/app.min.js')}}"></script>
<style>
.float-left i{
font-size: 50px;
}
</style>
</body>
</html>
<script>
$(function(){
    $('.dropify').dropify();
    // $('#datatable1').DataTable();


})
function spinnerShowHide (data, status='hide'){
        if(status == 'hide'){
            return $(data).hide()
        }
        return $(data).show()
    }
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {s
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '.editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {s
            console.error( error );
        } );
    console.log(ClassicEditor.instances);
</script>
