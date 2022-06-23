var JQ = jQuery.noConflict();
JQ(document).ready(function(){
 //JQ(".ndp-click-trigger").html('मिति');
	JQ(document).on("click","#edititem",function() {
	 	var column_name = JQ(this).attr('name');
		JQ('.edit_item').show();
	 	
    });

    JQ(document).on("click",".add_more_prastabana",function() {
                           var num = JQ(".remove_prastabana_detail").length;
			   var counter = num+2;
			   var param = {};
                         //  alert(counter);
			   param.counter = counter;
                          JQ.post("get_prastabana.php",param,function(res){
				   var obj = JSON.parse(res);
//                                   alert(obj.html); return false;
                                   JQ("#add_prastabana").append(obj.html);
				});
    });
    
      function round(value, exp) 
    {
        if (typeof exp === 'undefined' || +exp === 0)
          return Math.round(value);

        value = +value;
        exp = +exp;

        if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
          return NaN;

        // Shift
        value = value.toString().split('e');
        value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

        // Shift back
        value = value.toString().split('e');
        return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
    }
    function recalculateAfterCross(){
    var discount = parseFloat(JQ("#discount").val()) || 0;
     var total_amount_without_vat = 0;
            JQ(".total_amount_without_vat").each(function () {
                   var val = JQ(this).val() || 0;
                   total_amount_without_vat = parseFloat(total_amount_without_vat) + parseFloat(val);
    
            });
           
            JQ("#total_amount_without_vat").html('जम्मा : '+ total_amount_without_vat.toFixed(2));
           
             // for calculating total amounts
              var total_vat = 0;
              JQ(".total_vat").each(function () {
                     var val = JQ(this).val() || 0;
                     total_vat = parseFloat(total_vat) + parseFloat(val);
      
              });
              JQ("#total_vat").html('जम्मा : '+ total_vat.toFixed(2));

              // for calculating total amounts
              var total_amount_with_vat = 0;
              JQ(".total_amount_with_vat").each(function () {
                     var val = JQ(this).val() || 0;
                     total_amount_with_vat = parseFloat(total_amount_with_vat) + parseFloat(val);
      
              });
              JQ("#total_amount_with_vat").html('जम्मा : '+ total_amount_with_vat.toFixed(2));

                // for calculating total amounts
              var gross_total = 0;
              JQ(".gross_total").each(function () {
                     var val = JQ(this).val() || 0;
                     gross_total = parseFloat(gross_total) + parseFloat(val);
      
              });
              JQ("#sub_total").val(gross_total.toFixed(2));
              var grand_total = parseFloat(gross_total - discount);
              JQ("#grand_total").val(grand_total.toFixed(2));
  }
    JQ(document).on("click",".cross_row_dakhila",function() {
        
       var item = JQ(this).closest("tr");
        item.remove();
        var count = -1;
        var total_rows = JQ(".dakhila_item_row").length;
        JQ("#dakhilaTable tr").each(function(){
           // alert("inside row");

           var testnum = count;
            var test = testnum.toString();
            var nep_count = getNepCount(test);
            if(count <= total_rows )
            {
              JQ(this).find('td:eq(0)').html(nep_count);   
            }
           
            count ++;
        });
        recalculateAfterCross();
    });
    JQ(document).on("click",".cross_row_kharcha",function() {
        
       var item = JQ(this).closest("tr");
        item.remove();
        var count = 0;
        
        JQ("#kharchaTable tr").each(function(){
           // alert("inside row");
            var testnum = count;
            var test = testnum.toString();
            var nep_count = getNepCount(test);
           JQ(this).find('td:eq(0)').html(nep_count);
            count ++;
        });
    });
    JQ(document).on("click",".cross_row",function() {
        
       var item = JQ(this).closest("tr");
        item.remove();
        var count = 0;
        
        JQ("#maagTable tr").each(function(){
           // alert("inside row");
            var testnum = count;
            var test = testnum.toString();
            var nep_count = getNepCount(test);
           JQ(this).find('td:eq(0)').html(nep_count);
            count ++;
        });
      // JQ('.remove_prastabana_detail').last().remove();
        
        
    });
    
    function getNepCount(test)
        {
            var test_arr = test;
            var  final_count = '';
            for (var i = 0; i < test_arr.length; i++) {
                switch(test_arr.charAt(i)) {
                case "0":
                    final_count = final_count + "०";
                    break;
                case "1":
                    final_count = final_count + "१";
                    break;
                case "2":
                    final_count = final_count + "२";
                    break;
                case "3":
                    final_count = final_count + "३";
                    break;
                case "4":
                    final_count = final_count + "४";
                    break;
                case "5":
                    final_count = final_count + "५";
                    break;
                case "6":
                    final_count = final_count + "६";
                    break;
                case "7":
                    final_count = final_count + "७";
                    break;
                case "8":
                    final_count = final_count + "८";
                    break;
                case "9":
                    final_count = final_count + "९";
                    break;
                
                }
               //final_count = final_count + test_arr.charAt(i);
            }
            return final_count;
        }

    JQ(document).on("click",".cross_row_kharid_edit",function() { 
       var confirmIt = function (e) {
          if (!confirm('Are you sure?')) e.preventDefault();
        };
       var item = JQ(this).closest("tr");
        item.remove();
        var count = 0;
        
        JQ("#kharidMaagEditTable tr").each(function(){
           // alert("inside row");
            var testnum = count;
            var test = testnum.toString();
            var nep_count = getNepCount(test);
           JQ(this).find('td:eq(0)').html(nep_count);
            count ++;
        });
        
    });
    JQ(document).on("click",".remove_more_prastabana",function() {
       // alert("here");
       JQ('.remove_prastabana_detail').last().remove();
        
        
    });
    
      JQ(document).on("input","#org",function() {
         var name = JQ(this).val();
         var org_id=  JQ("#main option[value='"+ name +"']").attr("data-id") || 0;
       JQ('#show_org').val(org_id);
         
         
      });
    
    
    //for jinsimaujdat barsikkharcha
    JQ(document).on("input","input[name~='in_use[]']",function() {
                var id_selected = JQ(this).attr("id");
                var id_split    = id_selected.split("_");
                var counter     = id_split[id_split.length-1];
                
                var prev_stock  = parseFloat(JQ('#prevstock_'+counter).val());
                var input_stock = parseFloat(JQ(this).val());
                if(prev_stock < input_stock)
                {
                    alert ("परिमाण मिलेन |");
                    JQ('#inuse_'+counter).val(0);
                    JQ('#notinuse_'+counter).val(0);
                    return false;
                }
                else
                {
                    var difference= (prev_stock - input_stock) || 0;
                }
                JQ('#notinuse_'+counter).val(difference);
                
        
    });
    
     JQ(document).on("input","input[name~='to_repair[]']",function() {
                var id_selected = JQ(this).attr("id");
                var id_split    = id_selected.split("_");
                var counter     = id_split[id_split.length-1];
                //alert(counter);
                var prev_stock  = parseFloat(JQ('#prevstock_'+counter).val());
                var input_stock = parseFloat(JQ(this).val());
                if(prev_stock < input_stock)
                {
                    alert ("परिमाण मिलेन |");
                    JQ('#torepair_'+counter).val(0);
                    JQ('#nottorepair_'+counter).val(0);
                    return false;
                }
                else
                {
                    var difference= (prev_stock - input_stock) || 0;
                }
                JQ('#nottorepair_'+counter).val(difference);
                
        
    });
    
    //ends
    
     // for bill control
    JQ(document).on("change","#selected_description_id",function(){
       var desc_id = JQ(this).val() || 0;
       var param = {};
       param.description_id = desc_id;
        JQ.post('get_new_bill_ids.php',param,function(res){
                   var obj = JSON.parse(res);
            JQ('#dispatch_from').val(obj.new_id);
       });
    });
    
    
     JQ(document).on("change","#description_id",function(){
       var desc_id = JQ(this).val() || 0;
       var param = {};
       param.description_id = desc_id;
      // alert(desc_id);
        JQ.post('get_bill_description.php',param,function(res){
                   var obj = JSON.parse(res);
                  // alert(obj.mmhtml);
             JQ('#rashid_no').val(obj.mmhtml);
             JQ('#valhtml').html(obj.html);
//            JQ('#total_rashid').val(obj.new_id);
//            JQ('#remaining_rashid').val(obj.remaining);
//            JQ('#dispatch_from').val(obj.new_id);
//            JQ('#dispatch_total').val(obj.new_id);
            
       });
    });
     JQ(document).on("click",".dispatch_checkbox",function(){
         
         var length = JQ('input[name="dispatch[]"]:checked').length;
         JQ("#dispatch_total").val(length);
     });
    
     JQ(document).on("input","#quantity_theli , #each",function(){
        var theli_qty = JQ("#quantity_theli").val() || 0;
        var per_theli =  JQ("#each").val() || 0;
        var dispatch_from = parseFloat(JQ("#dispatch_from").val()) || 0;
        var total_rashid = parseFloat(theli_qty) * parseFloat(per_theli);
        var last_rashid_number = dispatch_from + total_rashid -1;
        JQ("#dispatch_to").val(last_rashid_number);
        JQ("#dispatch_total").val(total_rashid);
    
     });
    
    
    
     JQ(document).on("click","#submitbilldispatch",function(){
         //alert('here');
         var max_date = JQ("#max_date").val() || 0;
         var selected_date = JQ(".bill_date").val() || 0;
      //  alert(max_date);
     //   alert(selected_date);
         var param ={};
         param.max_date = max_date;
         param.selected_date = selected_date;
          JQ.post("get_converted_date.php",param,function(res){
              var obj = JSON.parse(res);
              if(obj.a=='no')
              {
                  alert("यो मितीमा निकास गर्न मिलेन | कृपया यो भन्दा बढी मिती हाल्नुहोस |");
                  return false;
              }
              
          });
         
     });
    //ends
    
    
    JQ(document).on("input","input[name^='rate_tippani']",function() {
               var id_selected = JQ(this).attr("id");
                var id_split    = id_selected.split("-");
               var org_id      = id_split[id_split.length-1];
               var counter     = id_split[id_split.length-2];
               var amount  =0;
           JQ(".rate_tippani"+'-'+org_id).each(function(){
               var net =JQ(this).val() || 0;
             amount= parseFloat(amount)+ parseFloat(net);
       });
       JQ('#total_rate-'+org_id).val(amount);
    });
    
    
    //for selection of organization
    
//    JQ(document).on("input","input[name^='rate_tippani']",function() {
//        var id_selected = JQ(this).attr("id");
//        var id_split    = id_selected.split("-");
//        var org_id      = id_split[id_split.length-1];
//        var counter     = id_split[id_split.length-2];
//        var check       = {};
//       JQ(".rate_tippani-"+counter).each(function(){
//           alert(JQ(this).val());
//            check.org_id = 0;
            
 //      });
//       check.toString();
//       alert(check); return false;
//       var minimum_value = Math.min.apply(null, check);
//       alert(minimum_value); 
//       var class_selected = JQ(this).attr("class");
//        var class_split= class_selected.split("-");
//        var counter1= class_split[class_split.length-1];
//        var class_name= class_split[class_split.length-2];
//        var check = [];
//        var check_number = 0;
//      //alert(counter1);return false;
//          for(var i=1; i<counter1 ; i++)
//          {
//               var number = JQ(this).val();
//               var d_selected = JQ(this).attr("id");
//               var d_split= d_selected.split("-");
//               var org= d_split[d_split.length-1];
//               check[org].push(number);
//               JQ.each(check, function(index, value) { 
//                alert(index + ': ' + value); 
//            });
//          }
//          alert(check);
//          var amount = Math.min.apply(Math,check);
       
          
//    });
    
    
    
      JQ(document).on("click",".add_more_hastantaran",function() {
                           var num = JQ(".remove_hastantaran_detail").length;
			   var counter = num+2;
			   var param = {};
			   param.counter = counter;
                          JQ.post("get_hastantaran.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#add_hastantaran").append(obj.html);
				});
    });
    JQ(document).on("click",".remove_more_hastantaran",function() {
       // alert("here");
       JQ('.remove_hastantaran_detail').last().remove();
        
        
    });
    
    
       JQ(document).on("change","#worker_id",function() {
         var worker_id = JQ("#worker_id").val();
//         alert(worker_id);return false;
        var param = {};
        param.worker_id = worker_id;
         JQ.post('get_post.php',param,function(res){
        var obj = JSON.parse(res);
//        alert(obj.html);return false;
        JQ("#post").html(obj.html);
         });
    });
       
    JQ(document).on("click",".radioBtnClass",function() {
        var id_selected = JQ(this).attr("name");
        var id_split= id_selected.split("_");
        var counter= id_split[id_split.length-1];
        var radio = JQ("input[type='radio'][name='specification_type_"+counter+"']:checked").val();
         
    if(radio==1)
        {
            JQ("#reduce_amount_"+counter+"").hide();
            JQ("#increased_amount_"+counter+"").hide();
            JQ("#total_amount_"+counter+"").hide();
        }
      else
      {
          JQ("#reduce_amount_"+counter+"").show();
          JQ("#increased_amount_"+counter+"").show();
          JQ("#total_amount_"+counter+"").show();
      }
 
                 
    });

  
  // for maag js starts
  
        JQ(document).on("change","select[name~='item_id[]']",function() {
        
        var id_selected 	= JQ(this).attr("id");
	      var res 		= id_selected.split("-");
        var counter 		= res[res.length-1];
        var forurl = JQ("#forurl").val();
         var item_id    = JQ('#item_name-'+counter).val(); 
        if(forurl=="kharid")
        {
            var url = "get_item_details_more.php";
        }
        else
        {
            JQ('#prev_stock-'+counter).val('');
            JQ('#qty-'+counter).val('');
            var url = "get_item_details_more_kharcha.php";
        }
        
       
           
    		//var item_type_id	= JQ("#item_type_id-"+counter).val();
    		var category		= JQ("#category-"+counter).val();
    		 var param 				= {};
    		//param.item_type_id 		= item_type_id;
    		param.category			= category;
                    param.item_id			= item_id;
    		param.counter                   = counter;

    		JQ.post(url,param,function(res){
            
                    var obj = JSON.parse(res);
                    JQ("#specification-"+counter).val(obj.html);
                    JQ("#jinsi_id-"+counter).val(obj.html1);
                    JQ("#unit_id-"+counter).val(obj.html2);
                    if(forurl=="kharid")
                    {
                        JQ("#prev_stock-"+counter).html(obj.html3);
                    }
                    else
                    {
                        JQ("#rate-"+counter).html(obj.rate_html);
                       
                    }
            });
    });
    
        JQ(document).on("change","select[name~='category[]'],select[name~='item_type_id[]']",function() {
         var id_selected = JQ(this).attr("id");
         var res = id_selected.split("-");
         var counter = res[res.length-1];
         var category = JQ("#category-"+counter).val() || 0;
         var item_type_id = JQ("#item_type_id-"+counter).val() || 0;
         if(category==0 || item_type_id==0)
         {
            
                return false;
         }
        var param = {};
        param.counter = counter;
        param.category = category;
        param.item_type_id = item_type_id;
        JQ.post('get_item_details.php',param,function(res){
        var obj = JSON.parse(res);
         if (obj.check ==1)
         {
                    JQ("#specification-"+counter).val('');
                    JQ("#jinsi_id-"+counter).val('');
                    JQ("#unit_id-"+counter).val('');
                    JQ("#rate-"+counter).html('');
                    JQ("#prev_stock-"+counter).val('');
                    JQ("#qty-"+counter).val('');
         }
        if(category!=0 && item_type_id!=0)
         {
        JQ("#item_name-"+counter).html(obj.html);
         }
            });
    });
                 
                 
                 JQ(document).on("change",".item_name",function(){
                     var date = JQ(".date_check").val();
                       var id_selected = JQ(this).attr("id");
                       var res = id_selected.split("-");
                       var counter = res[res.length-1];
                      var item_id = JQ('#item_name-'+counter).val();
                      var param = {};
                      var category = JQ('#category-'+counter).val();
                      param.item_id = item_id;
                      param.category = category;
                      param.date     = date;
                     JQ.post('get_kharcha_date_details.php',param,function(res){
                                var obj = JSON.parse(res);
//                                alert(obj.sql); return false;
//                                alert(obj.a);return false;
                                var a = obj.check_empty;
                                var b = obj.check_date;
                                if(a==1)
                                {
                                    alert("स्टोक मा समान भेटिएन | ")
                                    return false;
                                }
                                if(b==1)
                                {
                                    alert("स्टोक मिती भन्दा खर्च मिती अगाडीको भयो |")
                                    return false;
                                }
		});
                 });
                 
    
		  JQ(document).on("click",".add_more",function() {
		     
         var forurl = JQ("#forurl").val();
         if(forurl=="kharid")
         {
             var url = "get_maag_details.php";
         }
         else
         {
             var url = "get_maag_details_kharcha.php";
         }
			   var num=JQ(".remove_post_detail").length;
			   var counter=num+2;
			   var param = {};
			   param.counter= counter;
		   
			   JQ.post(url,param,function(res){
				   var obj = JSON.parse(res);
				   JQ("#detail_add_table").append(obj.html);
				   JQ('.select2').select2();
				});
    });
    
    JQ(document).on("click",".add_more_edit",function() {
                           var forurl = JQ("#forurl").val();
                           if(forurl=="kharid")
                           {
                               var url = "get_maag_details.php";
                           }
                           else
                           {
                               var url = "get_maag_details_kharcha.php";
                           }
			   var num=JQ(".remove_post_detail").length;
			   var counter=num+1;
			   var param = {};
			   param.counter= counter;
		   
			   JQ.post(url,param,function(res){
				   var obj = JSON.parse(res);
				   JQ("#detail_add_table").append(obj.html);
				});
    });

      
	   JQ(document).on("click",".remove_more",function() {
       // alert("here");
       JQ('.remove_post_detail').last().remove();
        
        
    });
	   JQ(document).on("click","#maag_id_find",function() {
       var maag_id = JQ("#maag_id_input").val();
	   if(maag_id != "")
	   {
		   var url = window.location.href;
		   window.location = url + "?maag_id="+maag_id;
	   }
        
    });
    // for maag js ends 
    
    // for kharid adesh starts
    
     
      
      
      
      //for kharcha mag faram check item in stock and date
      
     JQ(document).on("input",".qty_check",function(){
       var id_selected = JQ(this).attr("id");
       var res = id_selected.split("-");
       var counter = res[res.length-1];
       var qty = JQ(this).val();
       var amount = JQ('#prev_stock-'+counter).val();
     //  alert(amount);
       
       if(parseFloat(qty)>parseFloat(amount))
       {
           alert("स्टक भन्दा खर्च बढी भयो");
           return false;
       }
           
        
    });
      
      
      //ends
      
      
      
        JQ(document).on("click","#adesh_id_find",function() {
       var adesh_id = JQ("#adesh_id_input").val();
       var url ="dakhila_newAdd.php";
         if(adesh_id != "")
	   {
		 //  var url = window.location.href;
		   window.location = url + "?adesh_id="+adesh_id;
	   }
           else
           {
               window.location = url;
           }
        
    });
    
    JQ(document).on("change","#bill_type",function() {
          var forurl = JQ("#forurl").val()
          if(forurl=='dakhila'){ return false;}
          var bill_type = JQ(this).val() || 0;
          if(bill_type==0){ return false;};
          
          var vat_amount = 0;
          var vat_total = 0;
          var total = 0;
          var sub_total = 0;
          var discount = JQ("#discount").val() || 0;
          var grand_total = 0;
          var extra_amount = '';
          var counter = 1;
          var rate_vat = '';
          var vat = 0;
            JQ(".calc").each(function () {
                var rate = JQ("#rate-"+counter).val();
                var qty = JQ("#qty-"+counter).val();
                if(bill_type==2)
                {
                    extra_amount = JQ("#extra_amount-"+counter).val() || 0;
                    vat = 13;
                    rate_vat = parseFloat(rate)+((13*parseFloat(rate))/100);
                    rate_vat = rate_vat.toFixed(2);
                    vat_amount = parseFloat(rate)*parseFloat(qty)*(13/100);
                    total = parseFloat(rate)*parseFloat(qty) + parseFloat(extra_amount);
                    total = total.toFixed(2);
                    sub_total = parseFloat(sub_total) + parseFloat(total);
                    vat_total = parseFloat(vat_total) + vat_amount;
                   
                    //grand_total = parseFloat(grand_total) + parseFloat(total);
                }
                else
                {
                    extra_amount = JQ("#extra_amount-"+counter).val();
                    total = parseFloat(rate)*parseFloat(qty) + parseFloat(extra_amount);
                    total = total.toFixed(2);
                    sub_total = parseFloat(sub_total) + parseFloat(total);
                    //grand_total = parseFloat(grand_total) + parseFloat(total);
                   
                }
                JQ("#vat-"+counter).val(vat);
               JQ("#rate_vat-"+counter).val(rate_vat);
                JQ("#total-"+counter).val(total);
                counter++;
        });
          
          grand_total = (parseFloat(sub_total)+parseFloat(vat_total)) - parseFloat(discount);
          grand_total = grand_total.toFixed(2);
          JQ("#sub_total").val(sub_total);
          if(vat_total>0)
          {
              JQ("#vat_row").show();
              vat_total = vat_total.toFixed(2);
              JQ("#vat_total").val(vat_total);
          }
          else
          {
              JQ("#vat_row").hide();
          }
          JQ("#grand_total").val(grand_total);
        
      });
      JQ(document).on("input","input[name~='extra_amount[]'], .refresh-qty, #discount",function() {
           var bill_type = JQ("#bill_type").val() || 0;
          if(bill_type==0 || forurl == 'dakhila'){ return false;};
          
          var vat_amount = 0;
          var vat_total = 0;
          var total = 0;
          var sub_total = 0;
          var discount = JQ("#discount").val() || 0;
          var grand_total = 0;
          var extra_amount = '';
          var counter = 1;
          var rate_vat = '';
          var vat = 0;
            JQ(".calc").each(function () {
                var rate = JQ("#rate-"+counter).val();
                var qty = JQ("#qty-"+counter).val();
                if(bill_type==2)
                {
                    extra_amount = JQ("#extra_amount-"+counter).val() || 0;
                    vat = 13;
                    rate_vat = parseFloat(rate)+((13*parseFloat(rate))/100);
                    vat_amount = parseFloat(rate)*parseFloat(qty)*(13/100);
                    total = parseFloat(rate)*parseFloat(qty) + parseFloat(extra_amount);
                    total = total.toFixed(2);
                    sub_total = parseFloat(sub_total) + parseFloat(total);
                    vat_total = parseFloat(vat_total) + vat_amount;
                   
                    //grand_total = parseFloat(grand_total) + parseFloat(total);
                }
                else
                {
                    extra_amount = JQ("#extra_amount-"+counter).val();
                    total = parseFloat(rate)*parseFloat(qty) + parseFloat(extra_amount);
                    total = total.toFixed(2);
                    sub_total = parseFloat(sub_total) + parseFloat(total);
                    //grand_total = parseFloat(grand_total) + parseFloat(total);
                   
                }
                JQ("#vat-"+counter).val(vat);
               JQ("#rate_vat-"+counter).val(rate_vat);
                JQ("#total-"+counter).val(total);
                counter++;
        });
          grand_total = (parseFloat(sub_total)+parseFloat(vat_total)) - parseFloat(discount);
          JQ("#sub_total").val(sub_total);
          if(vat_total>0)
          {
              JQ("#vat_row").show();
              JQ("#vat_total").val(vat_total);
          }
          
          JQ("#grand_total").val(grand_total);
        
      });

      // for kharid adesh on vat change 
       JQ(document).on("change","select[name~='vat_status[]']",function() {
          var forurl = JQ("#forurl").val();
          if(forurl=='dakhila')
          {
            return false;
          }
          
           var vat_status_val = parseFloat(JQ(this).val()) || 0;
           var id_selected = JQ(this).attr("id");
           var res = id_selected.split("-");
           var counter = res[res.length-1];
           var rate_id = 'rate-' + counter;
           var rate = JQ('#'+ rate_id).val();
          var qty = JQ("#qty-"+counter).val();
          var total = parseFloat(rate)* parseFloat(qty);
          var final_total = total.toFixed(2);
          JQ("#total-"+counter).val(final_total);
          //var total = 0;
        /*  JQ(".total").each(function () {
            var val = JQ(this).val();
            if(val=="")
            {
                val = 0;
               
            }
            total = parseFloat(total) + parseFloat(val);
          
        }); */
          if(vat_status_val == 1)
          {
            
            var vat_amount     = parseFloat(final_total * 0.13);
            var vat_total    = parseFloat(final_total * 1.13);
            JQ("#vat_amount-"+counter).val(vat_amount.toFixed(2));
            JQ("#vat_total-"+counter).val(vat_total.toFixed(2));
          }
          else
          {
            JQ("#vat_amount-"+counter).val(0);
            JQ("#vat_total-"+counter).val(final_total);
          }
        // for total without vat
        var total_without_vat = 0;
          JQ(".total").each(function () {
              var val = JQ(this).val() || 0;
              total_without_vat = parseFloat(total_without_vat) + parseFloat(val);
            
          }); 
          JQ("#total_without_vat").val(total_without_vat);
          // for total without vat ends

          // for total vat amount
          var total_vat_amount = 0;
           JQ(".vat_amount").each(function () {
              var val = JQ(this).val() || 0;
              total_vat_amount = parseFloat(total_vat_amount) + parseFloat(val);
            
          }); 
           JQ("#total_vat_amount").val(total_vat_amount);


          // for total with vat
          var total_with_vat = 0;
           JQ(".vat_total").each(function () {
              var val = JQ(this).val() || 0;
              total_with_vat = parseFloat(total_with_vat) + parseFloat(val);
            
          }); 
           JQ("#total_with_vat").val(total_with_vat);
      });
    // for kharid adesh ends
       JQ(document).on("input","input[name~='rate[]'],input[name~='qty[]']",function() {
          var forurl = JQ("#forurl").val();
          if(forurl=='dakhila')
          {
            return false;
          }
            var id_selected = JQ(this).attr("id");
           var res = id_selected.split("-");
           var counter = res[res.length-1];
            var rate_id = "rate-"+counter;
           var rate = parseFloat(JQ("#"+rate_id).val()) || 0;
           
           var vat_status_id = 'vat_status-' + counter;
           var vat_status_val = JQ('#'+ vat_status_id).val();
          var qty = JQ("#qty-"+counter).val();
          var total = parseFloat(rate)* parseFloat(qty);
          var final_total = total.toFixed(2);
          JQ("#total-"+counter).val(final_total);
          //var total = 0;
        /*  JQ(".total").each(function () {
            var val = JQ(this).val();
            if(val=="")
            {
                val = 0;
               
            }
            total = parseFloat(total) + parseFloat(val);
          
        }); */
          if(vat_status_val == 1)
          {
            
            var vat_amount     = parseFloat(final_total * 0.13);
            var vat_total    = parseFloat(final_total * 1.13);
            JQ("#vat_amount-"+counter).val(vat_amount.toFixed(2));
            JQ("#vat_total-"+counter).val(vat_total.toFixed(2));
          }
          else
          {
            JQ("#vat_amount-"+counter).val(0);
            JQ("#vat_total-"+counter).val(final_total);
          }
        // for total without vat
        var total_without_vat = 0;
          JQ(".total").each(function () {
              var val = JQ(this).val() || 0;
              total_without_vat = parseFloat(total_without_vat) + parseFloat(val);
            
          }); 
          JQ("#total_without_vat").val(total_without_vat);
          // for total without vat ends

          // for total vat amount
          var total_vat_amount = 0;
           JQ(".vat_amount").each(function () {
              var val = JQ(this).val() || 0;
              total_vat_amount = parseFloat(total_vat_amount) + parseFloat(val);
            
          }); 
           JQ("#total_vat_amount").val(total_vat_amount);


          // for total with vat
          var total_with_vat = 0;
           JQ(".vat_total").each(function () {
              var val = JQ(this).val() || 0;
              total_with_vat = parseFloat(total_with_vat) + parseFloat(val);
            
          }); 
           JQ("#total_with_vat").val(total_with_vat);
      });

  // for maag kharcha starts 
    
         JQ(document).on("change","select[name~='rate[]']",function() {
          if(forurl=='dakhila')
          {
            return false;
          }
         var rate = JQ(this).val();
        
         var id_selected = JQ(this).attr("id");
          

         var res = id_selected.split("-");
         var counter = res[res.length-1];
        // var item_id_selected = 'item_id-'+counter;

         var item_id = JQ("#item_name-"+counter).val();
         var category = JQ("#category-"+counter).val();
        // alert(counter+ " " + item_id + " " + category + " " + rate );
          if(rate=="")
         {
             alert("Select a rate");
             JQ("#prev_stock-"+counter).val("");
             return false;
         }
          /*JQ("select[name~='item_id[]']").each(function() {
           var id_check_sel = JQ(this).attr('id'); 
           if(id_check_sel == item_id)
           {

           }
           else
           {
              var id_check       = JQ("#"+id_check_sel).val();
              var res_rate        = id_check_sel.split("-");
              var rate_check_count = res_rate[res_rate.length-1];
              var rate_sel_id = "#rate_selected-"+rate_check_count;
             var rate_check = JQ(rate_sel_id).val();
              //var rate_check = JQ().val();
              //alert(rate_check + "--" + rate);
              if((parseFloat(id_check) == parseFloat(item_id)) && (parseFloat(rate_check) == parseFloat(rate)) )
              {
                 
                 JQ(this).closest("tr").css("background-color","#FF0000");
                
                //JQ(item).css("background-color","#FF0000");
                alert("माथि यो जिन्सी समान  राखी सकेको छ")
              } 
           }
         }); */
//        alert(item_type_id);exit;
        var date = JQ('.date_check').val();
        var param = {};
        param.counter = counter;
        param.item_id   = item_id;
        param.category  = category;
        param.rate      = rate;
        param.date      = date;
        var forurl = JQ("#forurl").val();
        var url  = JQ("#url").val();
        JQ('#qty-'+counter).attr('readonly', false);
        if(forurl=="kharcha")
        {
           
           
            JQ.post('find_final_store.php',param,function(res){
                 var obj = JSON.parse(res);
               
                 if(obj.check != 1)
                 {
                    var maag_qty = JQ('#maag_qty-'+counter).html();
                    if(parseFloat(maag_qty)> obj.stock)
                    {
                      alert("माग भन्दा मौज्दात कम भयो");
                      JQ('#qty-'+counter).val('');
                    }
                    else
                    {
                      JQ('#qty-'+counter).val(maag_qty);
                    }
                   JQ('#prev_stock-'+counter).val(obj.stock);  
                   if(obj.stock ==0)
                   {
                       JQ('#qty-'+counter).attr('readonly', true);
                   }
                 }
                 else
                 {
                   alert(obj.msg);
                 }
                    
            });
        }
        if(url==='ledger')
        {
             JQ.post('get_item_details_for_ledger.php',param,function(res){
                var obj  = JSON.parse(res);
                //alert(obj.total_quanitity);return false;
                JQ("#safal-"+counter).html(obj.total_quanitity);
             });
        }
       
       
        
    });
  
   // for maag kharcha ends 
});