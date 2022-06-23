var JQ = jQuery.noConflict();
JQ(document).ready(function(){
    //for log book machinary
 JQ(document).on("input","input[name~='km_to[]'],input[name~='km_from[]']",function(){
    var id_selected = JQ(this).attr("id");
    var id_split= id_selected.split("_");
    var counter= id_split[id_split.length-1];
    var km_to = JQ("#km_to_"+counter).val()||0;
    var km_from = JQ("#km_from_"+counter).val()||0;
    var total = parseFloat(km_from) - parseFloat(km_to);
   JQ("#total_km_"+counter).val(total);
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
 
 JQ(document).on("click",".add_more_log",function() {
        
                            var num = JQ(".remove_log_detail").length;
//                            alert(num);return false;
			   var counter = num+2;
			   var param = {};
			   param.counter = counter;
                          JQ.post("get_logbook_html.php",param,function(res){
				   var obj = JSON.parse(res);
//                                   alert(obj.html);return false;
                                   JQ("#add_logbook").append(obj.html);
				});
    });
    JQ(document).on("click",".remove_more_log",function() {
     
       JQ('.remove_log_detail').last().remove();
        
        
    });
    //for jinsi_minha 
  JQ(document).on("input","input[name~='actual_reduced_stock[]']",function() {
      var id_selected = JQ(this).attr("id");
       var id_split= id_selected.split("_");
      var counter= id_split[id_split.length-1];
      var actual_reduced_stock = JQ(this).val();
      var prev_stock = JQ("#reduce_lilam_stock_"+counter).val();
//      alert(prev_stock);return false;
      if(parseFloat(actual_reduced_stock) > parseFloat(prev_stock))
      {
          alert("घटाउने स्टक धेरै भयो ");
          JQ("#actual_reduced_stock_"+counter).val(0);
          return false;
      }
      else
      {
          return true;
      }
        
       });

  /// for tippani getting the organization name for kharid
  JQ(document).on("change","#tippani_kharid_id",function() {
         var kharid_id = JQ(this).val();
        var param = {};
       
        param.kharid_id = kharid_id;
         JQ.post('get_org_for_tippani.php',param,function(res){
                 var obj = JSON.parse(res);
                 JQ("#org_list_selected").html(obj.html);
            });
   });
    //for machinary
    JQ(document).on("change","select[name~='item_id[]']",function() {
         var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("-");
        var counter= id_split[id_split.length-1];
        var item_id = JQ(this).val();
       var category = JQ("#category-"+counter).val();
//        alert(category);return false;
        var param = {};
        param.item_id = item_id;
        param.category = category;
         JQ.post('get_machine_unit_details.php',param,function(res){
         var obj = JSON.parse(res);
       JQ("#unit_machinary_"+counter).html(obj.html);
    });
        
    });
    JQ(document).on("input","input[name~='item_amount[]'],input[name~='item_rate[]']",function() {
         var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("_");
        var counter= id_split[id_split.length-1];
        var item_amount = JQ("#item_amount_"+counter).val();
        var item_rate = JQ("#item_rate_"+counter).val()||0;
//       alert(item_rate);return false;
        var total = parseFloat(item_amount) * parseFloat(item_rate);
         JQ("#total_amount_"+counter).val(total);
         var total = 0;
        var classname = JQ("#total_amount_"+counter).attr("class");
//        alert(classname);return false;
        JQ('input[type="text"].'+classname).each(function () {
                        var val = JQ(this).val();
                       
                        if(val=="")
                        {
                            val = 0;
                           
                        }
                        
                      total = parseFloat(total) + parseFloat(val);
        });
         JQ("#grand_total_machinary").val(total);
          if (JQ("#check_vat_machinary").is(':checked'))
          {
             var total_amount = JQ("#grand_total_machinary").val()||0;
             var total = parseFloat(total_amount) * 0.13;
             JQ("#vat_amount_machinary").val(total);
           
            } 
            else
            {
                JQ("#vat_amount_machinary").val(0);
                var total_amount1 = JQ("#grand_total_machinary").val()||0;
                JQ("#sum_amount_machinary").val(total_amount1);
            }
         
    });
     JQ(document).on("input","input[name~='item_amount[]']",function() {
         var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("_");
        var counter= id_split[id_split.length-1];
        var item_amount = JQ("#item_amount_"+counter).val();
        var item_rate = JQ("#item_rate_"+counter).val()||0;
//       alert(item_rate);return false;
        var total = parseFloat(item_amount) * parseFloat(item_rate);
         JQ("#total_amount_"+counter).val(total);
         var total = 0;
        var classname = JQ("#total_amount_"+counter).attr("class");
//        alert(classname);return false;
        JQ('input[type="text"].'+classname).each(function () {
                        var val = JQ(this).val();
                       
                        if(val=="")
                        {
                            val = 0;
                           
                        }
                        
                      total = parseFloat(total) + parseFloat(val);
        });
         JQ("#grand_total_machinary").val(total);
          if (JQ("#check_vat_machinary").is(':checked'))
          {
             var total_amount = JQ("#grand_total_machinary").val()||0;
             var total = parseFloat(total_amount) * 0.13;
             JQ("#vat_amount_machinary").val(total);
           
            } 
            else
            {
                JQ("#vat_amount_machinary").val(0);
                var total_amount1 = JQ("#grand_total_machinary").val()||0;
                JQ("#sum_amount_machinary").val(total_amount1);
            }
         
    });
    JQ(document).on("input","input[name~='item_rate[]']",function() {
        if(forurl == 'dakhila')
        {
            return false;
        }
         var id_selected = JQ(this).attr("id");
        
        var id_split= id_selected.split("_");
        var counter= id_split[id_split.length-1];
        var item_amount = JQ("#item_amount_"+counter).val();
        var item_rate = JQ("#item_rate_"+counter).val()||0;
//       alert(item_rate);return false;
        var total = parseFloat(item_amount) * parseFloat(item_rate);
         JQ("#total_amount_"+counter).val(total);
         var total = 0;
        var classname = JQ("#total_amount_"+counter).attr("class");
//        alert(classname);return false;
        JQ('input[type="text"].'+classname).each(function () {
                        var val = JQ(this).val();
                       
                        if(val=="")
                        {
                            val = 0;
                           
                        }
                        
                      total = parseFloat(total) + parseFloat(val);
        });
         JQ("#grand_total_machinary").val(total);
          if (JQ("#check_vat_machinary").is(':checked'))
          {
             var total_amount = JQ("#grand_total_machinary").val()||0;
             var total = parseFloat(total_amount) * 0.13;
             JQ("#vat_amount_machinary").val(total);
           
            } 
            else
            {
                JQ("#vat_amount_machinary").val(0);
                var total_amount1 = JQ("#grand_total_machinary").val()||0;
                JQ("#sum_amount_machinary").val(total_amount1);
            }
         
    });
   
         JQ(document).on("click","#check_vat_machinary",function() {
         if (JQ("#check_vat_machinary").is(':checked')) {
             var total_amount = JQ("#grand_total_machinary").val()||0;
             var total = parseFloat(total_amount) * 0.13;
             JQ("#vat_amount_machinary").val(total);
             var total_amount1 = JQ("#grand_total_machinary").val()||0;
             var check_vat_machinary1 = JQ("#vat_amount_machinary").val()||0;
             var total1 = parseFloat(total_amount1) + parseFloat(check_vat_machinary1);
             var total11 = total1.toFixed(2);
             JQ("#sum_amount_machinary").val(total11);
            } 
            else
            {
                JQ("#vat_amount_machinary").val(0);
                var total_amount1 = JQ("#grand_total_machinary").val()||0;
                JQ("#sum_amount_machinary").val(total_amount1);
            }
       });
     JQ(document).on("change","#machine_id",function() {
        var machine_id = JQ(this).val();
        var param = {};
        param.machine_id = machine_id;
         JQ.post('get_machine_details.php',param,function(res){
         var obj = JSON.parse(res);
//         alert(obj.html);return false;
        JQ("#type").val(obj.type);
        JQ("#model").val(obj.model);
        JQ("#darta_no").val(obj.darta_no);
                 });
       
 });
    JQ(document).on("click",".add_more_machine",function() {
        
                            var num = JQ(".remove_machine_detail").length;
			   var counter = num+2;
			   var param = {};
			   param.counter = counter;
                          JQ.post("get_machine_html.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#machinary_add").append(obj.html);
				});
    });
    JQ(document).on("click",".remove_more_machine",function() {
     
       JQ('.remove_machine_detail').last().remove();
        
        
    });
     // marmat adesh add more
     JQ(document).on("click",".add_more_marmat",function() {
        
                            var num = JQ(".remove_marmat_detail").length;
			   var counter = num+2;
			   var param = {};
			   param.counter = counter;
                          JQ.post("get_marmat_html.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#adesh_add").append(obj.html);
				});
    });
    JQ(document).on("click",".remove_more_marmat",function() {
     
       JQ('.remove_marmat_detail').last().remove();
        
        
    });
    //for jinsililam approve
    JQ(document).on("input","input[name~='reduce_stock[]']",function() {
        var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("_");
        var counter= id_split[id_split.length-1];
        var prev_stock = JQ("#prev_stock_"+counter).val();
        var reduce_stock = JQ(this).val();
        var total = parseFloat(prev_stock) - parseFloat(reduce_stock);
        
        if(total < 0)
        {
            alert("STOCK भन्दा धेरै भयो....कृपया STOCK भन्दा धेरै नहाल्नु होस् ..");
            JQ("#reduce_stock_"+counter).val(0);
            return false;
        }
       
 });
    //jinsi nirikshan
    JQ(document).on("input","input[name~='current_status_active[]']",function() {
        var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("_");
        var counter= id_split[id_split.length-1];
        var prev_stock = JQ("#prev_stock_"+counter).val();
        var current_status_active = JQ(this).val();
        var total = parseFloat(prev_stock) - parseFloat(current_status_active);
        
        if(total < 0)
        {
            alert("STOCK भन्दा धेरै भयो....कृपया STOCK भन्दा धेरै नहाल्नु होस् ..");
            JQ("#current_status_active_"+counter).val(0);
            return false;
        }
        else
        {
            JQ("#current_status_inactive_"+counter).val(total);
        }
        if( JQ(this).val().length == "")
        {
            JQ("#current_status_inactive_"+counter).val(0);
        }
 });
 JQ(document).on("input","input[name~='reduce_amount[]']",function() {
        var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("_");
        var counter= id_split[id_split.length-1];
        var prev_stock = JQ("#prev_stock_"+counter).val();
        var reduce_amount = JQ(this).val();
        var total = parseFloat(prev_stock) - parseFloat(reduce_amount);
        
        if(total < 0)
        {
            alert("STOCK भन्दा धेरै भयो....कृपया STOCK भन्दा धेरै नहाल्नु होस् ..");
             JQ("#reduce_amount_"+counter).val(0);
            return false;
        }
        
       
 });
 
  //for bhada 
   JQ(document).on("click",".add_more_bhada_taken",function() {
                           var num = JQ(".remove_bhada_details_taken").length;
			   var counter = num+2;
			   var param = {};
			   param.counter = counter;
                          JQ.post("get_bhada_add_details_taken.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#get_bhada_div_taken").append(obj.html);
				});
    });
    JQ(document).on("click",".remove_more_bhada_taken",function() {
       // alert("here");
       JQ('.remove_bhada_details_taken').last().remove();
        
        
    });
  
  
  
     JQ(document).on("change","#bhada_enlist_name",function() {
         var id = JQ(this).val();
         var param = {};
         param.id= id;
        JQ.post("get_bhada_enlist_address.php",param,function(res){
           var obj = JSON.parse(res);
           JQ('#bhada_enlist_address').val(obj.address);
           JQ('#bhada_enlist_number').val(obj.number);
            JQ('#khata_id').val(obj.khata_id);
         
     });
 });
    
      JQ(document).on("click",".add_more_bhada",function() {
                           var num = JQ(".remove_bhada_details").length;
			   var counter = num+2;
			   var param = {};
			   param.counter = counter;
                          JQ.post("get_bhada_add_details.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#get_bhada_div").append(obj.html);
				});
    });
    JQ(document).on("click",".remove_more_bhada",function() {
       // alert("here");
       JQ('.remove_bhada_details').last().remove();
        
        
    });
     JQ(document).on("input","input[name~='period[]'],input[name~='period_rate[]'],input[name~='qty[]']",function() {
        if(forurl == 'dakhila')
        {
            return false;
        }
        var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("_");
        var counter= id_split[id_split.length-1];
        var period = JQ('#period_'+counter).val() || 0;
        var period_rate =JQ('#period_rate_'+counter).val() || 0; 
        var qty = JQ('#qty_'+counter).val() || 0;
        var total = parseFloat(period) * parseFloat(period_rate) * parseFloat(qty);
        JQ('#bhada_amount_'+counter).val(total);
     });
    
    
    
    
    //ends
    
    //for ledger
    
    JQ(document).on("input",".qty_ledger_check",function() {
        var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("-");
        var counter= id_split[id_split.length-1];
        var total_qty  = JQ("#total_quantity_"+counter).val();
        var qty = JQ(this).val() || 0;
        if(parseFloat(qty)>parseFloat(total_qty))
        {
            alert("परिणाम मिलेन | ");
            JQ(this).val(0);
            return false;
        }
});
    
     JQ(document).on("change","select[name~='item_id[]']",function() {
          var url = JQ('#url').val();
          if(url!="ledger")
          {
              return false;
          }
          else
          {
               var id_selected = JQ(this).attr("id");
                var id_split= id_selected.split("-");
                var counter= id_split[id_split.length-1];
                var category = JQ("#category-"+counter).val();
                var item_id= JQ(this).val();
        //        alert(category);return false;
                var param = {};
                param.counter = counter;
                param.category = category;
                param.item_id = item_id;
                 JQ.post('get_hastantaran_details.php',param,function(res){
                var obj = JSON.parse(res);
        //        alert(obj.stock_item_id);return false;
                JQ("#stock_item_id_"+counter).html(obj.stock_item_id);
                JQ("#budget_title_id_"+counter).html(obj.budget_title_id);
                JQ("#specification_"+counter).html(obj.specification);
                 });
          }
      });
    
    
    
    //ends
    //for discount kharid adesh
    JQ(document).on("input","#discount_amount",function() {
        var discount_amount= JQ("#discount_amount").val() ||0;
        var total_amount = JQ("#total_amount").val() || 0;
        if(parseFloat(total_amount) < parseFloat(discount_amount))
        {
            alert("रकम धेरै भयो ....");
            return false;
        }
        var total_amount1 = parseFloat(total_amount) - parseFloat(discount_amount);
         JQ("#net_total_amount").val(total_amount1);
 });
    //for jinsi tippani addesh
    JQ(document).on("change","select[name~='orgs_id[]']",function() {
        var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("-");
        var counter= id_split[id_split.length-1];
        var org_id =  JQ(this).val();
        var kharid_id = JQ("#kharid_id-"+counter).val();
        var item_id =JQ("#item_id-"+counter).val();
        var category =JQ("#category-"+counter).val();
//        alert(category);return false;
        var param = {};
        param.kharid_id      = kharid_id;
        param.item_id = item_id;
        param.category = category;
        param.org_id = org_id;
        JQ.post("get_item_rate_for_tippani_adesh.php",param,function(res){
        var obj = JSON.parse(res);
//        alert(obj.html);return false;
        JQ("#tippani_rate-"+counter).html(obj.html);
 });
    });
    //for inserting stock
     JQ(document).on("click",".add_more_stock",function() {
                           var num = JQ(".remove_stock_detail").length;
			   var counter = num+2;
			   var param = {};
			   param.counter = counter;
                          JQ.post("get_inserted_stock.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#detail_add_table_stock").append(obj.html);
                                   JQ('.select2').select2();
				});
    });
    JQ(document).on("click",".remove_more_stock",function() {
       // alert("here");
       JQ('.remove_stock_detail').last().remove();
        
        
    });
