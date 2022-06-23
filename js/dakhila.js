 var MJ = jQuery.noConflict();
 MJ(document).ready(function() {
 MJ(document).on("input","input[name~='qty[]'], input[name~='rate[]'], input[name~='extra_amount[]'], input[name~='discount']",function() {
          var forurl = MJ('#forurl').val();
          if(forurl=='dakhila')
          {
            
            var id_selected     = MJ(this).attr("id");
            var res             = id_selected.split("-");
            var counter         = res[res.length-1];
            var qty             = parseFloat(MJ("#qty-"+counter).val()) || 0;
            var rate            = parseFloat(MJ("#rate-"+counter).val()) || 0;
            var vat_status      = parseInt(MJ("#vat_status-"+counter).val());
            var extra_amount    = parseFloat(MJ("#extra_amount-"+counter).val()) || 0;
            var discount        = parseFloat(MJ('#discount').val());
            var total = rate*qty;
            total = total.toFixed(2);
            if(vat_status === 1)
            {
              var vat_amount  = parseFloat(total*0.13);
              vat_amount      = vat_amount.toFixed(2);

            }
            else
            {
              var vat_amount  = 0;
            }
            var vat_total   = parseFloat(total) + parseFloat(vat_amount);
            vat_total       = vat_total.toFixed(2);


            //var gross_total = parseFloat(MJ('#vat_total-'+counter).val()) + parseFloat(MJ('#extra_amount-'+counter).val());
            
            var gross_total         = parseFloat(vat_total) + parseFloat(extra_amount);
            gross_total             = gross_total.toFixed(2);
            //alert(total + ' : ' + vat_amount + ' : ' + vat_total + ' : ' + extra_amount + " : " + vat_total);
            MJ("#total-"+counter).val(total);
            MJ("#vat-"+counter).val(vat_amount);
            MJ("#vat_total-"+counter).val(vat_total);
            MJ("#gross_total-"+counter).val(gross_total);
            // for calculating total amounts
            var total_amount_without_vat = 0;
            MJ(".total_amount_without_vat").each(function () {
                   var val = MJ(this).val() || 0;
                   total_amount_without_vat = parseFloat(total_amount_without_vat) + parseFloat(val);
    
            });
            MJ("#total_amount_without_vat").html('जम्मा : '+ total_amount_without_vat.toFixed(2));
           
             // for calculating total amounts
              var total_vat = 0;
              MJ(".total_vat").each(function () {
                     var val = MJ(this).val() || 0;
                     total_vat = parseFloat(total_vat) + parseFloat(val);
      
              });
              MJ("#total_vat").html('जम्मा : '+ total_vat.toFixed(2));

              // for calculating total amounts
              var total_amount_with_vat = 0;
              MJ(".total_amount_with_vat").each(function () {
                     var val = MJ(this).val() || 0;
                     total_amount_with_vat = parseFloat(total_amount_with_vat) + parseFloat(val);
      
              });
              MJ("#total_amount_with_vat").html('जम्मा : '+ total_amount_with_vat.toFixed(2));

                // for calculating total amounts
              var gross_total = 0;
              MJ(".gross_total").each(function () {
                     var val = MJ(this).val() || 0;
                     gross_total = parseFloat(gross_total) + parseFloat(val);
      
              });
              MJ("#sub_total").val(gross_total.toFixed(2));

              var grand_total = parseFloat(gross_total - discount);
              
               MJ("#grand_total").val(grand_total.toFixed(2));

          }
          if(forurl=='kharcha' || forurl == 'dakhila')
          {
              return false;
          }
          var id_selected = MJ(this).attr("id");
	        var res = id_selected.split("-");
	        var counter = res[res.length-1];
//          alert(counter);return false;
          var qty = MJ("#qty-"+counter).val();
           var rate = MJ("#rate-"+counter).val() || 0;
          var total = parseFloat(rate)* parseFloat(qty);
          var final_total = total.toFixed(2);
          MJ("#total-"+counter).val(final_total);
          var total = 0;
          MJ(".total").each(function () {
                        var val = MJ(this).val();
                       
                        if(val=="")
                        {
                            val = 0;
                           
                        }
                        
                      total = parseFloat(total) + parseFloat(val);
		
        });
        MJ("#total_amount").val(total);
      });

 MJ(document).on("change","select[name~='vat_status[]']",function() {
          var forurl = MJ("#forurl").val();
          if(forurl=='dakhila')
          {
            
            var id_selected     = MJ(this).attr("id");
            var res             = id_selected.split("-");
            var counter         = res[res.length-1];
            var qty             = parseFloat(MJ("#qty-"+counter).val()) || 0;
            var rate            = parseFloat(MJ("#rate-"+counter).val()) || 0;
            var vat_status      = parseInt(MJ("#vat_status-"+counter).val());
            var extra_amount    = parseFloat(MJ("#extra_amount-"+counter).val()) || 0;
            var discount        = parseFloat(MJ('#discount').val());
            var total = rate*qty;
            total = total.toFixed(2);
            if(vat_status === 1)
            {
              var vat_amount  = parseFloat(total*0.13);
              vat_amount      = vat_amount.toFixed(2);

            }
            else
            {
              var vat_amount  = 0;
            }
            var vat_total   = parseFloat(total) + parseFloat(vat_amount);
            vat_total       = vat_total.toFixed(2);
            //var gross_total = parseFloat(MJ('#vat_total-'+counter).val()) + parseFloat(MJ('#extra_amount-'+counter).val());
            
            var gross_total         = parseFloat(vat_total) + parseFloat(extra_amount);
            gross_total             = gross_total.toFixed(2);
            //alert(total + ' : ' + vat_amount + ' : ' + vat_total + ' : ' + extra_amount + " : " + vat_total);
            MJ("#total-"+counter).val(total);
            MJ("#vat-"+counter).val(vat_amount);
            MJ("#vat_total-"+counter).val(vat_total);
            MJ("#gross_total-"+counter).val(gross_total);
            // for calculating total amounts
            var total_amount_without_vat = 0;
            MJ(".total_amount_without_vat").each(function () {
                   var val = MJ(this).val() || 0;
                   total_amount_without_vat = parseFloat(total_amount_without_vat) + parseFloat(val);
    
            });
            MJ("#total_amount_without_vat").html('जम्मा : '+ total_amount_without_vat.toFixed(2));
           
             // for calculating total amounts
              var total_vat = 0;
              MJ(".total_vat").each(function () {
                     var val = MJ(this).val() || 0;
                     total_vat = parseFloat(total_vat) + parseFloat(val);
      
              });
              MJ("#total_vat").html('जम्मा : '+ total_vat.toFixed(2));

              // for calculating total amounts
              var total_amount_with_vat = 0;
              MJ(".total_amount_with_vat").each(function () {
                     var val = MJ(this).val() || 0;
                     total_amount_with_vat = parseFloat(total_amount_with_vat) + parseFloat(val);
      
              });
              MJ("#total_amount_with_vat").html('जम्मा : '+ total_amount_with_vat.toFixed(2));

                // for calculating total amounts
              var gross_total = 0;
              MJ(".gross_total").each(function () {
                     var val = MJ(this).val() || 0;
                     gross_total = parseFloat(gross_total) + parseFloat(val);
      
              });
              MJ("#sub_total").val(gross_total.toFixed(2));
              var grand_total = parseFloat(gross_total - discount);

               MJ("#grand_total").val(grand_total.toFixed(2));

          }
          if(forurl=='kharcha' || forurl == 'dakhila')
          {
              return false;
          }
          var id_selected = MJ(this).attr("id");
          var res = id_selected.split("-");
          var counter = res[res.length-1];
//          alert(counter);return false;
          var qty = MJ("#qty-"+counter).val();
           var rate = MJ("#rate-"+counter).val() || 0;
          var total = parseFloat(rate)* parseFloat(qty);
          var final_total = total.toFixed(2);
          MJ("#total-"+counter).val(final_total);
          var total = 0;
          MJ(".total").each(function () {
                        var val = MJ(this).val();
                       
                        if(val=="")
                        {
                            val = 0;
                           
                        }
                        
                      total = parseFloat(total) + parseFloat(val);
    
        });
        MJ("#total_amount").val(total);
      });
 MJ(document).on("input","input[name~='discount']",function() {
          var forurl = MJ("#forurl").val();
          if(forurl=='dakhila')
          {
            
           var sub_total    = parseFloat(JQ("#sub_total").val() || 0);
           var discount     = parseFloat(MJ('#discount').val() || 0);
           var grand_total   = parseFloat(sub_total - discount);
           MJ("#grand_total").val(grand_total.toFixed(2));
          }
      });
  MJ(document).on("input","input[name~='rate[]']",function() {
          var forurl = MJ("#forurl").val();
          if(forurl=='tippani')
          {
           
            var id_selected       = MJ(this).attr("id");
            var res               = id_selected.split("-");
            var counter           = res[res.length-1];

            var rate               = parseFloat(JQ("#rate-"+counter).val() || 0);
            var qty                = parseFloat(JQ("#qty-"+counter).val() || 0);
            
            var total              = parseFloat(rate * qty);

            MJ("#total-"+counter).val(total.toFixed(2));

            var grand_total = 0;
              MJ(".total").each(function () {
                     var val      = MJ(this).val() || 0;
                     grand_total  = parseFloat(grand_total) + parseFloat(val);
      
              });
            
            MJ("#grand_total").val(grand_total.toFixed(2));
          }
      });
       MJ(document).on("click",".vat_check",function() {
            
            var radio           = MJ(this).val();
            var grand_total     = parseFloat(MJ("#grand_total").val() || 0);
            if(radio==1)
            {
              var with_vat   = grand_total;
              var without_vat = (grand_total*100)/113;
            }
            else
            {
              var without_vat   = grand_total;
              var with_vat      = grand_total*1.13;
            }

             MJ("#with_vat").val(with_vat.toFixed(2));
             MJ("#without_vat").val(without_vat.toFixed(2));        
        });
     MJ(document).on("change","#item_type_id_generic",function() {
            var item_type_id = MJ("#item_type_id_generic").val();
            var category = MJ("#category").val();
            var param = {};

            param.item_type_id = item_type_id;
            param.category = category;
            MJ.post('get_generic_names.php',param,function(res){
                var obj = JSON.parse(res);
                MJ('#add_generic_list').html(obj.html);
            });
        });
});