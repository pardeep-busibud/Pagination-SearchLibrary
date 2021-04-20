# Pagination and Search Library

## Introduction
	This library is being used for pagination and for searching data. The library shows data from the database (mock_test_tbl.sql) and shows it in the frontend in a paginated manner. The library is further meant to assist with keyword searches on the data. This allows users to search for a particular record by name, for example.

## Known Issues
	In the search field, we do not get any results if we enter an email address. We need to configure pagination library and search library in such a way that it helps us search using the email address as well.


resolve All Issues in application
## show table Example 
                        $res_here=$val;
		                $res_here['max_page']=$max_page;
		                $res_here['total_length'] =$total_length;
		                $Name=$val['Name'];
		                $Email=$val['Email'];
		                $phoneNum=$val['Phone'];
		                $Gender=$val['Gender'];
		                $res_here['name']=$Name;
		                $res_here['email']=$Email;
		                $res_here['phone']=$phoneNum;
		                $res_here['gender']=$Gender;
		                $response[]=$res_here;   
                        
    ## searching
    
    $keys=array('type','table_name','search_col_name','get_colms','get_id');
	    $value=array(array('string','mock_test_tbl.mock_test_tbl','Name','null as name,id,null as Email,null as phone,null as gender','id'));
    
    
    
    Thnak you 
                        
                        
                        
                        
                        
                        


