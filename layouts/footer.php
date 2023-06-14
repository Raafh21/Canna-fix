</div>
</div>
</div>

<script src="assets/mazer/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/mazer/js/bootstrap.bundle.min.js"></script>

<script src="assets/mazer/vendors/simple-datatables/simple-datatables.js"></script>
<script>
// Simple Datatable
let table1 = document.querySelector('#table');
let dataTable = new simpleDatatables.DataTable(table1);
</script>

<script src="assets/mazer/vendors/ckeditor/ckeditor.js"></script>

<script>
ClassicEditor
    .create(document.querySelector('#editor'))
    .catch(error => {
        console.error(error);
    });
</script>

<script src="assets/mazer/js/main.js"></script>
<script src="assets/mazer/vendors/jquery/jquery.min.js"></script>
<script src="assets/mazer/vendors/sweetalert2/sweetalert2.all.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="assets/plugin/datatables/jquery.dataTables.min.js')}}"></script>
<script src="assets/plugin/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<script>
$(document).ready(function() {
    // DataTable
    $('#trainingTable').DataTable();
});
</script>

<script>
// Hapus Data Training
$(document).on('click', '.hapus-training', function(e) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    e.preventDefault();
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data Training!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if (result) {
            form.submit();
        }
    })
});
</script>

<script>
document.querySelectorAll('.treeview li span').forEach(function(node) {
    node.addEventListener('click', function(event) {
        event.stopPropagation();
        var parent = event.target.parentNode;
        if (parent.classList.contains('active')) {
            parent.classList.remove('active');
        } else {
            document.querySelectorAll('.treeview li').forEach(function(node) {
                node.classList.remove('active');
            });
            parent.classList.add('active');
        }
    });
});
</script>
</body>

</html>