//    for tippani
JQ(document).on("input","input[name~='rate_tippani[]']",function() {
            var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("-");
        var counter= id_split[id_split.length-1];
        var rate= JQ("#rate_tippani-"+counter).val() ||0;
        var qty_tippani = JQ("#qty_tippani-"+counter).val() ||0;
        var total_amount = parseFloat(rate) * parseFloat(qty_tippani);
         JQ("#total_tippani_amount-"+counter).val(total_amount);
 });
JQ(document).on("input","input[name~='rate_tippani[]']",function() {
            var total = 0;;
         JQ('.total_tippani_amount').each(function () {
                        var val = JQ(this).val() || 0;
                        total = parseFloat(total) + parseFloat(val);
                   
        });
         JQ("#total_rate").val(total);
 });
 JQ(document).on("input","input[name^='rate_tippani-']",function() {
           var total_items = JQ(".item_row").length;
            var rate = JQ(this).val();
           var name = JQ(this).attr("name");
           var id_selected = JQ(this).attr("id");
           var split_id = id_selected.split("-");
           var org_id = split_id[split_id.length-1];
           //alert(org_id);
//           var qty = JQ("#qty_tippani-"+counter).val();
//           var total = parseFloat(rate)*parseFloat(qty);
           var sub_total = 0;
           for(var k=1; k<=total_items; k++)
           {
               var rate = JQ("#rate_tippani-"+k+"-"+org_id).val() || 0;
                var qty = JQ("#qty_tippani-"+k).val() || 0;
               var total = parseFloat(rate)*parseFloat(qty);
               sub_total = parseFloat(sub_total)+total;
           }
//           JQ("input[name='"+name+"']").each(function(){
//                    var sel_val  = parseFloat(JQ(this).val()) || 0;
//                    var loop_total = sel_val * 
//                    val = parseFloat(val)+parseFloat(sel_val);
//               });
//               alert(val); return false;
            JQ("#total_rate-"+org_id).val(sub_total);
           
 });
    JQ(document).on("input","#jinsi_kharid_id",function() {
        var kharid_id= JQ("#jinsi_kharid_id").val();
        var param = {};
        param.kharid_id      = kharid_id;
         JQ.post('get_organization_list_tippani.php',param,function(res){
        var obj = JSON.parse(res);
//        alert(obj.html);return false;
        if(obj.html.length!="")
        {
            
            JQ("#jinsi_org").html(obj.html);
        }
        else
        {
           JQ("#jinsi_org").html(obj.html);
        }
});
     
    });
    //for prastabana
    JQ(document).on("blur","#kharid_add_prastabana",function() {
        var kharid_id= JQ("#kharid_add_prastabana").val();
        var param = {};
        param.kharid_id      = kharid_id;
         JQ.post('get_kharid_id_check_for_prastabana.php',param,function(res){
        var obj = JSON.parse(res);
        if(obj.html.length!="")
        {
           alert(obj.html);return false;
        }
        else
        {
            return true;
        }
});
     
    });
    //aanya prastabana 
   
    JQ(document).on("click",".add_more_aanya_organization",function() {
                           var num = JQ(".remove_aanya_organization_detail").length;
			   var counter = num+2;
			   var param = {};
			   param.counter = counter;
                          JQ.post("get_aanya_organization.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#add_aanya_organization").append(obj.html);
				});
    });
    JQ(document).on("click",".remove_more_aanya_organization",function() {
//        alert("here");return false;
       JQ(".remove_aanya_organization_detail").last().remove();
        
        
    });
     JQ(document).on("click",".add_more_aanya_reason",function() {
                           var num = JQ(".remove_aanya_reason_detail").length;
			   var counter = num+2;
			   var param = {};
			   param.counter = counter;
                          JQ.post("get_aanya_reason.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#aanya_prastabana_reason").append(obj.html);
				});
    });
    JQ(document).on("click",".remove_more_aanya_reason",function() {
//        alert("here");return false;
       JQ(".remove_aanya_reason_detail").last().remove();
        
        
    });
