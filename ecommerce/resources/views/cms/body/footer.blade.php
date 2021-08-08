
<footer class="main-footer">
        <div class="footer-left">
          <div class="bullet"></div> Design And Developed By <a href="http://faraitfusion.com/" target="_blank">Fara IT Fusion</a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  <script src="{{ asset('backend/assets/bundles/chartjs/chart.min.js') }}"></script>
  <script src="{{ asset('backend/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('backend/assets/js/page/index.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('backend/assets/js/custom.js') }}"></script>

  <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <script src="{{ asset('js/sweetalert.min.js') }}"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  <!-- lazyload js-->
  <script src="{{ asset('js/lozad.min.js') }}"></script>

  <script src="{{ asset('backend/datatable/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/datatable/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/datatable/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('backend/datatable/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/datatable/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('backend/datatable/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/datatable/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('backend/datatable/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('backend/datatable/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('backend/datatable/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('backend/datatable/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('backend/datatable/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

  @if(session('status'))
    <script>
        swal("Success!", "{{ session('status') }} ", "success");
    </script>
  @endif

  @if(session('adminError'))
    <script>
      swal({
          title: "Error!",
          text: "{{ session('adminError') }}",
          icon: "error",
        });
    </script>
  @endif
  

  <script>
    // Begin:: category name to url start
    $(document).on("click change paste keyup cut select", "#category_name", function() {
      var catName = $("#category_name").val();
      var replace_path = catName.replaceAll(" ", "-");
      var new_url = replace_path.toLowerCase();
      $("#category_url").val(new_url);
    }); 
    // End:: category name to url start

    // Begin:: Product Variation start

    const observer = lozad();
observer.observe();
    
      // variation change
    function checkvariation(){
	    var val = $("#variation").val();
      //console.log(val);
	    if(val=="simple"){
	        $(".variation").addClass("d-none");
	    }else{
	         $(".variation").removeClass("d-none");
	    }
	  }

  var count_id = 0;
  function AddVariation(variationID,variation_name) {

      var lowerCase = variation_name.toLowerCase();
      if(lowerCase == 'color' || lowerCase == 'colour'){
        $("#variation_table tr:last").after('<tr id="attribute_id_'+count_id+'"><td><input type="hidden" name="product_variation_id[]" value="new"><input type="hidden" name="variation_id[]" value="'+variationID+'">'+variation_name+'</td><td><input type="color" name="attribute[]" class="form-control"></td><td><input type="number" name="price[]" class="form-control" step=any></td><td class="text-center"><i onclick="delete_row(\'attribute_id_'+count_id+'\')" style="font-size: 20px;" class="fas fa-trash-alt text-danger" aria-hidden="true"></i></td></tr>');
      }
      else {
        $("#variation_table tr:last").after('<tr id="attribute_id_'+count_id+'"><td><input type="hidden" name="product_variation_id[]" value="new"><input type="hidden" name="variation_id[]" value="'+variationID+'">'+variation_name+'</td><td><input type="text" name="attribute[]" class="form-control"></td><td><input type="number" name="price[]" class="form-control" step=any></td><td class="text-center"><i onclick="delete_row(\'attribute_id_'+count_id+'\')" style="font-size: 20px;" class="fas fa-trash-alt text-danger" aria-hidden="true"></i></td></tr>');
      }
      Toastify({
        text: "New Variation Added",
        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
        className: "error",
      }).showToast();

      count_id++;
  }
  // delete variation attribute table row
  function delete_row(id){
    $("#"+id).remove();
      Toastify({
        text: "Variation Removed",
        backgroundColor: "linear-gradient(to right, #F50057, #1B1F85)",
        className: "error",
      }).showToast();

	}

  // delete variation attribute DB row
  function dbDeleteRow(id) {
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this Attribute",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          var v_attribute_id = id;
          $.ajax({
            url: '/cms/delete_vari_attribute/'+v_attribute_id,
            type: "POST",
            data : {"_token":"{{ csrf_token() }}"},
            dataType: "json",
            success:function(data) {
              //alert("hello paul");
            }
        });
        var trID = "exist_vari"+v_attribute_id;
        $("#"+trID).remove();
        Toastify({
          text: "Variation Removed",
          backgroundColor: "linear-gradient(to right, #F50057, #1B1F85)",
          className: "error",
        }).showToast();
        //console.log(trID);
      }
    });

  }
// End:: Product Variation start

//Begin:: copy product image path
function copyImageUrl(path) {
  //alert(path);
  var path = path;
  swal({
      title: "Your link is ready",
      text: path,
      icon: "success",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if(willDelete) {
        navigator.clipboard.writeText(path);
        Toastify({
          text: "Link Copied",
          backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
          className: "error",
        }).showToast();
      }
    });
}
//End:: copy product image path



</script>

<script>
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
    CKEDITOR.replace( 'editor3' );
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<!-- Begin:: Cat id to Subcat name dependency  -->
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script>
         $(document).ready(function() {
        $('#catID').on('change', function() {
            var catID = $(this).val();
            if(catID) {
                $.ajax({
                    url: '/cms/findCatIDTosubCatName/'+catID,
                    type: "GET",
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data) {
                      //console.log(data);
                      if(data){
                        $('#subCat').empty();
                        $('#subCat').focus;
                        $('#subCat').append('<option value="">-- Select Sub-Category --</option>'); 
                        $.each(data, function(key, value){
                        $('select[name="subCatID"]').append('<option value="'+ value.id +'">' + value.sub_cat_name+ '</option>');
                    });
                  }else{
                    $('#subCat').empty();
                  }
                  }
                });
            }else{
              $('#subCat').empty();
            }
        });
    });
  </script>
  <!-- End:: Cat id to Subcat name dependency  -->



</body>
</html>
