
            		function selects(cat_name)
            		{  
	                	var ele=document.getElementsByName(cat_name);  
	                	for(var i=0; i<ele.length; i++)
                		{  
		                    if(ele[i].type=='checkbox')  
		                    ele[i].checked=true;  
                		}  
            		}  
            		function deSelect(cat_name)
            		{  
                		var ele=document.getElementsByName(cat_name);  
                		for(var i=0; i<ele.length; i++)
                		{  
                    		if(ele[i].type=='checkbox')  
                        	ele[i].checked=false;  
                        }
                    }             