//    for sghar jagga avilekh
    JQ(document).on('change','input[name~="length[]"],input[name~="breadth[]"],select[name~="floor[]"]',function(){
        var id= JQ(this).attr("id");
        var res = id.split("_");
        var counter = res[res.length-1];
        var length  = JQ('#length_'+counter).val() || 0;
        var breadth = JQ('#breadth_'+counter).val() || 0;
        var floor = JQ('#floor_'+counter).val() || 0;
        var area = parseFloat(length)*parseFloat(breadth)*parseFloat(floor);
        JQ('#b_area_'+counter).val(area);
    });
JQ(document).on('input','input[name~="length[]"],input[name~="breadth[]"],select[name~="floor[]"]',function(){
        var id= JQ(this).attr("id");
        var res = id.split("_");
        var counter = res[res.length-1];
        var length  = JQ('#length_'+counter).val() || 0;
        var breadth = JQ('#breadth_'+counter).val() || 0;
        var floor = JQ('#floor_'+counter).val() || 0;
        var area = parseFloat(length)*parseFloat(breadth)*parseFloat(floor);
        JQ('#b_area_'+counter).val(area);
    });



     JQ(document).on("click","#check_ghar",function() {
                
                if(JQ(this).is(':checked'))
                {
                    JQ("#check_ghar_div").show();
                   
                }
                else
                {
                    JQ("#check_ghar_div").hide();
                }
                var param = {};
                var kitta = [];
             JQ('.kn').each(function(){
                var kn = JQ(this).val();
                kitta.push(kn);
             });
             var html = '';
             html += '<select name="land_kn[]"><option value="">छान्नुहोस्</option>';
            kitta.forEach(function(element) {
                html += '<option value="'+element+'">'+element+'</option>';
              });
               html +='</select>';
            JQ('.kn_ghar').html(html);    
        });
            
    JQ(document).on("click",".add_ghar_jagga",function() {
                           var num = JQ(".ghar_jagga_details").length;
			   var counter = num+2;
			   var param = {};
			   param.counter = counter;
                          JQ.post("get_more_ghar_jagga_kitta.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#add_more_kitta").append(obj.html);
				});
    });
    JQ(document).on("click",".remove_ghar_jagga",function() {
//        alert("here");return false;
       JQ(".ghar_jagga_details").last().remove();
        
        
    });
        JQ(document).on("click",".add_jagga",function() {
                           var num = JQ(".ghar_details").length;
                           var html = JQ(".kn_ghar").html();
			   var counter = num+2;
			   var param = {};
			   param.counter = counter;
                           param.sel= html;
                          JQ.post("get_more_jagga_kitta.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#show_ghar_details").append(obj.html);
                                   
				});
    });
    JQ(document).on("click",".remove_ghar",function() {
//        alert("here");return false;
       JQ(".ghar_details").last().remove();
        
        
    });
