<?php
include('db.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
include('timezone.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MONITASK</title>
  <link rel="stylesheet" href="css/styleAjax.css">
</head>
<body>
<!-- <div class="container-fluid"> -->
  <table id="main" > <!--border="0" cellspacing="0" -->

    <tr>
      <td id="header">
      <h1 class="h3 mb-0 text-gray-800">Advance</h1>
          <div id="search-bar">
          <label>Search :</label> 
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>   
    </tr>

    <tr>
      <td >
<!--****************************   FORM ABOVE TABLE : Table IS IN ajax-load.php  ********************************** -->
<div class="container-fluid"> 
<form id="addForm" class="row g-3">
  <div class="col-md-3">
    <label for="inputEmail4" class="form-label">Employee ID</label>
    <input type="email" class="form-control" id="empid">
  </div>
  <div class="col-md-3">
    <label for="inputPassword4" class="form-label">Amount</label>
    <input type="text" class="form-control" id="amount">
  </div>
  <div class="col-md-3">
    <label for="inputZip" class="form-label">Date</label>
    <input type="date" class="form-control" id="date">
  </div>
  <div class="col-md-6">
    <label for="inputCity" class="form-label">Description</label>
    <input type="text" class="form-control" id="description">
  </div>
  <div class="col-md-6">
     <button type="submit" id="save-button" class="btn btn-primary mt-4.2">Save</button>
  </div>
</form>
</div>
<!--**************************************************************************************
        <form id="addForm">
          Employee ID: <input type="text" id="empid">&nbsp;&nbsp;&nbsp;
          Amount : <input type="text" id="amount"><br>
          Description : <input type="text" id="description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Date : <input type="text" id="date"><br>
          <input type="submit" id="save-button" value="Save">
        </form> 
-->
      </td>
    </tr>
    <tr>
      <td id="table-data">
      </td>
    </tr>
  </table>
  <!--</div>-**Container close**-->
  <div id="error-message"></div>
  <div id="success-message"></div>
  
  <!--****************************************** Edit Modal Box ********************************************************88-->
  <div id="modal">
    <div id="modal-form">
      <h2>Edit Form</h2>
      <table cellpadding="10px" width="100%">
      </table>
      <div id="close-btn">X</div>
    </div>
  </div>

<script type="text/javascript" src="js_ajax/jquery.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
    // Load Table Records
    function loadTable(){
      $.ajax({
        url : "ajax-load.php",
        type : "POST",
        success : function(data){
          $("#table-data").html(data);
        }
      });
    }
    loadTable(); // Load Table Records on Page Load

    // Insert New Records
    $("#save-button").on("click",function(e){
      e.preventDefault();
      var empid = $("#empid").val();
      var amount = $("#amount").val();
      var description = $("#description").val();
      var date = $("#date").val();
      if(empid == "" || amount == ""|| description == ""|| date == ""){
        $("#error-message").html("All fields are required.").slideDown();
        $("#success-message").slideUp();
      }else{
        $.ajax({
          url: "ajax-insert.php",
          type : "POST",
          data : {id :empid, amount: amount, description : description, date : date },
          success : function(data){
            if(data == 1){
              loadTable();
              $("#addForm").trigger("reset");
              $("#success-message").html("Data Inserted Successfully.").slideDown();
              $("#error-message").slideUp();
            }else{
              $("#error-message").html("Can't Save Record.").slideDown();
              $("#success-message").slideUp();
            }

          }
        });
      }
    });

    //Delete Records
    $(document).on("click",".delete-btn", function(){
      if(confirm("Do you really want to delete this record ?")){
        var id = $(this).data("id");
        var element = this;

        $.ajax({
          url: "ajax-delete.php",
          type : "POST",
          data : {id : id},
          success : function(data){
              if(data == 1){
                $(element).closest("tr").fadeOut();
              }else{
                $("#error-message").html("Can't Delete Record.").slideDown();
                $("#success-message").slideUp();
              }
          }
        });
      }
    });

    //Show Modal Box***************************** Show Edit Form Popup ****************************************************
    $(document).on("click",".edit-btn", function(){
      $("#modal").show();
      var id = $(this).data("id");

      $.ajax({
        url: "ajax-load-update-form.php",
        type: "POST",
        data: {id: id},
        success: function(data) {
          $("#modal-form table").html(data);
        }
      })
    });

    //Hide Modal Box*******************************************************************************************************
    $("#close-btn").on("click",function(){
      $("#modal").hide();
    });

    //Save Update Form******************************** Save Editing ********************************************************
      $(document).on("click","#edit-submit", function(){
        var empid = $("#edit-id").val();
        var amount = $("#edit-amount").val();
        var description = $("#edit-description").val();
        var date = $("#edit-date").val();

        $.ajax({
          url: "ajax-update-form.php",
          type : "POST",
          data : {id: empid , aamount : amount , adescription : description , adate : date },
          success: function(data) {
            if(data == 1){
              $("#modal").hide();
              loadTable();
            }
          }
        })
      });

    // Live Search
     $("#search").on("keyup",function(){
       var search_term = $(this).val();

       $.ajax({
         url: "ajax-live-search.php",
         type: "POST",
         data : {search:search_term },
         success: function(data) {
           $("#table-data").html(data);
         }
       });
     });
  });
</script>
</body>
</html>


<?php
include('includes/footer.php');
?>