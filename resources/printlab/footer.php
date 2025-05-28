</div>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="index.php">Logout</a>
    </div>
</div>
</div>
</div>
<div id="msgbox"></div>
<div class="footer_box">Powered by ManiaLab &#169;</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://kit.fontawesome.com/6922355b88.js" crossorigin="anonymous"></script>
<Script>
var link=window.location.pathname;
link = (link.split('/')).pop();
console.log(link);
var all = $(".itemlink").map(function() {
  var hh =$(this).attr('href');
  if(hh == link){
    console.log("----------found----------------");
    ($(this).closest("li.nav-item")).addClass("active");
    $(this).addClass("active");
  }
}).get();

function closemsgph(){
  $('#msgboxph').hide();
}
</Script>