//    for hasrantaran
JQ(document).on("input","input[name~='quantity[]']",function() {
      var id_selected = JQ(this).attr("id");
      var id_split= id_selected.split("_");
      var counter = id_split[id_split.length-1];
      var rate = JQ("#rate_selected-"+counter).val();
//      var total_quantity = JQ("#total_quantity_"+counter).val();
      var quantity = JQ(this).val();
      var total = parseFloat(rate) * parseFloat(quantity);
      JQ("#total_amount_"+counter).val(round(total,2).toFixed(2));
//      alert(quantity);return false;
  });
JQ(document).on("change","select[name~='rate_hastantaran[]']",function() {
      var forurl = JQ("#forurl").val();
        if (typeof forurl === 'undefined')
        {
            return false;
        }
        var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("-");
        var counter= id_split[id_split.length-1];
        var category= JQ("#category_"+counter).val();
        var item_id=JQ("#item_id_"+counter).val();
        var rate = JQ(this).val();
        var param = {};
        param.counter  = counter;
        param.item_id  = item_id;
        param.category =category;
        param.rate = rate;
        JQ.post('get_item_details_for_hastantaran.php',param,function(res){
        var obj = JSON.parse(res);
        JQ("#safal-"+counter).html(obj.total_quanitity);
        JQ("#amulya-"+counter).html(obj.quantity);
        JQ("#dhiraj-"+counter).html(obj.total_amount);
        JQ("#sanjay-"+counter).html(obj.created_date);
        JQ("#pravin-"+counter).html(obj.current_status);
        
         });
     
    });
