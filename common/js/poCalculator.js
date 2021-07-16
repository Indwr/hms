
       function calculateAmount() {										   
			var field1 = document.getElementById("quantityy").value;     
			var field2 = document.getElementById("net_pricee").value;

			tot_result = field1 * field2;			
			
			var field3 = document.getElementById("taxx").value; 
			taxRate = field3 / 100;
			tot_result1 = taxRate * tot_result;  
			tot_result2 = tot_result1 + tot_result;  
			
			function formatNumber(num) {
			  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
			}
			
			
			if(tot_result1 == 0){
			taxxxRose = tot_result1;	
			}else{
			taxxxRose = 0;	
			}
			
			if (field3 == 0){
			document.getElementById("amountt").value = tot_result;
			document.getElementById("sub_total").value = tot_result;
			document.getElementById("taxxx").value = taxxxRose;
			} else {
			document.getElementById("amountt").value = tot_result2;
            document.getElementById("taxxx").value = tot_result1;			
			}			
		}

       function calculateAmount2() {										   
			var field1 = document.getElementById("quantityy1").value;     
			var field2 = document.getElementById("net_pricee2").value;

			tot_result = field1 * field2;			
			
			var field3 = document.getElementById("taxx3").value; 
			taxRate = field3 / 100;
			tot_result1 = taxRate * tot_result;  
			tot_result2 = tot_result1 + tot_result;  
			
			function formatNumber(num) {
			  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
			}
			
			if(tot_result1 == 0){
			taxxxRose = tot_result1;	
			}else{
			taxxxRose = 0;	
			}
			
			if (field3 == 0){
			document.getElementById("amountt4").value = tot_result;
			document.getElementById("sub_total2").value = tot_result;
			document.getElementById("taxxx5").value = taxxxRose;
			} else {
			document.getElementById("amountt4").value = tot_result2;
            document.getElementById("taxxx5").value = tot_result1;			
			}			
		}
=
