
        var div_data_container={};
        function make_table_pagination(ajax_url,ajax_data,table_div_id,data_per_page,search_enable_or_desiable,input_value,type,reload) 
        {

            var buffer_size= buffer_size || 40;
            var current_page= current_page || 1;
            var data_per_page= data_per_page || 10;
            var type= type || 'data';
            var ajax_url= ajax_url || "";
            var pagination_on_click='';
            var table_div_id=table_div_id || 'body';
            var input_value=input_value || '';
            var reload=reload || '';
            var search_enable_or_desiable=search_enable_or_desiable || false;
            var date_filter_enable_desable=date_filter_enable_desable || false;

            var ajax_data_sco=ajax_data;

            var data_of_div={};
            data_of_div['ajax_url']=ajax_url;
            data_of_div['ajax_data']=ajax_data_sco;
            data_of_div['buffer_size']=buffer_size;
            data_of_div['data_per_page']=data_per_page;
            data_of_div['table_div_id']=table_div_id;


            div_data_container[table_div_id]=data_of_div;

            var manage_buffer={
                total_data:{},
                max_page1:0,
                ajax_timeout:'',
                total_length:0,
                data_not_fount:'',
                date_not_found:'',
                search_div_counter:0,
                table_heading_names: new Array(),
                table_coulmn_names:new Array(),
                buffer_size_from_to:new Array(),

        construct:function(fun)
        {
            this.html_fun=fun;
           
        },
        manage_buffer_findPage:function(page)
        {   
          
            var range_from=current_page;
            var range_to=current_page+4;
            var flag=1;
            for (var i = 0; i < 4; i++) 
            {  
                if(page-flag>0)
                {
                    range_from=current_page-flag;
                }
                flag++;
            }
            var buffer_range=new Array();
            buffer_range[0]=range_from;
            buffer_range[1]=range_to;
            return buffer_range;
        },
        manage_buffer_WhetherBufferExists:function(buffer_range)
        {
            var page_not_present= new Array();
            var flag1=0;
            for (var i = buffer_range[0]; i <= buffer_range[1]; i++) 
            {
                if(this.total_data[i]==undefined)
                {
                    page_not_present[flag1]=i;
                    flag1++;
                    if(i==current_page)
                    {

                        $("#loading").show();
                        
                    }

                }   

            }
            return page_not_present;  
        },
        manage_buffer_GetPageRange:function(page_not_present)
        {
            var from=page_not_present[0];
            var to=page_not_present[0];
            if(page_not_present.length>1)
            {
                var from_next=page_not_present[1];   
            }
           
            var flag=0;
            this.buffer_size_from_to[flag]=""+from+""+","+""+to+"";
            for (var i = 1; i <page_not_present.length; i++) 
            {   

                if((to+1)==page_not_present[i])
                {   
                    to=page_not_present[i];
                    from_next=page_not_present[i+1];
                    this.buffer_size_from_to[flag]=""+from+""+","+""+to+"";
                }
                else
                {   
                    flag++;
                    to=from_next;
                    from=from_next;
                    this.buffer_size_from_to[flag]=""+from+""+","+""+to+"";
                    to=page_not_present[i];
                    from_next=page_not_present[i+1];
                }
                
            }
            if(this.buffer_size_from_to[0]!='undefined,undefined')
            {    
                return this.buffer_size_from_to;
               
            }
            else
            {
                this.buffer_size_from_to='undefined';
                return this.buffer_size_from_to;
            }
        },
        manage_buffer_SendAjax:function(ajax_data)
        {
  

            $.ajax({ 
                        type:"POST",
                        async: "false",
                        url:ajax_url,
                        data:ajax_data,
                        dataType: 'json',
                        beforeSend()
                        {
                           
                        },
                        success(data)
                        {    
                            
                           manage_buffer.manage_buffer_AddData(data);
                           $("#loading").hide();

                        },
                        error: function() 
                        {
                            
                            console.log("Error occured!");
                        }
                    }); 
        },
        manage_buffer_AddData:function(response)
        {   
            this.data_not_fount='';
            this.date_not_found='';
            this.table_heading_names=response['table_heading_name'];
            this.table_coulmn_names=response['table_column_name'];
            
            if(!jQuery.isEmptyObject(response['total_data']))
            {
                
                if(response=='Invalid Date or month')
                {   
                    
                    this.date_not_found='date not found';
                    this.max_page1=1;
                }
                else
                {
                  if(current_page==1)
                    {
                        this.total_length=response['total_length'];

                    }
                    var new_total_length=response['total_length'];; 
        
                    if(this.total_length!=new_total_length)
                    {
                        this.total_data={};
                        this.total_length=new_total_length;
                    }
                    for (var key in response['total_data']) 
                    {
                  
                        this.total_data[key] =response['total_data'][key];
                        this.max_page1=response['max_page'];
                        // 
                    }   
                }
                
            }
            else
            {    
                
                $(""+table_div_id+" table tbody").empty();
                if(type=='search' && current_page==1 && jQuery.isEmptyObject(this.total_data))
                {   
                   
                    this.data_not_fount='data not found';
                    
                    this.max_page1=1;
                }
            }
            console.log(type);
            manage_buffer.html_fun(this.max_page1);
           
        }
        };
        var manage_html={
        make_new_pagination:function(max_page)
        {   

            var max_page=max_page;
            var pagi_id=manage_html.make_new_table(current_page);

            $(document).ready(function()
            { 
                $("head").append('<script type="text/javascript" src="/./Pagination-SearchLibrary/pagination1.0/simplePagination.js-master/jquery.simplePagination.js"></script>');
                $("head").append('<link rel="stylesheet" href="/./Pagination-SearchLibrary/pagination1.0/simplePagination.js-master/simplePagination.css">');

                $("#"+pagi_id).pagination(
                {      
                    pages:max_page,
                    cssStyle: 'light-theme',
                    currentPage: current_page,
                    onPageClick: function (page, event) 
                    {

                        
                        current_page=page;

                        manage_buffer.construct(manage_html.make_new_pagination);
                        var buffer_range=manage_buffer.manage_buffer_findPage(current_page);

                        var page_not_present=manage_buffer.manage_buffer_WhetherBufferExists(buffer_range)
                        var get_page_range=manage_buffer.manage_buffer_GetPageRange(page_not_present);
                        
                        ajax_data['buffer_data']=JSON.stringify(get_page_range);
                        console.log(get_page_range);
                        if(get_page_range!='undefined')
                        {
                            manage_buffer.manage_buffer_SendAjax(ajax_data);
                        }
                        pagination_on_click='pagi';

                        manage_html.make_new_table(current_page);    
                    }
                });
            });
            
        },
        make_new_table:function(current_page_new)
        {    


            var tbody_ids=new Array('myTable','myTable1','myTable2','myTable3','myTable4','myTable5');

            var current_page_data=new Array();
            var current_page_data=manage_buffer.total_data[current_page_new];

            var tbody_id=$('tbody');
            var tb_id_name='';
            var pagination_id_name='';
            var id_tbody = [];
            for(var i=0;i<tbody_id.length;i++)
            {
                id_tbody.push(tbody_id[i].id);
            }
        
            console.log(id_tbody); 
            if(id_tbody.length==0)
            {
                tb_id_name='myTable';
                pagination_id_name='pagination_'+tb_id_name;
                
            }
            if(type=='search' ||pagination_on_click=='pagi' || reload=='reload')
            {
                var search_id=$(table_div_id).find('table tbody').attr('id');
                tb_id_name=search_id
                pagination_id_name='pagination_'+tb_id_name; 
           
                
            }
            else
            {
                
               if(type!='search' ||pagination_on_click!='pagi' ||reload=='reload') 
               {


                $.each(tbody_ids ,function (index, value_arr)
                {   
                    var flag=0;
                    $.each(id_tbody ,function (index, value_got)
                    {
                       
                        if(value_arr==value_got)
                        {
                           
                           flag=1;

                        }
                        
                    });

                    if(flag==0)
                    {
                        tb_id_name=value_arr;
                        pagination_id_name='pagination_'+tb_id_name;
                        return false;
                    }
                });
                }
            }

            tth='';
            $.each(manage_buffer.table_heading_names, function(index, value)
            {
                tth+='<th>'+value+'</th>';
            });
            if(manage_buffer.search_div_counter==0)
            {
                var table='<div class="panel-body" ><div class="row search_div" id="search_div"><div class="col-md-6"><div id="date_filter"><button id="today" class="btn btn-primary date_btn" value="today">Today</button> <button id="last_week" class="btn btn-primary date_btn" value="last_week">Last Week</button> <button id="last_month" class="btn btn-primary date_btn" value="last_month">Last Month</button></div></div><div class="col-md-6"><div class="form-group" id="search_id"><input type="input" class="form-control input-lg" id="txt-search" selectd_div='+table_div_id+' placeholder="Filter results"></div></div></div><div style="overflow-x:auto;"><table class="table table-bordered table-custom" id = "tbodyid_data_upcoming"><thead><tr>'+tth+'</tr></thead><tbody id='+tb_id_name+'></tbody></table></div><div id="data_not_found"></div><div class="pagination_page" style="margin-bottom: 50px"><ul id='+pagination_id_name+' class="pagination-lg pull-right"></ul></div></div>';
            }
         
            $("#"+tb_id_name+" tr").remove();
            $("#data_not").remove();
                      if(type!='search' && reload!='reload')
            {
                $(table_div_id).append(table);
            }
            
            var append_data='';
            var tr_id=0;
            $.each(current_page_data ,function (index, value)
            {   
                var ttd='';
                var value_of_id='';
                $.each(manage_buffer.table_coulmn_names, function(index,valueOfColumn)
                {                       
                    

                    if(valueOfColumn=='id')
                    {
                        value_of_id=value[valueOfColumn];
                    }
                    else
                    {
                        ttd+='<td>'+value[valueOfColumn]+'</td>'; 
                    }


                    
                });
                
                append_data+='<tr value='+value_of_id+' id='+tr_id+'>'+ttd+'</tr>';
                tr_id++;
                  
            });
            if(search_enable_or_desiable)
            {
            }
            else
            {
                $(""+table_div_id+" #search_id").remove();
            }
            if(date_filter_enable_desable==false)
            {
                $(""+table_div_id+" #date_filter").remove();
            }

            $('#'+tb_id_name).append(append_data);

            
            if(manage_buffer.data_not_fount)
            {

                $(""+table_div_id+" #data_not_found").append('<div id="data_not" align="center"><h3>Data Not Found</h3> </div>');
            }
            if(manage_buffer.date_not_found)
            {
                $(""+table_div_id+" #data_not_found").append('<div align="center"><h3>Invalid Date or month</h3> </div>');
            }
            manage_buffer.search_div_counter=1;
            return pagination_id_name;

        }};

            manage_buffer.construct(manage_html.make_new_pagination);
            var buffer_range=manage_buffer.manage_buffer_findPage(current_page);

            var page_not_present=manage_buffer.manage_buffer_WhetherBufferExists(buffer_range,current_page)
            var get_page_range=manage_buffer.manage_buffer_GetPageRange(page_not_present);
 
            var ajax_data = ajax_data || {};

                ajax_data["request"]=type;
                ajax_data["buffer_data"]=JSON.stringify(get_page_range);
                ajax_data["data_per_page"]=data_per_page;
                ajax_data["input_value"]=input_value;
             

            if(get_page_range!='undefined')
            {
                
                manage_buffer.manage_buffer_SendAjax(ajax_data,ajax_url);
            } 
        }
        $(document).on("keyup","#txt-search", function() 
        {   

        
            var div_id=$(this).attr('selectd_div');
            var div_data=div_data_container[div_id];
           
            if (this.ajax_timeout !="")
            {

                clearTimeout(this.ajax_timeout);
            }
            var value = $(this).val();

            if (value =="") 
            {   


                    delete div_data['ajax_data'].request;
                    delete div_data['ajax_data'].buffer_data;
                    delete div_data['ajax_data'].data_per_page;
                    delete div_data['ajax_data'].input_value;

                    var type='data';
                    var ajax_url=div_data['ajax_url'];
                    var ajax_data=div_data['ajax_data'];
                    var table_div_id=div_data['table_div_id'];
                    var input_value=value;
                    var data_per_page=div_data['data_per_page'];
                    var search_enable_or_desiable=true;
                    var reload='reload';
                    make_table_pagination(ajax_url,ajax_data,table_div_id,data_per_page,search_enable_or_desiable,input_value,type,reload);
                
                
            }
            else
            {
                this.ajax_timeout = setTimeout(function()
                {   
                    
                    delete div_data['ajax_data'].request;
                    delete div_data['ajax_data'].buffer_data;
                    delete div_data['ajax_data'].data_per_page;
                    delete div_data['ajax_data'].input_value;
                    var type='search';
                    var ajax_url=div_data['ajax_url'];
                    var ajax_data=div_data['ajax_data'];
                    var table_div_id=div_data['table_div_id'];
                    var input_value=value;
                    var data_per_page=div_data['data_per_page'];
                    var search_enable_or_desiable=true;
                    make_table_pagination(ajax_url,ajax_data,table_div_id,data_per_page,search_enable_or_desiable,input_value,type);

                    
                }, 1500);
            }
               
        });




//pagination........