JQ(document).on("change","select[name~='item_id[]']",function() {
        var forurl = JQ("#forurl").val();
//        alert(forurl);return false;
//        if (typeof forurl === 'undefined')
//        {
//            return false;
//        }
    if(forurl!=='kharid' && forurl !=='kharcha')
    {
        var id_selected = JQ(this).attr("id");
//        alert(id_selected);return false;
        var id_split= id_selected.split("_");
        var counter= id_split[id_split.length-1];
        var category = JQ("#category_"+counter).val();
        var item_id= JQ(this).val();
//         alert(counter);return false;
        var param = {};
        param.counter = counter;
        param.category = category;
        param.item_id = item_id;
         JQ.post('get_rate_hastantaran.php',param,function(res){
        var obj = JSON.parse(res);
        // alert(obj.html);return false;
//        if(obj.stock_message.length!="")
//        {
//                JQ("#rate_stock_"+counter).html(obj.html);
//                alert(obj.stock_message);
//              
//        }
//        else
//        {
//            JQ("#rate_stock_"+counter).html(obj.html);
//        }
        JQ("#rate-"+counter).html(obj.rate_html);
            
         });
      }
     
    });
JQ(document).on("change","select[name~='category[]']",function() {
      var forurl = JQ("#forurl").val();
      if(forurl=='dakhila' || forurl == 'kharid' || forurl=='kharcha')
      {
          return false;
      }
        if (typeof forurl === 'undefined')
        {
            return false;
        }
        var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("_");
        var counter= id_split[id_split.length-1];
        var category= JQ("#category_"+counter).val();
        var item_type_id=JQ("#item_type_id_"+counter).val();
        var param = {};
        param.counter = counter;
        param.item_type_id  =item_type_id;
        param.category      =category;
         JQ.post('get_item_name_for_hastantaran.php',param,function(res){
        var obj = JSON.parse(res);
        // alert(obj.html);return false;
        JQ("#item_name-"+counter).html(obj.html);
        
         });
     
    });
    
