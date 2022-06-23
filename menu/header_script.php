<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  
  <script>
      var mydate = jQuery.noConflict();
      
  mydate(document).ready(function() {
  mydate(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });
     
  });
  </script>
  <script type="text/javascript">
    function showHideDiv(chkPassport) {
       var div_id = "show-"+chkPassport;
       var mydiv = document.getElementById(div_id);
       var styleval = mydiv.style.display;
       if(styleval=="none"){
           mydiv.style.display="block";
           }
           else{
               mydiv.style.display="none";
           }
    }
     function showProject(chkPassport) {
        var dvPassport = document.getElementById("project_list");
        dvPassport.style.display = chkPassport.checked ? "block" : "none";
    }
    function showStaff(chkPassport) {
        var dvPassport = document.getElementById("staff_list");
        if(chkPassport.checked ){
            dvPassport.style.display ="block";     
        }
        else{
            dvPassport.style.display="none";
        } 
   }
</script>
<script>
function showResult(str) {
  var xhttp;    
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getcustomer.asp?q="+str, true);
  xhttp.send();
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>