//    check stock for hastantaran
// JQ(document).on("input","[name^='stock_id'],[name^='quantity']",function() {
//         var id_selected = JQ(this).attr("id");
//         var id_split= id_selected.split("_");
//         var counter= id_split[id_split.length-1];
// //        alert(id_selected);return false;
//         var item_id= JQ("#stock_id_"+counter).val();
//         var quantity = JQ("#quantity_"+counter).val();
// //        alert(item_id);return false;
//       var param = {};
//       param.counter   =counter;
//         param.item_id  = item_id;
//         param.quantity =quantity;
//          JQ.post('get_stock_check_for_hastantaran.php',param,function(res){
//         var obj = JSON.parse(res);
//         alert(obj.output);return false;
        
//          });
//     });
    
//   JQ(document).on("input","[name^='stock_id'],[name^='quantity']",function() {
//         var id_selected = JQ(this).attr("id");
//         var id_split= id_selected.split("_");
//         var counter= id_split[id_split.length-1];
// //        alert(id_selected);return false;
//         var item_id= JQ("#stock_id_"+counter).val();
//         var quantity = JQ("#quantity_"+counter).val();
// //        alert(item_id);return false;
//       var param = {};
//       param.counter   =counter;
//         param.item_id  = item_id;
//         param.quantity =quantity;
//          JQ.post('get_total_hastantaran_amount.php',param,function(res){
//         var obj = JSON.parse(res);
// //        alert(obj.html);return false;
//         JQ("#total_amount_"+counter).val(obj.html);
//          });
//     });
//     JQ(document).on("input","input[name~='quantity[]']",function() {
//         var id_selected = JQ(this).attr("id");
//         var id_split= id_selected.split("_");
//         var counter= id_split[id_split.length-1];
//         var item_id= JQ("#item_id_"+counter).val();
//         var quantity=JQ("#quantity_"+counter).val();
// //        alert(quantity);return false;
//       var param = {};
//       param.counter=counter;
//         param.item_id = item_id;
//         param.quantity=quantity;
//          JQ.post('get_total_hastantaran_amount.php',param,function(res){
//         var obj = JSON.parse(res);
// //        alert(obj.output);return false;
//         JQ("#total_amount_"+counter).val(obj.html);
//          });
//     });
    JQ(document).on("change","select[name~='item_id[]']",function() {
        var forurl = JQ("#forurl").val();
        if (typeof forurl === 'undefined')
        {
            return false;
        }
       if(forurl!="kharid" && forurl !="kharcha")
       { 
        var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("_");
        var counter= id_split[id_split.length-1];
        var category = JQ("#category_"+counter).val();
        var item_id= JQ(this).val();
//        alert(category);return false;
        var param = {};
        param.counter = counter;
        param.category = category;
        param.item_id = item_id;
         JQ.post('get_hastantaran_details.php',param,function(res){
        var obj = JSON.parse(res);
//        alert(obj.stock_item_id);return false;
        JQ("#stock_item_id_"+counter).html(obj.stock_item_id);
        JQ("#budget_title_id_"+counter).html(obj.budget_title_id);
        JQ("#specification_"+counter).html(obj.specification);
         });
      }
    });
    
    
//    for jinsi minha
    
   JQ(document).on("change","#category",function() {
        var item_type_id = JQ("#item_type_id").val();
        var category     =  JQ("#category").val();
        var param = {};
        param.item_type_id = item_type_id;  
        param.category     = category;
         JQ.post('get_item_name_for_jinsiminha.php',param,function(res){
        var obj = JSON.parse(res);
     JQ("#item_name").html(obj.html);
         });
        });
    JQ(document).on("change","#item_type_id",function() {
        var item_type_id = JQ("#item_type_id").val();
        var category     =  JQ("#category").val();
        var param = {};
        param.item_type_id = item_type_id;  
        param.category     = category;
         JQ.post('get_item_name_for_jinsiminha.php',param,function(res){
        var obj = JSON.parse(res);
         JQ("#item_name").html(obj.html);
             });
    });
  
 JQ(document).on("input","input[name~='reduce_amount[]']",function() {
        var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("_");
        var counter= id_split[id_split.length-1];
        var reduce_amount  = JQ("#reduce_amount_"+counter).val();
        if(reduce_amount.lenth==0)
        {
             JQ("#increased_amount_"+counter).attr("disabled","false");
        }
        else
        {
             JQ("#increased_amount_"+counter).attr("disabled","true");
        }
       
        var spent_item_id= JQ("#spent_item_id_"+counter).val();
//        alert(spent_item_id);return false;
       param={};
        param.spent_item_id = spent_item_id;  
        param.reduce_amount = reduce_amount;
       JQ.post('get_total_amount_jinsi_nirakshan.php',param,function(res){
        var obj = JSON.parse(res);
//        alert(obj.html);return false;
         JQ("#total_amount_"+counter).val(obj.html);
             });
    });
         
         JQ(document).on("input","input[name~='increased_amount[]']",function() {
        var id_selected = JQ(this).attr("id");
        var id_split= id_selected.split("_");
        var counter= id_split[id_split.length-1];
        JQ("#reduce_amount_"+counter).attr("disabled","true");
        var reduce_amount  = JQ("#increased_amount_"+counter).val();
        var spent_item_id= JQ("#spent_item_id_"+counter).val();
//        alert(spent_item_id);return false;
       param={};
        param.spent_item_id = spent_item_id;  
        param.reduce_amount = reduce_amount;
       JQ.post('get_total_amount_jinsi_nirakshan.php',param,function(res){
        var obj = JSON.parse(res);
//        alert(obj.html);return false;
         JQ("#total_amount_"+counter).val(obj.html);
             });
              
    });
         
         //for inserting ledger
         
     JQ(document).on("click",".check_to",function() {
                           var to = JQ(this).val();
                           var param = {};
			   param.to = to;
                          JQ.post("check_to_ledger.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#show_to").html(obj.html);
                                   JQ("#check_type").val(obj.type);
				});
    });
    
 
 
 
   JQ(document).on("click",".add_more_ledger",function() {
               var num = JQ(".remove_ledger_detail").length;
			   var counter = num+2;
			   var param = {};
			   param.counter = counter;
               JQ.post("get_inserted_ledger.php",param,function(res){
			   var obj = JSON.parse(res);
               JQ("#detail_add_table_ledger").append(obj.html);
               JQ('.select2').select2();
				});
    });
    JQ(document).on("click",".remove_more_ledger",function() {
       // alert("here");
       JQ('.remove_ledger_detail').last().remove();
        
        
    });
    
    JQ(document).on("change","input[name='return_check[]']",function() {
          var id_selected = JQ(this).attr("id");
          var id_split= id_selected.split("_");
          var counter= id_split[id_split.length-1];
          JQ('#returnamt_'+counter).show();
            if(JQ(this).prop('checked')==false)
              {
                   JQ('#returnamt_'+counter).hide();
              } 
    });
    
    //for add kharid ikai rows
     JQ(document).on("click","#btn_add_ikai",function() {
                           var counter = JQ(".remove_ikai_row").length;
                           var param = {};
                           param.counter = counter;
                           JQ.post("get_kharid_ikai_rows.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#ikai-add").append(obj.html);
				});
    });
    
    // for removing kharid ikai rows
    JQ(document).on("click","#btn_deduct_ikai",function() {
                           var counter = JQ(".remove_ikai_row").length;
                           if(counter>1)
                           {
                            JQ(".remove_ikai_row").last().remove();
                           }
                           
    });
    //for prastab and nirnaya
     JQ(document).on("click","#btn_add_prastab",function() {
                           var counter = JQ(".remove_prastab_row").length;
                           var param = {};
                           param.counter = counter;
                           JQ.post("get_prastab_rows.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#prastab-add").append(obj.html);
				});
    });
    
    // for removing kharid ikai rows
    JQ(document).on("click","#btn_deduct_prastab",function() {
                           var counter = JQ(".remove_prastab_row").length;
                           if(counter>1)
                           {
                                JQ(".remove_prastab_row").last().remove();
                           }
                           
    });
    
    //for prastab and nirnaya
     JQ(document).on("click","#btn_add_member",function() {
                           var counter = JQ(".remove_member_row").length;
                           var param = {};
                           param.counter = counter;
                           JQ.post("get_member_rows.php",param,function(res){
				   var obj = JSON.parse(res);
                                   JQ("#member-add").append(obj.html);
				});
    });
    
    // for removing kharid ikai rows
    JQ(document).on("click","#btn_deduct_member",function() {
                           var counter = JQ(".remove_member_row").length;
                           if(counter>1)
                           {
                                JQ(".remove_member_row").last().remove();
                           }
                           
    });
 //ends     
    
    
 //ends       
             
       
         

});

